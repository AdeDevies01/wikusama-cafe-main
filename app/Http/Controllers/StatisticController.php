<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        $transaction = Transaction::query();
        return view('statistics.index', [
            'title' => 'Statistik',
            'totalTransaction' => $transaction->count(),
            'totalItemSold' => Order::sum('qty'),
            'totalRevenue' => $transaction->where('is_paid', 1)->sum('total_price'),
            'totalMenu' => Menu::count(),
            'mostSelling' => $this->getMenuReport('DESC', 7),
            'leastSelling' => $this->getMenuReport('ASC', 7),
            'bestCashier' => $this->getCashierReport('DESC', 7),
            'transactionChart' => $this->setTransactionReportChart($this->getTransactionReport()),
            'menuChart' => $this->setMenuReportByDate($this->getMenuReportByDate())
        ]);
    }

    private function getMenuReport($order = 'DESC', $limit = 10)
    {
        return DB::select("
            SELECT r.*, categories.name AS category_name
            FROM menu_report r
            JOIN categories ON categories.id = r.category_id
            ORDER BY total_sold $order
            LIMIT $limit
        ");
    }

    private function getCashierReport($order = 'DESC', $limit = 10)
    {
        return DB::select("
            SELECT * FROM cashier_report
            ORDER BY total_transaction $order, total_revenue $order, name ASC
            LIMIT $limit
        ");
    }

    private function getTransactionReport()
    {
        return DB::table('transaction_report_by_date')
            ->where('date', '>=', date('Y-m-d', strtotime('-1 month')))
            ->orderBy('date', 'ASC')
            ->get();
    }

    private function setTransactionReportChart($data)
    {
        $labels = [];
        $totalTransaction = [];
        $totalRevenue = [];
        foreach ($data as $row) {
            $labels[] = $row->date;
            $totalTransaction[] = $row->total_transaction;
            $totalRevenue[] = $row->total_revenue;
        }

        return [
            'labels' => $labels,
            'totalTransaction' => $totalTransaction,
            'totalRevenue' => $totalRevenue,
        ];
    }

    private function getMenuReportByDate()
    {
        return DB::table('menu_report_by_date')
            ->where('date', '>=', date('Y-m-d', strtotime('-1 month')))
            ->orderBy('date', 'ASC')
            ->get();
    }

    private function setMenuReportByDate($data)
    {
        $labels = [];
        $totalDrinkSold = [];
        $totalFoodSold = [];
        $totalSnackSold = [];
        foreach ($data as $row) {
            $labels[] = $row->date;
            $totalDrinkSold[] = $row->total_drink_sold;
            $totalFoodSold[] = $row->total_food_sold;
            $totalSnackSold[] = $row->total_snack_sold;
        }

        return [
            'labels' => $labels,
            'totalDrinkSold' => $totalDrinkSold,
            'totalFoodSold' => $totalFoodSold,
            'totalSnackSold' => $totalSnackSold,
        ];
    }
}
