@extends('admin.layout.app')
@section('title', 'Item')
@section('item', 'active')
@section('content')

<div class="container my-4">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="card-title mb-0">All Orders</h4>
        </div>
        <table class="table table-striped align-middle mb-0">
            <thead class="table-light">
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
                @php
                    $counter = 1; // initialize counter
                @endphp

                @foreach ($orders as $order)
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $counter++ }}</td> <!-- Serial number -->
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

    <div class="m-1 mt-2">
        {{ $orders->links() }}
    </div>
</div>

@endsection
