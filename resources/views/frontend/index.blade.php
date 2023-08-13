<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('landingpage/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('landingpage/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{ asset('landingpage/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('landingpage/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('landingpage/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        <div id="app">
            @include('frontend.includes.nav')

            
            <!-- ======= Hero Section ======= -->
            <section id="hero">
                <div class="container">
                <div class="row">
                    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                    <div>
                        <h1>We design digital products that help grow businesses</h1>
                        <h2>We are team of talented designers making websites with Bootstrap</h2>
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
                    <img src="{{ asset('img/landingpage/hero-img.png')}}" class="img-fluid" alt="">
                    </div>
                </div>
                </div>

            </section><!-- End Hero -->
        </div>

        <main id="main">
            <!-- ======= Services Section ======= -->
            <section id="jadwal-praktik" class="services section-bg">
                <div class="container">

                    <div class="section-title" data-aos="fade-up">
                        <h2>Jadwal Praktik Mandiri</h2>
                        <p>
                            Berikut adalah daftar jadwal praktik mandiri dr. Eka Nugraha  <br>
                            Silahkan lakukan reservasi sesuai jadwal yang tersedia, Hari Minggu / Tanggal merah libur!
                            <br>
                            @auth

                            @else
                            <br>
                                Silahkan <a href="{{ url('login') }}">Login</a> terlebih dahulu agar dapat melakukan pengambilan antrian secara daring! <br>
                                Belum punya akun? silahkan daftar <a href="{{ url('register') }}" >Disini!</a>
                            @endauth
                        </p>
                    </div>

                    <div class="row">
                        @foreach ($scheduleData as $scheduleItem)
                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
                                <div class="icon-box icon-box-pink">
                                    <div class="icon"><i class="bx bx-time"></i></div>
                                    <h4 class="title"><a href="">{{ $scheduleItem['day'] }}</a></h4>
                                    <p class="description">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Jam Buka</th>
                                                <th>Jam Selesai</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($scheduleItem['schedule_time'] as $scheduleId => $scheduleTime)
                                                    <tr>
                                                        <td>{{ $scheduleTime['start'] }}</td>
                                                        <td>{{ $scheduleTime['end'] }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </p>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section><!-- End Services Section -->

            <!-- ======= Cta Section ======= -->
            <section id="cta" class="cta">
            <div class="container">

                <div class="row" data-aos="zoom-in">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3>Ambil Antrian</h3>
                    <p>
                        @auth
                            Silahkan gunakan fitur ambil antrian secara daring melalui tombol disamping
                        @else
                        <br>
                            Silahkan <a href="{{ url('login') }}">Login</a> terlebih dahulu agar dapat melakukan pengambilan antrian secara daring! <br>
                            Belum punya akun? silahkan daftar <a href="{{ url('register') }}" >Disini!</a>
                        @endauth
                    </p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    @auth
                        <a class="cta-btn align-middle" href="{{ route('frontend.getQueue') }}">Ambil Antrian Disini!</a>
                    @else
                        <a class="cta-btn align-middle" href="{{ route('frontend.auth.login') }}">Login</a> atau <a class="cta-btn align-middle" href="{{ route('frontend.auth.register') }}">Daftar</a>
                    @endauth
                </div>
                </div>

            </div>
            </section><!-- End Cta Section -->

            <!-- ======= Team Section ======= -->
            <section id="staff" class="team">
                <div class="container">

                    <div class="section-title" data-aos="fade-up">
                    <h2>Staff Pendukung Klinik</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                    </div>

                    <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in">
                        <div class="pic"><img src="{{ asset('img/landingpage/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Penanggung Jawab Klinik</span>
                            <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pic"><img src="{{ asset('img/landingpage/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Dokter Umum</span>
                            <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="200">
                        <div class="pic"><img src="{{ asset('img/landingpage/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>Perawat</span>
                            <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>

                    </div>

                </div>
            </section><!-- End Team Section -->

            <!-- ======= Contact Section ======= -->
            <section id="about" class="contact section-bg">
                <div class="container">

                    <div class="section-title" data-aos="fade-up">
                    <h2>Tentang Klinik </h2>
                    </div>

                    <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-right">
                        <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-left">
                        <div class="php-email-form">
                            <p>Lorem Ipsum</p>
                        </div>
                    </div>

                    </div>

                </div>
            </section><!-- End Contact Section -->

        </main><!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
