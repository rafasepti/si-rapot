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
                        <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="{{ $siswa->id }}">
                        <div class="col-md-6">
                          <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Nama Siswa</label>
                              <div class="col-sm-9">
                                  <input type="hidden" class="form-control" name="id_nilai" value="{{ $kd_nilai }}">
                                  <input type="text" class="form-control" name="nama_siswa" value="{{ $siswa->nama_siswa }}" disabled>
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">NISN</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nisn" value="{{ $siswa->nisn }}" disabled>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Kelas</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nama_kelas" value="{{ $siswa->kel }}" disabled>
                                  <input type="hidden" class="form-control" name="id_kelas" id="id_kelas" value="{{ $siswa->id_kelas }}">
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
                          <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Thn Ajaran</label>
                              <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="id_thn_ajaran" value="{{ $thn_ajaran->id }}">
                                  <input type="text" class="form-control" name="thn_ajaran" value="{{ $thn_ajaran->nama_tahun }}" disabled>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="col-sm-1 text-center">No.</th>
                            <th class="col-sm-3 text-center">Mata Pelajaran</th>
                            <th class="col-sm-1 text-center">NRL</th>
                            <th class="col-sm-1 text-center">NTP</th>
                            <th class="col-sm-1 text-center">NAS</th>
                            <th class="col-sm-3 text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th colspan="6">Kelompok A</th>
                          </tr>
                          @foreach ($mapel as $index => $m)
                          <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $m->nama_mapel }}</td>
                            <td>
                              <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $m->id }}" required>
                              <input type="number" class="form-control nilai_rl" name="nilai_rl[]" required>
                            </td>
                            <td><input type="number" class="form-control nilai_tp" name="nilai_tp[]" required></td>
                            <td>
                              <input type="number" class="form-control nilai_as" name="nilai_as[]" required>
                            </td>
                            <td>
                              <textarea name="ket[]" class="form-control" required></textarea>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="col-sm-5" colspan="3">Catatan Guru</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <textarea class="form-control" style="height: 100px" name="catatan" required></textarea>
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="col-sm-5" colspan="3">Ketidakhadiran</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Sakit</td>
                            <td>:</td>
                            <td class="text-center">
                              <div class="row">
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="kehadiran_sakit" required>
                                </div>
                                <div class="col-md-2">
                                  Hari
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Izin</td>
                            <td>:</td>
                            <td class="text-center">
                                <div class="row">
                                  <div class="col-md-4">
                                    <input type="number" class="form-control" name="kehadiran_izin" required>
                                  </div>
                                  <div class="col-md-2">
                                    Hari
                                  </div>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Tanpa Keterangan</td>
                            <td>:</td>
                            <td class="text-center">
                              <div class="row">
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="kehadiran_tanpa_ket" required>
                                </div>
                                <div class="col-md-2">
                                  Hari
                                </div>
                              </div>
                            </td>
                          </tr>
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