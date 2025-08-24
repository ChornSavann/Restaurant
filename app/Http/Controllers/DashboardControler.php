<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Foods;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // make sure you import

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
        $todayOrders = Order::with(['customer', 'orderItems.food'])
            ->whereDate('created_at', Carbon::today())
            ->paginate(4);


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
            'todayOrders',
           

        ));
    }

    // public function print($id)
    // {
    //     $order = Order::with('orderItems.food')->findOrFail($id);

    //     // $order = Order::with('orderItems.food')->findOrFail($id);

    //     $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));

    //     return $pdf->download('invoice_' . $order->id . '.pdf');
    // }



    public function todayOrders()
    {
        // Get today's date
        $today = Carbon::today();

        // Fetch pending orders created today, with related foods
        $orders = Order::with('orderItems.food')
            ->where('status', 'pending')
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass orders to view
        return view('admin.Foods.orders.show', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::with('food')->findOrFail($id);

        return view('admin.Foods.orders.show', compact('order'));
    }

    public function salesReport()
    {
        $totalSales = Order::sum('total_amount');
        $lastYearSales = Order::whereYear('created_at', now()->year - 1)->sum('total_amount');

        $change_amount = ($lastYearSales > 0)
            ? (($totalSales - $lastYearSales) / $lastYearSales) * 100
            : 0;

        return view('admin.report.Salereport', compact('totalSales', 'lastYearSales', 'change_amount'));
    }

}
