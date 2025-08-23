@extends('admin.layout.app')
@section('title', 'Dashboaard')
@section('dashboard', 'active')
@section('content')
    @include('admin.font.index')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <div class="container-fluid">
            {{-- test --}}
            @include('admin.TEST.test')
            <!--begin::Container-->

            <!--end::Row-->
            <div class="row">
                @include('admin.report.Salereport')
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Latest Members</h3>
                            <div class="card-tools" style="float: left;">
                                <span class="badge text-bg-danger">{{ $users->count() }} New Members</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row text-center g-12">
                                @forelse ($users as $user)
                                    <div class="col-2">
                                        <img class="img-fluid rounded-circle"
                                            src="{{ $user->image ? asset('images/users/' . $user->image) : asset('assets/img/default-user.png') }}"
                                            alt="{{ $user->name }}">
                                        <a class="d-block text-truncate fw-bold fs-7 text-secondary" href="#">
                                            {{ $user->name }}
                                        </a>
                                        <small class="text-muted">{{ $user->created_at->format('d M Y') }}</small>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-3 text-muted">
                                        No members found.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Recently Added Products</h3>
                            <div class="card-tools" style="float: left;">
                                <span class="badge text-bg-warning">{{ $foodCounttoday }} New Foods</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @forelse ($todayfoods as $product)
                                    <div class="list-group-item d-flex align-items-center py-2 px-1 border-top">
                                        <div class="me-3">
                                            <img src="{{ $product->image ? asset('foods/image/' . $product->image) : asset('assets/img/default-150x150.png') }}"
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 0.25rem;"
                                                alt="{{ $product->title }}">
                                        </div>
                                        <div class="flex-grow-1">
                                            <!-- Title + Price -->
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <a href="#" class="fw-bold text-primary"
                                                    style="max-width: 70%; word-break: break-word;">
                                                    {{ $product->title }}
                                                </a>
                                                <span
                                                    class="badge
                                                @if ($product->price <= 3) text-bg-danger
                                                @elseif($product->price <= 10) text-bg-info
                                                @elseif($product->price <= 15) text-bg-warning
                                                @else text-bg-success @endif">
                                                    ${{ $product->price }}
                                                </span>
                                            </div>

                                            <!-- Description -->
                                            <div class="text-muted small" style="word-break: break-word;">
                                                {{ $product->desc }}
                                            </div>
                                        </div>

                                    </div>
                                @empty
                                    <div class="py-3 text-center text-muted">No products added today.</div>
                                @endforelse
                            </div>
                        </div>
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Latest Orders</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Popularity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (  $todayOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                OR{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($order->orderItems->count() > 0)
                                                {{ $order->orderItems->first()->food->title }}
                                                @if ($order->orderItems->count() > 1)
                                                    + {{ $order->orderItems->count() - 1 }} more
                                                @endif
                                            @else
                                                No items
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match ($order->status) {
                                                    'completed' => 'success',
                                                    'pending' => 'warning',
                                                    'Delivered' => 'danger',
                                                    'Processing' => 'info',
                                                    default => 'secondary',
                                                };
                                            @endphp
                                            <span class="badge text-bg-{{ $statusClass }}">{{ $order->status }}</span>
                                        </td>
                                        <td>
                                            <div id="table-sparkline-{{ $order->id }}"></div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No orders today</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-primary float-start">
                        Place New Order
                    </a>
                    <a href="{{ route('orders.show') }}" class="btn btn-sm btn-secondary float-end">
                        View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
