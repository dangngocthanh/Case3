@extends('welcome')
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store products -->
                    <div class="row">
                    @foreach($products as $product)
                        <!-- product -->
                            <div class="col-md-4 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="">
                                        <div class="product-label">
                                            @if ($product->sale_percent != 0 )
                                                <span class="sale">{{ $product->sale_percent }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('detail.product',$product->id) }}">{{ $product->name }}</a>
                                        </h3>
                                        @if($product->sale_percent !=0)
                                            <h4 class="product-price">{{ number_format($product->price - ($product->price/100*$product->sale_percent)) }}
                                                VND
                                                <del class="product-old-price">{{ number_format($product->price) }}VND
                                                </del>
                                            </h4>
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
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{ route('addToCart',$product->id) }}">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    <!-- /product -->

                    </div>
                    <!-- /store products -->

                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
