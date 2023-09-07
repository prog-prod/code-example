@extends('layout.base',['pageTitle' => 'not_found'])
@section('content')
    <section class="page-404 section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('index')}}">
                        <h2>PRINTOPIA</h2>
                    </a>
                    <h1>404</h1>
                    <h2>@lang('main.not_found')</h2>
                    <a href="{{route('index')}}" class="btn btn-primary mt-4"><i class="ti-angle-double-left"></i> Go Home</a>
                    <p class="copyright-text">@lang('main.footer.all_rights_reserved', ['year' => date('Y')])</p>
                </div>
            </div>
        </div>
    </section>
@endsection
