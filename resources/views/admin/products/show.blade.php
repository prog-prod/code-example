@extends('admin.layouts.base')
@section('title', 'Show Product')

@section('header')
    <h1>Product {{$product->name}}</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class=" d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <a href="{{ route('admin.products.group',$product->key) }}" class="btn btn-link"><i
                            class="fa fa-arrow-left"></i></a>
                    <h3>{{ $product->name }}</h3>
                </div>
                <div>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form id="deleteProductButton" action="{{ route('admin.products.destroy', $product->id) }}"
                          method="POST"
                          class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $product->name}}</h3>
                    <div class="col-12">
                        <img src="{{ $mainImage ? Storage::url($mainImage) : get_default_image() }}"
                             data-toggle="lightbox"
                             class="product-image" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        @foreach($product->images as $image)
                            <div class="product-image-thumb">
                                <img src="{{ $image->filename ? Storage::url($image->filename) : get_default_image()}}"
                                     alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3"><a target="_blank"
                                        href="{{ route('products.show', $product->url) }}">{{ $product->name}}</a>
                    </h3>
                    <h6><b>Slug:</b> /products/{{ $product->slug}}</h6>
                    <h6><b>Group key:</b> {{ $product->key}}</h6>
                    <h6 class="d-flex"><b class="mr-2">Status:</b>
                        <x-product-status :status="$product->active"></x-product-status>
                    </h6>
                    <h6 class="d-flex"><b class="mr-2">Main:</b>
                        <x-product-main :is-main="$product->main"></x-product-main>
                    </h6>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Category:</h4>
                            <h5>
                                <a href="{{ route('admin.categories.show', $product->category) }}">
                                    {{$product->category->name}}
                                </a>
                            </h5>
                        </div>
                    </div>
                    <x-product-price :price="$product->price" :currency="$product->currency_name"
                                     :price_with_discount="$product->priceWithDiscount" :styled="true"/>
                    @if($product->sales->isNotEmpty())
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="mt-2">Sales:</h4>
                                @foreach($product->sales as $sale)
                                    <a class="d-flex justify-content-between"
                                       href="{{ route('admin.sales.show', $sale->id) }}">
                                        <span>Name: {{$sale->name }} </span>
                                        <span>Discount: {{$product->discount->getAmount()->toInt() }} {{\App\Enums\CurrencyEnum::from($product->currency_name)->symbol()}}</span>
                                        <span>End on: {{$sale->endDate->format('d.m.Y H:i') }}</span>
                                        <span>Left: {{$sale->endDate->diffForHumans() }}</span>
                                        <span>Percent: {{$sale->percent}} %</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($similarProductsColors->isNotEmpty() )
                        <hr>
                        <h4>Available Colors:</h4>
                        <div class="btn-group btn-group-toggle d-block">
                            @foreach($similarProductsColors as $similarProduct)
                                <a href="{{route('admin.products.show',[ 'product' => $similarProduct->url])}}"
                                   class="btn btn-default text-center @if($similarProduct->color_id === $product->color_id) active @endif">
                                    {{ $similarProduct->color?->name }}
                                    <br>
                                    <i class="fas fa-circle fa-2x"
                                       style="color: {{$similarProduct->color?->hex_code}}"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if($similarProductsSizes->isNotEmpty() )
                        <h4 class="mt-3">Size: </h4>
                        <div class="btn-group btn-group-toggle d-block">
                            @foreach($similarProductsSizes as $similarProduct)
                                @continue(!$similarProduct->size)
                                <a href="{{route('admin.products.show', $similarProduct->url)}}"
                                   class="btn btn-default text-center @if($similarProduct->size_id == $product->size_id) active @endif">
                                    <span class="text-xl">{{ $similarProduct->size?->name  }}</span>
                                    <br>
                                    {{ $similarProduct->size?->value }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if($product->features->isNotEmpty())
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4>Features:</h4>
                                <ul>
                                    @foreach($product->features as $feature)
                                        <li> {{ $feature->name }}: {{ $feature->text }},</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if($product->related->isNotEmpty())
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4>Related products:</h4>
                                <ul>
                                    @foreach($product->related as $relatedProduct)
                                        <a href="{{ route('admin.products.show', $relatedProduct->id) }}">
                                            <li> {{ $relatedProduct->name }}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if($product->prints->isNotEmpty())
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4>Prints:</h4>
                                <ul>
                                    @foreach($product->prints as $print)
                                        <li>
                                            <a href="{{ route('admin.prints.show', $print->id) }}">
                                                <h6>{{ $print->name }}</h6>
                                                <img src="{{Storage::url($print->image)}}" alt="" width="200">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if($product->brand)
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4>Brand:</h4>
                                <a href="{{ route('admin.brands.show', $product->brand->id) }}">
                                    {{ $product->brand->name }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Stock quantity:</h4>
                            <h5 class="@if($product->quantity > 30) text-success @elseif($product->quantity < 10) text-danger @else text-warning @endif">
                                {{ $product->quantity }}</h5>
                        </div>
                    </div>
                    @if($product->gender)
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h4>Gender:</h4>
                                <h5>{{ \App\Enums\GenderEnum::from($product->gender->id)->name }}</h5>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Views:</h4>
                            <h5>{{ $product->views }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Weight, g:</h4>
                            <h5>{{ $product->weight ?? '-' }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Average rating:</h4>
                            <h5>{{ number_format($product->avg_rating, 2) }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>New until:</h4>
                            <h5>{{ $product->new_until->format('d.m.Y H:i') }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Is new:</h4>
                            <h5>
                                @if($product->is_new)
                                    <i class="fa fa-plus text-success"></i>
                                @else
                                    <i class="fa fa-minus"></i>
                                @endif
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Created:</h4>
                            <h5>{{ $product->created_at->format('d.m.Y H:i') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                           role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                           href="#product-reviews" role="tab" aria-controls="product-comments" aria-selected="false">Reviews
                            <span class="badge badge-info"> {{$product->reviews->count()}}</span></a>
                        <a class="nav-item nav-link" id="product-with-my-quantity-tab" data-toggle="tab"
                           href="#product-with-my-quantity" role="tab" aria-controls="product-with-my-quantity"
                           aria-selected="false">Products
                            with my Quantity
                            <span class="badge badge-info"> {{$product->productsWithMyQuantity->count()}}</span></a>
                        <a class="nav-item nav-link" id="stock-product-tab" data-toggle="tab"
                           href="#stock-product" role="tab" aria-controls="stock-product"
                           aria-selected="false">Stock Product
                            <span class="badge badge-info"> {{(int)!!$product->stockProduct}}</span></a>

                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                         aria-labelledby="product-desc-tab"> {!! $product->description !!}
                    </div>
                    <div class="tab-pane fade" id="product-reviews" role="tabpanel"
                         aria-labelledby="product-comments-tab">
                        <div class="row">
                            @foreach($product->reviews as $review)
                                <div class="col-sm-3 col-12">
                                    <x-adminlte-card :title="$review->user->name" theme="dark">
                                        <div
                                            class="@if($review->rating > 3) text-success @elseif($review->rating < 3) text-danger @else text-warning @endif">
                                            @for($i=0; $i< $review->rating; $i++)
                                                <i class="fa fa-lg fa-star mr-1"></i>
                                            @endfor
                                        </div>
                                        <h5 class="mt-2">{{$review->title}}</h5>
                                        {{$review->body}}
                                        <div
                                            class="text-muted mt-3 text-right">{{$review->created_at->format('d.m.Y H:i')}}</div>
                                    </x-adminlte-card>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-with-my-quantity" role="tabpanel"
                         aria-labelledby="product-with-my-quantity-tab">
                        <ul class="unstyled-list">
                            @foreach($product->productsWithMyQuantity as $product)
                                <li><a href="{{route('admin.products.show',$product->id)}}">{{$product->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="stock-product" role="tabpanel"
                         aria-labelledby="stock-product-tab">
                        @if($product->stockProduct)
                            <a href="{{route('admin.products.show',$product->stockProduct->id)}}">{{$product->stockProduct->name}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(() => {
            $('#deleteProductButton > button').click(function() {
                if (confirm(`Are you sure you want to delete item ?`)) {
                    $(this).parent().submit();
                }
            });
            $('.product-image-thumb > img').click(function() {
                $('.product-image').attr('src', $(this).attr('src'));
            });
        });
    </script>
@endsection
@section('css')
    <style>
        .btn.active {
            border: 1px solid red;
        }
    </style>
@endsection
