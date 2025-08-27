<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderItem;

use App\Models\Foods;
use App\Models\Reservation;
use App\Models\Stocks;

class Reportcontroller extends Controller
{
    // public function salesReport(Request $request)
    // {
    //     $start = $request->input('start_date', Carbon::today()->toDateString());
    //     $end   = $request->input('end_date', Carbon::today()->toDateString());

    //     $query = Order::with('customer', 'orderItems.food')
    //         ->whereBetween('created_at', [$start, $end]);

    //     $orders = $query->get();
    //     $totalAmount = $orders->sum('total_amount');
    //     $totalOrders = $orders->count();

    //     return view('admin.report.index', compact('orders', 'totalAmount', 'totalOrders', 'start', 'end', ));
    // }
    public function salesReport(Request $request)
    {
        $start = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))->startOfDay()
            : Carbon::today()->startOfDay();

        $end = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->endOfDay()
            : Carbon::today()->endOfDay();

        $query = Order::with('customer', 'orderItems.food')
            ->whereBetween('created_at', [$start, $end]);

        $orders = $query->get();
        $totalAmount = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        return view('admin.report.index', compact('orders', 'totalAmount', 'totalOrders', 'start', 'end'));
    }

    public function foods()
    {
        // Foods sold count
        $topFoods = OrderItem::with('food')
            ->selectRaw('food_id, SUM(quantity) as total_qty')
            ->groupBy('food_id')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        // Foods never sold
        $unsoldFoods = Foods::whereDoesntHave('orderItems')->get();

        return view('admin.report.food', compact('topFoods', 'unsoldFoods'));
    }

    public function customer()
    {
        // Customers with reservations
        $reservedCustomers = Customer::has('reservations')->get();
        // Top customers by order count
        $topCustomers = Order::selectRaw('customer_id, COUNT(*) as total_orders, SUM(total_amount) as total_spent')
            ->groupBy('customer_id')
            ->with('customer')
            ->orderByDesc('total_orders')
            ->take(10)
            ->get();
        return view('admin.report.customer', compact(
            'reservedCustomers',
            'topCustomers',

        ));
    }

    public function stock()
    {
        // Current stock
        $stocks = Stocks::all();

        // Stock in vs out (assume model has in_qty, out_qty)
        $stockSummary = [
            'in' => $stocks->sum('in_qty'),
            'out' => $stocks->sum('out_qty'),
            'remain' => $stocks->sum('quantity')
        ];

        return view('admin.report.stock', compact('stocks', 'stockSummary'));
    }
}
