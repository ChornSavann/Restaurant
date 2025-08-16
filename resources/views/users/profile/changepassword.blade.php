@extends('admin.layout.app')
@section('title', 'Change Password')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.changePassword') }}" method="POST">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="new_password" id="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                   class="form-control @error('new_password_confirmation') is-invalid @enderror">
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.profile') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
