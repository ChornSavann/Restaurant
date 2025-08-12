@extends('admin.layout.app')
@section('title', 'Item')
@section('item', 'active')
@section('content')

<div class="container my-4">
    <h3 class="mb-4" style="font-family: Cambria; font-weight: bold;">Orders List</h3>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Food Image</th>
                    <th>Food Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Unit Price</th>
                    <th class="text-end">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                @if ($item->food && $item->food->image)
                                    <img src="{{ asset('foods/image/' . $item->food->image) }}" alt="{{ $item->food_name }}"
                                        style="max-width: 60px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <img src="{{ asset('images/default-food.png') }}" alt="No Image"
                                        style="max-width: 50px; height: 60px; object-fit: cover; border-radius: 5px;">
                                @endif
                            </td>
                            <td>{{ $item->food_name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">${{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end">${{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>

@endsection
