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

        <!-- Discounts List -->
        <div class="tab-content mt-4">
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
                                    <img src="https://placehold.co/80x60" alt="No Image" style="border-radius:5px;"
                                        class="me-3">
                                @endif

                                <!-- Card Content -->
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $discount->food->title ?? '-' }}</h6>
                                    <p class="mb-1 text-muted" style="font-size:0.85rem;">
                                        {{ Str::limit($discount->food->desc ?? 'No description', 60) }}
                                    </p>
                                    <p class="mb-1" style="font-size:0.8rem;">
                                        <span class="text-warning">
                                            {{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y') }}
                                        </span> -
                                        <span class="text-danger">
                                            {{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y') }}
                                        </span>
                                    </p>
                                    <div class="price mb-2">
                                        <span class="text-decoration-line-through text-muted me-2"
                                            style="font-size:0.85rem;">
                                            ${{ number_format($discount->food->price, 2) }}
                                        </span>
                                        <span class="fw-bold text-success">
                                            ${{ number_format($discount->food->price - ($discount->food->price * $discount->discount_percent) / 100, 2) }}
                                        </span>
                                    </div>

                                    <!-- Order Button -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#orderModal{{ $discount->id }}">
                                        Order
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Order Modal -->
                        <div class="modal fade" id="orderModal{{ $discount->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <form action="{{ route('discount.storediscount') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="food_id" value="{{ $discount->food->id }}">
                                    <input type="hidden" name="discount_id" value="{{ $discount->id }}">

                                    @php
                                        $discountPrice =
                                            $discount->food->price -
                                            ($discount->food->price * $discount->discount_percent) / 100;
                                    @endphp

                                    <div class="modal-content shadow-sm rounded">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Order: {{ $discount->food->title }}</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <!-- Customer Info -->
                                                <div class="col-12 col-md-6">
                                                    <input type="text" name="customer_name" class="form-control mb-2"
                                                        placeholder="Name" required>
                                                    <input type="text" name="customer_phone"
                                                        class="form-control mb-2" placeholder="Phone">
                                                    <textarea name="customer_address" class="form-control" rows="3" placeholder="Address"></textarea>
                                                </div>

                                                <!-- Order Info -->
                                                <div class="col-12 col-md-6">
                                                    <div class="border rounded p-2 bg-light mb-2">
                                                        <p class="mb-1 text-muted small">Original: <span
                                                                class="text-decoration-line-through">${{ number_format($discount->food->price, 2) }}</span>
                                                        </p>
                                                        <p class="mb-1 text-success fw-bold">Discount: $<span
                                                                id="price-{{ $discount->id }}">{{ number_format($discountPrice, 2) }}</span>
                                                        </p>
                                                        <p class="mb-1 fw-bold">Total: $<span
                                                                id="total-{{ $discount->id }}">{{ number_format($discountPrice, 2) }}</span>
                                                        </p>
                                                        <p class="mb-1 fw-bold text-info"
                                                            id="change-text-{{ $discount->id }}"
                                                            style="display:none;">Change: $<span
                                                                id="change-{{ $discount->id }}">0.00</span></p>
                                                    </div>

                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" name="quantity"
                                                        id="quantity{{ $discount->id }}" class="form-control mb-2"
                                                        min="1" value="1" required
                                                        oninput="updateTotal('{{ $discount->id }}', {{ $discountPrice }})">

                                                    <label class="form-label">Payment Method</label>
                                                    <select name="payment_method" class="form-select mb-2"
                                                        onchange="togglePaymentFields(this, '{{ $discount->id }}')">
                                                        <option value="cash">Cash</option>
                                                        <option value="card">Card</option>
                                                    </select>

                                                    <!-- Cash Section -->
                                                    <div id="cash-section-{{ $discount->id }}">
                                                        <input type="number" name="customer_pay"
                                                            id="customer_pay{{ $discount->id }}"
                                                            class="form-control mb-2" min="0" step="0.01"
                                                            placeholder="Customer Pay"
                                                            oninput="calculateChange('{{ $discount->id }}', {{ $discountPrice }})">
                                                    </div>

                                                    <!-- Card Section -->
                                                    <div id="card-section-{{ $discount->id }}" style="display:none;">
                                                        <input type="text" name="card_number"
                                                            class="form-control mb-2" placeholder="Card Number">
                                                        <div class="d-flex gap-2">
                                                            <input type="text" name="expiry" class="form-control"
                                                                placeholder="MM/YY">
                                                            <input type="text" name="cvc" class="form-control"
                                                                placeholder="CVC">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Confirm Order</button>
                                        </div>
                                    </div>
                                </form>
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

    <!-- JS for Payment, Quantity, Total & Change -->
    <script>
        function togglePaymentFields(select, id) {
            const cashSection = document.getElementById('cash-section-' + id);
            const cardSection = document.getElementById('card-section-' + id);

            if (select.value === 'cash') {
                cashSection.style.display = 'block';
                cardSection.style.display = 'none';
            } else {
                cashSection.style.display = 'none';
                cardSection.style.display = 'block';
            }
        }

        function updateTotal(id, price) {
            const qty = parseInt(document.getElementById('quantity' + id).value) || 1;
            const total = (qty * price).toFixed(2);
            document.getElementById('total-' + id).innerText = total;
            calculateChange(id, price);
        }

        function calculateChange(id, price) {
            const qty = parseInt(document.getElementById('quantity' + id).value) || 1;
            const total = qty * price;
            const customerPay = parseFloat(document.getElementById('customer_pay' + id).value) || 0;
            const change = (customerPay - total).toFixed(2);

            const changeText = document.getElementById('change-text-' + id);
            const changeValue = document.getElementById('change-' + id);

            if (customerPay > 0) {
                changeText.style.display = 'block';
                changeValue.innerText = change >= 0 ? change : "0.00";
            } else {
                changeText.style.display = 'none';
            }
        }
    </script>

    <!-- SweetAlert Success -->
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    </div>
</section>
