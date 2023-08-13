<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

    <div class="logo me-auto">
        <h1><a href="/">Inklinik</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="nav-link scrollto active" href="{{ url('/') }}">Home</a></li>
            <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#jadwal-praktik' : url('/') }}">Jadwal Praktik</a></li>
            <li><a class="nav-link scrollto " href="{{ request()->is('/') ? '#staff' : url('/') }}">Staff Klinik</a></li>
            <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#about' : url('/') }}">Tentang Klinik</a></li>
        @auth
            <li class="dropdown"><a href="#"><b>{{ $logged_in_user->name }}</b> <i class="bi bi-chevron-down"></i></a>
                <ul>
                    <li><a class="nav-link" href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a></li>
                    <li><a class="nav-link" href="{{ route('frontend.user.account') }}">@lang('My Account')</a></li>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">@lang('Logout')
                        <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                    </a>
                </ul>
            </li>
        @else
            <li><a class="nav-link" href="{{ route('frontend.auth.login') }}">@lang('Login')</a></li>

            @if (config('boilerplate.access.user.registration'))
                <li><a class="nav-link" href="{{ route('frontend.auth.register') }}">@lang('Register')</a></li>
            @endif
        @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
<br><br>

@if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
@endif
