@extends('admin.layout.app')
@section('title', 'Orders')
@section('order', 'active')
@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">Orders List</h3>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="card-title mb-0">All Orders</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Food Image</th>
                            <th>Food Name</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Notes</th>
                            <th>Ordered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($order->food && $order->food->image)
                                        <img src="{{ asset('foods/image/' . $order->food->image) }}" alt="{{ $order->food->title }}"
                                             style="max-width: 60px; height: auto; border-radius: 5px;">
                                    @else
                                        <img src="{{ asset('images/default-food.png') }}" alt="Default Food"
                                             style="max-width: 60px; height: auto; border-radius: 5px;">
                                    @endif
                                </td>
                                <td>{{ $order->food_name ?? ($order->food->title ?? '-') }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>{{ $order->notes ?? '-' }}</td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-2 px-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
