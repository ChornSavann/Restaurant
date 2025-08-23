<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Foods;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\OrderItem;
use App\Models\Stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log as FacadesLog;

class OrderController extends Controller
{



    public function index()
    {
        $foods = Foods::whereHas('stocks', function ($q) {
            $q->where('quantity', '>', 0);
        })->with('stocks')->get();

        return view('admin.orders.index', compact('foods'));
    }



    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::updateOrCreate(
                ['phone' => $request->phone],
                ['name' => $request->customer_name, 'address' => $request->address]
            );


            $totalAmount   = $request->total_amount;
            $customerPay   = $request->customer_pay;
            $changeAmount  = $customerPay - $totalAmount; // calculate here

            $order = Order::create([
                'customer_id'    => $customer->id,
                'total_amount'   => $totalAmount,
                'payment_method' => $request->payment_selected,
                'customer_pay'   => $customerPay,
                'change_amount'  => $changeAmount, // calculated, never null
                'status'         => 'pending',
                'order_number'   => 'OR' . rand(1000, 9999)
            ]);


            $cart = json_decode($request->cart_data, true);

            foreach ($cart as $item) {
                $food = Foods::with('stocks')->findOrFail($item['id']);
                $stock = $food->stocks; // get the stock relation

                if ($stock->quantity < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$food->title}");
                }

                // Decrease stock
                $stock->quantity -= $item['quantity'];
                $stock->save();

                // Save order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id' => $food->id,
                    'food_name' => $food->title,
                    'quantity' => $item['quantity'],
                    'unit_price' => $food->price,
                    'total_price' => $food->price * $item['quantity']
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Order placed successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show()
    {
        $orders = Order::with('customer', 'items')->latest()->paginate(8);
        return view('admin.orders.show', compact('orders'));
    }

    // public function updateStatus($id)
    // {
    //     $order = Order::findOrFail($id);
    //     $order->status = 'completed';
    //     $order->save();

    //     return redirect()->back()->with('success', 'Order status updated successfully.');
    // }


    public function storeHome(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::updateOrCreate(
                ['phone' => $request->phone],
                ['name' => $request->customer_name, 'address' => $request->address]
            );


            $totalAmount   = $request->total_amount;
            $customerPay   = $request->customer_pay;
            $changeAmount  = $customerPay - $totalAmount; // calculate here

            $order = Order::create([
                'customer_id'    => $customer->id,
                'total_amount'   => $totalAmount,
                'payment_method' => $request->payment_selected,
                'customer_pay'   => $customerPay,
                'change_amount'  => $changeAmount, // calculated, never null
                'status'         => 'pending',
                'order_number'   => 'OR' . rand(1000, 9999)
            ]);

            $cart = json_decode($request->cart_data, true);

            foreach ($cart as $item) {
                $food = Foods::with('stocks')->findOrFail($item['id']);
                $stock = $food->stocks; // get the stock relation

                if ($stock->quantity < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$food->title}");
                }

                // Decrease stock
                $stock->quantity -= $item['quantity'];
                $stock->save();

                // Save order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id' => $food->id,
                    'food_name' => $food->title,
                    'quantity' => $item['quantity'],
                    'unit_price' => $food->price,
                    'total_price' => $food->price * $item['quantity']
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Order placed successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
