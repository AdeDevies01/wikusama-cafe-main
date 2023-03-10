<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Table;
use App\Models\Order;
use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index', [
            'title' => 'Riwayat Pesanan',
            'transactions' => Transaction::where('cashier_id', auth()->user()->id)->with('table')->options(request(['q', 'sortby', 'order', 'is_paid', 'start_date', 'end_date']))->paginate(is_numeric(request('limit', 10)) ? request('limit', 10) : 10),
            'sortables' => Transaction::$sortables,
        ]);
    }

    public function indexManager()
    {
        return view('transactions.index-manager', [
            'title' => 'Riwayat Transaksi',
            'transactions' => Transaction::with(['table', 'cashier'])->options(request(['q', 'sortby', 'order', 'is_paid', 'cashier_id', 'start_date', 'end_date']))->paginate(is_numeric(request('limit', 10)) ? request('limit', 10) : 10),
            'cashiers' => User::where('role', 'cashier')->orderBy('name')->get(),
            'sortables' => Transaction::$sortables,
        ]);
    }

    public function create()
    {
        return view('transactions.create', [
            'title' => 'Input Pesanan',
            'menus' => Menu::with('category')->orderBy('name')->get(),
            'categories' => Category::all(),
            'sortables' => Menu::$sortable,
            'tables' => Table::orderBy('is_available', 'desc')->orderBy('number')->get(),
        ]);
    }

    public function store(StoreTransactionRequest $request)
    {
        $validated_data = $request->validated();
        $orderedMenus = json_decode($validated_data['orderedMenus'], true);

        $priceTotal = 0;
        foreach ($orderedMenus as $orderedMenu) {
            $priceTotal += $orderedMenu['price'] * $orderedMenu['qty'];
        }

        $transaction = Transaction::create([
            'cashier_id' => auth()->user()->id,
            'table_id' => $validated_data['table_id'],
            'total_price' => $priceTotal,
            'customer_name' => $validated_data['customer_name'],
            'note' => $validated_data['note'],
            'is_delivered' => true,
        ]);

        foreach ($orderedMenus as $menu) {
            Order::create([
                'transaction_id' => $transaction->id,
                'menu_id' => $menu['id'],
                'qty' => $menu['qty'],
            ]);
        }

        Table::find($validated_data['table_id'])->update([
            'is_available' => false,
        ]);

        $this->storeActivityLog('create', 'Membuat pesanan baru dengan ID ' . $transaction->id);

        return back()->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show(Transaction $transaction)
    {
        if (auth()->user()->role == 'cashier') {
            $this->checkTransactionCashier($transaction);
        }
        return view('transactions.show', [
            'title' => 'Detail Transaksi',
            'transaction' => $transaction->load('cashier', 'table', 'orders.menu'),
        ]);
    }

    public function showInvoice(Transaction $transaction)
    {
        $this->checkTransactionCashier($transaction);

        if (!$transaction->is_paid) {
            return abort(404);
        }

        return view('transactions.print', [
            'transaction' => $transaction->load('table', 'orders.menu', 'cashier'),
        ]);
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        if ($transaction->is_paid) {
            return back()->with('error', 'Pesanan yang sudah dibayar, tidak dapat diubah');
        }

        $validated_data = $request->validated();

        if ($validated_data['total_payment'] < $transaction->total_price) {
            return back()->with('error', 'Jumlah yang dibayar kurang');
        }

        $transaction->update([
            'total_payment' => $validated_data['total_payment'],
            'is_paid' => true,
        ]);

        if ($validated_data['update_table_status'] ?? false) {
            Table::find($transaction->table_id)->update([
                'is_available' => true,
            ]);
        }

        $this->storeActivityLog('update', 'Mengubah status pembayaran pesanan dengan ID ' . $transaction->id);

        $return = [
            'invoice_url' => route('transactions.print', $transaction->id),
            'message' => 'Kembalian: Rp ' . number_format($validated_data['total_payment'] - $transaction->total_price, 0, ',', '.'),
        ];
        return back()->with('paymentSuccess', $return);
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->is_paid) {
            return back()->with('error', 'Pesanan sudah yang dibayar, tidak dapat dihapus');
        }
        $transaction->delete();

        $this->storeActivityLog('delete', 'Menghapus pesanan dengan ID ' . $transaction->id);

        return back()->with('success', 'Pesanan berhasil dihapus');
    }

    private function checkTransactionCashier(Transaction $transaction)
    {
        if ($transaction->cashier_id != auth()->user()->id) {
            return abort(404);
        }
    }
}
