<nav class="bg-gray py-3">
    <div class="container">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item @if($loop->last) active @endif"><a href="{{$breadcrumb}}">@lang('main.menu.'.str_replace('-','_',basename($breadcrumb)))</a></li>
            @endforeach
        </ol>
    </div>
</nav>
