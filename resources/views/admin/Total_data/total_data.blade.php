
<div class="row g-3">

    {{-- Total Chef --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-warning d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-person-workspace fs-4"></i> {{-- chef/worker --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Chef</span>
                <span class="info-box-number fs-5 fw-bold">{{ $countchef }}</span>
            </div>
        </div>
    </div>

    {{-- Total Stock --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-primary d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-box-seam fs-4"></i> {{-- box/stock --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Stock</span>
                <span class="info-box-number fs-5 fw-bold">{{ $countstock }} </span>
            </div>
        </div>
    </div>

    {{-- Total Category --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-danger d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-grid-3x3-gap-fill fs-4"></i> {{-- category/grid --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Category</span>
                <span class="info-box-number fs-5 fw-bold">{{ $countCategory }} Item</span>
            </div>
        </div>
    </div>

    {{-- Total Delivery --}}
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box shadow-sm d-flex align-items-center p-3 rounded-3 bg-white">
            <span class="info-box-icon text-bg-success d-flex align-items-center justify-content-center rounded-circle p-3 me-3">
                <i class="bi bi-truck fs-4"></i> {{-- delivery/truck --}}
            </span>
            <div class="info-box-content">
                <span class="info-box-text fw-semibold text-secondary">Total Delivery</span>
                <span class="info-box-number fs-5 fw-bold">{{ $countDelivery }}</span>
            </div>
        </div>
    </div>

</div>
