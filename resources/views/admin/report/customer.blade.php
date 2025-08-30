@extends('admin.layout.app')
@section('title', 'របាយការណ៍ភ្ញៀវ')
@section('content')
    @include('admin.font.index')

    <div class="container-fluid py-4">
        <h3 class="mb-3">របាយការណ៍ភ្ញៀវ</h3>
        <form method="GET" action="{{ route('report.customer') }}">
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="🔍Search name ..." name="search"
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <select name="category" class="form-control">
                            <option value="">All Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-warning">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('report.customer') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-undo me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">Top Customers</div>
                    <div class="scroll">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>ឈ្មោះភ្ញៀវ</th>
                                    <th>អាស្រយដ្ឋាន</th>
                                    <th>ទូរសព្ទ</th>
                                    <th class="text-center">ចំនួន Order</th>
                                    <th class="text-end">សរុបចំណាយ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalOrders = 0;
                                    $totalSpent = 0;
                                @endphp
                                @foreach ($topCustomers as $cus)
                                    @php
                                        $totalOrders += $cus->total_orders;
                                        $totalSpent += $cus->total_spent;
                                    @endphp
                                    <tr>
                                        <td>{{ $cus->customer->name ?? '-' }}</td>
                                        <td>{{ $cus->customer->address ?? '-' }}</td>
                                        <td>{{ $cus->customer->phone ?? '-' }}</td>
                                        <td class="text-center">{{ $cus->total_orders }}</td>
                                        <td class="text-end">{{ number_format($cus->total_spent, 2) }} $</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="row justify-content-end p-2">
                        <div class="col-2">
                            <div class="mb-3">
                                <label>Total Orders</label>
                                <input type="text" class="form-control text-end" value="{{ $totalOrders }}" readonly>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mb-3 ">
                                <label>Total Spent</label>
                                <input type="text" class="form-control text-end"
                                    value="{{ number_format($totalSpent, 2) }} $" readonly>
                            </div>
                        </div>
                    </div>

                </div> <!-- card -->
            </div>
        </div>
    </div>
    <style>
        .scroll {
            display: block;
            max-height: 400px;
            /* adjust height */
            overflow-y: auto;
            /* vertical scroll */
            overflow-x: auto;
            /* horizontal scroll if too many columns */
        }
    </style>
@endsection
