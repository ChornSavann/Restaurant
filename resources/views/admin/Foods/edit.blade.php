@extends('admin.layout.app')
@section('title', 'Food/Edit')
@section('active', 'food')
@section('content')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">Foods Update</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('food.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-backward-step"></i> Back
                    </a>
                </div>
            </div>

            <!-- Food Edit Form -->
            <div class="card card-primary card-outline mb-4">
                <form action="{{ route('food.update', $food->id) }}" method="POST" name="foodForm" id="userForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title<span class="text-danger">*</label>
                            <input value="{{ old('title', $food->title) }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold"><span class="text-danger">*</label>
                            <input value="{{ old('price', $food->price) }}" type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" />
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-semibold">Category</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="category"> Select Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $food->category_id) == $category->id) ? 'selected' : '' }}>
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
                            <label for="desc" class="form-label fw-semibold">Description<span class="text-danger">*</label>
                            <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3">{{ old('desc', $food->desc) }}</textarea>
                            @error('desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-2">
                                @if ($food->image)
                                    <img src="{{ asset('foods/image/' . $food->image) }}" alt="{{ $food->title }}"
                                         style="max-width: 100px; height: auto; border-radius: 5px;">
                                @else
                                    <img src="{{ asset('foods/image/default.png') }}" alt="Default Image" width="100" height="100">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-pen-to-square"></i> Update
                        </button>
                        <a href="{{ route('food.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
