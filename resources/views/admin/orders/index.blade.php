@extends('admin.layout.app')
@section('title', 'Order/Food')
@section('active', 'food')
@section('content')
    @include('admin.font.index')

    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h3 class="mb-0" style="font-family: Cambria; font-weight:bold">Create New Order</h3>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Search Filters -->
                <div class="col-md-4 mb-2">
                    <input type="text" id="food-search" class="form-control" placeholder="Search by name...">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="number" id="min-price" class="form-control" placeholder="Min Price">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="number" id="max-price" class="form-control" placeholder="Max Price">
                </div>
            </div>

            <div class="row">
                <!-- Menu Items -->
                <div class="col-lg-8" style="max-height:600px; overflow-y:auto;">
                    <div class="row" id="menu-items">
                        @foreach ($foods as $food)
                            <div class="col-md-3 mb-4 menu-item" data-title="{{ strtolower($food->title) }}"
                                data-price="{{ $food->price }}" data-stock="{{ $food->stocks->quantity }}">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('foods/image/' . $food->image) }}" class="card-img-top"
                                        style="height:155px; ">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $food->title }}</h5>
                                        <p class="price-text fw-bold text-warning mb-2">
                                            ${{ number_format($food->price, 2) }}</p>
                                        <p class="text-muted mb-2">Stock: {{ $food->stocks->quantity }}</p>
                                        <button type="button" class="btn btn-outline-warning add-to-cart"
                                            data-id="{{ $food->id }}" data-name="{{ $food->title }}"
                                            data-price="{{ $food->price }}" data-stock="{{ $food->stocks->quantity }}">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Cart / Order -->
                {{-- <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white fw-bold fs-5">Your Order</div>
                        <div class="card-body d-flex flex-column">
                            <div id="alert-container"></div>

                            <!-- Cart Items -->
                            <div id="cart-items" style="flex-grow:1; overflow-y:auto; min-height:150px; max-height:400px;">
                                <p class="text-muted">No items added yet.</p>
                            </div>

                            <!-- Customer Info -->
                            <div class="mt-3">
                                <div class="d-flex justify-content-between fw-bold mb-2 fs-5">
                                    <span>Total:</span>
                                    <span id="cart-total">$0.00</span>
                                </div>

                                <input type="text" id="customer-name" placeholder="Customer Name"
                                    class="form-control mb-2">
                                <input type="tel" id="customer-phone" placeholder="Phone" class="form-control mb-2">
                                <input type="text" id="customer-address" placeholder="Address" class="form-control mb-2">
                                <input type="number" step="0.01" id="customer-pay" placeholder="Customer Pay"
                                    class="form-control mb-2">
                                <input type="text" id="customer-change" placeholder="Change" class="form-control mb-2"
                                    readonly>

                                <select id="payment-method" class="form-control mb-2">
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                </select>

                                <div id="payment-details" style="display:none;">
                                    <input type="text" id="card_number" placeholder="Card Number"
                                        class="form-control mb-2">
                                    <div class="d-flex gap-2">
                                        <input type="text" id="expiry" placeholder="MM/YY" class="form-control mb-2">
                                        <input type="text" id="cvc" placeholder="CVC" class="form-control mb-2">
                                    </div>
                                </div>

                                <button id="checkout-btn" class="btn btn-success w-100 mt-2" disabled>Place Order</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-4">
                    <div class="card shadow-sm" id="order-card">
                        <div class="card-header bg-warning text-white fw-bold fs-5">Your Order</div>
                        <div class="card-body d-flex flex-column">
                            <div id="alert-container"></div>

                            <!-- Cart Items -->
                            <div id="cart-items" style="flex-grow:1; overflow-y:auto; min-height:150px; max-height:400px;">
                                <p class="text-muted">No items added yet.</p>
                            </div>

                            <!-- Customer Info -->
                            <div class="mt-3">
                                <div class="d-flex justify-content-between fw-bold mb-2 fs-5">
                                    <span>Total:</span>
                                    <span id="cart-total">$0.00</span>
                                </div>

                                <input type="text" id="customer-name" placeholder="Customer Name"
                                    class="form-control mb-2">
                                <input type="tel" id="customer-phone" placeholder="Phone" class="form-control mb-2">
                                <input type="text" id="customer-address" placeholder="Address" class="form-control mb-2">
                                <input type="number" step="0.01" id="customer-pay" placeholder="Customer Pay"
                                    class="form-control mb-2">
                                <input type="text" id="customer-change" placeholder="Change" class="form-control mb-2"
                                    readonly>

                                <select id="payment-method" class="form-control mb-2">
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                </select>

                                <div id="payment-details" style="display:none;">
                                    <input type="text" id="card_number" placeholder="Card Number"
                                        class="form-control mb-2">
                                    <div class="d-flex gap-2">
                                        <input type="text" id="expiry" placeholder="MM/YY" class="form-control mb-2">
                                        <input type="text" id="cvc" placeholder="CVC" class="form-control mb-2">
                                    </div>
                                </div>
                                {{-- <button id="orderBtn" disabled>Order</button> --}}
                                <button id="checkout-btn" class="btn btn-success w-100 mt-2" disabled>Place Order</button>
                                {{-- <button id="print-btn" class="btn btn-primary w-100 mt-2">🖨️ Print</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let cart = [];
            // Update Cart Function (your existing code)
            function updateCart() {
                const cartContainer = document.getElementById('cart-items');
                const totalEl = document.getElementById('cart-total');
                cartContainer.innerHTML = '';
                if (cart.length === 0) {
                    cartContainer.innerHTML = '<p class="text-muted">No items added yet.</p>';
                    document.getElementById('checkout-btn').disabled = true;
                    totalEl.textContent = '$0.00';
                    return;
                }

                let total = 0;
                cart.forEach((item, index) => {
                    total += item.price * item.quantity;
                    const div = document.createElement('div');
                    div.className =
                        'd-flex justify-content-between align-items-center mb-2 p-2 border rounded shadow-sm bg-light';
                    div.innerHTML = `
                        <div class="d-flex flex-column">
                            <strong>${item.name}</strong>
                            <small class="text-muted">$${item.price.toFixed(2)} each</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-secondary decrement" data-index="${index}">-</button>
                            <span class="px-2 fw-bold">${item.quantity}</span>
                            <button class="btn btn-sm btn-outline-secondary increment" data-index="${index}">+</button>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="fw-bold">$${(item.price*item.quantity).toFixed(2)}</span>
                            <button class="btn btn-sm btn-danger remove-item mt-1" data-index="${index}">Remove</button>
                        </div>
                    `;
                    cartContainer.appendChild(div);
                });

                // Event listeners for increment/decrement/remove
                document.querySelectorAll('.increment').forEach(btn => {
                    btn.addEventListener('click', e => {
                        cart[e.target.dataset.index].quantity++;
                        updateCart();
                    });
                });
                document.querySelectorAll('.decrement').forEach(btn => {
                    btn.addEventListener('click', e => {
                        const idx = e.target.dataset.index;
                        if (cart[idx].quantity > 1) cart[idx].quantity--;
                        updateCart();
                    });
                });
                document.querySelectorAll('.remove-item').forEach(btn => {
                    btn.addEventListener('click', e => {
                        cart.splice(e.target.dataset.index, 1);
                        updateCart();
                    });
                });

                totalEl.textContent = '$' + total.toFixed(2);
                document.getElementById('checkout-btn').disabled = false;
                updateChange();
            }

            // Add to cart buttons
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const name = btn.dataset.name;
                    const price = parseFloat(btn.dataset.price);
                    const stock = parseInt(btn.dataset.stock);

                    const exist = cart.find(i => i.id == id);
                    if (exist) {
                        if (exist.quantity < stock) exist.quantity++;
                        else return alert(`Stock limit reached for ${name}!`);
                    } else {
                        if (stock <= 0) return alert(`No stock available for ${name}`);
                        cart.push({
                            id,
                            name,
                            price,
                            quantity: 1,
                            stock
                        });
                    }
                    updateCart();
                });
            });

            // Update Change
            function updateChange() {
                const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                const pay = parseFloat(document.getElementById('customer-pay').value) || 0;
                document.getElementById('customer-change').value = '$' + Math.max(0, pay - total).toFixed(2);
            }
            document.getElementById('customer-pay').addEventListener('input', updateChange);

            // Payment method toggle
            document.getElementById('payment-method').addEventListener('change', function() {
                document.getElementById('payment-details').style.display = (this.value === 'credit' || this
                    .value === 'paypal') ? 'block' : 'none';
            });

            // Checkout button (your existing code)
            document.getElementById('checkout-btn').addEventListener('click', async () => {
                if (cart.length === 0) return alert('Cart is empty!');
                const payload = {
                    customer_name: document.getElementById('customer-name').value,
                    phone: document.getElementById('customer-phone').value,
                    address: document.getElementById('customer-address').value,
                    cart_data: JSON.stringify(cart),
                    total_amount: cart.reduce((sum, i) => sum + i.price * i.quantity, 0),
                    customer_pay: parseFloat(document.getElementById('customer-pay').value) || 0,
                    customer_change: parseFloat(document.getElementById('customer-change').value
                        .replace('$', '')) || 0,
                    payment_selected: document.getElementById('payment-method').value,
                    card_number: document.getElementById('card_number').value || null,
                    expiry: document.getElementById('expiry').value || null,
                    cvc: document.getElementById('cvc').value || null
                };
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                try {
                    const res = await fetch("{{ route('orders.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json();
                    const alertContainer = document.getElementById('alert-container');
                    if (res.ok) {
                        alertContainer.innerHTML =
                            `<div class="alert alert-success">${data.message}</div>`;
                        cart = [];
                        updateCart();
                        document.getElementById('customer-name').value = '';
                        document.getElementById('customer-phone').value = '';
                        document.getElementById('customer-address').value = '';
                        document.getElementById('customer-pay').value = '';
                        document.getElementById('customer-change').value = '';
                        document.getElementById('payment-method').value = 'cash';
                        document.getElementById('payment-details').style.display = 'none';
                        document.getElementById('card_number').value = '';
                        document.getElementById('expiry').value = '';
                        document.getElementById('cvc').value = '';
                    } else {
                        alertContainer.innerHTML =
                            `<div class="alert alert-danger">${JSON.stringify(data)}</div>`;
                        console.error(data);
                    }
                } catch (err) {
                    document.getElementById('alert-container').innerHTML =
                        `<div class="alert alert-danger">Error submitting order.</div>`;
                    console.error(err);
                }
            });

            // --- Food Search Filter ---
            const searchInput = document.getElementById('food-search');
            const minPriceInput = document.getElementById('min-price');
            const maxPriceInput = document.getElementById('max-price');

            function filterFoods() {
                const filter = searchInput.value.toLowerCase();
                const minPrice = parseFloat(minPriceInput.value) || 0;
                const maxPrice = parseFloat(maxPriceInput.value) || Infinity;

                document.querySelectorAll('.menu-item').forEach(item => {
                    const title = item.dataset.title;
                    const price = parseFloat(item.dataset.price);

                    if (title.includes(filter) && price >= minPrice && price <= maxPrice) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterFoods);
            minPriceInput.addEventListener('input', filterFoods);
            maxPriceInput.addEventListener('input', filterFoods);
            // Checkout
            document.getElementById('checkout-btn').addEventListener('click', () => {
                if (cart.length === 0) return alert('Cart is empty!');
                printReceipt(cart);
            });



        });
    </script>

    @include('admin.invoice.index')

@endsection
