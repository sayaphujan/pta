<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ 'PTA | PDAM Kendal' }}</title>
        
        <!-- Favicons -->
      <link rel="icon" href="{{ asset('assets/dist/img/pdamkendal.png') }}">
      
      <meta content="" name="description">
      <meta content="" name="keywords">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!-- Vendor CSS Files -->
      <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.0/mapbox-gl.css' rel='stylesheet' />
      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.0/mapbox-gl.js'></script>
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

      <!-- Template Main CSS File -->
      <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
      <style type="text/css">
            .mapboxgl-popup {
                max-width: 400px;
                font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
            }
            .mapboxgl-popup-content {
                position: relative;
                background: #fff;
                border-radius: 3px;
                box-shadow: 0 1px 2px rgb(0 0 0 / 10%);
                padding: 10px 10px 15px;
                pointer-events: auto;
                color: #000000;
            }
            #map {
                width: 100%;
                height: 500px;
            }
            .marker {
                background-image: url('{{ asset('images/point.png')}}');
                background-repeat:no-repeat;
                background-size:100%;
                width: 50px;
                height: 100px;
                cursor: pointer; 
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button { 
                box-sizing: border-box;
                display: inline-block;
                min-width: 1.5em;
                padding: 0px 0px;
                margin-left: 2px;
                text-align: center;
                text-decoration: none !important;
                cursor: pointer;
                *cursor: hand;
                color: #FFF !important;
                border: 1px solid transparent;
                border-radius: 2px;
            }
            table.dataTable thead {background-color:#FFF}
            .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
                  color: #FFF !important;
              }
          a {
            text-decoration: none;
          }
          #topbar {
            background-color: #7e7e7e;
          }
          .dropdown-toggle,
          .dropdown-menu {
              border-radius: 0px !important;
              background-color: #393837;
             /* color : #000;*/
          }
          /*.dropdown-item {
            color: #000;
          }*/
          .dropdown-item:hover {
              background-color: #cda45e;
          }
          .dropdown:hover>.dropdown-menu {
            display: block;
          }
          /*.dropdown-item:hover>.dropdown-submenu {
            display: block;
          }*/
          .dropdown-submenu {
            display: none;
          }
          #hdbidang {
              color: black;
              position: relative;
              margin: 10px auto;
              padding: 20px;
              max-width: 90%;
              background-color: rgba(200,200,255,.4);
              height: 120%;
          }
          .bdt {
              background-color: rgba(255,190,190,.8);
              position: absolute;
              margin-left: auto;
              margin-right: auto;
              margin-top: auto;
              margin-bottom: auto;
              left: 0;
              right: 0;
              top: 5px;
              bottom: 5px;
          }
          .spbidang1 {
              color: #FFF;
          }
          .spbidang2 {
              margin-left: 35px;
              color: #FFF;
          }
          .spbidang3 {
              margin-left: 33px;
              color: #FFF;
          }
          #header .btn-menu, #header .btn-book {
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            transition: 0.3s;
            line-height: 1;
            color: white;
            border: 2px solid #cda45e;
        }

              img {
                max-width: 100%;
                width: 1000px !important;
                object-fit: cover;
                object-position: center;
              }
              
            @media only screen and (max-width: 480px) {
              img {
                width: 100%;
              }
            }
            @media only screen and (max-width: 1080px) {
              img {
                width: 900px !important;
              }
            }
      </style>

      <!-- =======================================================
      * Template Name: Restaurantly - v1.2.1
      * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
      * Author: BootstrapMade.com
      * License: https://bootstrapmade.com/license/
      ======================================================== -->
</head>
<body class="antialiased">

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-phone"></i> +62294381165
        <i class="icofont-envelope"></i> pdam@pdamkendal.com
        <i class="icofont-building"></i> Jl. Pemuda No.62, Kebondalem, Langenharjo, Kec. Kendal, Kabupaten Kendal, Jawa Tengah 51314
        <!--<span class="d-none d-lg-inline-block"><i class="icofont-clock-time icofont-rotate-180"></i> Senin - Jum'at : 08:00 - 15:00</span>-->
      </div>
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo mr-auto"><a href="{{url('/')}}">PTA</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
          <li><a href="{{ url('https://pdamkendal.com/') }}" target="_blank">Tirto Panguripan</a></li>
          <li class="book-a-table text-center"><a href="{{ url('/masuk') }}">Masuk</a></li>
          <li class="book-a-table text-center"><a href="{{ url('/daftar') }}">Daftar</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
    @yield('content')
  
  <!--<div id="preloader"></div>-->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa fa-arrow-up"></i></a>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui-1.13.0.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>      
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
  function scrollTo(id) {
    var elmnt = document.getElementById(id);
    elmnt.scrollIntoView();
  }
</script>
  <script type="text/javascript">
  $(document).ready(function () {

     var swiper = new Swiper(".swiper", {
       spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
      
   $(function () {
       $('body').on('click.tab.data-api', '[data-bs-toggle="tab"], [data-toggle="pill"]', function (e) {
         e.preventDefault()
         $(this).tab('show')
         //alert(this);
       })
     })
     
      $('[data-toggle="dropdown-submenu"]').on("click", function(e){
          $('.dropdown-submenu').attr('style','display:inline-grid');
        e.stopPropagation();
        e.preventDefault();
      });
  });
</script>
    </body>
</html>
