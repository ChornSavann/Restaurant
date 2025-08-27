<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\Foods;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\OrderItem;
use App\Models\Stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
                'order_number'   => 'OR' . rand(1000, 9999) //
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

    // public function storediscount(Request $request)
    // {
    //     $request->validate([
    //         'food_id'     => 'required|exists:foods,id',
    //         'discount_id' => 'nullable|exists:discounts,id',
    //         'quantity'    => 'required|integer|min:1',
    //         'payment_method' => 'required|in:cash,card',
    //         'customer_pay'   => 'nullable|numeric|min:0',
    //         'card_number'    => 'nullable|string|max:20',
    //         'expiry'         => 'nullable|string|max:10',
    //         'cvc'            => 'nullable|string|max:5',
    //     ]);

    //     // 🔹 Find food
    //     $food = Foods::findOrFail($request->food_id);

    //     // 🔹 Apply discount if available
    //     $price = $food->price;
    //     if ($request->discount_id) {
    //         $discount = Discount::find($request->discount_id);

    //         if ($discount && $discount->food_id == $food->id) {
    //             $price = $price - ($price * $discount->discount_percent / 100);
    //         }
    //     }

    //     // 🔹 Total amount
    //     $totalAmount = $price * $request->quantity;

    //     // 🔹 Payment
    //     $customerPay = $request->payment_method === 'cash' ? $request->customer_pay : $totalAmount;
    //     $changeAmount = $customerPay - $totalAmount;

    //     // 🔹 Generate order number
    //     $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

    //     // 🔹 Save order
    //     $order = Order::create([
    //         'order_number'  => $orderNumber,
    //         'customer_id'   => Auth::id() ?? null, // optional
    //         'total_amount'  => $totalAmount,
    //         'customer_pay'  => $customerPay,
    //         'change_amount' => $changeAmount >= 0 ? $changeAmount : 0,
    //         'payment_method'=> $request->payment_method,
    //         'card_number'   => $request->payment_method === 'card' ? $request->card_number : null,
    //         'expiry'        => $request->payment_method === 'card' ? $request->expiry : null,
    //         'cvc'           => $request->payment_method === 'card' ? $request->cvc : null,
    //         'status'        => 'pending',
    //     ]);

    //     return redirect()->back()->with('success', 'Order placed successfully! Order No: ' . $order->order_number);
    // }

    public function storediscount(Request $request)
    {
        // 🔹 Validation
        $request->validate([
            'food_id'          => 'required|exists:food,id',
            'discount_id'      => 'nullable|exists:discounts,id',
            'quantity'         => 'required|integer|min:1',
            'payment_method'   => 'required|in:cash,card',
            'customer_pay'     => 'nullable|numeric|min:0',
            'card_number'      => 'nullable|string|max:20',
            'expiry'           => 'nullable|string|max:10',
            'cvc'              => 'nullable|string|max:5',
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'nullable|string|max:20',
            'customer_address' => 'nullable|string|max:255',
        ]);

        // 🔹 Save or update customer
        $customer = Customer::updateOrCreate(
            ['phone' => $request->customer_phone],
            [
                'name'    => $request->customer_name,
                'address' => $request->customer_address
            ]
        );

        // 🔹 Find food
        $food = Foods::with('stocks')->findOrFail($request->food_id);

        // 🔹 Check stock
        if ($food->stocks->quantity < $request->quantity) {
            return back()->with('error', "Not enough stock for {$food->title}. Available: {$food->stocks->quantity}");
        }

        // 🔹 Calculate price
        $price = $food->price;
        if ($request->discount_id)
        {
            $discount = Discount::find($request->discount_id);
            if ($discount && $discount->food_id == $food->id)
            {
                $price -= ($price * $discount->discount_percent / 100);
            }
        }

        // 🔹 Total amount
        $totalAmount = $price * $request->quantity;

        // 🔹 Payment handling
        if ($request->payment_method === 'cash')
        {
            $customerPay = $request->customer_pay ?? 0;
            if ($customerPay < $totalAmount)
            {
                return back()->with('error', 'Customer did not pay enough. Total: $' . number_format($totalAmount, 2));
            }
            $changeAmount = $customerPay - $totalAmount;
        }
        else
        {
            // Card Payment → exact amount
            $customerPay = $totalAmount;
            $changeAmount = 0;
        }

        // 🔹 Generate order number
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // 🔹 Save Order
        $order = Order::create([
            'order_number'   => $orderNumber,
            'customer_id'    => $customer->id,
            'food_id'        => $food->id,
            'discount_id'    => $request->discount_id,
            'quantity'       => $request->quantity,
            'price'          => $price,
            'total_amount'   => $totalAmount,
            'customer_pay'   => $customerPay,
            'change_amount'  => $changeAmount,
            'payment_method' => $request->payment_method,
            'card_number'    => $request->payment_method === 'card' ? $request->card_number : null,
            'expiry'         => $request->payment_method === 'card' ? $request->expiry : null,
            'cvc'            => $request->payment_method === 'card' ? $request->cvc : null,
            'status'         => 'pending',
        ]);

        // 🔹 Reduce stock
        $food->stocks->decrement('quantity', $request->quantity);

        return redirect()->back()->with('success', '✅ Order placed successfully! Order No: ' . $order->order_number);
    }

}
