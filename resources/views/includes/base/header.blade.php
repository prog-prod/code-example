<header>
    <!-- top advertise -->
    @include('includes.base.top_advertise')

    <!-- top header -->
    <div class="top-header">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <p class="text-white mb-lg-0 mb-1">@lang('main.free_shipping')</p>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <ul class="list-inline">
                    <li class="list-inline-item"><img src="{{ asset('images/flag_ua.jpg') }}" alt="flag"></li>
                    <li class="list-inline-item"><a href="{{route('login')}}">@lang('main.my_account')</a></li>
                    <li class="list-inline-item">
                        <form action="#">
                            <select class="country" name="country">
                                <option value="UAH" selected>UAH</option>
                                <option value="USD">USD</option>
                            </select>
                        </form>
                        <!-- <li class="list-inline-item">
                          <a class="active" href="#">EN</a>
                          <a href="#">FR</a>
                        </li> -->
                    </li></ul>
            </div>
        </div>
    </div>
    <!-- /top-header -->
</header>
