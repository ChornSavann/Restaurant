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
                <p id="viewFoodDesc" class="text-muted"></p>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // View Recipe Modal
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        // Get data attributes
        var title = button.getAttribute('data-foodtitle');
        var desc = button.getAttribute('data-fooddesc');
        var price = button.getAttribute('data-foodprice');
        var image = button.getAttribute('data-foodimage');

        // Set modal content
        document.getElementById('viewFoodTitle').textContent = title || '';
        document.getElementById('viewFoodDesc').textContent = desc || '';
        document.getElementById('viewFoodPrice').textContent = price ? "$" + parseFloat(price).toFixed(2) : '';
        document.getElementById('viewFoodImage').src = image || '';
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





