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


</div>
