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
                    <a href="{{route('chefs.index')}}" class="btn btn-secondary">
                        <i class="fa-solid fa-backward-step"></i> Back
                    </a>
                </div>
            </div>

            <!-- User Detail Table -->
            <div class="card card-primary card-outline mb-4">

                <form action="{{route('chefs.store')}}" method="POST" name="chefForm" id="userForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control
                            @error('title') is-invalid @enderror"id="name" name="name" />

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price (label error fixed) -->
                        <div class="mb-3">
                            <label for="speciality" class="form-label fw-semibold">Spaciality</label>
                            <input value="{{ old('speciality') }}" type="text" class="form-control @error('price') is-invalid @enderror" id="speciality" name="speciality" />
                            @error('speciality')
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
                        <a href="{{route('chefs.index')}}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i>
                            Cancel</a>
                    </div>
                </form>


                <!--end::Form-->
            </div>
        </div>
    </div>


@endsection
