@extends('admin.layout.app')
@section('title', 'Edit Discount')
@section('content')
@include('admin.font.index')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0 fw-bold">Edit Discount</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('discount.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <div class="card card-primary card-outline mb-4">
                <form action="{{ route('discount.update', $discount->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        {{-- Select Food --}}
                        <div class="mb-3">
                            <label class="form-label">Discount (%)</label>
                            <input type="number" name="discount_percent" class="form-control" min="0" max="100"
                                value="{{ old('discount_percent', $discount->discount_percent) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                   value="{{ old('start_date', optional($discount->start_date) ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d') : '') }}">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                   value="{{ old('end_date', optional($discount->end_date) ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d') : '') }}">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Footer Buttons --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i> Update Discount
                        </button>
                        <a href="{{ route('discount.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
