<section class="section py-5" id="menu">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6 class="text-warning fw-semibold">Our Menu</h6>
                    <h2 class="fw-bold">Our selection of cakes with quality taste</h2>
                </div>
            </div>
        </div>

        <div class="menu-item-carousel">
            <div class="owl-menu-item owl-carousel">
                @foreach ($foods as $food)
                    <div class="order-card shadow-sm rounded overflow-hidden bg-white border border-light">
                        <div class="order-image-wrapper position-relative overflow-hidden rounded-top">
                            <img src="{{ asset('foods/image/' . $food->image) }}" alt="{{ $food->title }}"
                                class="w-100" style="height: 180px; object-fit: cover;">
                        </div>
                        <div class="order-content p-3">
                            <h5 class="order-title fw-bold mb-2 text-dark">{{ $food->title }}</h5>

                            <div class="order-description mb-2">
                                {{ Str::limit($food->desc, 100) }}
                            </div>

                            <div class="order-price fw-bold text-warning mb-3">
                                ${{ number_format($food->price, 2) }}
                            </div>

                            <div class="order-stars mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star{{ $i < $food->rating ? '' : '-o' }} text-warning"></i>
                                @endfor
                            </div>

                            <div
                                class="order-info d-flex justify-content-start align-items-center gap-3 mb-3 text-muted small">
                                <div class="info-item d-flex align-items-center gap-1">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> <span></span>
                                </div>
                                <div class="info-item d-flex align-items-center gap-1">
                                    <i class="fa fa-users" aria-hidden="true"></i> <span>2 people</span>
                                </div>
                                <div class="info-item d-flex align-items-center gap-1">
                                    <i class="fa fa-star" aria-hidden="true"></i> <span>Beginner</span>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-warning w-100 fw-semibold mb-2"
                                style="border-radius: 25px; font-size: 0.95rem;" data-bs-toggle="modal"
                                data-bs-target="#viewModal" data-foodtitle="{{ $food->title }}"
                                data-fooddesc="{{ $food->desc }}" data-foodprice="{{ $food->price }}"
                                data-foodimage="{{ asset('foods/image/' . $food->image) }}">
                                View Recipe
                            </button>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>





<!-- View Recipe Modal with 3D card style -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content rounded-4 shadow"
            style="transform-style: preserve-3d; perspective: 1000px;
                  box-shadow: 0 8px 20px rgba(0,0,0,0.25);
                  transform: rotateX(3deg);">

            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="viewModalLabel">Food Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 pt-0 pb-4">
                <div class="text-center mb-3">
                    <img id="viewFoodImage" src="" alt="" class="rounded shadow"
                        style="max-height: 150px; max-width: 200px; object-fit: cover; display: inline-block;">
                </div>

                <h5 id="viewFoodTitle" class="fw-bold mb-2"></h5>
                <h6 id="viewFoodPrice" class="text-warning fw-semibold mb-3"></h6>
                <p id="viewFooddesc" class="text-muted"></p>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Order Modal -->
{{-- <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0" style="transform: perspective(1000px) rotateX(2deg);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="orderModalLabel">
                    Place Your Order
                    <p>
                        <span class="text-warning ms-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                    </p>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="modal-body pt-2">
                    <div class="text-center mb-2">
                        <img id="modalFoodImage" src="" alt="" class="rounded-3 shadow-sm w-100" style="max-height: 150px; object-fit: cover;">
                    </div>

                    <h6 id="modalFoodTitle" class="fw-bold mb-1"></h6>
                    <p id="modalFoodPrice" class="text-warning fw-semibold mb-3"></p>

                    <input type="hidden" name="food_id" id="modalFoodId">

                    <div class="mb-2">
                        <input type="text" name="customer_name" class="form-control form-control-sm" placeholder="Customer Name" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="phone" class="form-control form-control-sm" placeholder="Phone" required>
                    </div>
                    <div class="mb-2">
                        <textarea name="address" class="form-control form-control-sm" rows="2" placeholder="Address" required></textarea>
                    </div>
                    <div class="mb-2">
                        <textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="Note" required></textarea>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <input type="number" id="orderQuantity" name="quantity" value="1" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                        <span class="fw-bold">Total: <span id="orderTotal" class="text-success"></span></span>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-warning w-100 fw-semibold shadow-sm">
                        Confirm Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<script>
    // View Recipe Modal
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        var title = button.getAttribute('data-foodtitle');
        var desc = button.getAttribute('data-fooddesc');
        var price = button.getAttribute('data-foodprice');
        var image = button.getAttribute('data-foodimage');

        document.getElementById('viewFoodTitle').textContent = title;
        document.getElementById('viewFooddesc').textContent = desc;
        document.getElementById('viewFoodPrice').textContent = "$" + parseFloat(price).toFixed(2);
        document.getElementById('viewFoodImage').src = image;
    });

    // Order Modal
    var orderModal = document.getElementById('orderModal');
    orderModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var title = button.getAttribute('data-foodtitle');
        var price = parseFloat(button.getAttribute('data-foodprice'));
        var image = button.getAttribute('data-foodimage');
        var id = button.getAttribute('data-foodid');

        document.getElementById('modalFoodTitle').textContent = title;
        document.getElementById('modalFoodPrice').textContent = "$" + price.toFixed(2);
        document.getElementById('modalFoodImage').src = image;
        document.getElementById('modalFoodId').value = id;

        var qtyInput = document.getElementById('orderQuantity');
        var totalEl = document.getElementById('orderTotal');

        // Reset quantity on modal show
        qtyInput.value = 1;

        function updateTotal() {
            var qty = parseInt(qtyInput.value) || 1;
            totalEl.textContent = "$" + (qty * price).toFixed(2);
        }

        qtyInput.addEventListener('input', updateTotal);
        updateTotal();
    });
</script>

<style>
    /* Menu Cards */
    #menu .card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    #menu .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    #menu .card-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        margin-bottom: 6px;
    }

    #menu .star-rating {
        color: #f1c40f;
        font-size: 1rem;
        margin-bottom: 8px;
        user-select: none;
    }

    #menu .star-rating span {
        margin-right: 2px;
    }

    #menu .price-text {
        font-weight: 700;
        font-size: 1.1rem;
        color: #d18c00;
        margin-bottom: 10px;
    }

    #menu .btn-warning {
        border-radius: 20px;
        font-weight: 600;
    }

    /* Order Cart */
    #menu .card.shadow-sm {
        border-radius: 12px;
    }

    #cart-items {
        max-height: 280px;
        overflow-y: auto;
    }

    #cart-items ul.list-group {
        padding-left: 0;
        margin-bottom: 0;
    }

    #cart-items ul.list-group li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #eee;
        padding: 8px 0;
        font-size: 0.9rem;
    }

    #cart-items ul.list-group li:last-child {
        border-bottom: none;
    }

    #cart-items ul.list-group li .item-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #cart-items ul.list-group li .item-info img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 5px;
    }

    #cart-items ul.list-group li .item-title {
        font-weight: 600;
        color: #444;
    }

    #cart-items ul.list-group li .star-icon {
        color: #f1c40f;
        margin-left: 6px;
        font-size: 1.1rem;
        user-select: none;
    }

    #cart-items ul.list-group li .qty-controls {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-left: 12px;
    }

    #cart-items ul.list-group li button.qty-btn {
        border-radius: 50%;
        width: 26px;
        height: 26px;
        font-weight: bold;
        font-size: 16px;
        line-height: 1;
        padding: 0;
    }

    #cart-items ul.list-group li .item-total {
        font-weight: 700;
        color: #666;
        min-width: 60px;
        text-align: right;
    }

    /* Scrollbar styling for cart */
    #cart-items::-webkit-scrollbar {
        width: 6px;
    }

    #cart-items::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
</style>
<section class="section py-5" id="menu">
    <div class="container">
        <div class="row">
            <!-- Menu Items -->
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($foods as $food)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('foods/image/' . $food->image) }}" class="card-img-top"
                                    style="height:150px; object-fit:cover; border-top-left-radius:12px; border-top-right-radius:12px;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $food->title }}</h5>
                                    <div class="star-rating" aria-label="5 star rating">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                    </div>
                                    <p class="price-text">${{ number_format($food->price, 2) }}</p>
                                    <button type="button" class="btn btn-sm btn-warning mt-auto add-to-cart"
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
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white fw-bold fs-5">
                        Your Order
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('orders.store') }}" method="POST" id="cart-form" class="card-body d-flex flex-column">
                        @csrf

                        <div id="cart-items" style="flex-grow:1; overflow-y:auto; min-height: 150px;">
                            <p class="text-muted">No items added yet.</p>
                        </div>

                        <div class="mt-3">
                            <!-- Total -->
                            <div class="d-flex justify-content-between fw-bold mb-2 fs-5">
                                <span>Total:</span>
                                <span id="cart-total">$0.00</span>
                            </div>

                            <!-- Customer Payment -->
                            <div class="mb-2">
                                <label class="fw-semibold" for="customer-pay">Customer Pay</label>
                                <input type="number" step="0.01" id="customer-pay" name="customer_pay_visible"
                                    class="form-control form-control-sm" placeholder="Enter amount">
                            </div>

                            <!-- Change -->
                            <div class="mb-2">
                                <label class="fw-semibold" for="customer-change">Change</label>
                                <input type="text" id="customer-change" class="form-control form-control-sm" readonly>
                            </div>

                            <!-- Customer Info -->
                            <div class="mb-2">
                                <label class="fw-semibold" for="customer-name">Customer Name</label>
                                <input type="text" id="customer-name" name="customer_name" class="form-control form-control-sm" placeholder="Enter customer name" required>
                            </div>

                            <div class="mb-2">
                                <label class="fw-semibold" for="customer-phone">Phone</label>
                                <input type="tel" id="customer-phone" name="phone" class="form-control form-control-sm" placeholder="Enter phone number" required pattern="[\d\s\-\+\(\)]{7,}">
                            </div>

                            <div class="mb-2">
                                <label class="fw-semibold" for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control form-control-sm" placeholder="Enter address" required>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-2">
                                <label class="fw-semibold" for="payment-method">Payment Method</label>
                                <select name="payment_method_visible" id="payment-method" class="form-control form-control-sm">
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit/Debit Card</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                            </div>

                            <!-- Payment Details (card) -->
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

                            <!-- Hidden fields to submit -->
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
        // Elements
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

        // Cart state
        let cart = []; // items: {id, title, price, qty, image}
        let cartTotalValue = 0;

        // Helpers
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
                }[m];
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

        // Render cart items with quantity controls and star icon
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
              <div class="d-flex align-items-center">
                <img src="${item.image}" alt="${escapeHtml(item.title)}" style="width:50px; height:50px; object-fit:cover; border-radius:6px; margin-right:10px;">
                <div>
                  <div>${escapeHtml(item.title)} <span class="star-icon">★ ★ ★ ★ ★</span></div>
                  <small class="text-muted">Unit Price: ${formatMoney(item.price)}</small>
                  <div class="qty-controls mt-1">
                    <button class="btn btn-secondary btn-sm qty-btn qty-decrease" data-index="${index}">−</button>
                    <span class="mx-2">Qty: ${item.qty}</span>
                    <button class="btn btn-secondary btn-sm qty-btn qty-increase" data-index="${index}">+</button>
                  </div>
                </div>
              </div>
              <div>${formatMoney(item.price * item.qty)}</div>
            </li>
          `).join('')}
        </ul>
      `;

            updateCartTotal();
        }

        // Add to cart event (with quantity increase if exists)
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

        // Quantity buttons event (increase/decrease)
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

        // Pay input event
        payInput.addEventListener("input", calculateChange);

        // Payment method toggle
        paymentMethodSelect.addEventListener("change", function() {
            const value = this.value;
            paymentSelected.value = value;
            if (value === 'credit') {
                paymentDetails.style.display = 'block';
            } else {
                paymentDetails.style.display = 'none';
            }
        });

        // Form submit validation & hidden fields update
        document.getElementById("cart-form").addEventListener("submit", function(e) {
            if (cart.length === 0) {
                e.preventDefault();
                alert('Cart is empty. Add items before placing order.');
                return;
            }
            const customerName = document.getElementById("customer-name").value.trim();
            const customerPhone = document.getElementById("customer-phone").value.trim();
            const address = document.getElementById("address").value.trim();

            if (!customerName) {
                e.preventDefault();
                alert('Please enter customer name.');
                return;
            }
            if (!customerPhone) {
                e.preventDefault();
                alert('Please enter phone number.');
                return;
            }
            if (!address) {
                e.preventDefault();
                alert('Please enter address.');
                return;
            }

            cartDataInput.value = JSON.stringify(cart);
            totalHidden.value = cartTotalValue.toFixed(2);
            payHidden.value = (parseFloat(payInput.value) || 0).toFixed(2);
            changeHidden.value = (parseFloat(changeInput.value.replace(/[^\d.-]/g, '')) || 0).toFixed(2);
            paymentSelected.value = paymentMethodSelect.value;
        });

        // Initialize default state
        paymentSelected.value = paymentMethodSelect.value;
        renderCart();
    });
</script>

