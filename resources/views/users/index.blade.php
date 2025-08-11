@extends('admin.layout.app')
@section('title', 'user')
@section('active', 'user')
@section('content')
    <div class="app-content-header py-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria;font-wwidth:bold">User Details</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Add User
                    </a>
                </div>
            </div>


            <!-- Usage inside alert -->
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Error:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif


            <!-- Bootstrap Icons SVG Sprites -->
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03l-3.47-3.47 1.41-1.41 2.06 2.06 4.59-4.59 1.41 1.41-6 6z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 0c-.69 0-1.32.34-1.71.88L.34 13.23c-.4.57-.08 1.32.66 1.32h13.99c.74 0 1.07-.75.66-1.32L9.71.88A2 2 0 0 0 8 0zm.93 4.41a.5.5 0 0 1-.86 0L6.16 7.54a.5.5 0 0 0 .43.76h2.82a.5.5 0 0 0 .43-.76L8.93 4.41zM8 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
            </svg>


            <!-- User Detail Table -->
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="card-title mb-0">List Users</h4>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->image)
                                            <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->name }}"
                                                style="max-width: 60px; height: auto; border-radius: 50px;">
                                        @else
                                            <img src="{{ asset('images/default-user.png') }}" alt="Default Image"
                                                style="max-width: 60px; height: auto; border-radius: 5px;">
                                        @endif

                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->usertype == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                            {{ ucfirst($user->usertype) }}
                                        </span>
                                    </td>
                                    <td>

                                        <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#userModal{{ $user->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>
                                        <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete user?')"
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
            </div>
        </div>
    </div>


    <!-- First Modal (User Details) -->
  <!-- User Info Modal -->
  @foreach ($users as $user )
 <!-- User Detail Modal -->
{{-- <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="userModalLabel{{ $user->id }}">
                    <i class="fas fa-user-circle me-2"></i> User Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        @if ($user->image)
                            <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->name }}"
                                 class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-user.png') }}" alt="Default Image"
                                 class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 120px;">Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>
                                    <span class="badge {{ $user->usertype == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                        {{ ucfirst($user->usertype) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light rounded-bottom-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div> --}}
<!-- User Detail Modal (Smaller Version) -->
<div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0 rounded-4">
            <div class="modal-header bg-primary text-white py-2 px-3 rounded-top-4">
                <h6 class="modal-title mb-0" id="userModalLabel{{ $user->id }}">
                    <i class="fas fa-user-circle me-2"></i> User Info
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3">
                <div class="row align-items-center">
                    <div class="col-4 text-center">
                        @if ($user->image)
                            <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->name }}"
                                 class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-user.png') }}" alt="Default Image"
                                 class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="col-8 ps-2">
                        <p class="mb-1"><strong>Name  :</strong> {{ $user->name }}</p>
                        <p class="mb-1"><strong>Email :</strong> {{ $user->email }}</p>
                        <p class="mb-0"><strong>Type  :</strong>
                            <span class="badge {{ $user->usertype == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                {{ ucfirst($user->usertype) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light py-2 px-3 rounded-bottom-4">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>


  @endforeach


@endsection
