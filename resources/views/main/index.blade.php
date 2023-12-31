@extends('layout.base')

@section('content')
    <section class="section bg-gray hero-area">
        <div class="container">
            <div class="hero-slider">

                <!-- Start first slide  -->
                <div class="slider-item">
                    <div class="row">
                        <div class="col-lg-6 align-self-center text-center text-md-left mb-4 mb-lg-0">
                            <h3 data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in="0"
                                data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">For
                                Men’s</h3>
                            <!-- Start Title -->
                            <h1 data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".2"
                                data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">High
                                Quality Converse</h1>
                            <!-- end title -->
                            <!-- Start Subtitle -->
                            <h3 class="mb-4" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".4"
                                data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">for only
                                $59.00</h3>
                            <!-- end subtitle -->
                            <!-- Start description -->
                            <p class="mb-4" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".6"
                               data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">Lorem
                                ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <!-- end description -->
                            <!-- Start button -->
                            <a href="{{route('products.index')}}" class="btn btn-primary" data-duration-in=".5"
                               data-animation-in="fadeInLeft" data-delay-in=".8" data-animation-out="fadeOutLeft"
                               data-delay-out="5" data-duration-out=".3">shop now</a>
                            <!-- end button -->
                        </div>
                        <!-- Start slide image -->
                        <div class="col-lg-6 text-center text-md-left">
                            <!-- background letter -->
                            <div class="bg-letter">
              <span data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1.2"
                    data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                C
              </span>
                                <!-- Slide image -->
                                <img class="img-fluid d-unset" src="{{ asset('images/converse.png') }}"
                                     alt="converse" data-duration-in=".5" data-animation-in="fadeInRight"
                                     data-delay-in="1" data-animation-out="fadeOutRight" data-delay-out="5"
                                     data-duration-out=".3">
                            </div>
                        </div>
                        <!-- end slide image  -->
                    </div>
                </div> <!-- end slider item -->


                <!-- Start slide  -->
                <div class="slider-item">
                    <div class="row">
                        <div class="col-lg-6 align-self-center text-center text-md-left mb-4 mb-lg-0">
                            <h3 data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in="0"
                                data-animation-out="fadeOutDown" data-delay-out="5.8" data-duration-out=".3">For
                                Women’s</h3>
                            <h1 data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".2"
                                data-animation-out="fadeOutDown" data-delay-out="5.4" data-duration-out=".3">High
                                Quality Bag</h1>
                            <h3 class="mb-4" data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".4"
                                data-animation-out="fadeOutDown" data-delay-out="5" data-duration-out=".3">for only
                                $37.00</h3>
                            <p class="mb-4" data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".6"
                               data-animation-out="fadeOutDown" data-delay-out="4.6" data-duration-out=".3">Lorem
                                ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <a href="{{route('products.index')}}" class="btn btn-primary" data-duration-in=".5"
                               data-animation-in="fadeInDown" data-delay-in=".8" data-animation-out="fadeOutDown"
                               data-delay-out="4.2" data-duration-out=".3">shop now</a>
                        </div>
                        <div class="col-lg-6 text-center">
                            <div class="bg-letter">
                                <!-- background letter -->
                                <span data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1.2"
                                      data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                B
              </span>
                                <img class="img-fluid d-unset" src="{{ asset('images/bag.png') }}" alt="converse"
                                     data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1"
                                     data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end slide  -->

            </div>
        </div>
    </section>
    <!-- /hero area -->

    <!-- categories -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Top Categories</h2>
                </div>
                <!-- categories item -->
                <div class="col-lg-4 col-md-6 mb-50">
                    <div class="card p-0">
                        <div class="border-bottom text-center hover-zoom-img">
                            <a href="{{route('products.index')}}"><img src="{{ asset('images/product-big-1.jpg') }}"
                                                                       class="rounded-top img-fluid w-100"
                                                                       alt="product-img"></a>
                        </div>
                        <ul class="d-flex list-unstyled pl-0 categories-list">
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-1.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-2.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-3.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                        </ul>
                        <div class="px-4 py-3 border-top">
                            <h4 class="d-inline-block mb-0 mt-1">Clothing</h4>
                            <a href="{{route('products.index')}}" class="btn btn-sm btn-outline-primary float-right">view
                                more</a>
                        </div>
                    </div>
                </div>
                <!-- categories item -->
                <div class="col-lg-4 col-md-6 mb-50">
                    <div class="card p-0">
                        <div class="border-bottom text-center hover-zoom-img">
                            <a href="{{route('products.index')}}"><img src="{{ asset('images/product-big-2.jpg') }}"
                                                                       class="rounded-top img-fluid w-100"
                                                                       alt="product-img"></a>
                        </div>
                        <ul class="d-flex list-unstyled pl-0 categories-list">
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-4.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-5.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-6.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                        </ul>
                        <div class="px-4 py-3 border-top">
                            <h4 class="d-inline-block mb-0 mt-1">Shoes</h4>
                            <a href="{{route('products.index')}}" class="btn btn-sm btn-outline-primary float-right">view
                                more</a>
                        </div>
                    </div>
                </div>
                <!-- categories item -->
                <div class="col-lg-4 col-md-6 mb-50">
                    <div class="card p-0">
                        <div class="border-bottom text-center hover-zoom-img">
                            <a href="{{route('products.index')}}"><img src="{{ asset('images/product-big-3.jpg') }}"
                                                                       class="rounded-top img-fluid w-100"
                                                                       alt="product-img"></a>
                        </div>
                        <ul class="d-flex list-unstyled pl-0 categories-list">
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-7.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-8.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                            <li class="m-0 hover-zoom-img">
                                <a href="{{route('products.index')}}"><img src="{{ asset('images/product-sm-9.jpg') }}"
                                                                           class="img-fluid w-100"
                                                                           alt="product-img"></a>
                            </li>
                        </ul>
                        <div class="px-4 py-3 border-top">
                            <h4 class="d-inline-block mb-0 mt-1">Accessories</h4>
                            <a href="{{route('products.index')}}" class="btn btn-sm btn-outline-primary float-right">view
                                more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /categories -->

    <section class="section overlay cta" data-background="images/backgrounds/cta.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="text-white mb-2">End of Season Sale</h1>
                    <p class="text-white mb-4">Take 25% off all sweaters and knits. Discount applied at
                        checkout.</p>
                    <a href="{{route('products.index')}}" class="btn btn-light">shop now</a>
                </div>
            </div>
        </div>
    </section>

    <div id="quickView" class="quickview">
        <div class="row w-100">
            <div class="col-lg-6 col-md-6 mb-5 mb-md-0 pl-5 pt-4 pt-lg-0 pl-lg-0">
                <img src="{{ asset('images/product_1.png') }}" alt="product-img" class="img-fluid">
            </div>
            <div class="col-lg-5 col-md-6 text-center text-md-left align-self-center pl-5">
                <h3 class="mb-lg-2 mb-2">Woven Crop Cami</h3>
                <span class="mb-lg-4 mb-3 h5">$90.00</span>
                <p class="mb-lg-4 mb-3 text-gray">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus</p>
                <form action="#">
                    <select class="form-control w-100 mb-2" name="color">
                        <option value="brown">Brown Color</option>
                        <option value="gray">Gray Color</option>
                        <option value="black">Black Color</option>
                    </select>
                    <select class="form-control w-100 mb-3" name="size">
                        <option value="small">Small Size</option>
                        <option value="medium">Medium Size</option>
                        <option value="large">Large Size</option>
                    </select>
                    <button class="btn btn-primary w-100 mb-lg-4 mb-3">add to cart</button>
                </form>
                <ul class="list-inline social-icon-alt">
                    <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="ti-vimeo-alt"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="ti-google"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- collection -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Top Collections</h2>
                </div>
                <div class="col-12">
                    <div class="collection-slider">
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/product-1_1.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-4.jpg') }}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Leather
                                            Backpack</a></h3>
                                    <span class="h5">$320.79</span>
                                </div>
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/product-2_1.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-5.jpg') }}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Box Leather
                                            Shoulder Bag</a></h3>
                                    <span class="h5">$520.79</span>
                                </div>
                                <!-- product label badge -->
                                <div class="product-label new">
                                    new
                                </div>
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/product-3.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-6.jpg') }}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Sneaky Leather
                                            Sneakers</a></h3>
                                    <span class="h5">$270.79</span>
                                </div>
                                <!-- product label badge -->
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/product-4.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-2_1.jpg') }}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Puzzle leather
                                            shoulder bag</a></h3>
                                    <span class="h5">$400.79</span>
                                </div>
                                <!-- product label badge -->
                                <div class="product-label sale">
                                    -10%
                                </div>
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/images/product-5.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-3.jpg') }}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Puzzle leather
                                            shoulder bag</a></h3>
                                    <span class="h5">$400.79</span>
                                </div>
                                <!-- product label badge -->
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{asset('images/product-6.jpg')}}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-1_1.jpg') }}}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Puzzle leather
                                            shoulder bag</a></h3>
                                    <span class="h5">$400.79</span>
                                </div>
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/product-7.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{asset('images/product-3.jpg')}}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Puzzle leather
                                            shoulder bag</a></h3>
                                    <span class="h5">$400.79</span>
                                </div>
                                <!-- product label badge -->
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="product text-center">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="product-single.html">
                                            <img class="img-fluid w-100 mb-3 img-first"
                                                 src="{{ asset('images/product-8.jpg') }}" alt="product-img">
                                            <img class="img-fluid w-100 mb-3 img-second"
                                                 src="{{ asset('images/product-5.jpg') }}" alt="product-img">
                                        </a>
                                        <div class="btn-cart">
                                            <a href="#" class="btn btn-primary btn-sm">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-hover-overlay">
                                        <a href="#" class="product-icon favorite" data-toggle="tooltip"
                                           data-placement="left" title="Wishlist"><i class="ti-heart"></i></a>
                                        <a href="#" class="product-icon cart" data-toggle="tooltip"
                                           data-placement="left" title="Compare"><i
                                                class="ti-direction-alt"></i></a>
                                        <a data-vbtype="inline" href="#quickView" class="product-icon view venobox"
                                           data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                                class="ti-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="h5"><a class="text-color" href="product-single.html">Puzzle leather
                                            shoulder bag</a></h3>
                                    <span class="h5">$400.79</span>
                                </div>
                            </div>
                        </div>
                        <!-- //end of product -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /collection -->

    <!-- deal -->
    <section class="section bg-cover" data-background="images/backgrounds/deal.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                    <h1>Deal of the day</h1>
                    <h4 class="mb-40">Get at discounted price!</h4>
                    <!-- syo-timer -->
                    <div class="syotimer large">
                        <div id="simple-timer" data-year="2019" data-month="12" data-day="1" data-hour="1"></div>
                    </div>
                    <a href="{{route('products.index')}}" class="btn btn-primary">shop now</a>
                </div>
                <div class="col-md-6 text-center text-md-left align-self-center">
                    <img src="{{ asset('images/product.png') }}" alt="product-img" class="img-fluid up-down">
                </div>
            </div>
        </div>
    </section>
    <!-- /deal -->

    <!-- instagram -->
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mb-2">Follow Us On Instagram</h2>
                    <p class="mb-5">@ Occaecat Cupidatat</p>
                </div>
            </div>
            <!-- instafeed -->
            <!-- <div class="row" id="instafeed" data-userId="4044026246" data-accessToken="4044026246.1677ed0.8896752506ed4402a0519d23b8f50a17"></div> -->
            <!-- for linking to instagram, just uncomment this line and change data-userid with your instagram user id andata-accesstoken with your instagram access token -->

            <!-- without instagram image -->
            <!-- remove this section after link with your instagram account -->
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img class="img-fluid w-100"
                                                          src="{{ asset('images/item-1.png') }}"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-heart mr-2"></i>40</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-comments mr-2"></i>24</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img class="img-fluid w-100"
                                                          src="{{ asset('images/item-2.png') }}"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-heart mr-2"></i>65</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-comments mr-2"></i>11</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img class="img-fluid w-100"
                                                          src="{{ asset('images/item-3.png') }}"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-heart mr-2"></i>33</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-comments mr-2"></i>78</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img class="img-fluid w-100"
                                                          src="{{ asset('images/item-4.png') }}"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-heart mr-2"></i>32</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-comments mr-2"></i>77</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img class="img-fluid w-100"
                                                          src="{{ asset('images/item-5.png') }}"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-heart mr-2"></i>80</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-comments mr-2"></i>38</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img class="img-fluid w-100"
                                                          src="{{ asset('images/item-6.png') }}"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-heart mr-2"></i>22</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                        class="ti-comments mr-2"></i>57</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /without instagram image -->
        </div>
    </section>
    <!-- /instagram -->

    <!-- service -->
    <section class="section-sm border-top">
        <div class="container">
            <div class="row">
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-truck icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>Free Shipping</h4>
                            <p class="mb-0 text-gray">Free shipping on oder over $70</p>
                        </div>
                    </div>
                </div>
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-shield icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>Secure Payment</h4>
                            <p class="mb-0 text-gray">We ensure secure payment with PEV</p>
                        </div>
                    </div>
                </div>
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-timer icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>Support 24/7</h4>
                            <p class="mb-0 text-gray">Contact us 24 hours a day, 7 days a week</p>
                        </div>
                    </div>
                </div>
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-reload icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>30 Days Return</h4>
                            <p class="mb-0 text-gray">Simply return it within 30 days for an exchange.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /service -->

    <!-- newsletter -->
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Our Newsletter</h2>
                    <p class="mb-4">Subscribe to our Newsletter to receive early discount offers</p>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-9 col-10 mx-auto">
                    <form action="#" class="d-flex flex-column flex-sm-row">
                        <input type="email" class="form-control rounded-0 border-0 mr-3 mb-4 mb-sm-0" id="mail"
                               placeholder="Enter your email">
                        <button type="submit" value="send" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /newsletter -->

    <!-- Newsletter Modal -->
    <div class="modal fade subscription-modal" id="subscriptionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <!-- modal content start -->
            <div class="modal-content">
                <!-- container start -->
                <div class="container-fluid">
                    <div class="row">
                        <!-- close button -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="col-lg-6 px-0">
                            <!-- newsletter image -->
                            <div class="image"><img src="{{ asset('images/newsletter-popup.jpg') }}" alt="products"
                                                    class="img-fluid w-100 rounded-left"></div>
                        </div>
                        <div class="col-lg-6 align-self-center p-5">
                            <!-- Content start -->
                            <div class="text-center align-self-center">
                                <h3 class="mb-lg-5 mb-4">Lucky You!</h3>
                                <h4>Want an Instant</h4>
                                <h2 class="mb-lg-5 mb-4">10% OFF?</h2>
                                <!-- newsletter form -->
                                <div class="form">
                                    <input type="email" class="form-control mb-3" name="email" id="email"
                                           placeholder="Email Address">
                                    <button class="btn btn-primary w-100" type="submit">Join Us</button>
                                </div>
                            </div>
                            <!-- Content end -->
                        </div>
                    </div>
                </div>
                <!-- container end -->
            </div>
            <!-- modal content end -->
        </div>
    </div>
    <!-- /Newsletter Modal -->
@endsection

