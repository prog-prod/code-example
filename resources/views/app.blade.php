<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title inertia>{{config('app.name')}}</title>
    @include('helpers.head')
    <!-- Scripts -->
    @routes
    @vite(['resources/sass/base.scss', 'resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    <x-translations/>

</head>
<body>
@include('includes.base.preloader')
@inertia
<!-- scripts -->
@include('helpers.body')
<!-- /scripts -->
</body>
</html>
