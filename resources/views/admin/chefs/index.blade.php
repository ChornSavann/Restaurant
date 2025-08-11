@extends('admin.layout.app')
@section('title', 'Chefs')
@section('chefs', 'active')
@section('content')
    <div class="app-content-header py-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria;font-wwidth:bold">Chefs Details</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route('chefs.create')}}" class="btn btn-primary">
                        <i class="fa-solid fa-kitchen-set"></i>
                        Add Chefs
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
                    <h4 class="card-title mb-0">List Chefs</h4>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Spaciality</th>
                                <th style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chefs as $index => $chef)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>{{ $chef->name }}</td>
                                    <td>
                                        @if ($chef->image)
                                            <img src="{{ asset('chef/images/' . $chef->image) }}" alt="{{ $chef->name }}"
                                                style="max-width: 90px; height: Auto; border-radius:10px;">
                                        @else
                                            <img src="{{ asset('images/default-chef.png') }}" alt="Default Chef Image"
                                                style="max-width: 60px; height: auto; border-radius: 5px;">
                                        @endif
                                    </td>
                                    <td>{{ $chef->speciality }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#chefModal{{ $chef->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{route('chefs.edit',$chef->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{route('chefs.delete',$chef->id)}}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are You sure you want to Delete this chef?')" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
                {{-- <div class="my-1 mt-2" style="padding-right: 30px;padding-left: 30px;">
                    {{ $foods->links() }}
                </div> --}}


            </div>
        </div>
    </div>


    <!-- First Modal (User Details) -->

    {{-- Chef Details Modal --}}
@foreach ($chefs as $chef)
<div class="modal fade" id="chefModal{{ $chef->id }}" tabindex="-1" aria-labelledby="chefModalLabel{{ $chef->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0 rounded-4">
            {{-- Header --}}
            <div class="modal-header bg-success text-white py-2 px-3 rounded-top-4">
                <h4 class="modal-title mb-0 fs-4" id="chefModalLabel{{ $chef->id }}">
                    <i class="fas fa-user-tie me-2"></i> Chef Details
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-3 fs-5">
                <div class="row align-items-center">
                    <div class="col-4 text-center">
                        @if ($chef->image)
                            <img src="{{ asset('chef/images/' . $chef->image) }}" alt="{{ $chef->name }}"
                                class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-chef.png') }}" alt="Default Chef Image"
                                class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="col-8 ps-3">
                        <p class="mb-2"><strong class="fw-bold">Name:</strong> {{ $chef->name }}</p>
                        <p class="mb-2"><strong class="fw-bold">Specialty:</strong> {{ $chef->speciality }}</p>

                    </div>
                </div>
            </div>

            {{-- Footer --}}
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
