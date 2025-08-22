@extends('admin.layout.app')
@section('title', 'Orders')
@section('orders', 'active')

@section('content')
    @include('admin.font.index')

    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-bold">Order List</h3>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0">Orders</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>អតិថិជន</th>
                                <th>ទូរស័ព្ទ</th>
                                <th>តម្លៃសរុប</th>
                                <th>ស្ថានភាព</th>
                                <th>ថ្ងៃបញ្ជា</th>
                                <th style="width: 120px">សកម្មភាព</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($orders as $index => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge
                                            @if ($order->status == 'pending') bg-warning
                                            @elseif($order->status == 'completed') bg-success
                                            @elseif($order->status == 'canceled') bg-danger @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <!-- View Order Modal -->
                                            <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                               data-bs-target="#orderModal{{ $order->id }}">
                                                <i class="fa-solid fa-eye"></i> View
                                            </a>


                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No orders found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-3 d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Order Modal --}}
    @foreach ($orders as $order)
        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow border-0 rounded-4">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Order #{{ $order->id }} Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->customer->address }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Food</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->food_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->unit_price, 2) }}</td>
                                        <td>${{ number_format($item->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h5 class="text-end">Total: ${{ number_format($order->total_amount, 2) }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
