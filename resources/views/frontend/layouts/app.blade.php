<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <livewire:styles />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landingpage/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('landingpage/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/css/style.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>
<body>
    <br>

    <div id="app">
        @include('frontend.includes.nav')
        @include('includes.partials.messages')
        <main>
            @yield('content')
        </main>
    </div><!--app-->

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    <script src="{{ asset('vendor/js/moment.js') }}"></script>
    <livewire:scripts />

    <script>
        $(document).ready( () => {
            moment.locale('id')
        })
    </script>
    @stack('after-scripts')
</body>
</html>
