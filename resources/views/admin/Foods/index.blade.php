@extends('admin.layout.app')
@section('title', 'Food')
@section('food', 'food-menu-open')
@section('content')
    <div class="app-content-header py-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria;font-wwidth:bold">Foods Details</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('food.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-bowl-food"></i>Add Food
                    </a>
                </div>
            </div>

            <!-- Usage inside alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ❌ {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- User Detail Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0">List Foods</h4>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Image</th>
                                <th>Food Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $index => $food)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($food->image)
                                            <img src="{{ asset('foods/image/' . $food->image) }}" alt="{{ $food->title }}"
                                                style="max-width: 60px; height: auto; border-radius: 5px;">
                                        @else
                                            <img src="{{ asset('images/default-food.png') }}" alt="Default Image"
                                                style="max-width: 60px; height: auto; border-radius: 5px;">
                                        @endif
                                    </td>
                                    <td>{{ $food->title }}</td>
                                    <td>{{ $food->category->name ?? 'No category' }}</td>

                                    <td>{{ $food->desc ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#foodModal{{ $food->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{route('food.edit',$food->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{route('food.delete',$food->id)}}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete this food?')"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="my-1 mt-2" style="padding-right: 30px;padding-left: 30px;">
                    {{ $foods->links() }}
                </div>


            </div>
        </div>
    </div>


    <!-- First Modal (User Details) -->

    @foreach ($foods as $food)
    <div class="modal fade" id="foodModal{{ $food->id }}" tabindex="-1" aria-labelledby="foodModalLabel{{ $food->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow border-0 rounded-4">
                <div class="modal-header bg-primary text-white py-2 px-3 rounded-top-4">
                    <h4 class="modal-title mb-0 fs-4" id="foodModalLabel{{ $food->id }}">
                        <i class="fas fa-utensils me-2"></i> Food Details
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3 fs-5">
                    <div class="row align-items-center">
                        <div class="col-4 text-center">
                            @if ($food->image)
                                <img src="{{ asset('foods/image/' . $food->image) }}" alt="{{ $food->title }}"
                                     class="rounded shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-food.png') }}" alt="Default Food Image"
                                     class="rounded shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                            @endif
                        </div>

                        <div class="col-8 ps-3">
                            <p class="mb-2"><strong class="fw-bold">Title:</strong> {{ $food->title }}</p>
                            <p class="mb-2"><strong class="fw-bold">Price:</strong> ${{ number_format($food->price, 2) }}</p>
                            <p class="mb-2"><strong class="fw-bold">Description:</strong> {{ $food->desc }}</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light py-2 px-3 rounded-bottom-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary fs-6" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach


@endsection
