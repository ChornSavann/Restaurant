@extends('admin.layout.app')
@section('title', 'Delivery/Create')
@section('active', 'delivery')
@section('content')
    @include('admin.font.index')

    <div class="app-content-header py-3">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria; font-weight: bold;">Create Delivery</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('delivery.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <!-- Delivery Create Form -->
            <div class="card card-primary card-outline mb-4">
                <form action="{{ route('delivery.store') }}" method="POST" name="deliveryForm" id="deliveryForm">
                    @csrf
                    <div class="card-body">

                        <!-- Customer -->
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="customer_id" class="form-label fw-semibold">Customer <span
                                            class="text-danger">*</span></label>
                                    <select name="customer_id" id="customer_id"
                                        class="form-select @error('customer_id') is-invalid @enderror" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-6">
                                <!-- Order -->
                                <div class="mb-3">
                                    <label for="order_id" class="form-label fw-semibold">Order <span
                                            class="text-danger">*</span></label>
                                    <select name="order_id" id="order_id"
                                        class="form-select @error('order_id') is-invalid @enderror" required>
                                        <option value="">Select Order</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}"
                                                {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                                #{{ $order->id }} - {{ $order->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('order_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="delivery_address" class="form-label fw-semibold">Delivery Address <span
                                    class="text-danger">*</span></label>
                            <textarea name="delivery_address" id="delivery_address"
                                class="form-control @error('delivery_address') is-invalid @enderror" rows="3">{{ old('delivery_address') }}</textarea>
                            @error('delivery_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <!-- Date -->
                                <div class="mb-3">
                                    <label for="delivery_date" class="form-label fw-semibold">Delivery Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="delivery_date" id="delivery_date"
                                        value="{{ old('delivery_date') }}"
                                        class="form-control @error('delivery_date') is-invalid @enderror" required>
                                    @error('delivery_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- Time -->
                                <div class="mb-3">
                                    <label for="delivery_time" class="form-label fw-semibold">Delivery Time</label>
                                    <input type="time" name="delivery_time" id="delivery_time"
                                        value="{{ old('delivery_time') }}"
                                        class="form-control @error('delivery_time') is-invalid @enderror">
                                    @error('delivery_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="delivery_status" class="form-label fw-semibold">Delivery Status</label>
                            <select name="delivery_status" id="delivery_status"
                                class="form-select @error('delivery_status') is-invalid @enderror">
                                <option value="Pending" {{ old('delivery_status') == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="In Transit" {{ old('delivery_status') == 'In Transit' ? 'selected' : '' }}>
                                    In Transit</option>
                                <option value="Delivered" {{ old('delivery_status') == 'Delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="Cancelled" {{ old('delivery_status') == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            @error('delivery_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-download"></i> Save
                        </button>
                        <a href="{{ route('delivery.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-ban"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
