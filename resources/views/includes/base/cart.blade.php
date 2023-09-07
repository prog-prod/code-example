<div class="cart">
    <button id="cartOpen" class="cart-btn"><i class="ti-bag"></i><span class="d-xs-none">CART</span> 3
    </button>
    <div class="cart-wrapper">
        <i id="cartClose" class="ti-close cart-close"></i>
        <h4 class="mb-4">Your Cart</h4>
        <ul class="pl-0 mb-3">
            <li class="d-flex border-bottom">
                <img src="{{ asset('images/product-1.jpg') }}" alt="product-img">
                <div class="mx-3">
                    <h6>Eleven Paris Skinny Jeans</h6>
                    <span>1</span> X <span>$79.00</span>
                </div>
                <i class="ti-close"></i>
            </li>
            <li class="d-flex border-bottom">
                <img src="{{ asset('images/product-2.jpg') }}" alt="product-img">
                <div class="mx-3">
                    <h6>Eleven Paris Skinny Jeans top</h6>
                    <span>1 X</span> <span>$79.00</span>
                </div>
                <i class="ti-close"></i>
            </li>
        </ul>
        <div class="mb-3">
            <span>Cart Total</span>
            <span class="float-right">$79.00</span>
        </div>
        <div class="text-center">
            <a href="{{route('cart')}}" class="btn btn-dark btn-mobile rounded-0">view cart</a>
            <a href="{{route('shipping')}}" class="btn btn-dark btn-mobile rounded-0">check out</a>
        </div>
    </div>
</div>
