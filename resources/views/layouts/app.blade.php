<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DAYAH</title>
    <link href="{{ url('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

  </head>
<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ route(auth()->user()->level.'.Dashboard') }}">Dayah</a>
      <button class="btn btn-link btn-sm order-1 order-lg-0 ml-auto" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
  </nav>
  <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
          <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
              <div class="sb-sidenav-menu">
                  <div class="nav">
                      <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route(auth()->user()->level.'.Dashboard') }}">
                        <div class="sb-nav-link-icon">
                          <i class="fas fa-tachometer-alt"></i>
                        </div>
                          Dashboard
                      </a>
                      <div class="sb-sidenav-menu-heading">Laporan</div>
                      @if(auth()->user()->level != 'asrama')
                        @if(auth()->user()->level == 'admin')
                          <a class="nav-link" href="{{ route('laporanUser') }}">
                            <div class="sb-nav-link-icon">
                              <i class="fas fa-user"></i>
                            </div>
                            User
                          </a>
                          
                          <a class="nav-link" href="{{ route(auth()->user()->level.'.laporanFasilitas') }}">
                            <div class="sb-nav-link-icon">
                              <i class="fas fa-chart-area"></i>
                            </div>
                            Data Fasilitas
                          </a>
                          @endif
                        <a class="nav-link" href="{{ route(auth()->user()->level.'.laporanRuang') }}">
                          <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                          </div>
                          Data Ruang
                        </a>
                        <a class="nav-link" href="{{ route('laporanKerusakan') }}">
                          <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                          </div>
                          Laporan Pengaduan
                        </a>
                        <a class="nav-link" href="{{ route('laporanPerbaikan') }}">
                          <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                          </div>
                          Laporan Perbaikan
                        </a>
                      @endif
                      @if(auth()->user()->level != 'admin')
                        @if(auth()->user()->level == 'sekolah')
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data Fasilitas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <a class="nav-link" href="{{ route('sekolah.laporanPerbaikan') }}">
                              <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-area"></i>
                              </div>
                              Laporan Perbaikan
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ibtidayah" aria-expanded="false" aria-controls="ibtidayah">Ibtidayah
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="ibtidayah" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", ["ibtidayah", "putra"]) }}">Putra</a>
                                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", ["ibtidayah", "putri"]) }}">Putri</a>
                                        </nav>
                                    </div>
                                     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tsanawiyah" aria-expanded="false" aria-controls="tsanawiyah">Tsanawiyah
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="tsanawiyah" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", ["tsanawiyah", "putra"]) }}">Putra</a>
                                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", ["tsanawiyah", "putri"]) }}">Putri</a>
                                        </nav>
                                    </div>
                                     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#aliyah" aria-expanded="false" aria-controls="aliyah">Aliyah
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="aliyah" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", ["aliyah", "putra"]) }}">Putra</a>
                                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", ["aliyah", "putri"]) }}">Putri</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link" href="{{ route(auth()->user()->level.".dataFasilitas", "umum") }}">Umum</a>
                                    <a class="nav-link" href="{{ route(auth()->user()->level.'.inputFasilitas') }}">Tambah Fasilitas</a>
                                  </nav>
                            </div>
                            @endif
                          <a class="nav-link" href="{{ route(auth()->user()->level.".dataPerbaikan") }}">
                            <div class="sb-nav-link-icon">
                              <i class="fas fa-chart-area"></i>
                            </div>
                            Laporan Pengaduan
                          </a>
                        <a class="nav-link" href="{{ route(auth()->user()->level.".inputKerusakan") }}">
                          <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                          </div>
                          Input Kerusakan
                        </a>
                      @endif
                      <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="sb-nav-link-icon">
                          <i class="fas fa-sign-out-alt"></i>
                        </div>
                        Sign Out
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                  </div>
              </div>
              <div class="sb-sidenav-footer">
                  <div class="small">Logged in as:</div>
                  {{ auth()->user()->jabatan }}
              </div>
          </nav>
      </div>
      <div id="layoutSidenav_content">
          <main>
            @yield('content')
          </main>
          <footer class="py-4 bg-light mt-auto">
              <div class="container-fluid">
                  <div class="d-flex align-items-center justify-content-between small">
                      <div class="text-muted">Copyright &copy; DAYAH {{ date('Y') }}</div>
                  </div>
              </div>
          </footer>
      </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('js/datatables.js') }}"></script>
    <script>
      $('.show_confirm').click(function(e) {
				if(!confirm('Are you sure you want to delete this?')) {
					e.preventDefault();
				}
			});
    </script>
    @yield('script')
  </body>
</html>