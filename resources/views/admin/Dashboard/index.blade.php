@extends('admin.layout.app')
@section('title', 'Dashboaard')
@section('dashboard', 'active')
@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
                </ol>
            </div> --}}
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-3">
                {{-- Total Users --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon text-bg-warning">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Users</span>
                            <span class="info-box-number">{{ $userCount }}</span>
                        </div>
                    </div>
                </div>

                {{-- Total Orders --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon text-bg-primary">
                            <i class="bi bi-basket-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Orders</span>
                            <span class="info-box-number">{{ $orderCount }}</span>
                        </div>
                    </div>
                </div>

                {{-- Total Foods --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon text-bg-danger">
                            <i class="bi bi-egg-fried"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Foods</span>
                            <span class="info-box-number">{{ $foodCount }}</span>
                        </div>
                    </div>
                </div>

                {{-- Total Sales --}}
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon text-bg-success">
                            <i class="bi bi-currency-dollar"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Sales</span>
                            <span class="info-box-number">${{ number_format($totalSales, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
            <!--begin::Row-->
            {{-- <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Recap Report</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bi bi-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item"> Something else here </a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong>
                                </p>
                                <div id="sales-chart"></div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center"><strong>Goal Completion</strong></p>
                                <div class="progress-group">
                                    Add Products to Cart
                                    <span class="float-end"><b>160</b>/200</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar text-bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    Complete Purchase
                                    <span class="float-end"><b>310</b>/400</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar text-bg-danger" style="width: 75%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Visit Premium Page</span>
                                    <span class="float-end"><b>480</b>/800</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar text-bg-success" style="width: 60%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    Send Inquiries
                                    <span class="float-end"><b>250</b>/500</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar text-bg-warning" style="width: 50%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    <span class="text-success">
                                        <i class="bi bi-caret-up-fill"></i> 17%
                                    </span>
                                    <h5 class="fw-bold mb-0">$35,210.43</h5>
                                    <span class="text-uppercase">TOTAL REVENUE</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    <span class="text-info"> <i class="bi bi-caret-left-fill"></i> 0% </span>
                                    <h5 class="fw-bold mb-0">$10,390.90</h5>
                                    <span class="text-uppercase">TOTAL COST</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    <span class="text-success">
                                        <i class="bi bi-caret-up-fill"></i> 20%
                                    </span>
                                    <h5 class="fw-bold mb-0">$24,813.53</h5>
                                    <span class="text-uppercase">TOTAL PROFIT</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center">
                                    <span class="text-danger">
                                        <i class="bi bi-caret-down-fill"></i> 18%
                                    </span>
                                    <h5 class="fw-bold mb-0">1200</h5>
                                    <span class="text-uppercase">GOAL COMPLETIONS</span>
                                </div>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div> --}}
            <!-- /.col -->
        </div>
        <!--end::Row-->


        <!--begin::Row-->
        {{-- <div class="row">
            <!-- Start col -->
            <div class="col-md-8">
                <!--begin::Row-->
                <div class="row g-4 mb-4">
                    <!-- /.col -->
                    <div class="col-5">
                        <!-- USERS LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Members</h3>
                                <div class="card-tools">
                                    <span class="badge text-bg-danger">{{ $user->count() }} New Members</span>
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
                                <div class="row text-center m-1">
                                    @forelse ($users as $user)
                                        <div class="col-3 p-2">
                                            <img class="img-fluid rounded-circle"
                                                src="{{ 'images/users/' . $user->image ?? asset('images/users/') }}"
                                                alt="{{ $user->name }}" />
                                            <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0"
                                                href="#">
                                                {{ $user->name }}
                                            </a>
                                            <div class="fs-8">{{ $user->created_at->format('d M') }}</div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center py-3">
                                            <p class="text-muted">No members found.</p>
                                        </div>
                                    @endforelse
                                </div>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ route('user.index') }}"
                                    class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    View All Users
                                </a>
                            </div>
                            <!-- /.card-footer -->

                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                    <div class="col-7">
                        <div class="card form-control">
                            <div class="card-header">
                                <h3 class="card-title">Recently Added Products</h3>
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

                            <div class="card-body p-0">
                                <div class="px-2">
                                    @forelse ($todayfoods as $product)
                                        <div class="d-flex border-top py-2 px-1">
                                            <div class="col-2">
                                                <img src="{{ 'foods/image/' . $product->image ?? asset('assets/img/default-150x150.png') }}"
                                                    alt="Product Image" class="img-size-50" />
                                            </div>
                                            <div class="col-10">
                                                <a href="javascript:void(0)" class="fw-bold">
                                                    {{ $product->title }}
                                                    <span
                                                        class="badge
                                                        @if ($product->price < 5) text-bg-danger
                                                        @elseif($product->price < 10) text-bg-info
                                                        @elseif($product->price < 20) text-bg-warning
                                                        @else text-bg-success @endif
                                                        float-end">
                                                        ${{ $product->price }}
                                                    </span>
                                                </a>
                                                <div class="text-truncate">{{ $product->desc }}</div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="py-3 text-center text-muted">
                                            No products added today.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <a href="{{ route('food.index') }}" class="uppercase">View All Products</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div> --}}
        <div class="row">
            <!-- Left Column: Latest Members -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Latest Members</h3>
                        <div class="card-tools" style="float: left;">
                            <span class="badge text-bg-danger">{{ $users->count() }} New Members</span>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="row text-center g-2">
                            @forelse ($users as $user)
                                <div class="col-2">
                                    <img class="img-fluid rounded-circle"
                                        src="{{ $user->image ? asset('images/users/' . $user->image) : asset('assets/img/default-user.png') }}"
                                        alt="{{ $user->name }}">
                                    <a class="d-block text-truncate fw-bold fs-7 text-secondary" href="#">
                                        {{ $user->name }}
                                    </a>
                                    <small class="text-muted">{{ $user->created_at->format('d M') }}</small>
                                </div>
                            @empty
                                <div class="col-12 text-center py-3 text-muted">
                                    No members found.
                                </div>
                            @endforelse
                        </div>
                    </div>
                    {{-- <div class="card-footer clearfix">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary float-start">
                            View All User
                        </a>
                    </div> --}}
                </div>
            </div>

            <!-- Right Column: Today’s Products -->
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
                        {{-- <a href="{{ route('food.index') }}" class="btn btn-sm btn-secondary float-end">
                            View All Foods
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-7 connectedSortable">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Sales Value</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="revenue-chart" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- Pass PHP data to JS --}}
            <script>
                const months = @json($months);
                const totals = @json($totals);
            </script>

            {{-- Chart.js Script --}}
            {{-- <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script> --}}
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const ctx = document.getElementById('revenue-chart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Sales ($)',
                            data: totals,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: true },
                            tooltip: { enabled: true }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            });
            </script>

            <!-- /.Start col -->
            <!-- Start col -->

            <!-- /.Start col -->
        </div>

        {{-- <div class="row">
            <!-- Start col -->
            <div class="col-md-8">
                <!--begin::Row-->

                <!--end::Row-->
                <!--begin::Latest Order Widget-->
                <div class="card">
                    <div class="card-header form-control">
                        <h3 class="card-title">Latest Orders</h3>

                    </div>
                    <!-- /.card-header -->
                    @include('admin.Foods.orders.show')
                    <!-- /.card-footer -->
                </div>


                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div> --}}
        <!--end::Row-->
    </div>
    <!--end::Container-->
    </div>


@endsection
