
<div class="row g-3">

    {{-- Total Users --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-warning d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-person-circle fs-4"></i> {{-- users --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Users</span>
                <span class="info-box-number fs-5 fw-bold">{{ $userCount }}</span>
            </div>
        </div>
    </div>

    {{-- Total Orders --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-primary d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-cart-check fs-4"></i> {{-- orders --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Orders</span>
                <span class="info-box-number fs-5 fw-bold">{{ $orderCount }}</span>
            </div>
        </div>
    </div>

    {{-- Total Foods --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-danger d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-cup-straw fs-4"></i> {{-- foods/drinks --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Foods</span>
                <span class="info-box-number fs-5 fw-bold">{{ $foodCount }}</span>
            </div>
        </div>
    </div>

    {{-- Total Sales --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-success d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-graph-up-arrow fs-4"></i> {{-- sales --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Sales</span>
                <span class="info-box-number fs-5 fw-bold">$ {{ number_format($totalSales, 2) }}</span>
            </div>
        </div>
    </div>
</div>
