<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\Customer;
use App\Models\deliveries;
use App\Models\Foods;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $customers  = Customer::all();
        $orders     = Order::all();
        $deliveries = Delivery::with(['customer', 'order.food'])->paginate(10);
        return view('admin.delivery.index', compact('customers', 'orders', 'deliveries'));
    }

    public function getCustomerOrders(Customer $customer)
    {
        $orders = $customer->orders()->where('status', 'pending')->get();
        return response()->json($orders);
    }

    public function create()
    {
        // Only get customers who have at least one pending order
        $customers = Customer::whereHas('orders', function ($query) {
            $query->where('status', 'pending');
        })->get();

        $orders = Order::where('status', 'pending')->get();
        return view('admin.delivery.create', compact('customers', 'orders'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'      => 'required|exists:customers,id',
            'order_id'         => 'required|exists:orders,id',
            'delivery_address' => 'required|string|max:255',
            'delivery_status'  => 'required|in:Pending,In Transit,Delivered,Cancelled',
            'delivery_date'    => 'required|date',
            'delivery_time'    => 'nullable|date_format:H:i',
        ]);

        // Create Delivery
        $delivery = Delivery::create($validated);

        // Update corresponding Order status automatically
        $order = Order::find($validated['order_id']);
        if ($order) {
            if ($delivery->delivery_status == 'Delivered') {
                $order->status = 'completed';
            } elseif ($delivery->delivery_status == 'Cancelled') {
                $order->status = 'cancelled';
            } else {
                $order->status = 'pending'; // or 'in progress'
            }
            $order->save();
        }

        return redirect()->route('delivery.index')->with('success','Create delivery successfully...');
    }
    // Show edit form
    public function edit($id)
    {
        $delivery  = Delivery::findOrFail($id);
        $customers = Customer::all();
        $orders    = Order::all();

        return view('admin.delivery.edit', compact('delivery', 'customers', 'orders'));
    }

    // Update delivery
    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);

        $validated = $request->validate([
            'delivery_status'  => 'required|in:Pending,In Transit,Delivered,Cancelled',
            'delivery_address' => 'required|string|max:255',
            'delivery_date'    => 'required|date',
            'delivery_time'    => 'nullable|date_format:H:i',
            'customer_id'      => 'required|exists:customers,id',
            'order_id'         => 'required|exists:orders,id',
        ]);

        // Update Delivery
        $delivery->update($validated);

        // Automatically update Order status based on Delivery status
        $order = $delivery->order; // assumes relation exists
        if ($order) {
            if ($delivery->delivery_status == 'Delivered') {
                $order->status = 'completed'; // or whatever status you want
            } elseif ($delivery->delivery_status == 'Cancelled') {
                $order->status = 'cancelled';
            } else {
                $order->status = 'pending'; // or 'in progress'
            }
            $order->save();
        }

        return redirect()->route('delivery.index')->with('success', 'Delivery and Order status updated successfully!');
    }


    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('delivery.index')->with('success', 'Delivery deleted successfully!');
    }
}
