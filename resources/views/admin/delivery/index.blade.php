@extends('admin.layout.app')
@section('title', 'Deliveries')
@section('delivery', 'menu-open')
@section('content')
@include('admin.font.index')

<div class="app-content-header py-3">
    <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0" style="font-family: Cambria; font-weight:bold;">Deliveries</h3>
        <a href="{{ route('delivery.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-truck-fast me-1"></i> Add Delivery
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-message">
            <i class="fa fa-times-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Deliveries Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">List of Deliveries</h4>
            <span class="text-muted small">{{ $deliveries->total() }} item(s)</span>
        </div>

        <div class="card-body p-0 table-responsive kh-battambang">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Order</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($deliveries as $index => $delivery)
                        <tr>
                            <td class="text-center">{{ $deliveries->firstItem() + $index }}</td>
                            <td class="text-center">{{ $delivery->customer->name ?? '-' }}</td>
                            <td class="text-center">#{{ $delivery->order->order_number ?? '-' }}</td>
                            <td class="text-center">{{ $delivery->delivery_address }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $delivery->delivery_status == 'Delivered' ? 'success' : ($delivery->delivery_status == 'In Transit' ? 'info' : ($delivery->delivery_status == 'Cancelled' ? 'danger' : 'secondary')) }}">
                                    {{ $delivery->delivery_status }}
                                </span>
                            </td>
                            <td class="text-center">{{ $delivery->delivery_date }}</td>
                            <td class="text-center">{{ $delivery->delivery_time ?? '-' }}</td>
                            <td class="text-center">
                                {{-- View --}}
                                <a href="#" class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#deliveryModal{{ $delivery->delivery_id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{route('delivery.edit',$delivery->delivery_id)}}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{route('delivery.delete',$delivery->delivery_id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this delivery?')" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-truck fa-lg me-2"></i>No Deliveries Found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="m-2 mt-2 d-flex justify-content-center">
            {{ $deliveries->links() }}
        </div>
    </div>
</div>

{{-- Delivery Details Modal --}}
@foreach ($deliveries as $delivery)
<div class="modal fade" id="deliveryModal{{ $delivery->delivery_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow border-0 rounded-4">
            <div class="modal-header bg-primary text-white py-2 px-3 rounded-top-4">
                <h5 class="modal-title"><i class="fa-solid fa-truck me-2"></i> Delivery Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <p><strong>Customer:</strong> {{ $delivery->customer->name ?? '-' }}</p>
                <p><strong>Order:</strong> #{{ $delivery->order->id ?? '-' }}</p>
                <p><strong>Address:</strong> {{ $delivery->delivery_address }}</p>
                <p><strong>Status:</strong> {{ $delivery->delivery_status }}</p>
                <p><strong>Date:</strong> {{ $delivery->delivery_date }}</p>
                <p><strong>Time:</strong> {{ $delivery->delivery_time ?? '-' }}</p>
            </div>
            <div class="modal-footer bg-light py-2 px-3 rounded-bottom-4">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Auto-dismiss alert --}}
<script>
    setTimeout(() => {
        document.querySelectorAll('#alert-message').forEach(alertEl => {
            const bsAlert = new bootstrap.Alert(alertEl);
            bsAlert.close();
        });
    }, 5000);
</script>

@include('admin.msg.index')
@endsection
