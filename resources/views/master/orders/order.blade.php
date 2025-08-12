<section class="section py-5" id="order">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6 class="text-warning fw-semibold">Our Orders</h6>
                    <h2 class="fw-bold">Our selection of cake for Orders Please..!</h2>
                </div>
            </div>
        </div>
        <!-- Search Bar -->
        <div class="row mb-3">
            <div class="col-lg-8">
                <input type="text" id="menu-search" class="form-control" placeholder="Search for a food...">
            </div>
        </div>

        <div class="row">
            <!-- Menu Items with vertical scroll -->
            <div class="col-lg-8" style="max-height: 600px; overflow-y: auto;">
                <div class="row" id="menu-items">
                    @foreach ($foods as $food)
                        <div class="col-md-4 mb-4 menu-item" data-title="{{ strtolower($food->title) }}"
                            data-desc="{{ strtolower($food->desc) }}">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('foods/image/' . $food->image) }}" class="card-img-top"
                                    style="height:150px; object-fit:cover; border-top-left-radius:12px; border-top-right-radius:12px;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $food->title }}</h5>
                                    <div class="star-rating text-warning" aria-label="5 star rating">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <div class="order-description mb-2">
                                        {{ Str::limit($food->desc, 100) }}
                                    </div>
                                    <p class="price-text fw-bold text-warning mb-3">
                                        ${{ number_format($food->price, 2) }}</p>
                                    <button type="button"
                                        class="btn btn-outline-warning w-100 fw-semibold  add-to-cart"
                                        data-id="{{ $food->id }}" data-title="{{ $food->title }}"
                                        data-price="{{ $food->price }}"
                                        data-image="{{ asset('foods/image/' . $food->image) }}">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Cart -->
            <div class="col-lg-4">
                <div id="alert-container"></div>

                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white fw-bold fs-5">
                        Your Order
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST" id="cart-form"
                        class="card-body d-flex flex-column">
                        @csrf

                        <div id="cart-items" style="flex-grow:1; overflow-y:auto; min-height: 150px;">
                            <p class="text-muted">No items added yet.</p>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex justify-content-between fw-bold mb-2 fs-5">
                                <span>Total:</span>
                                <span id="cart-total">$0.00</span>
                            </div>

                            <div class="mb-2">
                                <label for="customer-pay" class="fw-semibold">Customer Pay</label>
                                <input type="number" step="0.01" id="customer-pay" name="customer_pay_visible"
                                    class="form-control form-control-sm" placeholder="Enter amount">
                            </div>

                            <div class="mb-2">
                                <label for="customer-change" class="fw-semibold">Change</label>
                                <input type="text" id="customer-change" class="form-control form-control-sm"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="customer-name" class="fw-semibold">Customer Name</label>
                                <input type="text" id="customer-name" name="customer_name" required
                                    class="form-control form-control-sm" placeholder="Enter customer name">
                            </div>

                            <div class="mb-2">
                                <label for="customer-phone" class="fw-semibold">Phone</label>
                                <input type="tel" id="customer-phone" name="phone" required
                                    pattern="[\d\s\-\+\(\)]{7,}" class="form-control form-control-sm"
                                    placeholder="Enter phone number">
                            </div>

                            <div class="mb-2">
                                <label for="address" class="fw-semibold">Address</label>
                                <input type="text" id="address" name="address" required
                                    class="form-control form-control-sm" placeholder="Enter address">
                            </div>

                            <div class="mb-2">
                                <label for="payment-method" class="fw-semibold">Payment Method</label>
                                <select name="payment_method_visible" id="payment-method"
                                    class="form-control form-control-sm">
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit/Debit Card</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                            </div>

                            <div id="payment-details" style="display:none;">
                                <div class="mb-2">
                                    <input type="text" id="card_number" name="card_number"
                                        class="form-control form-control-sm" placeholder="Card Number">
                                </div>
                                <div class="mb-2 d-flex gap-2">
                                    <input type="text" id="expiry" name="expiry"
                                        class="form-control form-control-sm" placeholder="MM/YY">
                                    <input type="text" id="cvc" name="cvc"
                                        class="form-control form-control-sm" placeholder="CVC">
                                </div>
                            </div>

                            <!-- Hidden inputs -->
                            <input type="hidden" name="cart_data" id="cart-data">
                            <input type="hidden" name="payment_selected" id="payment-selected">
                            <input type="hidden" name="total_amount" id="total-amount">
                            <input type="hidden" name="customer_pay" id="customer-pay-hidden">
                            <input type="hidden" name="customer_change" id="customer-change-hidden">

                            <button type="submit" class="btn btn-success w-100 mt-2" disabled id="checkout-btn">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ===== SEARCH FUNCTION =====
        const searchInput = document.getElementById('menu-search');
        const menuItems = document.querySelectorAll('.menu-item');

        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            menuItems.forEach(item => {
                const title = item.dataset.title;
                const desc = item.dataset.desc;
                if (title.includes(query) || desc.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // ===== CART FUNCTIONALITY =====
        const cartItemsContainer = document.getElementById("cart-items");
        const totalEl = document.getElementById("cart-total");
        const payInput = document.getElementById("customer-pay");
        const changeInput = document.getElementById("customer-change");
        const checkoutBtn = document.getElementById("checkout-btn");

        const totalHidden = document.getElementById("total-amount");
        const payHidden = document.getElementById("customer-pay-hidden");
        const changeHidden = document.getElementById("customer-change-hidden");
        const cartDataInput = document.getElementById("cart-data");
        const paymentSelected = document.getElementById("payment-selected");

        const paymentMethodSelect = document.getElementById("payment-method");
        const paymentDetails = document.getElementById("payment-details");

        const alertContainer = document.getElementById("alert-container");

        let cart = [];
        let cartTotalValue = 0;

        function formatMoney(num) {
            return '$' + Number(num).toFixed(2);
        }

        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/[&<>"']/g, function(m) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [m];
            });
        }

        function updateCartTotal() {
            cartTotalValue = cart.reduce((sum, it) => sum + (it.price * it.qty), 0);
            totalEl.textContent = formatMoney(cartTotalValue);
            totalHidden.value = cartTotalValue.toFixed(2);
            cartDataInput.value = JSON.stringify(cart);
            calculateChange();
        }

        function calculateChange() {
            const paid = parseFloat(payInput.value) || 0;
            const change = paid - cartTotalValue;

            if (cart.length === 0) {
                changeInput.value = '';
                checkoutBtn.disabled = true;
            } else if (change >= 0) {
                changeInput.value = formatMoney(change);
                checkoutBtn.disabled = false;
            } else {
                changeInput.value = 'Not enough';
                checkoutBtn.disabled = true;
            }

            payHidden.value = (paid || 0).toFixed(2);
            changeHidden.value = change >= 0 ? change.toFixed(2) : 0;
        }

        function renderCart() {
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `<p class="text-muted">No items added yet.</p>`;
                checkoutBtn.disabled = true;
                return;
            }

            cartItemsContainer.innerHTML = `
                <ul class="list-group">
                    ${cart.map((item, index) => `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <!-- Left: Image + Info -->
                            <div class="d-flex align-items-center flex-grow-1">
                                <img src="${item.image}" alt="${escapeHtml(item.title)}"
                                    class="rounded" style="width:60px; height:60px; object-fit:cover; margin-right:12px;">
                                <div>
                                    <div class="fw-bold">${escapeHtml(item.title)}</div>
                                    <div class="text-warning small">★ ★ ★ ★ ★</div>
                                    <small class="text-muted">Unit Price: ${formatMoney(item.price)}</small>
                                </div>
                            </div>

                            <!-- Middle: Qty controls -->
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-secondary btn-sm qty-btn qty-decrease me-1" data-index="${index}">−</button>
                                <span class="fw-bold">${item.qty}</span>
                                <button class="btn btn-outline-secondary btn-sm qty-btn qty-increase ms-1" data-index="${index}">+</button>
                            </div>

                            <!-- Right: Total price -->
                            <div class="fw-bold text-end" style="min-width: 80px;">
                                ${formatMoney(item.price * item.qty)}
                            </div>
                        </li>
                    `).join('')}
                </ul>
            `;
            updateCartTotal();
        }

        document.querySelectorAll(".add-to-cart").forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                const title = this.dataset.title;
                const price = parseFloat(this.dataset.price) || 0;
                const image = this.dataset.image || '';

                const existingItem = cart.find(item => item.id === id);
                if (existingItem) {
                    existingItem.qty++;
                } else {
                    cart.push({
                        id,
                        title,
                        price,
                        qty: 1,
                        image
                    });
                }

                renderCart();
            });
        });

        cartItemsContainer.addEventListener("click", function(e) {
            const target = e.target;
            const idx = target.dataset.index ? parseInt(target.dataset.index) : null;
            if (idx === null) return;

            if (target.classList.contains("qty-increase")) {
                cart[idx].qty++;
                renderCart();
            } else if (target.classList.contains("qty-decrease")) {
                cart[idx].qty--;
                if (cart[idx].qty <= 0) {
                    cart.splice(idx, 1);
                }
                renderCart();
            }
        });

        payInput.addEventListener("input", calculateChange);

        paymentMethodSelect.addEventListener("change", function() {
            const value = this.value;
            paymentSelected.value = value;
            if (value === 'credit') {
                paymentDetails.style.display = 'block';
            } else {
                paymentDetails.style.display = 'none';
            }
        });

        document.getElementById("cart-form").addEventListener("submit", function(e) {
            e.preventDefault();

            if (cart.length === 0) {
                alert('Cart is empty. Add items before placing order.');
                return;
            }

            const customerName = document.getElementById("customer-name").value.trim();
            const customerPhone = document.getElementById("customer-phone").value.trim();
            const address = document.getElementById("address").value.trim();

            if (!customerName || !customerPhone || !address) {
                alert('Please fill in all required customer info.');
                return;
            }

            cartDataInput.value = JSON.stringify(cart);
            totalHidden.value = cartTotalValue.toFixed(2);
            payHidden.value = (parseFloat(payInput.value) || 0).toFixed(2);
            changeHidden.value = (parseFloat(changeInput.value.replace(/[^\d.-]/g, '')) || 0).toFixed(
                2);
            paymentSelected.value = paymentMethodSelect.value;

            const submitBtn = checkoutBtn;
            submitBtn.disabled = true;

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: new FormData(this)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alertContainer.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                        this.reset();
                        cart = [];
                        renderCart();
                        payInput.value = '';
                        changeInput.value = '';
                        paymentDetails.style.display = 'none';
                    } else {
                        alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${data.message || 'Failed to place order.'}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                    }
                    submitBtn.disabled = false;
                })
                .catch(() => {
                    alertContainer.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    An unexpected error occurred.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
                    submitBtn.disabled = false;
                });
        });

        paymentSelected.value = paymentMethodSelect.value;
        renderCart();
    });
</script>
