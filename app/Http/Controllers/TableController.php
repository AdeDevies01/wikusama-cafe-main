<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Transaction;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TableController extends Controller
{
    public function index()
    {
        return view('tables.index', [
            'title' => 'Meja',
            'tables' => Table::options(request(['q', 'sortby', 'order']))->paginate(is_numeric(request('limit', 10)) ? request('limit', 10) : 10),
            'sortables' => Table::$sortables
        ]);
    }

    public function store(StoreTableRequest $request)
    {
        Table::create($request->validated());

        $this->storeActivityLog('create', 'Menambahkan meja nomor ' . $request->number);

        return back()->with('success', 'Meja berhasil ditambahkan!');
    }

    public function edit(Table $table)
    {
        return view('tables.edit', [
            'title' => 'Ubah Meja',
            'table' => $table
        ]);
    }

    public function update(UpdateTableRequest $request, Table $table)
    {
        $table->update($request->validated());

        $this->storeActivityLog('update', 'Mengubah meja nomor ' . $table->number);

        return redirect($request->previous_url ?? route('tables.index'))->with('success', 'Menu berhasil diubah!');
    }

    public function destroy(Table $table)
    {
        if (!$table) {
            return back()->with('error', 'Meja tidak ditemukan!');
        }

        if (Transaction::where('table_id', $table->id)->exists()) {
            return back()->with('error', 'Meja tidak dapat dihapus karena memiliki transaksi!');
        }

        $table->delete();

        $this->storeActivityLog('delete', 'Menghapus meja nomor ' . $table->number);

        return back()->with('success', 'Meja berhasil dihapus!');
    }

    public function editStatus() {
        return view('tables.edit-status', [
            'title' => 'Perbarui Status Meja',
            'tables' => Table::options(request(['q', 'sortby', 'order', 'is_available']))->paginate(is_numeric(request('limit', 10)) ? request('limit', 10) : 10),
            'sortables' => Table::$sortables
        ]);
    }

    public function updateStatus(Request $request, Table $table)
    {
        if (!$table) {
            return back()->with('error', 'Meja tidak ditemukan!');
        }

        if ($request->is_available == 'on') {
            $table->update(['is_available' => true]);
        } else {
            $table->update(['is_available' => false]);
        }

        $this->storeActivityLog('update', 'Mengubah status meja nomor ' . $table->number);

        return back()->with('success', 'Status meja berhasil diperbarui!');
    }
}
