@extends('welcome')
@section('content')
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="{{ route('user.home') }}">Home</a></li>
                    <li><a href="{{ route('product.list') }}">Products List</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @foreach($products as $product)
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="">
                                            <div class="product-label">
                                                @if ($product->sale_percent != 0 )
                                                <span class="sale">{{ $product->sale_percent }}%</span>
                                                @endif
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $product->category->name }}</p>
                                            <h3 class="product-name"><a href="{{ route('detail.product',$product->id) }}">{{ $product->name }}</a></h3>
                                            @if($product->sale_percent !=0)
                                            <h4 class="product-price">{{ number_format($product->price - ($product->price/100*$product->sale_percent)) }}VND<del class="product-old-price">{{ number_format($product->price) }}VND</del></h4>
                                            @else
                                                <h4 class="product-price">{{ number_format($product->price) }}VND</h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
{{--                                            <div class="product-btns">--}}
{{--                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>--}}
{{--                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>--}}
{{--                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>--}}
{{--                                            </div>--}}
                                        </div>
                                        <div class="add-to-cart">
                                            <a href="{{ route('addToCart',$product->id) }}"><button class=" add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> add to cart</button></a>
                                        </div>
                                    </div>
                                @endforeach
                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <h3 class="title">Top Products</h3>
                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach($all as $product)
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ asset('storage/'.$product->image) }}" alt="">
                                                <div class="product-label">
                                                    @if ($product->sale_percent != 0 )
                                                        <span class="sale">{{ $product->sale_percent }}%</span>
                                                    @endif
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category->name }}</p>
                                                <h3 class="product-name"><a href="{{ route('detail.product',$product->id) }}">{{ $product->name }}</a></h3>
                                                @if($product->sale_percent !=0)
                                                    <h4 class="product-price">{{ number_format($product->price - ($product->price/100*$product->sale_percent)) }}VND<del class="product-old-price">{{ number_format($product->price) }}VND</del></h4>
                                                @else
                                                    <h4 class="product-price">{{ number_format($product->price) }}VND</h4>
                                                @endif
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                {{--                                            <div class="product-btns">--}}
                                                {{--                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>--}}
                                                {{--                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>--}}
                                                {{--                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>--}}
                                                {{--                                            </div>--}}
                                            </div>
                                            <div class="add-to-cart">
                                                <a href="{{ route('addToCart',$product->id) }}"><button class=" add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> add to cart</button></a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->
@endsection
