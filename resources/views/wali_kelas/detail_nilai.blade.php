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
                <ul class="nav nav-tabs nav-tabs-bordered">
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#smt1">Semester 1</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#smt">Semester 2</button>
                  </li>
                </ul>
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Nilai Siswa</h5>
                  </div>
                </div>
                <div class="tab-content pt-2">
                  <div class="tab-pane fade show active smt1" id="smt1">
                    <!-- Vertical Form -->
                    <form class="row g-3" action="/nilai/store" method="post">
                      {{ csrf_field() }}
                      <div class="row">
                          <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="{{ $siswa->id }}">
                          <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Nama Siswa</label>
                                <div class="col-sm-9">
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
                                  <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $m->id }}" disabled>
                                  <input type="number" class="form-control nilai_rl" name="nilai_rl[]" value="" disabled>
                                </td>
                                <td><input type="number" class="form-control nilai_tp" name="nilai_tp[]" disabled></td>
                                <td>
                                  <input type="number" class="form-control nilai_as" name="nilai_as[]" disabled>
                                </td>
                                <td>
                                  <textarea name="ket[]" class="form-control ket" disabled></textarea>
                                </td>
                              </tr>
                            @endforeach
                            <tr>
                              <th colspan="6">Kelompok B</th>
                            </tr>
                            @foreach ($mapelb as $index => $mb)
                              <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $mb->nama_mapel }}</td>
                                <td>
                                  <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $mb->id }}" required>
                                  <input type="number" class="form-control nilai_rl" name="nilai_rl[]" value="" disabled>
                                </td>
                                <td><input type="number" class="form-control nilai_tp" name="nilai_tp[]" disabled></td>
                                <td>
                                  <input type="number" class="form-control nilai_as" name="nilai_as[]" disabled>
                                </td>
                                <td>
                                  <textarea name="ket[]" class="form-control ket" disabled></textarea>
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
                                <textarea class="form-control" style="height: 100px" name="catatan" disabled>{{ $nilai1->catatan }}</textarea>
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
                                    <input type="number" class="form-control" name="kehadiran_sakit" disabled value="{{ $nilai1->kehadiran_sakit }}">
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
                                      <input type="number" class="form-control" name="kehadiran_izin" disabled value="{{ $nilai1->kehadiran_izin }}">
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
                                    <input type="number" class="form-control" name="kehadiran_tanpa_ket" disabled value="{{ $nilai1->kehadiran_tanpa_ket }}">
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
                    </form><!-- Vertical Form -->
                  </div>
                </div>

                <div class="tab-content pt-2">
                  <div class="tab-pane fade show active smt2" id="smt2">
                    <!-- Vertical Form -->
                    {{-- <form class="row g-3" action="/nilai/store" method="post">
                      {{ csrf_field() }}
                      <div class="row">
                          <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="{{ $siswa->id }}">
                          <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Nama Siswa</label>
                                <div class="col-sm-9">
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
                                  <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $m->id }}" disabled>
                                  <input type="number" class="form-control nilai_rl" name="nilai_rl[]" value="" disabled>
                                </td>
                                <td><input type="number" class="form-control nilai_tp" name="nilai_tp[]" disabled></td>
                                <td>
                                  <input type="number" class="form-control nilai_as" name="nilai_as[]" disabled>
                                </td>
                                <td>
                                  <textarea name="ket[]" class="form-control ket" disabled></textarea>
                                </td>
                              </tr>
                            @endforeach
                            <tr>
                              <th colspan="6">Kelompok B</th>
                            </tr>
                            @foreach ($mapelb as $index => $mb)
                              <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $mb->nama_mapel }}</td>
                                <td>
                                  <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $mb->id }}" required>
                                  <input type="number" class="form-control nilai_rl" name="nilai_rl[]" value="" disabled>
                                </td>
                                <td><input type="number" class="form-control nilai_tp" name="nilai_tp[]" disabled></td>
                                <td>
                                  <input type="number" class="form-control nilai_as" name="nilai_as[]" disabled>
                                </td>
                                <td>
                                  <textarea name="ket[]" class="form-control ket" disabled></textarea>
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
                                <textarea class="form-control" style="height: 100px" name="catatan" disabled>{{ $nilai2->catatan }}</textarea>
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
                                    <input type="number" class="form-control" name="kehadiran_sakit" disabled value="{{ $nilai2->kehadiran_sakit }}">
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
                                      <input type="number" class="form-control" name="kehadiran_izin" disabled value="{{ $nilai2->kehadiran_izin }}">
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
                                    <input type="number" class="form-control" name="kehadiran_tanpa_ket" disabled value="{{ $nilai2->kehadiran_tanpa_ket }}">
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
                    </form><!-- Vertical Form --> --}}
                  </div>
                </div>
              </div>
            </div>
        </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

  
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        //HITUNG NAS OTOMATIS
        const nilaiRlInputs = document.querySelectorAll(".nilai_rl");
        const nilaiTpInputs = document.querySelectorAll(".nilai_tp");
        const nilaiAsInputs = document.querySelectorAll(".nilai_as");

        // Fungsi untuk menghitung nilai AS
        function hitungNilaiAs(rl, tp) {
            return (parseInt(rl) + parseInt(tp)) / 2;
        }

        // Tambahkan event listener untuk setiap input nilai RL dan TP
        nilaiRlInputs.forEach(function(input, index) {
            input.addEventListener("input", function() {
                const rlValue = this.value;
                const tpValue = nilaiTpInputs[index].value;
                nilaiAsInputs[index].value = hitungNilaiAs(rlValue, tpValue);
            });
        });

        nilaiTpInputs.forEach(function(input, index) {
            input.addEventListener("input", function() {
                const tpValue = this.value;
                const rlValue = nilaiRlInputs[index].value;
                nilaiAsInputs[index].value = hitungNilaiAs(rlValue, tpValue);
            });
        });

        //GET DATA NILAI MAPEL
        var detailNilai = {!! json_encode($detail_nilai1) !!}; // Ambil data detail nilai dari PHP dan konversi menjadi JavaScript array
        // Loop melalui setiap baris tabel
        var rows = document.querySelectorAll("tr");
        rows.forEach(function(row) {
            // Temukan elemen input dengan nama 'id_mapel[]' dalam setiap baris
            var idMapelInput = row.querySelector('input[name="id_mapel[]"]');
            
            // Periksa apakah elemen input ditemukan
            if (idMapelInput) {
                var idMapel = idMapelInput.value; // Ambil nilai dari elemen input
                
                // Cari nilai detail nilai yang cocok dengan id_mapel saat ini
                var matchingDetailNilai = detailNilai.find(function(detail) {
                    return detail.id_mapel == idMapel;
                });
                
                // Jika ditemukan nilai detail nilai yang cocok, atur nilai-nilai input
                if (matchingDetailNilai) {
                    row.querySelector('.nilai_rl').value = matchingDetailNilai.nilai_rl;
                    row.querySelector('.nilai_tp').value = matchingDetailNilai.nilai_tp;
                    row.querySelector('.nilai_as').value = matchingDetailNilai.nilai_as;
                    row.querySelector('.ket').value = matchingDetailNilai.ket;
                }
            }
        });
    });
</script>
    

</body>
</html>