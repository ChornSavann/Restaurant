<section class="section" id="offers">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="section-heading">
                    <h6>Klassy Week</h6>
                    <h2>This Week’s Special Meal Offers</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="tabs">
                    <div class="col-lg-12">
                        <div class="heading-tabs">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-3">
                                    <ul>
                                        <li><a href='#tabs-1'><img src="assets/images/tab-icon-01.png"
                                                    alt="">Breakfast</a></li>
                                        <li><a href='#tabs-2'><img src="assets/images/tab-icon-02.png"
                                                    alt="">Lunch</a></a></li>
                                        <li><a href='#tabs-3'><img src="assets/images/tab-icon-03.png"
                                                    alt="">Dinner</a></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <section class='tabs-content'>

                            <article id='tabs-1'>
                                <div class="row">
                                    @foreach ($foods as $food )
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="left-list">

                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{ asset('foods/image/' . $food->image) }}" alt="{{$food->title}}"class="w-100" style="height:100px; object-fit: cover;">
                                                        <h4>{{$food->title}}</h4>
                                                        <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">{{$food->desc}}</p>
                                                        <div class="price">
                                                            <h6>$10.50</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
