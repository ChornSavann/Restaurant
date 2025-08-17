
<section class="section" id="offers">
    <div class="container">
        <!-- Section Heading -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Klassy Week</h6>
                    <h2>This Week’s Special Meal Offers</h2>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="heading-tabs">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 text-center d-flex justify-content-center">
                            <ul class="list-unstyled d-flex mb-0">
                                <li class="me-3">
                                    <a href="#" class="active">
                                        <img src="assets/images/tab-icon-01.png" alt="Breakfast Icon" class="me-1">
                                        Breakfast
                                    </a>
                                </li>
                                <li class="me-3">
                                    <a href="#">
                                        <img src="assets/images/tab-icon-02.png" alt="Lunch Icon" class="me-1">
                                        Lunch
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/tab-icon-03.png" alt="Dinner Icon" class="me-1">
                                        Dinner
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Content -->
        <div class="tab-content mt-4">
            <!-- Example: Lunch Tab -->
            <div class="tab-pane fade show active" id="tabs-2">
                <div class="row">
                    @forelse ($discounts as $discount)
                        <div class="col-lg-6 col-md-6 mb-3">
                            <div class="d-flex shadow-sm rounded p-2 align-items-center">
                                <!-- Food Image -->
                                @if ($discount->food && $discount->food->image)
                                    <img src="{{ asset('foods/image/' . $discount->food->image) }}"
                                         alt="{{ $discount->food->title }}"
                                         style="width:80px; height:60px; object-fit:cover; border-radius:5px;"
                                         class="me-3">
                                @else
                                    <img src="https://placehold.co/80x60"
                                         alt="No Image"
                                         style="border-radius:5px;" class="me-3">
                                @endif

                                <!-- Card Content -->
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $discount->food->title ?? '-' }}</h6>
                                    <p class="mb-1 text-muted" style="font-size:0.85rem;">
                                        {{ Str::limit($discount->food->desc ?? 'No description', 60) }}
                                    </p>
                                    <p class="mb-1" style="font-size:0.8rem;">
                                        <span class="text-warning">{{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y') }}</span> -
                                        <span class="text-danger">{{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y') }}</span>
                                    </p>
                                    <div class="price">
                                        <span class="text-decoration-line-through text-muted me-2" style="font-size:0.85rem;">
                                            ${{ number_format($discount->food->price, 2) }}
                                        </span>
                                        <span class="fw-bold text-success">
                                            ${{ number_format($discount->food->price - ($discount->food->price * $discount->discount_percent) / 100, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No discounts available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
