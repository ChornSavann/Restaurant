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

                            {{-- <div class="order-description mb-2">
                                {{ Str::limit($food->desc, 100) }}
                            </div> --}}

                            <div class="order-price fw-bold text-warning mb-3">
                                ${{ number_format($food->price, 2) }}
                            </div>

                            <div class="order-stars mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star{{ $i < $food->rating ? '' : '-o' }} text-warning"></i>
                                @endfor
                            </div>

                            <div class="order-info d-flex justify-content-start align-items-center gap-3 mb-3 text-muted small">
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

                            <button type="button" class="btn btn-warning w-100 fw-semibold"
                                style="border-radius: 25px; font-size: 0.95rem;" data-bs-toggle="modal"
                                data-bs-target="#orderModal" data-foodid="{{ $food->id }}"
                                data-foodtitle="{{ $food->title }}" data-foodprice="{{ $food->price }}"
                                data-foodimage="{{ asset('foods/image/' . $food->image) }}">
                                Order Now
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
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
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
                    <div class="mb-2 d-flex align-items-center">
                        <input type="number" id="orderQuantity" name="quantity" value="1" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                        <span class="fw-bold">Total: <span id="orderTotal" class="text-success"></span></span>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="note" class="form-control form-control-sm" placeholder="Enter note" required>
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
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    // View Recipe Modal
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
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
    orderModal.addEventListener('show.bs.modal', function (event) {
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

        function updateTotal() {
            var qty = parseInt(qtyInput.value) || 1;
            totalEl.textContent = "$" + (qty * price).toFixed(2);
        }

        qtyInput.addEventListener('input', updateTotal);
        updateTotal();
    });
</script>
