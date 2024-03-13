<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Mata Pelajaran</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Mata Pelajaran</h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Mapel</th>
                      <th>KKM</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Unity Pugh</td>
                      <td>9958</td>
                      <td>Curicó</td>
                      <td style="text-align: center">
                        <a href="/siswa/edit/" class="btn btn-outline-success">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/siswa/hapus/" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin?')">
                          <i class="bi bi-trash-fill"></i>
                        </a>
                      </td>
                    </tr>
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