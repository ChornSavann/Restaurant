@extends('admin.layout.app')
@section('title', 'Edit Category')
@section('category', 'active')
@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">Edit Category</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('category.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Back to Categories
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa fa-exclamation-circle me-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Category Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        @if ($category->image)
                            <small>Current Image:</small><br>
                            <img src="{{ asset('category/images/'.$category->image) }}" alt="{{ $category->name }}" style="max-width: 100px; height: auto; border-radius: 5px;">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-danger fw-semibold">
                        <i class="fa-solid fa-pen me-1"></i> Update Category
                    </button>
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-ban"></i> Cancel
                    </a>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
