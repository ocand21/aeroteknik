<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{!! $konfig->judul_web !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{$konfig->favicon}}" rel="icon" width="40px">
    <link href="{{$konfig->favicon}}" rel="apple-touch-icon" width="40px">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="front/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="front/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="front/lib/animate/animate.min.css" rel="stylesheet">
    <link href="front/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="front/lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="front/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="front/css/style.css" rel="stylesheet">

    <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

    <div id="app">
        <!--==========================
        Top Bar
      ============================-->
        <button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>

        <section id="topbar" class="d-none d-lg-block">
            <div class="container clearfix">
                <div class="contact-info float-left">
                    @if($konfig->email)
                        <i class="fa fa-envelope-o"></i> <a href="mailto:{{$konfig->email}}">{{$konfig->email}}</a>
                        @endif
                </div>
                <div class="social-links float-right">
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </section>

        <!--==========================
        Header
      ============================-->
        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <h1><a href="#body" class="scrollto">
                            <img src="{{$konfig->logo}}" alt="" width="160px">
                        </a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#body">Home</a></li>
                        @foreach ($halaman as $hlm)
                        <li class="menu"><a href="#{{$hlm->slug}}">{{$hlm->judul}}</a></li>
                        @endforeach
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->

        <!--==========================
        Intro Section
      ============================-->
        {{-- <section id="intro" class="headerq" style="background: url({{$konfig->header}}) no-repeat; background-size: cover;">
            <div class="intro-content">
            </div>
        </section> --}}

        <main id="main">
            {{-- Konten --}}

            <aboutus></aboutus>
            <principals></principals>
            <products></products>
            <galeri></galeri>
            <contactus></contactus>
        </main>

        <!--==========================
        Footer
      ============================-->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong>{{$konfig->footer}}</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
            -->
                    {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
                </div>
            </div>
        </footer><!-- #footer -->

        <a href="#" class="back-to-top" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <script src="js/app.js"></script>
    {{-- <script src="front/lib/jquery/jquery.min.js"></script> --}}
    {{-- <script src="front/lib/jquery/jquery-migrate.min.js"></script> --}}
    <script src="front/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="front/lib/easing/easing.min.js"></script>
    <script src="front/lib/superfish/hoverIntent.js"></script>
    <script src="front/lib/superfish/superfish.min.js"></script>
    <script src="front/lib/wow/wow.min.js"></script>
    <script src="front/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="front/lib/magnific-popup/magnific-popup.min.js"></script>
    <script src="front/lib/sticky/sticky.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}
    <!-- Contact Form JavaScript File -->
    {{-- <script src="contactform/contactform.js"></script> --}}

    <!-- Template Main Javascript File -->
    <script src="front/js/main.js"></script>



</body>

</html>
