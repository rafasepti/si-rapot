<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                          <div class="card info-card customers-card">
            
                            <div class="card-body">
                              <h5 class="card-title">Selamat Datang, {{ Session::get('nama') }}</h5>
            
                            </div>
                          </div>
            
                        </div><!-- End Customers Card -->

            <!-- Sales Card -->
            @if (Session::get('hak_akses') == "Guru")
              @if (Session::get('walikelas') == "Ya")
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Kelas yang di wali: </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $siswa_kel->tingkat }}-{{ $siswa_kel->kelas }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Jumlah Siswa Kelas {{ $siswa_kel->tingkat }}-{{ $siswa_kel->kelas }}: </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $countSiswa }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @else
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Kelas yang di Ajar: </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        @foreach ($kelas_ajar as $kj)
                          <span>{{ $kj->tingkat }}-{{ $kj->kelas }}|</span>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <h5 class="card-title">Extrakulikuler yang diajar :</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-emoji-laughing"></i>
                      </div>
                      <div class="ps-3">
                        <h6>$3,264</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Revenue Card -->
            @else
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Kelas</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $countKelas }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Guru</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $countGuru }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->
            @endif<!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Kepala Sekolah</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $kepsek->nama_guru }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

</body>

</html>