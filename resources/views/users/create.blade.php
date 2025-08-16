@extends('admin.layout.app')
@section('title', 'user/create')
@section('active', 'user')
@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">User Details</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-backward-step"></i> Back
                </a>
            </div>
        </div>

        <!-- User Form -->
        <div class="card card-primary card-outline mb-4">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address <span class="text-danger">*</span></label>
                        <input value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                        <input
                            value="{{ old('phone') }}"
                            type="text"
                            class="form-control @error('phone') is-invalid @enderror"
                            id="phone"
                            name="phone"
                            required
                        />
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="com_password" class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" class="form-control @error('com_password') is-invalid @enderror" id="com_password" name="com_password" />
                        @error('com_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- User Type -->
                    <div class="mb-3">
                        <label for="usertype" class="form-label fw-semibold">User Type</label>
                        <select name="usertype" id="usertype" class="form-select @error('usertype') is-invalid @enderror" required>
                            <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('usertype')
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.msg.index')
@endsection
