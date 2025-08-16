@extends('admin.layout.app')
@section('title', 'Item')
@section('item', 'active')

@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid" style="font-family: 'Battambang', sans-serif;">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0 fw-bold">Item List</h3>

            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Item List</h4>

            </div>

            <div class="card-body p-0 table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Food Image</th>
                            <th>Food Name</th>
                            <th style="width:80px;">Quantity</th>
                            <th style="width:100px;">Unit Price</th>
                            <th style="width:100px;">Total Price</th>
                            <th style="width:100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1; @endphp
                        @forelse ($orders as $order)
                            @foreach ($order->orderItems as $item)
                                <tr class="align-middle">
                                    <td class="text-center fw-semibold">{{ $counter++ }}</td>
                                    <td class="text-center">{{ $order->customer_name }}</td>
                                    <td class="text-center">{{ $order->phone }}</td>
                                    <td class="text-center">{{ $order->address }}</td>
                                    <td class="text-center">
                                        <img src="{{ $item->food && $item->food->image ? asset('foods/image/' . $item->food->image) : asset('images/default-food.png') }}"
                                             alt="{{ $item->food_name }}"
                                             class="rounded shadow-sm border border-light"
                                             style="width:60px; height:60px; object-fit:cover;">
                                    </td>
                                    <td class="text-center fw-semibold">{{ $item->food_name }}</td>
                                    <td class="text-center fw-bold text-primary">{{ $item->quantity }}</td>
                                    <td class="text-end fw-semibold text-muted">${{ number_format($item->unit_price, 2) }}</td>
                                    <td class="text-end fw-bold text-success">${{ number_format($item->total_price, 2) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary shadow-sm"
                                                data-bs-toggle="modal" data-bs-target="#itemModal{{ $item->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Item Details Modal --}}
                                <div class="modal fade" id="itemModal{{ $item->id }}" tabindex="-1" aria-labelledby="itemModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden" style="font-family: 'Battambang', sans-serif;">

                                            {{-- Header --}}
                                            <div class="modal-header text-white" style="background: linear-gradient(90deg, #4307e8);">
                                                <h5 class="modal-title" id="itemModalLabel{{ $item->id }}">
                                                    <i class="fa-solid fa-bowl-food me-2"></i> {{ $item->food_name }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>

                                            {{-- Body --}}
                                            <div class="modal-body p-4">
                                                <div class="row align-items-center">
                                                    {{-- Food Image --}}
                                                    <div class="col-md-4 text-center mb-3">
                                                        <img src="{{ $item->food && $item->food->image ? asset('foods/image/' . $item->food->image) : asset('images/default-food.png') }}"
                                                             class="rounded shadow-sm border"
                                                             style="width:160px; height:160px; object-fit:cover;"
                                                             alt="{{ $item->food_name }}">
                                                    </div>

                                                    {{-- Food Info --}}
                                                    <div class="col-md-8">
                                                        <h4 class="fw-bold mb-3 text-dark">{{ $item->food_name }}</h4>
                                                        <ul class="list-unstyled mb-3" style="font-size: 1rem;">
                                                            <li><strong>Quantity:</strong> {{ $item->quantity }}</li>
                                                            <li><strong>Unit Price:</strong> <span class="text-primary fw-semibold">${{ number_format($item->unit_price, 2) }}</span></li>
                                                            <li><strong>Total Price:</strong> <span class="text-success fw-bold">${{ number_format($item->total_price, 2) }}</span></li>
                                                        </ul>
                                                        @if ($item->food && $item->food->desc)
                                                            <p class="mb-2"><strong>Description:</strong> {{ $item->food->desc }}</p>
                                                        @endif
                                                        @if ($item->food && $item->food->category)
                                                            <p><strong>Category:</strong>
                                                                <span class="badge bg-info text-dark">{{ $item->food->category->name }}</span>
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Footer --}}
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-3 text-muted">
                                    <i class="fa-solid fa-utensils fa-lg me-2"></i>No order items found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-3 d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
            <nav aria-label="...">
                <ul class="pagination">
                  <li class="page-item disabled"><a class="page-link">Previous</a></li>
                  <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
        </div>
    </div>
</div>
@endsection
