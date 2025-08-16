<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Foods;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log as FacadesLog;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('food')->orderBy('id', 'desc')->paginate(7); // paginate 10 per page
        return view('admin.Foods.orders.index', compact('orders'));
    }



    public function item()
    {
        $orders = Order::with('orderItems.food')
            ->orderBy('id', 'desc')
            ->paginate(4);

        return view('admin.Foods.orders.item', compact('orders'));
    }

    // public function store(Request $request)
    // {
    //     // Validate as usual
    //     $validated = $request->validate([
    //         'customer_name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:50',
    //         'address' => 'required|string',
    //         'cart_data' => 'required|json',
    //         'total_amount' => 'required|numeric|min:0',
    //         'customer_pay' => 'required|numeric|min:0',
    //         'customer_change' => 'required|numeric|min:0',
    //         'payment_selected' => 'required|string|in:cash,credit,paypal',
    //         'card_number' => 'nullable|string|max:50',
    //         'expiry' => 'nullable|string|max:10',
    //         'cvc' => 'nullable|string|max:10',
    //     ]);

    //     $cartItems = json_decode($validated['cart_data'], true);

    //     if (empty($cartItems))
    //     {
    //         return response()->json(['success' => false, 'message' => 'Cart cannot be empty'], 422);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $order = Order::create([
    //             'customer_name' => $validated['customer_name'],
    //             'phone' => $validated['phone'],
    //             'address' => $validated['address'],
    //             'total_amount' => $validated['total_amount'],
    //             'customer_pay' => $validated['customer_pay'],
    //             'change_amount' => $validated['customer_change'],
    //             'payment_method' => $validated['payment_selected'],
    //             'card_number' => $request->input('card_number'),
    //             'expiry' => $request->input('expiry'),
    //             'cvc' => $request->input('cvc'),
    //         ]);

    //         foreach ($cartItems as $item)
    //         {
    //             $order->orderItems()->create([
    //                 'food_id' => $item['id'],
    //                 'food_name' => $item['title'],
    //                 'quantity' => $item['qty'],
    //                 'unit_price' => $item['price'],
    //                 'total_price' => $item['price'] * $item['qty'],
    //             ]);
    //         }

    //         DB::commit();

    //         return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    //     }
    //     catch (\Exception $e)
    //     {
    //         DB::rollBack();
    //         return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
    //     }
    // }


    public function store(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'customer_name'     => 'required|string|max:255',
                'phone'             => 'required|string|max:50',
                'address'           => 'required|string',
                'cart_data'         => 'required|json',
                'total_amount'      => 'required|numeric|min:0',
                'customer_pay'      => 'required|numeric|min:0',
                'payment_selected'  => 'required|string|in:cash,credit,paypal',
                'card_number'       => 'required_if:payment_selected,credit|nullable|string',
                'expiry'            => 'required_if:payment_selected,credit|nullable|string',
                'cvc'               => 'required_if:payment_selected,credit|nullable|string',
            ]);

            // Decode cart data
            $cart = json_decode($validated['cart_data'], true);
            if (!$cart || !is_array($cart) || count($cart) === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty or invalid.'
                ], 422);
            }

            // Calculate change amount on server
            $changeAmount = max(0, $validated['customer_pay'] - $validated['total_amount']);

            // Create order
            $order = Order::create([
                'customer_name'  => $validated['customer_name'],
                'phone'          => $validated['phone'],
                'address'        => $validated['address'],
                'total_amount'   => $validated['total_amount'],
                'customer_pay'   => $validated['customer_pay'],
                'change_amount'  => $changeAmount,
                'payment_method' => $validated['payment_selected'],
                'card_number'    => $validated['card_number'] ?? null,
                'expiry'         => $validated['expiry'] ?? null,
                'cvc'            => $validated['cvc'] ?? null,
            ]);

            // Save order items
            foreach ($cart as $item) {
                $order->items()->create([
                    'food_id' => $item['id'] ?? null,
                    'title'   => $item['title'] ?? '',
                    'price'   => $item['price'] ?? 0,
                    'qty'     => $item['qty'] ?? 1,
                    'image'   => $item['image'] ?? null,
                ]);
            }

            return response()->json([
                'success'  => true,
                'message'  => 'Order placed successfully!',
                'order_id' => $order->id
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Order store failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.'
            ], 500);
        }
    }







    // public function store(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'customer_name'=>'required|string|max:255',
    //             'phone'=>'required|string|max:50',
    //             'address'=>'required|string',
    //             'cart_data'=>'required|json',
    //             'total_amount'=>'required|numeric|min:0',
    //             'customer_pay'=>'required|numeric|min:0',
    //             'customer_change'=>'required|numeric|min:0',
    //             'payment_selected'=>'required|string',
    //             'card_number'=>'nullable|required_if:payment_selected,credit',
    //             'expiry'=>'nullable|required_if:payment_selected,credit',
    //             'cvc'=>'nullable|required_if:payment_selected,credit',
    //         ]);

    //         if($validator->fails()){
    //             return response()->json(['success'=>false,'errors'=>$validator->errors()],422);
    //         }

    //         $order = Order::create([
    //             'customer_name'=>$request->customer_name,
    //             'phone'=>$request->phone,
    //             'address'=>$request->address,
    //             'cart_data'=>$request->cart_data,
    //             'total_amount'=>$request->total_amount,
    //             'customer_pay'=>$request->customer_pay,
    //             'customer_change'=>$request->customer_change,
    //             'payment_selected'=>$request->payment_selected,
    //         ]);

    //         return response()->json(['success'=>true,'message'=>'Order placed successfully!','order_id'=>$order->id]);

    //     } catch (\Exception $e){
    //         Log::error('Order store failed: '.$e->getMessage());
    //         return response()->json(['success'=>false,'message'=>'An unexpected error occurred.'],500);
    //     }
    // }

}
