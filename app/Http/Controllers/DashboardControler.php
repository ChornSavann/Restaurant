<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardControler extends Controller
{

    public function salesData(Request $request)
    {
        // Adjust table/column names to match your schema:
        // Assuming orders table with column "total_amount" and timestamps "created_at"
        $rows = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json(['data' => $rows]);
    }

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
        $salesData = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
        ->groupBy('month') 
        ->orderBy('month')
        ->get();

    // Convert month numbers to short month names
    $months = $salesData->pluck('month')->map(function ($m) {
        return date('M', mktime(0, 0, 0, $m, 1));
    });

    $totals = $salesData->pluck('total');

        return view('admin.Dashboard.index', compact(
            'orders',
            'user',
            'userCount',
            'totalSales',
            'orderCount',
            'foodCount',
            'users',
            'todayfoods',
            'foodCounttoday',
            'salesData',
            'months',
            'totals',
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
