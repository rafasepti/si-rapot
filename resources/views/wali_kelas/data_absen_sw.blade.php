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
                                <input type="text" class="form-control" name="nama_kelas" value="{{ $siswa_kel->tingkat }}-{{ $siswa_kel->kelas }}" disabled>
                                <input type="hidden" class="form-control" name="id_kelas" value="{{ $siswa_kel->id }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tanggal" value="{{ $today }}" disabled>
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
                                    <option value="">Pilih Mapel</option>
                                    @foreach ($mapel2 as $m)
                                    <option value="{{ $m->id_mp }}">{{ $m->nama_mapel }}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                          <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Semester</label>
                            <div class="col-sm-9">
                              <select class="form-select" aria-label="Default select example" required name="semester" id="semesterSelect">
                                <option value="">Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                                <th class="col-sm-1 text-center">No.</th>
                                <th class="col-sm-5 text-center">Nama Siswa</th>
                                <th class="col-sm-6 text-center" colspan="5">Absensi</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach ($siswa as $index => $s)
                          <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td >{{ $s->nama_siswa }}</td>
                              <td colspan="2">
                                <input type="hidden" class="form-control" name="id_siswa[]" value="{{ $s->id }}" required>
                                <label class="form-check">
                                  <input type="radio" class="form-check-input hadir_{{ $s->id }}_{{ $siswa_kel->id }}" name="k_absen_{{ $s->id }}_{{ $siswa_kel->id }}" value="hadir" {{ old('k_absen.'.$index) == 'hadir' ? 'checked' : '' }} required>
                                  Hadir
                                </label>
                              </td>
                              <td>
                                <label class="form-check">
                                  <input type="radio" class="form-check-input sakit_{{ $s->id }}_{{ $siswa_kel->id }}" name="k_absen_{{ $s->id }}_{{ $siswa_kel->id }}" value="sakit" {{ old('k_absen.'.$index) == 'sakit' ? 'checked' : '' }} required>
                                  Sakit
                                </label>
                              </td>
                              <td>
                                <label class="form-check">
                                  <input type="radio" class="form-check-input izin_{{ $s->id }}_{{ $siswa_kel->id }}" name="k_absen_{{ $s->id }}_{{ $siswa_kel->id }}" value="izin" {{ old('k_absen.'.$index) == 'izin' ? 'checked' : '' }} required>
                                  Izin
                              </label>
                              </td>
                              <td>
                                <label class="form-check">
                                  <input type="radio" class="form-check-input alpha_{{ $s->id }}_{{ $siswa_kel->id }}" name="k_absen_{{ $s->id }}_{{ $siswa_kel->id }}" value="alpha" {{ old('k_absen.'.$index) == 'alpha' ? 'checked' : '' }} required>
                                  Alpha
                              </label>
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
    // document.getElementById("semesterSelect").addEventListener("change", function() {
    //   // Mendapatkan nilai semester yang dipilih
    //   var semester = $(this).val();
    //   console.log("Nilai semester yang dipilih:", semester);
    //   $.ajax({
    //       url: '/filter_sw',
    //       method: 'POST',
    //       data: { semester: semester },
    //       success: function(response) {
    //         if (response.length > 0) {
    //           $.each(response, function(index, nilai) {
    //               // Temukan input field berdasarkan id siswa dan isi dengan nilai yang sesuai
    //               var idSiswa = nilai.id_siswa;
    //               var idKelas = nilai.id_kelas;
                 
    //               $('.hadir_' + idSiswa +'_'+ idKelas).val(nilai.k_hadir);
    //               $('.sakit_' + idSiswa +'_'+ idKelas).val(nilai.k_sakit);
    //               $('.izin_' + idSiswa +'_'+ idKelas).val(nilai.k_izin);
    //               $('.alpha_' + idSiswa +'_'+ idKelas).val(nilai.k_tanpa_ket);
    //             });
    //           } else {
    //             $('input[name^="k_hadir"]').val('');
    //             $('input[name^="k_sakit"]').val('');
    //             $('input[name^="k_izin"]').val('');
    //             $('input[name^="k_tanpa_ket"]').val('');
    //           }
    //       },
    //       error: function(xhr, status, error) {
    //           // Tangani kesalahan jika ada
    //       }
    //   });
    // });
  </script>

  
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