@extends('admin.layout.app')
@section('title', 'របាយការណ៍ការលក់')

@section('content')
    @include('admin.font.index')
    <div class="container-fluid py-4">

        <h3 class="mb-3">របាយការណ៍ការលក់</h3>

        {{-- Filter --}}
        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-3">
                <input type="date" name="start_date" value="{{ $start }}" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" value="{{ $end }}" class="form-control">
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-50" type="submit">
                    <i class="fa-solid fa-search"></i> ស្វែងរក
                </button>
            </div>
        </form>

        {{-- Summary --}}
        <div class="alert alert-info">
            <strong>ចំនួន Order:</strong> {{ $totalOrders }} |
            <strong>ប្រាក់សរុប:</strong> {{ number_format($totalAmount, 2) }} $
        </div>

        {{-- Table --}}
            <div class="card-body table-responsive​​ shadow-sm ">
                <div class="scroll">
                    <table class="table table-bordered text-center align-middle table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>ល.រ</th>
                                <th>ថ្ងៃខែ</th>
                                <th>ឈ្មោះភ្ញៀវ</th>
                                <th>សរុប</th>
                                <th>ចំនួនម្ហូប</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $i => $order)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $order->customer->name ?? '-' }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }} $</td>
                                    <td>{{ $order->orderItems->count() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted">មិនមានទិន្នន័យ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

    </div>
    <style>
        .scroll {
            display: block;
            max-height: 450px;
            /* adjust height */
            overflow-y: auto;
            /* vertical scroll */
            overflow-x: auto;
            /* horizontal scroll if too many columns */
        }
    </style>
@endsection
