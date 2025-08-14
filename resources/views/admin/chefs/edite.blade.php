@extends('admin.layout.app')
@section('title', 'Food/create')
@section('active', 'food')
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
                    <a href="#" class="btn btn-secondary">
                        <i class="fa-solid fa-backward-step"></i> Back
                    </a>
                </div>
            </div>

            <!-- User Detail Table -->
            <div class="card card-primary card-outline mb-4">

                <form action="{{route('chefs.update',$chef->id)}}" method="POST" name="chefForm" id="userForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name<span class="text-danger">*</label>
                            <input value="{{ old('name',$chef->name) }}" type="text" class="form-control
                            @error('title') is-invalid @enderror"id="name" name="name" />

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price (label error fixed) -->
                        <div class="mb-3">
                            <label for="speciality" class="form-label fw-semibold">Spaciality<span class="text-danger">*</label>
                            <input value="{{ old('speciality',$chef->speciality) }}" type="text" class="form-control @error('price') is-invalid @enderror" id="speciality" name="speciality" />
                            @error('speciality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Image</label>
                            <input type="file" class="form-control" id="image" name="image">

                            <div class="mt-2">
                                @if ($chef->image)
                                    <img src="{{ asset('chef/images/' . $chef->image) }}" alt="{{ $chef->name }}"
                                         style="max-width: 100px; height: auto; border-radius: 5px;">
                                @else
                                    <img src="{{ asset('chef/images/default.png') }}" alt="Default User Image" width="100" height="100">
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Footer Buttons -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-pen-nib"></i>
                            Update
                        </button>
                        <a href="{{route('chefs.index')}}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i>
                            Cancel
                        </a>
                    </div>
                </form>


                <!--end::Form-->
            </div>
        </div>
    </div>


@endsection
