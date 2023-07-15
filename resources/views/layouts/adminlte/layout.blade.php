<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ 'PTA | PDAM Kendal' }}</title>
  <link rel="icon" href="{{ asset('assets/dist/img/pdamkendal.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- Zoom Image -->
  <link href="{{ asset('assets/plugins/lightbox-zoom/zoomify.css') }}" rel="stylesheet" type="text/css">
  <style>

select[readonly] {
  background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
  pointer-events: none;
  touch-action: none;
}  
    .wrapper {
      position: relative;
    }

    .alert {
      position: relative;
      padding: 0.75rem 1.25rem;
      margin-bottom: 1rem;
      border: 1px solid transparent;
      border-radius: 0.25rem;
    }

    .alert-success {
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
    }

    .alert-danger {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }

    .zoomify {
      cursor: pointer;
      cursor: -webkit-zoom-in;
      cursor: zoom-in;
    }

    .zoomify.zoomed {
      cursor: -webkit-zoom-out;
      cursor: zoom-out;
      padding: 0;
      margin: 0;
      border: none;
      border-radius: 0;
      box-shadow: none;
      position: relative;
      z-index: 1501;
    }

    .zoomify-shadow {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
      display: block;
      z-index: 1500;
      background: rgba(0, 0, 0 , .3);
      opacity: 0;
    }

    .zoomify-shadow.zoomed {
      opacity: 1;
      cursor: pointer;
      cursor: -webkit-zoom-out;
      cursor: zoom-out;
    }
  </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  
    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                
                <div class="dropdown-divider"></div>
                <a href="/profile/{{ Auth::user()->id }}" class="dropdown-item">
                  <i class="fas fa-user mr-2"></i> {{ __('Profil') }}
                </a>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-door-open"></i>
                                        {{ __('Keluar') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
            </div>
          </a>
        </li>
      </ul>
    </nav>
    <!-- END NAVBAR -->

    <!-- SIDEBAR -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" target="_" class="brand-link">
        <img src="{{ asset('assets/dist/img/pdamkendal.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PTA PDAM Kendal</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if(empty(Auth::user()->photo))
            <img src="{{ asset('assets/dist/img/user-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @else
            <img src="{{ asset('upload/profile/'.Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image">
            @endif
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ strtoupper(Auth::user()->name) }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
              <a href="{{ url('/home') }}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-book"></i>
                <p>
                  Transaksi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="margin-left: 25px;">
                <li class="nav-item">
                  <a href="{{ url('/trans') }}" class="nav-link">
                    <i class="fa fa-signal nav-icon"></i>
                    <p>Semua Transaksi</p>
                  </a>
                </li>
                @if(Auth::user()->level != '4')
                <li class="nav-item">
                  <a href="{{ url('/unpaid') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Belum Terbayar</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->level == '1')
                <li class="nav-item">
                  <a href="{{ url('/unverified') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Belum Terverifikasi</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->level == '3')
                <li class="nav-item">
                  <a href="{{ url('/paid') }}" class="nav-link">
                    <i class="fa fa-check-circle nav-icon"></i>
                    <p>Terbayar</p>
                  </a>
                </li>
                @endif
                @if(Auth::user()->level == '4')
                <li class="nav-item">
                  <a href="{{ url('/unsent') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Belum Terkirim</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/sent') }}" class="nav-link">
                    <i class="far fa-check-circle nav-icon"></i>
                    <p>Terkirim</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @if (Auth::user()->level == 1 || Auth::user()->level == 2 )
            <li class="nav-item">
              <a href="{{ url('/prices') }}" class="nav-link">
                <i class="nav-icon fas fa-money-bill-alt"></i>
                <p>
                  Daftar Harga
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/banks') }}" class="nav-link">
                <i class="nav-icon fas fa-wallet"></i>
                <p>
                  No. Rekening
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/officers') }}" class="nav-link">
                <i class="nav-icon fas fa-street-view"></i>
                <p>
                  Petugas Pengiriman
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/users') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Pengguna
                </p>
              </a>
            </li>
             <li class="nav-item">
              <a href="#" data-target="#modal-laporan" data-toggle="modal" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>
                  Cetak Laporan
                </p>
              </a>
            </li>
            @endif
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside> 
    <!-- END SIDEBAR -->

    <div class="modal fade" id="modal-laporan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cetak Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('cetak') }}" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label>Date range:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                <input type="text" class="form-control float-right" id="tglLaporan" name="tglLaporan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" class="btn btn-primary">Cetak</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
     
    @yield('content')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="#">Perumda Air Minum Tirta Panguripan</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/lightbox-zoom/zoomify.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
  <script type="text/javascript">
    //Date range picker
    $('#tglLaporan').daterangepicker({
        locale : {
            format : 'DD/MM/YYYY'
        }
    });
    
    function newexportaction(e, dt, button, config) {
         var self = this;
         var oldStart = dt.settings()[0]._iDisplayStart;
         dt.one('preXhr', function (e, s, data) {
             // Just this once, load all data from the server...
             data.start = 0;
             data.length = 2147483647;
             dt.one('preDraw', function (e, settings) {
                 // Call the original action function
                 if (button[0].className.indexOf('buttons-copy') >= 0) {
                     $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                     $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                     $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                     $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-print') >= 0) {
                     $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                 }
                 dt.one('preXhr', function (e, s, data) {
                     // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                     // Set the property to what it was before exporting.
                     settings._iDisplayStart = oldStart;
                     data.start = oldStart;
                 });
                 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                 setTimeout(dt.ajax.reload, 0);
                 // Prevent rendering of the full data to the DOM
                 return false;
             });
         });
         // Requery the server with the new one-time export settings
         dt.ajax.reload();
     }
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('img').zoomify({

    // animation duration
    duration: 200,

    // easing effect
    easing:   'linear',

    // zoom scale
    // 1 = fullscreen
    scale:    1

  });
});
</script>
 </body>
</html>
