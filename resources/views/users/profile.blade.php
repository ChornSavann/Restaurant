@extends('admin.layout.app')
@section('title', 'User Profile')
@section('content')
@include('admin.font.index')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-md-6">
                <h3 class="mb-0" style="font-family: Cambria;font-weight:bold;">Edit Profile</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-backward-step"></i> Back
                </a>
            </div>
        </div>
        <div class="card card-primary card-outline mb-4">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                        <input
                            value="{{ old('phone', $user->phone) }}"
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

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="com_password" class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="com_password" id="com_password"
                            class="form-control @error('com_password') is-invalid @enderror" placeholder="Leave blank to keep current password">
                        @error('com_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profile Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Profile Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if(Auth::user()->image)
                            <div class="mt-3">
                                <img src="{{ asset('images/users/' . Auth::user()->image) }}" alt="Profile Image" class="rounded shadow" style="width:120px; height:120px; object-fit:cover;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Update Profile</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-ban"></i>
                        Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
