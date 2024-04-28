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
                    <h5 class="card-title">Data Kelas</h5>   
                  </div>
                </div>
                <!-- Table with stripped rows -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Tingkat</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $index => $k)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $k->tingkat }}</td>
                                <td>{{ $k->kelas }}</td>
                                <td><a  href="/absen-guru/siswa/{{ $k->ids_kelas }}" class="btn btn-primary float-right" style="
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