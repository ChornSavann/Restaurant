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
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Order Items</th>
                            <th>Total Amount</th>
                            <th>Ordered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($order->orderItems as $item)
                                            <li class="d-flex align-items-center mb-2">
                                                @if ($item->food && $item->food->image)
                                                    <img src="{{ asset('foods/image/' . $item->food->image) }}"
                                                        alt="{{ $item->food_name }}"
                                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 8px;">
                                                @else
                                                    <img src="{{ asset('images/default-food.png') }}"
                                                        alt="No Image"
                                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 8px;">
                                                @endif
                                                <span>{{ $item->food_name }} (x{{ $item->quantity }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
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
