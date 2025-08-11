<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('food')->paginate(10); // adjust pagination
        return view('admin.Foods.orders.index', compact('orders'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_id' => 'required|exists:food,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $food = Foods::findOrFail($validated['food_id']);
        $totalPrice = $food->price * $validated['quantity'];

        $order = Order::create([
            'food_id' => $validated['food_id'],
            'food_name' => $food->title,
            'quantity' => $validated['quantity'],
            'image' => $food->image,
            'notes' => $validated['notes'] ?? null,
            'total_price' => $totalPrice,
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            // order_number is auto-generated in the model
        ]);

        return redirect()->back()->with('success', 'Order placed successfully! Total: $' . number_format($totalPrice, 2));
    }
}
