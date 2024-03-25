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
                @if($siswa != "")
                <form class="row g-3" action="/nilai/store_ekskul" method="post">
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
                        <div class="col-md-6">
                          <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Thn Ajaran</label>
                              <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="id_thn_ajaran" value="{{ $thn_ajaran->id }}">
                                <input type="text" class="form-control" name="thn_ajaran" value="{{ $thn_ajaran->nama_tahun }}" disabled>
                              </div>
                          </div>
                            <div class="row mb-3">
                              <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Ekskul</label>
                              <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="id_ekskul" value="{{ $ekskul->id }}">
                                <input type="text" class="form-control" name="nama_ekskul" value="{{ $ekskul->nama_ekskul }}" disabled>
                              </div>
                          </div>
                    </div>
                    <div class="row">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class=" text-center col-md-1">No.</th>
                            <th class="col-sm-3 text-center">Nama Siswa</th>
                            <th class="col-sm-2 text-center">Kelas</th>
                            <th class="col-sm-2 text-center">Nilai</th>
                            <th class="col-sm-4 text-center">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($siswa as $index => $s)
                          <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>{{ $s->kel }}</td>
                            <td>
                              <input type="hidden" class="form-control" name="id_siswa[]" value="{{ $s->id }}" required>
                              <input type="hidden" class="form-control" name="id_kelas[]" value="{{ $s->idk }}" required>
                              <input type="number" class="form-control nilai_eks_{{ $s->id }}_{{ $s->idk }}" name="nilai_eks[]" value="{{ old('nilai_eks.'.$index) }}" required>
                            </td>
                            <td>
                              <textarea name="ket_eks[]" class="form-control ket_eks_{{ $s->id }}_{{ $s->idk }}" required>{{ old('ket_eks.'.$index) }}</textarea>
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
                @else
                <div>Tidak Ada ekskul yang diajar</div>
                @endif
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

<script>
  document.getElementById("semesterSelect").addEventListener("change", function() {
    // Mendapatkan nilai semester yang dipilih
    var semester = $(this).val();
    console.log("Nilai semester yang dipilih:", semester);
    $.ajax({
        url: '/filter_ekskul',
        method: 'POST',
        data: { semester: semester },
        success: function(response) {
          if (response.length > 0) {
            $.each(response, function(index, nilai) {
                // Temukan input field berdasarkan id siswa dan isi dengan nilai yang sesuai
                var idSiswa = nilai.id_siswa;
                var idKelas = nilai.id_kelas;
                $('.nilai_eks_' + idSiswa +'_'+ idKelas).val(nilai.nilai_eks);
                $('.ket_eks_' + idSiswa +'_'+ idKelas).val(nilai.ket_eks);
              });
            } else {
              $('input[name^="nilai_eks"]').val('');
              $('textarea[name^="ket_eks"]').val('');
            }
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan jika ada
        }
    });
  });
</script>
    

</body>
</html>