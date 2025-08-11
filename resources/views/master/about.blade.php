{{-- <section class="section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>About Us</h6>
                        <h2>We Leave A Delicious Memory For You</h2>
                    </div>
                    <p>Klassy Cafe is one of the best <a href="https://templatemo.com/tag/restaurant"
                            target="_blank" rel="sponsored">restaurant HTML templates</a> with Bootstrap v4.5.2 CSS
                        framework. You can download and feel free to use this website template layout for your
                        restaurant business. You are allowed to use this template for commercial purposes.
                        <br><br>You are NOT allowed to redistribute the template ZIP file on any template donwnload
                        website. Please contact us for more information.
                    </p>
                    <div class="row">
                        @foreach ($category as $cate )
                        <div class="col-4">
                                @if ($cate->image)
                                <img src="{{ asset('category/images/'.$cate->image) }}" alt="{{ $cate->name }}">
                            @else
                                <img src="https://placehold.co/600x400" alt="No Image" width="50px">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="right-content">
                    <div class="thumb">
                        <a rel="nofollow" href="http://youtube.com"><i class="fa fa-play"></i></a>
                        <img src="assets/images/about-video-bg.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}



<section class="section" id="about">
    <div class="container">
        <div class="row">
            <!-- Left Text Content -->
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>About Us</h6>
                        <h2>We Leave A Delicious Memory For You</h2>
                    </div>
                    <p>
                        Klassy Cafe is one of the best
                        <a href="https://templatemo.com/tag/restaurant" target="_blank" rel="sponsored">restaurant HTML templates</a>
                        with Bootstrap v4.5.2 CSS framework. You can download and feel free to use this website template layout for your restaurant business. You are allowed to use this template for commercial purposes.
                        <br><br>
                        You are NOT allowed to redistribute the template ZIP file on any template download website. Please contact us for more information.
                    </p>

                    <div class="row">
                        @foreach ($category as $cate)
                            <div class="col-4 mb-3">
                                @if ($cate->image)
                                    <img src="{{ asset('category/images/' . $cate->image) }}"
                                         alt="{{ $cate->name }}"
                                         class="category-image">
                                @else
                                    <img src="https://placehold.co/600x400"
                                         alt="No Image"
                                         class="category-image">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Video Content -->
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="right-content">
                    <div class="thumb position-relative">
                        <a rel="nofollow" href="http://youtube.com" class="play-button position-absolute top-50 start-50 translate-middle">
                            <i class="fa fa-play fa-3x text-white"></i>
                        </a>
                        <img src="{{ asset('assets/images/about-video-bg.jpg') }}" alt="About Video Background" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
    .category-image {
        width: 100%;
        height: 200px; /* Fixed height to keep images same size */
        object-fit: cover; /* Crop and cover the area */
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }
    .category-image:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .thumb {
        position: relative;
    }
    .play-button {
        cursor: pointer;
        z-index: 2;
    }
</style>
