@extends('admin.layout.app')
@section('title', 'Item')
@section('item', 'active')
@section('content')

<div class="container">
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h3 class="mb-0 mt-3" style="font-family: Cambria; font-weight: bold;">Orders List</h3>
        </div>
    </div>

    @foreach ($orders as $order)
        <div class="card mb-4 p-3 shadow-sm">
            <h5>Order #{{ $order->id }} - {{ $order->customer_name }}</h5>
            <p>Phone: {{ $order->phone }} | Address: {{ $order->address }}</p>

            <table class="table table-bordered">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Food Image</th>
                        <th>Food Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td style="width: 100px;">
                                @if ($item->food && $item->food->image)
                                    <img src="{{ asset('foods/image/' . $item->food->image) }}" alt="{{ $item->food_name }}" class="img-fluid rounded" style="max-width: 80px;">
                                @else
                                    <img src="{{ asset('images/default-food.png') }}" alt="No Image" class="img-fluid rounded" style="max-width: 80px;">
                                @endif
                            </td>
                            <td>{{ $item->food_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>${{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>

@endsection
