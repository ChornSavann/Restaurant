@extends('admin.layout.app')
@section('title', 'User Profile')
@section('active', 'profile')
@section('content')
@include('admin.font.index')
    @php
        $user = auth()->user();
        $profileImage = $user->image ? asset('images/users/' . $user->image) : asset('admin/images/undraw_profile.svg');
    @endphp

    <section class="container-fluid">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-sm" style="border-radius: 8px; max-width: 700px;">
                <div class="row p-4">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="fa fa-check-circle me-2"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <h2 class="fw-bold text-center mb-4">Profile Layout</h2>

                    <!-- Profile Image & Name -->
                    <div class="col-md-6 d-flex flex-column align-items-center text-center mb-4 mb-md-0">
                        <img id="profilePreview" src="{{ $profileImage }}" class="img-thumbnail rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <h4 class="fw-bold">{{ $user->name }}</h4>
                        <p class="text-muted">Role: {{ $user->usertype }}</p>
                    </div>

                    <!-- Contact Details -->
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Contact Details</h5>
                        <p class="mb-2"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
                        <p class="mb-2"><i class="bi bi-telephone me-2"></i>{{ $user->phone ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="mt-4 border-top pt-3">
                    <ul class="nav nav-tabs justify-content-center" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                data-bs-target="#dashboard" type="button" role="tab">Dashboard</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account"
                                type="button" role="tab">Account & Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password"
                                type="button" role="tab">Reset Password</button>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="profileTabsContent">
                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                            <h5 class="fw-bold">Welcome, {{ $user->name }}!</h5>
                            <p>This is your dashboard overview.</p>
                        </div>

                        <div class="tab-pane fade" id="account" role="tabpanel">
                            <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" name="image" class="form-control"
                                        onchange="previewImage(event)">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="password" role="tabpanel">
                            <form action="{{ route('user.updatePassword') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profilePreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @include('admin.msg.index')
@endsection
