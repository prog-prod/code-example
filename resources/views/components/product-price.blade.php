<div>
    @if($styled)
        <div class="py-2 px-3 mt-4" style="border:1px solid rgba(0,0,0,.1)">
            @if ($priceWithDiscount)
                <h2 class="mb-0 text-danger">
                    {{ $priceWithDiscount}} {{$currency}}
                </h2>
                <h4 class="mt-0">
                    <s class="text-muted ml-2">{{ $price }} {{$currency}}</s>
                </h4>
            @else
                <h2 class="mb-0">
                    {{ $price }} {{$currency}}
                </h2>
            @endif
        </div>
    @else
        <span class="product-price">
            @if ($priceWithDiscount)
                <span
                    class="product-sale-price text-danger">  {{ $priceWithDiscount}} {{$currency}}</span>
                <s class="text-muted ml-2">{{ $price }} {{$currency}}</s>
            @else
                {{ $price }} {{$currency}}
            @endif
     </span>
    @endif

</div>
