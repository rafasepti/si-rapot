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
                  @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Kelas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_kelas" value="{{ $kelas->tingkat }}-{{ $kelas->kelas }}" disabled>
                                <input type="hidden" class="form-control" name="id_kelas" value="{{ $kelas->id }}">
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
                        </div>
                        <div class="col-md-6">
                          <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Thn Ajaran</label>
                              <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="id_thn_ajaran" value="{{ $thn_ajaran->id }}">
                                  <input type="text" class="form-control" name="thn_ajaran" value="{{ $thn_ajaran->nama_tahun }}" disabled>
                              </div>
                          </div>
                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Mata Pelajaran</label>
                              <div class="col-sm-9">
                                <select class="form-select" aria-label="Default select example" required name="id_mapel">
                                  @foreach ($mapel2 as $m)
                                    <option value="{{ $m->id_mp }}">{{ $m->nama_mapel }}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                    </div>
                    <div class="row">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class=" text-center">No.</th>
                            <th class="col-sm-3 text-center">Nama Siswa</th>
                            <th class="col-sm-2 text-center">NRL</th>
                            <th class="col-sm-2 text-center">NTP</th>
                            <th class="col-sm-2 text-center">NAS</th>
                            <th class="col-sm-3 text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($siswa as $index => $s)
                          <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>
                              <input type="hidden" class="form-control" name="id_siswa[]" value="{{ $s->id }}" required>
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

  
  <script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     const nilaiRlInputs = document.querySelectorAll(".nilai_rl");
    //     const nilaiTpInputs = document.querySelectorAll(".nilai_tp");
    //     const nilaiAsInputs = document.querySelectorAll(".nilai_as");

    //     // Fungsi untuk menghitung nilai AS
    //     function hitungNilaiAs(rl, tp) {
    //         return (parseInt(rl) + parseInt(tp)) / 2;
    //     }

    //     // Tambahkan event listener untuk setiap input nilai RL dan TP
    //     nilaiRlInputs.forEach(function(input, index) {
    //         input.addEventListener("input", function() {
    //             const rlValue = this.value;
    //             const tpValue = nilaiTpInputs[index].value;
    //             nilaiAsInputs[index].value = hitungNilaiAs(rlValue, tpValue);
    //         });
    //     });

    //     nilaiTpInputs.forEach(function(input, index) {
    //         input.addEventListener("input", function() {
    //             const tpValue = this.value;
    //             const rlValue = nilaiRlInputs[index].value;
    //             nilaiAsInputs[index].value = hitungNilaiAs(rlValue, tpValue);
    //         });
    //     });
    // });
</script>
    

</body>
</html>