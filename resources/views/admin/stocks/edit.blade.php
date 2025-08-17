@extends('admin.layout.app')
@section('title', 'Stock/Edit')
@section('stock', 'active')

@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0 fw-bold">Edit Stock</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('stocks.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="card card-primary card-outline mb-4">
            <form action="{{ route('stocks.update', $stock->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    {{-- Select Food --}}
                    <div class="mb-3">
                        <label for="food_id" class="form-label fw-semibold">Food <span class="text-danger">*</span></label>
                        <select name="food_id" id="food_id" class="form-select @error('food_id') is-invalid @enderror">
                            <option value="">Select Food</option>
                            @foreach($foods as $food)
                                <option value="{{ $food->id }}" {{ $stock->food_id == $food->id ? 'selected' : '' }}>
                                    {{ $food->title }} ({{ number_format($food->price,2) }} $)
                                </option>
                            @endforeach
                        </select>
                        @error('food_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">Quantity<span class="text-danger">*</span></label>
                        <input value="{{ old('quantity', $stock->quantity) }}" type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Unit --}}
                    <div class="mb-3">
                        <label for="unit" class="form-label fw-semibold">Unit</label>
                        <input value="{{ old('unit', $stock->unit) }}" type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit">
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $stock->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Food Image Preview --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Food Image</label>
                        <div>
                            @if($stock->food && $stock->food->image)
                                <img src="{{ asset('foods/image/' . $stock->food->image) }}" alt="{{ $stock->food->title }}" style="width:120px; height:100px; object-fit:cover; border-radius:5px;">
                            @else
                                <img src="https://placehold.co/120x100" alt="No Image" style="border-radius:5px;">
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Footer Buttons --}}
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i> Update
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-ban"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
