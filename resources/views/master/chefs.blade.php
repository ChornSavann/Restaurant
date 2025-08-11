<section class="section" id="chefs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Our Chefs</h6>
                    <h2>We offer the best ingredients for you</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($chefs as $chef)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="chef-item">
                        <div class="thumb">
                            <div class="overlay"></div>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            <img src="{{ asset('chef/images/' . $chef->image) }}" alt="{{ $chef->name }}">
                        </div>
                        <div class="down-content">
                            <h4>{{ $chef->name }}</h4>
                            <span>{{ $chef->speciality }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<style>
    .chef-item {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }

    .chef-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .chef-item .thumb {
        position: relative;
        overflow: hidden;
    }

    .chef-item .thumb img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .chef-item:hover .thumb img {
        transform: scale(1.08);
    }

    .chef-item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .chef-item:hover .overlay {
        opacity: 1;
    }

    .chef-item .social-icons {
        list-style: none;
        padding: 0;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: center;
        gap: 15px;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
        /* ensures they stay above overlay */
    }

    .chef-item:hover .social-icons {
        opacity: 1;
    }

    .chef-item .social-icons li a {
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
        padding: 2px;
        border-radius: 50%;
        font-size: 20px;
        transition: background 0.3s ease;
    }

    .chef-item .social-icons li a:hover {
        background: #ff0404;
        color: #fff;
    }


    .chef-item .down-content {
        padding: 20px 15px;
    }

    .chef-item .down-content h4 {
        margin-bottom: 5px;
        font-weight: 600;
    }

    .chef-item .down-content span {
        color: #888;
        font-size: 0.95rem;
    }
</style>
