<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'PdParis') }}</title>
    <meta name="description" content="<?=isset($description) ? $description : 'Parfum de Paris' ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">

    <link rel="stylesheet" href="/css/main.css?<?=mt_rand(1111,9999) ?>">
    <link rel="stylesheet" href="/css/style.css?<?=mt_rand(1111,9999) ?>">

    <!-- Font Awesome ver 5.15.3 -->
    <link rel="stylesheet" href="/fonts/FontAwesome/css/all.css">
    <!-- OwlCarousel 2.3.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="/js/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/js/slick/slick-theme.css">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="host" content="{{ env('APP_HOST') }}">

    <!-- Scripts... этот кусок (Scripts,Fonts, Styles) ставит лара, конфликтует с jquery-3.3.1 -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    @yield('pixels')

</head>
<body>
<div class="vue">

    @yield('content')

    @yield('footer')

</div>

<!-- for lang switch -->
<input type="hidden" class="lang" value="{{ app()->getLocale() }}">

<!--Модалки конец-->
<script src="/js/libs/vue.min.js"></script>

<script src="/js/libs/vue-cookies.js"></script>

<script src="/js/libs/jquery-3.3.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="/js/libs/slick.min.js"></script>
<script src="/js/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>
<script src="/js/libs/select2.min.js"></script>

<script src="/js/main.js?<?=mt_rand(1111,9999)?>"></script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v6.0"></script>

<script>
    $(function() {
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 8000,
            autoplayHoverPause: true,
            smartSpeed: 1500,
            dots: false,
            nav: true,
            navText: [
                '<img src="/images/angle-left.png">',
                '<img src="/images/angle-right.png">',
                //'<i class="fas fa-angle-left fa-3x"></i>', '<i class="fas fa-angle-right fa-3x"></i>'
            ],
            navContainer: '.owl-carousel',
        });
    });
</script>

</body>
</html>
