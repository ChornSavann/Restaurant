@extends('admin.layout.app')
@section('title', 'Categories')
@section('category', 'active')
@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">Categories</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i> Add Category
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="card-title mb-0">Category List</h4>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width:150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{route('category.delete',$category->id)}}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want Delete this category?')" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-1 mt-2" style="padding-left: 30px; padding-right: 30px;">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
