<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Mapel</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    @if ($siswa_kel != "")
                        <h5 class="card-title">Data Mapel Kelas {{ $siswa_kel->tingkat }}-{{ $siswa_kel->kelas }}</h5>           
                    @else
                        <h5 class="card-title">Data Mapel Kelas -</h5>           
                    @endif
                  </div>
                </div>
                <!-- Table with stripped rows -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Nama Mapel</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($mapel as $index => $m)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $m->nama_mapel }}</td>
                                <td><a href="{{ url('absen-wali/siswa/') }}" class="btn btn-primary float-right" style="
                                    margin-top: 15px; margin-left: 52px;">
                                    <i class="bi bi-plus"></i> Pilih
                                </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </div>
        </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

</body>

</html>