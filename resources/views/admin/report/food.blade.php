@extends('admin.layout.app')
@section('title', 'របាយការណ៍ម្ហូប')
@section('content')
    @include('admin.font.index')

    <div class="container-fluid py-4">
        <h3 class="mb-3">របាយការណ៍ម្ហូប</h3>
        <form method="GET" action="{{ route('report.food') }}" class="mb-3">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search food name..."
                        class="form-control">
                </div>

                <div class="col-md-4">
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cate)
                            <option value="{{ $cate->id }}" {{ request('category') == $cate->id ? 'selected' : '' }}>
                                {{ $cate->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-warning w-100">
                        <i class="fa fa-filter me-1"></i> Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('report.food') }}" class="btn btn-outline-secondary w-100">
                        <i class="fa fa-undo me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>


        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5>មុខម្ហូបដែលលក់ច្រើន</h5>
                    </div>
                    <div class="scroll">
                        <table class="table table-sm table-bordered">
                            <thead class="f-bold">
                                <tr>
                                    <th style="width:50px;">ល.រ</th>
                                    <th style="width:200px;">ម្ហូប</th>
                                    <th style="width:200px;">ប្រភេទ</th>
                                    <th class="text-center">ចំនួនលក់</th>
                                    <th class="text-center">ចំនួនស្តុកទាំងអស់</th>
                                    <th class="text-center">ចំនួនស្តុកនៅសល់</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topFoods as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->food->title }}</td>
                                        <td>{{ $item->food->category->name }}</td>
                                        <td class="text-center">{{ $item->total_qty }}</td>
                                        <td class="text-center">
                                            {{ ($item->food->stocks->quantity ?? 0) + $item->total_qty }}
                                        </td>
                                        <td class="text-center">
                                            {{ ($item->food->stocks->quantity + $item->total_qty ?? 0) - $item->total_qty }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-end p-2">
                        <div class="col-2">
                            <div class="mb-3">
                                <label>Total Sale</label>
                                <input type="text" class="form-control" value="{{ $totalSale }}" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label>Total Stock</label>
                                <input type="text" class="form-control" value="{{ $totalStock }}" readonly>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-danger text-white">មុខម្ហូបដែលមិនទាន់លក់</div>
                    <div class="card-body">
                        <ul>
                            @forelse($unsoldFoods as $food)
                                <li>{{ $food->title }}</li>

                            @empty
                                <li class="text-muted">ទាំងអស់មានការលក់</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div> --}}
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
