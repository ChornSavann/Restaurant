<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <input type="hidden" name="food_id" value="{{ $discount->food->id }}">
    <input type="hidden" name="discount_id" value="{{ $discount->id }}">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Order: {{ $discount->food->title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity{{ $discount->id }}" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity{{ $discount->id }}" class="form-control" min="1" value="1" required>
            </div>

            <!-- Payment Method -->
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-select" onchange="togglePaymentFields(this, '{{ $discount->id }}')">
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                </select>
            </div>

            <!-- Cash Section -->
            <div class="mb-3" id="cash-section-{{ $discount->id }}">
                <label for="customer_pay{{ $discount->id }}" class="form-label">Customer Pay</label>
                <input type="number" name="customer_pay" id="customer_pay{{ $discount->id }}" class="form-control" min="0" step="0.01">
            </div>

            <!-- Card Section -->
            <div id="card-section-{{ $discount->id }}" style="display:none;">
                <div class="mb-3">
                    <label for="card_number{{ $discount->id }}" class="form-label">Card Number</label>
                    <input type="text" name="card_number" id="card_number{{ $discount->id }}" class="form-control">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="expiry{{ $discount->id }}" class="form-label">Expiry</label>
                        <input type="text" name="expiry" id="expiry{{ $discount->id }}" class="form-control" placeholder="MM/YY">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="cvc{{ $discount->id }}" class="form-label">CVC</label>
                        <input type="text" name="cvc" id="cvc{{ $discount->id }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </div>
    </div>
</form>

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
</script>
