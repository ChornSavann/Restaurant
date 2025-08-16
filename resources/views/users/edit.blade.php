@extends('admin.layout.app')

@section('title', 'Edit User')
@section('active', 'user')

@section('content')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria;">Edit User</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-backward-step"></i>
                        Back
                    </a>
                </div>
            </div>

            <div class="card card-primary card-outline mb-4">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
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

                        <!-- Password (optional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">New Password (optional)</label>
                            <input type="password" class="form-control" id="password" name="password"
                            placeholder="Leave blank to keep current password">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="com_password" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control" id="com_password" name="com_password"
                            placeholder="Leave blank to keep current password">
                        </div>

                        <!-- User Type -->
                        <div class="mb-3">
                            <label for="usertype" class="form-label fw-semibold">User Type</label>
                            <select name="usertype" id="usertype" class="form-select" required>
                                <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Image</label>
                            <input type="file" class="form-control" id="image" name="image">

                            <div class="mt-2">
                                @if ($user->image)
                                    <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->name }}"
                                         style="max-width: 100px; height: auto; border-radius: 5px;">
                                @else
                                    <img src="{{ asset('images/users/default.png') }}" alt="Default User Image" width="100" height="100">
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- Submit -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Update
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i>
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
    @push('styles')
        <style>
            form label {
                font-weight: 600;
            }
        </style>
    @endpush

@endsection
