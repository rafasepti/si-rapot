<!DOCTYPE html>
<html lang="en">

<style>
@media (max-width: 768px) { /* use the max to specify at each container level */
    .specifictd {    
        width:360px;  /* adjust to desired wrapping */
        display:table;
        white-space: pre-wrap; /* css-3 */
        white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
        white-space: -pre-wrap; /* Opera 4-6 */
        white-space: -o-pre-wrap; /* Opera 7 */
        word-wrap: break-word; /* Internet Explorer 5.5+ */
    }
}
</style>
  
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
                              <select class="form-select" aria-label="Default select example" required name="semester">
                                <option>1</option>
                                <option>2</option>
                              </select>
                            </div>
                        </div>
                        @endforeach
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Thn Ajaran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_thn_ajaran" value="{{ $thn_ajaran->nama_tahun }}" disabled>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <table class="table table-bordered border-dark">
                        <thead>
                          <tr>
                            <th class="col-sm-1 text-center">No.</th>
                            <th class="col-sm-5 text-center">Mata Pelajaran</th>
                            <th class="col-sm-2 text-center">Nilai Ruang Lingkup</th>
                            <th class="col-sm-2 text-center">Nilai Tujuan Pembelajaran</th>
                            <th class="col-sm-2 text-center">Nilai Akhir Semester</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($mapel as $index => $m)
                          <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $m->nama_mapel }}</td>
                            <td><input type="text" class="form-control" name="nilai_rl[]" required></td>
                            <td><input type="text" class="form-control" name="nilai_tp[]" required></td>
                            <td><input type="text" class="form-control" name="nilai_as[]" required></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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