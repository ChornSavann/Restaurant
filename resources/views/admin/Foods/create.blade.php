@extends('admin.layout.app')
@section('title', 'Food/create')
@section('active', 'food')
@section('content')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">Foods Details</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('food.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <!-- Food Create Form -->
            <div class="card card-primary card-outline mb-4">
                <form action="{{ route('food.store') }}" method="POST" name="foodForm" id="userForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Price</label>
                            <input value="{{ old('price') }}" type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" />
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-semibold">Category</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value=""> Select Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="desc" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3">{{ old('desc') }}</textarea>
                            @error('desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="input-group mb-3">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" />
                            <label class="input-group-text fw-semibold" for="image">Upload</label>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-download"></i>
                            Save</button>
                        <a href="{{ route('food.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i>
                            Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
