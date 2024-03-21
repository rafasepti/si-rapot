<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Nilai</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Nilai Siswa</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                <form class="row g-3" action="/nilai/store" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                      @foreach ($siswa as $s)
                      <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_siswa" value="{{ $s->nama_siswa }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">NISN</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nisn" value="{{ $s->nisn }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Kelas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_kelas" value="{{ $s->kel }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Semester</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="semester" value="1" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Thn Ajaran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_thn_ajaran" value="" disabled>
                            </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <table class="table table-bordered border-dark">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">KKM</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Huruf</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Brandon Jacob</td>
                            <td>Designer</td>
                            <td>28</td>
                            <td>2016-05-25</td>
                          </tr>
                        </tbody>
                      </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- Vertical Form -->
              </div>
            </div>
        </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

</body>
</html>