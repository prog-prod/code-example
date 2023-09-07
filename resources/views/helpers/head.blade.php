<meta charset="utf-8">

<!-- mobile responsive meta -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- ** Plugins Needed for the Project ** -->
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('css/venobox.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/aos.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-slider.min.css') }}">

<!--Favicon-->
<link rel="shortcut icon" href="{{ asset('favicons/favicon.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('favicons/favicon.png')}}'" type="image/x-icon">
<link rel="icon" href="{{ asset('favicons/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('favicons/favicon.svg') }}" type="image/svg+xml">

@if(app()->environment(['production']))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EJTSQ8RP9B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-EJTSQ8RP9B');
    </script>
@endif
