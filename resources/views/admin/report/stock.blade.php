@extends('admin.layout.app')
@section('title', 'របាយការណ៍ស្តុក')
@section('content')
    @include('admin.font.index')

    <div class="container-fluid py-4">
        <h3>របាយការណ៍ស្តុក</h3>

        <div class="alert alert-primary">
            <strong>ចូល:</strong> {{ $stockSummary['in'] }} |
            <strong>ចេញ:</strong> {{ $stockSummary['out'] }} |
            <strong>នៅសល់:</strong> {{ $stockSummary['remain'] }}
        </div>

        <div class="card shadow-sm">
            <div class="scroll">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ល.រ</th>
                            <th>ឈ្មោះស្តុក</th>
                            <th>ចំនួននៅសល់</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $i => $stock)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $stock->food->title }}</td>
                                <td>{{ $stock->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
