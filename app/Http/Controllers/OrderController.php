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
    // public function index()
    // {
    //     $orders = Order::with('food')->orderBy('id', 'desc')->paginate(7); // paginate 10 per page
    //     return view('admin.Foods.orders.index', compact('orders'));
    // }

    // public function item()
    // {
    //     $orders = Order::with('orderItems.food')
    //         ->orderBy('id', 'desc')
    //         ->paginate(4);

    //     return view('admin.Foods.orders.item', compact('orders'));
    // }

    // // public function store(Request $request)
    // // {
    // //     // Validate as usual
    // //     $validated = $request->validate([
    // //         'customer_name' => 'required|string|max:255',
    // //         'phone' => 'required|string|max:50',
    // //         'address' => 'required|string',
    // //         'cart_data' => 'required|json',
    // //         'total_amount' => 'required|numeric|min:0',
    // //         'customer_pay' => 'required|numeric|min:0',
    // //         'customer_change' => 'required|numeric|min:0',
    // //         'payment_selected' => 'required|string|in:cash,credit,paypal',
    // //         'card_number' => 'nullable|string|max:50',
    // //         'expiry' => 'nullable|string|max:10',
    // //         'cvc' => 'nullable|string|max:10',
    // //     ]);

    // //     $cartItems = json_decode($validated['cart_data'], true);

    // //     if (empty($cartItems))
    // //     {
    // //         return response()->json(['success' => false, 'message' => 'Cart cannot be empty'], 422);
    // //     }

    // //     DB::beginTransaction();

    // //     try {
    // //         $order = Order::create([
    // //             'customer_name' => $validated['customer_name'],
    // //             'phone' => $validated['phone'],
    // //             'address' => $validated['address'],
    // //             'total_amount' => $validated['total_amount'],
    // //             'customer_pay' => $validated['customer_pay'],
    // //             'change_amount' => $validated['customer_change'],
    // //             'payment_method' => $validated['payment_selected'],
    // //             'card_number' => $request->input('card_number'),
    // //             'expiry' => $request->input('expiry'),
    // //             'cvc' => $request->input('cvc'),
    // //         ]);

    // //         foreach ($cartItems as $item)
    // //         {
    // //             $order->orderItems()->create([
    // //                 'food_id' => $item['id'],
    // //                 'food_name' => $item['title'],
    // //                 'quantity' => $item['qty'],
    // //                 'unit_price' => $item['price'],
    // //                 'total_price' => $item['price'] * $item['qty'],
    // //             ]);
    // //         }

    // //         DB::commit();

    // //         return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    // //     }
    // //     catch (\Exception $e)
    // //     {
    // //         DB::rollBack();
    // //         return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
    // //     }
    // // }



    // public function store(Request $request)
    // {
    //     // Validate required fields
    //     $validated = $request->validate([
    //         'customer_name'    => 'required|string|max:255',
    //         'phone'            => 'required|string|max:50',
    //         'address'          => 'required|string',
    //         'cart_data'        => 'required|json',
    //         'total_amount'     => 'required|numeric|min:0',
    //         'customer_pay'     => 'required|numeric|min:0',
    //         'customer_change'  => 'required|numeric|min:0',
    //         'payment_selected' => 'required|string|in:cash,credit,paypal',
    //         'card_number'      => 'nullable|string|max:50',
    //         'expiry'           => 'nullable|string|max:10',
    //         'cvc'              => 'nullable|string|max:10',
    //     ]);

    //     // Decode cart JSON
    //     $cartItems = json_decode($validated['cart_data'], true);

    //     if (empty($cartItems)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Cart cannot be empty'
    //         ], 422);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // Create order
    //         $order = Order::create([
    //             'customer_name'  => $validated['customer_name'],
    //             'phone'          => $validated['phone'],
    //             'address'        => $validated['address'],
    //             'total_amount'   => $validated['total_amount'],
    //             'customer_pay'   => $validated['customer_pay'],
    //             'change_amount'  => $validated['customer_change'],
    //             'payment_method' => $validated['payment_selected'],
    //             'card_number'    => $validated['card_number'] ?? null,
    //             'expiry'         => $validated['expiry'] ?? null,
    //             'cvc'            => $validated['cvc'] ?? null,
    //         ]);

    //         // Create order items
    //         $createdItems = [];
    //         foreach ($cartItems as $item) {
    //             $orderItem = $order->orderItems()->create([
    //                 'food_id'     => $item['id'],
    //                 'food_name'   => $item['name'],      // must match your JS key
    //                 'quantity'    => $item['quantity'],  // must match your JS key
    //                 'unit_price'  => $item['price'],
    //                 'total_price' => $item['price'] * $item['quantity'],
    //             ]);
    //             $createdItems[] = $orderItem;
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'order_id' => $order->id,
    //             'items'    => $createdItems
    //         ], 200);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to place order',
    //             'error'   => $e->getMessage()
    //         ], 500);
    //     }
    // }


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


            $order = Order::create([
                'customer_id' => $customer->id,
                'total_amount' => $request->total_amount,
                'payment_method' => $request->payment_selected,
                'customer_pay' => $request->customer_pay,
                'customer_change' => $request->customer_change,
                'status' => 'pending',
                'order_number' => 'OR' . rand(1000, 9999) // or a better generator
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

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }


    public function storeHome(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::updateOrCreate(
                ['phone' => $request->phone],
                ['name' => $request->customer_name, 'address' => $request->address]
            );


            $order = Order::create([
                'customer_id' => $customer->id,
                'total_amount' => $request->total_amount,
                'payment_method' => $request->payment_selected,
                'customer_pay' => $request->customer_pay,
                'customer_change' => $request->customer_change,
                'status' => 'pending',
                'order_number' => 'OR' . rand(1000, 9999) // or a better generator
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
