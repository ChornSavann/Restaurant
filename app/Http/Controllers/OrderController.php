<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Foods;
use App\Models\Order;
use App\Models\orderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function store(Request $request)
    {
        // Validate as usual
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
            'cart_data' => 'required|json',
            'total_amount' => 'required|numeric|min:0',
            'customer_pay' => 'required|numeric|min:0',
            'customer_change' => 'required|numeric|min:0',
            'payment_selected' => 'required|string|in:cash,credit,paypal',
            'card_number' => 'nullable|string|max:50',
            'expiry' => 'nullable|string|max:10',
            'cvc' => 'nullable|string|max:10',
        ]);

        $cartItems = json_decode($validated['cart_data'], true);

        if (empty($cartItems))
        {
            return response()->json(['success' => false, 'message' => 'Cart cannot be empty'], 422);
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'total_amount' => $validated['total_amount'],
                'customer_pay' => $validated['customer_pay'],
                'change_amount' => $validated['customer_change'],
                'payment_method' => $validated['payment_selected'],
                'card_number' => $request->input('card_number'),
                'expiry' => $request->input('expiry'),
                'cvc' => $request->input('cvc'),
            ]);

            foreach ($cartItems as $item)
            {
                $order->orderItems()->create([
                    'food_id' => $item['id'],
                    'food_name' => $item['title'],
                    'quantity' => $item['qty'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['price'] * $item['qty'],
                ]);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
        }
    }

}
