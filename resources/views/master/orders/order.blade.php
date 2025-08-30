{{-- Tesing --}}
@include('admin.font.index')
<section class="section py-5" id="order">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6 class="text-warning fw-semibold">Our Orders</h6>
                    <h2 class="fw-bold">Please select your items</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Menu Items -->
            <div class="row mb-3">
                <div class="col-lg-8">
                    <input type="text" id="food-search" class="form-control" placeholder="Search food items...">
                </div>
            </div>

            <div class="col-lg-8" style="max-height:600px; overflow-y:auto;">
                <div class="row" id="menu-items">
                    @foreach ($foods as $food)
                        <div class="col-md-3 mb-3 menu-item">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('foods/image/' . $food->image) }}" class="w-100"
                                    style="height: 130px;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-2 text-dark">{{ $food->title }}</h5>
                                    <div class="order-description mb-2">
                                        {{ Str::limit($food->desc, 100) }}
                                    </div>
                                    <div class="order-stars mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star{{ $i < $food->rating ? '' : '-o' }} text-warning"></i>
                                        @endfor
                                    </div>

                                    <p class="price-text fw-bold text-warning mb-2">
                                        ${{ number_format($food->price, 2) }}</p>
                                    <button type="button" class="btn btn-outline-warning add-to-cart"
                                        data-id="{{ $food->id }}" data-name="{{ $food->title }}"
                                        data-price="{{ $food->price }}">
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
                    <div class="card-header bg-warning text-white fw-bold fs-5">Your Order</div>
                    <div class="card-body d-flex flex-column">
                        <div id="alert-container"></div>
                        <div id="cart-items" style="flex-grow:1; overflow-y:auto; min-height:150px;">
                            <p class="text-muted">No items added yet.</p>
                        </div>

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
            </div>
        </div>
    </div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = [];
        const searchInput = document.getElementById('food-search');
        const menuItems = document.querySelectorAll('.menu-item');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();

            menuItems.forEach(item => {
                const title = item.querySelector('.card-title').textContent.toLowerCase();
                const desc = item.querySelector('.order-description').textContent.toLowerCase();

                if (title.includes(query) || desc.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });

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
                        <span class="fw-bold">$${(item.price * item.quantity).toFixed(2)}</span>
                        <button class="btn btn-sm btn-danger remove-item mt-1" data-index="${index}">Remove</button>
                    </div>
                `;

                cartContainer.appendChild(div);
            });

            // Event listeners
            cartContainer.querySelectorAll('.increment').forEach(btn => btn.onclick = e => {
                const idx = e.target.dataset.index;
                if (cart[idx].quantity < cart[idx].stock) cart[idx].quantity++;
                updateCart();
            });

            cartContainer.querySelectorAll('.decrement').forEach(btn => btn.onclick = e => {
                const idx = e.target.dataset.index;
                if (cart[idx].quantity > 1) cart[idx].quantity--;
                updateCart();
            });

            cartContainer.querySelectorAll('.remove-item').forEach(btn => btn.onclick = e => {
                const idx = e.target.dataset.index;
                cart.splice(idx, 1);
                updateCart();
            });

            totalEl.textContent = '$' + total.toFixed(2);
            document.getElementById('checkout-btn').disabled = false;
            updateChange();
        }

        function updateChange() {
            const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
            const payInput = document.getElementById('customer-pay');
            const pay = parseFloat(payInput.value) || 0;
            const changeInput = document.getElementById('customer-change');

            changeInput.value = '$' + Math.max(0, pay - total).toFixed(2);

            const checkoutBtn = document.getElementById('checkout-btn');
            const paymentMethod = document.getElementById('payment-method').value;

            let canCheckout = false;

            if (paymentMethod === 'cash') {
                canCheckout = (cart.length > 0 && pay >= total);
            } else if (paymentMethod === 'credit' || paymentMethod === 'paypal') {
                const cardNumber = document.getElementById('card_number').value.trim();
                const expiry = document.getElementById('expiry').value.trim();
                const cvc = document.getElementById('cvc').value.trim();
                canCheckout = (cart.length > 0 && cardNumber && expiry && cvc);
            }

            checkoutBtn.disabled = !canCheckout;
        }

        // Attach input listeners
        document.getElementById('customer-pay').addEventListener('input', updateChange);
        document.getElementById('card_number').addEventListener('input', updateChange);
        document.getElementById('expiry').addEventListener('input', updateChange);
        document.getElementById('cvc').addEventListener('input', updateChange);
        document.getElementById('payment-method').addEventListener('change', () => {
            const method = document.getElementById('payment-method').value;
            document.getElementById('payment-details').style.display = (method === 'credit' ||
                method === 'paypal') ? 'block' : 'none';
            updateChange();
        });



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

        function clearOrder() {
            // Clear cart
            cart = [];
            updateCart();

            // Clear customer inputs
            document.getElementById('customer-name').value = '';
            document.getElementById('customer-phone').value = '';
            document.getElementById('customer-address').value = '';
            document.getElementById('customer-pay').value = '';
            document.getElementById('customer-change').value = '';

            // Reset payment method
            document.getElementById('payment-method').value = 'cash';
            document.getElementById('payment-details').style.display = 'none';
            document.getElementById('card_number').value = '';
            document.getElementById('expiry').value = '';
            document.getElementById('cvc').value = '';

            // Disable checkout button until new cart input
            document.getElementById('checkout-btn').disabled = true;
        }

        document.getElementById('checkout-btn').addEventListener('click', async () => {
            if (cart.length === 0) return alert('Cart is empty!');
            const alertContainer = document.getElementById('alert-container');

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
                const res = await fetch("{{ route('orders.storeHome') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const text = await res.text();
                let data;
                try {
                    data = JSON.parse(text);
                } catch (err) {
                    throw new Error(
                        'Server returned HTML. Check your route/controller for errors.');
                }

                if (res.ok) {
                    alertContainer.innerHTML =
                        `<div class="alert alert-success">${data.message}</div>`;
                    clearOrder();
                } else {
                    alertContainer.innerHTML =
                        `<div class="alert alert-danger">${data.error || JSON.stringify(data)}</div>`;
                }
            } catch (err) {
                alertContainer.innerHTML = `<div class="alert alert-danger">${err.message}</div>`;
                console.error(err);
            }
        });

    });
</script>



{{-- testing --}}
