@extends('admin.layout.app')
@section('title', 'របាយការណ៍ភ្ញៀវ')
@section('content')
    @include('admin.font.index')

    <div class="container-fluid py-4">
        <h3>របាយការណ៍ភ្ញៀវ</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-info text-white">ភ្ញៀវដែលមានការកក់</div>
                    <div class="card-body">
                        <ul>
                            @forelse($reservedCustomers as $cus)
                                <li>{{ $cus->name }} ({{ $cus->reservations->count() }} កក់)</li>
                            @empty
                                <li class="text-muted">គ្មានទិន្នន័យ</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">Top Customers</div>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>ឈ្មោះភ្ញៀវ</th>
                                <th>ចំនួន Order</th>
                                <th>សរុបចំណាយ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topCustomers as $cus)
                                <tr>
                                    <td>{{ $cus->customer->name ?? '-' }}</td>
                                    <td>{{ $cus->total_orders }}</td>
                                    <td>{{ number_format($cus->total_spent, 2) }} $</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
