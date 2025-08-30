<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function foods(Request $request)
    {
        $search = $request->search;
        $category = $request->category;

        // load all categories for filter dropdown
        $categories = Category::all();

        // Foods sold count
        $topFoods = OrderItem::with(['food.stocks'])
            ->selectRaw('food_id, SUM(quantity) as total_qty')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('food', function ($q2) use ($search) {
                    $q2->where('title', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($q) use ($category) {
                $q->whereHas('food', function ($q2) use ($category) {
                    $q2->where('category_id', $category);
                });
            })
            ->groupBy('food_id')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        // Foods never sold
        $stocks = Stocks::all();

        // Total Sale
        $totalSale = $topFoods->sum('total_qty');

        // Total Stock
        $totalStock = $topFoods->sum(function ($item) {
            return optional($item->food->stocks)->quantity ?? 0;
        });

        return view('admin.report.food', compact('topFoods', 'stocks', 'totalSale', 'totalStock', 'categories'));
    }




    public function customer(Request $request)
    {
        $categories = Category::all();

        $query = Order::selectRaw('customer_id, COUNT(*) as total_orders, SUM(total_amount) as total_spent')
            ->with('customer')
            ->groupBy('customer_id')
            ->orderByDesc('total_orders');

        // 🔎 Search by customer name / phone
        if ($request->search) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // 📂 Filter by category
        if ($request->category) {
            $query->whereHas('items', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        $topCustomers = $query->get();
        return view('admin.report.customer', compact('topCustomers', 'categories'));
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
