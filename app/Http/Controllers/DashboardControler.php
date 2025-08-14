<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardControler extends Controller
{

    public function index()
    {
        $orders = Order::all();
        $userCount = User::count(); // ចំនួន Users ពិត
        $totalSales = Order::sum('total_amount');
        $orderCount = Order::count();
        $foodCount = Foods::count();
        $user = Auth::user();
        $users = User::all();
        $foodCounttoday = Foods::whereDate('created_at', Carbon::today())->count();
        $todayfoods = Foods::whereDate('created_at', Carbon::today())->get(); // products added today

        return view('admin.Dashboard.index', compact(
            'orders',
            'user',
            'userCount',
            'totalSales',
            'orderCount',
            'foodCount',
            'users',
            'todayfoods',
            'foodCounttoday'
        ));
    }

    public function todayOrders()
    {
        $today = Carbon::today();

        $orders = Order::with('orderItems.food')
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
