<!-- /.col-md-6 -->
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="{{route('sale.report')}}"
                    class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View
                    Report</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="fw-bold fs-5">${{ number_format($totalSales, 2) }}</span>
                    <span>Sales Over Time</span>
                </p>
                <p class="ms-auto d-flex flex-column text-end">

                    <span class="text-secondary">Since Past Year</span>
                </p>


            </div>

            <!-- Chart placeholder -->
            <div class="position-relative mb-4">
                <div id="sales-chart" style="height:250px; background:#f8f9fa; text-align:center; line-height:250px;">
                    Chart Here
                </div>
            </div>

            <div class="d-flex flex-row justify-content-end">
                <span class="me-2">
                    <i class="bi bi-square-fill text-primary"></i> This year
                </span>
                <span>
                    <i class="bi bi-square-fill text-secondary"></i> Last year
                </span>
            </div>
        </div>
    </div>
</div>


