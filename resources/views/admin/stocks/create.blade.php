@extends('admin.layout.app')
@section('title', 'Stock/Create')
@section('stock', 'active')

@section('content')
    @include('admin.font.index')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0 fw-bold">បន្ថែមផលិតផល</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('stocks.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <div class="card card-outline mb-4">
                <form action="{{ route('stocks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="food_name" class="form-label fw-semibold">Food <span
                                    class="text-danger">*</span></label>
                            <select name="food_id" id="food_id"
                                class="form-select @error('food_id') is-invalid @enderror">
                                <option value="">Select Food</option>
                                @foreach ($foods as $food)
                                    <option value="{{ $food->id }}" {{ old('food_id') == $food->id ? 'selected' : '' }}>
                                        {{ $food->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error('food_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @error('food_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-semibold">Quantity<span
                                    class="text-danger">*</span></label>
                            <input value="{{ old('quantity') }}" type="number" min="0"
                                class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label fw-semibold">Unit</label>
                            <input value="{{ old('unit') }}" type="text"
                                class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit"
                                placeholder="pcs, kg, liters">
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-download"></i> Save</button>
                        <a href="{{ route('stocks.index') }}" class="btn btn-secondary"><i class="fa-solid fa-ban"></i>
                            Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
