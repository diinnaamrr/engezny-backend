<!DOCTYPE html>
<html lang="en">
    @php($preloader = getSession('preloader'))
    @php($favicon = getSession('favicon'))
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/animate.css" />
    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/line-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/odometer.css" />
    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/owl.min.css" />
    <link rel="stylesheet" href="{{ asset('public/landing-page') }}/assets/css/main.css" />
        @include('landing-page.layouts.css')
    @stack('style')
    <link rel="shortcut icon" href="{{ $favicon ? asset("storage/app/public/business/".$favicon) : asset('public/landing-page/assets/img/favicon.png') }}" type="image/x-icon" />
</head>

<body>

    <div class="preloader" id="preloader">
        @if ($preloader)
            <img class="preloader-img" width="160" loading="eager"
                src="{{ $preloader ? asset('storage/app/public/business/' . $preloader) : '' }}" alt="">
        @else
            <div class="spinner-grow" role="status">
                <span class="visually-hidden">{{ translate('Loading...') }}</span>
            </div>
        @endif
    </div>

@include('landing-page.partials._header')

@yield('content')

<!-- Footer Section Start -->
@include('landing-page.partials._footer')
<!-- Footer Section End -->
{{--<script src="{{ asset('public/js/app.js') }}"></script>--}}

<script src="{{ asset('public/landing-page') }}/assets/js/jquery-3.6.0.min.js"></script>
<script src="{{ asset('public/landing-page') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('public/landing-page') }}/assets/js/viewport.jquery.js"></script>
<script src="{{ asset('public/landing-page') }}/assets/js/wow.min.js"></script>
<script src="{{ asset('public/landing-page') }}/assets/js/owl.min.js"></script>
<script src="{{ asset('public/landing-page') }}/assets/js/main.js"></script>

@stack('script')
</body>

</html>
