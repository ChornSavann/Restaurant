<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
class DashboardControler extends Controller
{
    public function index()
    {
        $orders=Order::all();
        return view('admin.Dashboard.index',compact('orders'));
    }

    public function todayOrders()
    {
        $today = Carbon::today();

        $orders = Order::with('food')
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.Foods.orders.show', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('food')->findOrFail($id);

        return view('admin.Foods.orders.show', compact('order'));
    }
}
