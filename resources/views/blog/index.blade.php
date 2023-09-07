@extends('layout.base')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="post">
                        <div class="post-thumb">
                            <a href="{{route('blog-single')}}">
                                <img class="img-fluid" src="{{asset('/images/blog-post-1.jpg')}}" alt="">
                            </a>
                        </div>
                        <h3 class="post-title"><a href="{{route('blog-single')}}">How To Wear Bright Shoes</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> 20, MAR 2017
                                </li>
                                <li>
                                    <i class="ti-user"></i> POSTED BY ADMIN
                                </li>
                                <li><i class="ti-tag"> <a href="{{route('blog')}}"></a></i><a href="{{route('blog')}}"> LIFESTYLE</a>,<a
                                        href="{{route('blog')}}"> TRAVEL</a>, <a href="{{route('blog')}}">FASHION</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"><i class="ti-comments"></i> 4 COMMENTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit vitae placeat ad
                                architecto nostrum
                                asperiores vel aperiam, veniam eum nulla. Maxime cum magnam, adipisci architecto
                                quibusdam cumque veniam
                                fugiat quae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio vitae ab
                                doloremque accusamus
                                sit, eos dolorum officiis a perspiciatis aliquid. Lorem ipsum dolor sit amet,
                                consectetur adipisicing
                                elit. Quod, facere. </p>
                            <a href="{{route('blog-single')}}" class="btn btn-primary btn-sm">Continue Reading</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post">
                        <div class="post-thumb">
                            <a href="{{route('blog-single')}}">
                                <img class="img-fluid" src="{{asset('/images/blog-post-2.jpg')}}" alt="">
                            </a>
                        </div>
                        <h3 class="post-title"><a href="{{route('blog-single')}}">Two Ways To Wear Straight Shoes</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> 20, MAR 2017
                                </li>
                                <li>
                                    <i class="ti-user"></i> POSTED BY ADMIN
                                </li>
                                <li><i class="ti-tag"> <a href="{{route('blog')}}"></a></i><a href="{{route('blog')}}"> LIFESTYLE</a>,<a
                                        href="{{route('blog')}}"> TRAVEL</a>, <a href="{{route('blog')}}">FASHION</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"><i class="ti-comments"></i> 4 COMMENTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit vitae placeat ad
                                architecto nostrum
                                asperiores vel aperiam, veniam eum nulla. Maxime cum magnam, adipisci architecto
                                quibusdam cumque veniam
                                fugiat quae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio vitae ab
                                doloremque accusamus
                                sit, eos dolorum officiis a perspiciatis aliquid. Lorem ipsum dolor sit amet,
                                consectetur adipisicing
                                elit. Quod, facere</p>
                            <a href="{{route('blog-single')}}" class="btn btn-primary btn-sm">Continue Reading</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post">
                        <div class="post-thumb">
                            <a href="{{route('blog-single')}}">
                                <img class="img-fluid" src="{{asset('/images/blog-post-3.jpg')}}" alt="">
                            </a>
                        </div>
                        <h3 class="post-title"><a href="{{route('blog-single')}}">Making A Denim Statement</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> 20, MAR 2017
                                </li>
                                <li>
                                    <i class="ti-user"></i> POSTED BY ADMIN
                                </li>
                                <li><i class="ti-tag"> <a href="{{route('blog')}}"></a></i><a href="{{route('blog')}}"> LIFESTYLE</a>,<a
                                        href="{{route('blog')}}"> TRAVEL</a>, <a href="{{route('blog')}}">FASHION</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"><i class="ti-comments"></i> 4 COMMENTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit vitae placeat ad
                                architecto nostrum asperiores
                                vel aperiam, veniam eum nulla. Maxime cum magnam, adipisci architecto quibusdam cumque
                                veniam fugiat quae. Lorem
                                ipsum dolor sit amet, consectetur adipisicing elit. Odio vitae ab doloremque accusamus
                                sit, eos dolorum officiis
                                a perspiciatis aliquid. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod,
                                facere</p>
                            <a href="{{route('blog-single')}}" class="btn btn-primary btn-sm">Continue Reading</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post">
                        <div class="post-thumb">
                            <a href="{{route('blog-single')}}">
                                <img class="img-fluid" src="{{asset('/images/blog-post-4.jpg')}}" alt="">
                            </a>
                        </div>
                        <h3 class="post-title"><a href="{{route('blog-single')}}">Standard Text Post</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> 20, MAR 2017
                                </li>
                                <li>
                                    <i class="ti-user"></i> POSTED BY ADMIN
                                </li>
                                <li><i class="ti-tag"> <a href="{{route('blog')}}"></a></i><a href="{{route('blog')}}"> LIFESTYLE</a>,<a
                                        href="{{route('blog')}}"> TRAVEL</a>, <a href="{{route('blog')}}">FASHION</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"><i class="ti-comments"></i> 4 COMMENTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit vitae placeat ad
                                architecto nostrum asperiores
                                vel aperiam, veniam eum nulla. Maxime cum magnam, adipisci architecto quibusdam cumque
                                veniam fugiat quae. Lorem
                                ipsum dolor sit amet, consectetur adipisicing elit. Odio vitae ab doloremque accusamus
                                sit, eos dolorum officiis
                                a perspiciatis aliquid. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod,
                                facere</p>
                            <a href="{{route('blog-single')}}" class="btn btn-primary btn-sm">Continue Reading</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post">
                        <div class="post-thumb">
                            <a href="{{route('blog-single')}}">
                                <img class="img-fluid" src="{{asset('/images/blog-post-4.jpg')}}" alt="">
                            </a>
                        </div>
                        <h3 class="post-title"><a href="{{route('blog-single')}}">Standard Audio Post</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> 20, MAR 2017
                                </li>
                                <li>
                                    <i class="ti-user"></i> POSTED BY ADMIN
                                </li>
                                <li><i class="ti-tag"> <a href="{{route('blog')}}"></a></i><a href="{{route('blog')}}"> LIFESTYLE</a>,<a
                                        href="{{route('blog')}}"> TRAVEL</a>, <a href="{{route('blog')}}">FASHION</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"><i class="ti-comments"></i> 4 COMMENTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit vitae placeat ad
                                architecto nostrum asperiores
                                vel aperiam, veniam eum nulla. Maxime cum magnam, adipisci architecto quibusdam cumque
                                veniam fugiat quae. Lorem
                                ipsum dolor sit amet, consectetur adipisicing elit. Odio vitae ab doloremque accusamus
                                sit, eos dolorum officiis
                                a perspiciatis aliquid. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod,
                                facere</p>
                            <a href="{{route('blog-single')}}" class="btn btn-primary btn-sm">Continue Reading</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post">
                        <div class="post-thumb">
                            <a href="{{route('blog-single')}}">
                                <img class="img-fluid" src="{{asset('/images/blog-post-3.jpg')}}" alt="">
                            </a>
                        </div>
                        <h3 class="post-title"><a href="{{route('blog-single')}}">Standard Video Post</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> 20, MAR 2017
                                </li>
                                <li>
                                    <i class="ti-user"></i> POSTED BY ADMIN
                                </li>
                                <li><i class="ti-tag"> <a href="{{route('blog')}}"></a></i><a href="{{route('blog')}}"> LIFESTYLE</a>,<a
                                        href="{{route('blog')}}"> TRAVEL</a>, <a href="{{route('blog')}}">FASHION</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}"><i class="ti-comments"></i> 4 COMMENTS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit vitae placeat ad
                                architecto nostrum asperiores
                                vel aperiam, veniam eum nulla. Maxime cum magnam, adipisci architecto quibusdam cumque
                                veniam fugiat quae. Lorem
                                ipsum dolor sit amet, consectetur adipisicing elit. Odio vitae ab doloremque accusamus
                                sit, eos dolorum officiis
                                a perspiciatis aliquid. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod,
                                facere</p>
                            <a href="{{route('blog-single')}}" class="btn btn-primary btn-sm">Continue Reading</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link big" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link big" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
