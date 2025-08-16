@extends('admin.layout.app')
@section('title', 'Food')
@section('reservation', 'active')
@section('content')
    <div class="app-content-header py-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria;font-wwidth:bold">Ressevation Details</h3>
                </div>

            </div>

            <!-- Usage inside alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('success') }}
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
                    <h4 class="card-title mb-0">List Reservation</h4>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Guest</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Message</th>
                                <th style="width:60px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $index => $reser)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $reser->name }}</td>
                                    <td>{{ $reser->email }}</td>
                                    <td>{{ $reser->phone }}</td>
                                    <td>{{ $reser->guest }}</td>
                                    <td>{{ $reser->created_at ? $reser->created_at->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $reser->time }}</td>
                                    <td>{{ $reser->message }}</td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a> --}}
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $reser->id}}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-2 my-2">
                    {{ $reservations->links() }}
                </div>

            </div>
        </div>
    </div>


    <!-- First Modal (User Details) -->
    @foreach ($reservations as $reservation)
    <div class="modal fade" id="reservationModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="reservationModalLabel{{ $reservation->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow border-0 rounded-4">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white py-2 px-3 rounded-top-4">
                    <h6 class="modal-title mb-0" id="reservationModalLabel{{ $reservation->id }}">
                        <i class="fas fa-calendar-check me-2"></i> Reservation Details
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><i class="fas fa-user me-2 text-primary"></i><strong>Name:</strong> {{ $reservation->name }}</p>
                            <p><i class="fas fa-envelope me-2 text-primary"></i><strong>Email:</strong> {{ $reservation->email }}</p>
                            <p><i class="fas fa-phone me-2 text-primary"></i><strong>Phone:</strong> {{ $reservation->phone ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-users me-2 text-primary"></i><strong>Guests:</strong> {{ $reservation->guest ?? '-' }}</p>
                            <p><i class="fas fa-calendar-alt me-2 text-primary"></i><strong>Created At:</strong> {{ $reservation->created_at ? $reservation->created_at->format('d-m-Y') : '-' }}</p>
                            <p><i class="fas fa-clock me-2 text-primary"></i><strong>Time:</strong> {{ $reservation->time ?? '-' }}</p>
                        </div>
                        <div class="col-12">
                            <p><i class="fas fa-comment me-2 text-primary"></i><strong>Message:</strong> {{ $reservation->message ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
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
