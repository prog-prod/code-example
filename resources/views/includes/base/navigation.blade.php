<nav class="navbar navbar-expand-lg navbar-light bg-white w-100" id="navbar">

    @include('includes.base.logo')

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-1 order-lg-2" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            @foreach($menuItems as $item)
                @if($item->mega)
                    <li class="nav-item dropdown mega-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            @lang('main.menu.'.$item->name)
                        </a>
                        <div class="dropdown-menu mega-menu">
                            @foreach($item->children as $child)
                                <div class="mx-3 mega-menu-item">
                                    @if(!$child->link)
                                        <h6>@lang('main.menu.'.$child->name)</h6>
                                    @endif
                                    <ul class="pl-0">
                                        @foreach($child->children as $subchild)
                                            <li><a href="{{$subchild->link}}">@lang('main.menu.'.$subchild->name)</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                            <div class="mx-3 mega-megu-image">
                                <img class="img-fluid h-100" src="{{ asset('images/mega-megu.jpg') }}"
                                     alt="feature-img">
                            </div>
                        </div>
                    </li>
                @elseif($item->children->isNotEmpty())
                    <li class="nav-item dropdown view">
                        <a class="nav-link dropdown-toggle" href="{{$item->link}}" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">@lang('main.menu.'.$item->name)
                        </a>
                        <div class="dropdown-menu">
                            @foreach($item->children as $child)
                                <a class="dropdown-item" href="{{$child->link}}">@lang('main.menu.'.$child->name)</a>
                            @endforeach
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{$item->link}}">@lang('main.menu.'.$item->name)</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="order-3 navbar-right-elements">
        <div class="search-cart">
            <!-- search -->
            @include('includes.base.search')
            <!-- cart -->
            @include('includes.base.cart')
        </div>
    </div>
</nav>
