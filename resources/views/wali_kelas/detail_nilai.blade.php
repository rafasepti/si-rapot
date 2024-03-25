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
                    <div class="card-title">
                      <!-- Pills Tabs -->
                      <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-smt1-tab" data-bs-toggle="pill" data-bs-target="#pills-smt1" type="button" role="tab" aria-controls="pills-smt1" aria-selected="true">Semester 1</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-smt2-tab" data-bs-toggle="pill" data-bs-target="#pills-smt2" type="button" role="tab" aria-controls="pills-smt12" aria-selected="false">Semester 2</button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tab-content pt-2" id="myTabContent">
                  <div class="tab-pane fade show active" id="pills-smt1" role="tabpanel" aria-labelledby="smt1-tab">
                    <!-- Vertical Form -->
                    <div class="row">
                      <div class="col-md-10">
                        <h5 class="card-title">Nilai Siswa</h5>
                      </div>
                      <div class="col-md-2">
                        <a href="/print_nilai/smt1/{{ $siswa->id }}" class="btn btn-primary">
                          <i class="bi bi-printer me-1"></i>
                          Print
                        </a>
                      </div>
                    </div>
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

                        @if(!is_null($nilai1))
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

                        <div class="row">
                          <div class="col-sm-6">
                            <table class="table table-sm table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th class="col-sm-5" colspan="4">Kegiatan Ekstrakurikuler </th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th><span class="small">Nama Extrakurikuler</span></th>
                                  <th>:</th>
                                  <th class="text-center">
                                    <span class="small">Nilai</span>
                                  </th>
                                  <th class="text-center">
                                    <span class="small">Keterangan</span>
                                  </th>
                                </tr>
                                <tr>
                                  <td><span class="small">{{ $ekskul ? $ekskul->nama_ekskul : '-'; }}</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                    <span class="small">{{ $nilai1->nilai_eks }}</span>
                                  </td>
                                  <td class="text-center">
                                    <span class="small">{{ $nilai1->ket_eks }}</span>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-sm-6">
                            <table class="table table-sm table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th class="col-sm-5" colspan="3">Ketidakhadiran</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="col-md-2"><span class="small">Sakit</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <span class="small">{{ $nilai1->kehadiran_sakit }}</span>
                                      </div>
                                      <div class="col-md-4">
                                        <span class="small">Hari</span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="col-md-2"><span class="small">Izin</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <span class="small">{{ $nilai1->kehadiran_izin }}</span>
                                        </div>
                                        <div class="col-md-4">
                                          <span class="small">Hari</span>
                                        </div>
                                      </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="col-md-2"><span class="small">Tanpa Keterangan</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <span class="small">{{ $nilai1->kehadiran_tanpa_ket }}</span>
                                      </div>
                                      <div class="col-md-4">
                                        <span class="small">Hari</span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        @else
                        @endif
                      </div>
                    </form><!-- Vertical Form -->
                  </div>

                  <div class="tab-pane fade" id="pills-smt2" role="tabpanel" aria-labelledby="smt2-tab">
                    <!-- Vertical Form -->
                    @if (!is_null($nilai2))
                    <div class="row">
                      <div class="col-md-10">
                        <h5 class="card-title">Nilai Siswa</h5>
                      </div>
                      <div class="col-md-2">
                        <a href="/print_nilai/smt2/{{ $siswa->id }}" class="btn btn-primary">
                          <i class="bi bi-printer me-1"></i>
                          Print
                        </a>
                      </div>
                    </div>
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
                                  <input type="hidden" class="form-control" name="id_mapel2[]" value="{{ $m->id }}" disabled>
                                  <input type="number" class="form-control nilai_rl2" name="nilai_rl2[]" value="" disabled>
                                </td>
                                <td><input type="number" class="form-control nilai_tp2" name="nilai_tp2[]" disabled></td>
                                <td>
                                  <input type="number" class="form-control nilai_as2" name="nilai_as2[]" disabled>
                                </td>
                                <td>
                                  <textarea name="ket2[]" class="form-control ket2" disabled></textarea>
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
                                  <input type="hidden" class="form-control" name="id_mapel2[]" value="{{ $mb->id }}" required>
                                  <input type="number" class="form-control nilai_rl2" name="nilai_rl[]" value="" disabled>
                                </td>
                                <td><input type="number" class="form-control nilai_tp2" name="nilai_tp2[]" disabled></td>
                                <td>
                                  <input type="number" class="form-control nilai_as2" name="nilai_as2[]" disabled>
                                </td>
                                <td>
                                  <textarea name="ket2[]" class="form-control ket2" disabled></textarea>
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

                        <div class="row">
                          <div class="col-sm-6">
                            <table class="table table-sm table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th class="col-sm-5" colspan="4">Kegiatan Ekstrakurikuler </th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th><span class="small">Nama Extrakurikuler</span></th>
                                  <th>:</th>
                                  <th class="text-center">
                                    <span class="small">Nilai</span>
                                  </th>
                                  <th class="text-center">
                                    <span class="small">Keterangan</span>
                                  </th>
                                </tr>
                                <tr>
                                  <td><span class="small">{{ $ekskul ? $ekskul->nama_ekskul : '-'; }}</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                    <span class="small">{{ $nilai2->nilai_eks }}</span>
                                  </td>
                                  <td class="text-center">
                                    <span class="small">{{ $nilai2->ket_eks }}</span>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-sm-6">
                            <table class="table table-sm table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th class="col-sm-5" colspan="3">Ketidakhadiran</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="col-md-2"><span class="small">Sakit</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <span class="small">{{ $nilai2->kehadiran_sakit }}</span>
                                      </div>
                                      <div class="col-md-4">
                                        <span class="small">Hari</span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="col-md-2"><span class="small">Izin</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <span class="small">{{ $nilai2->kehadiran_izin }}</span>
                                        </div>
                                        <div class="col-md-4">
                                          <span class="small">Hari</span>
                                        </div>
                                      </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="col-md-2"><span class="small">Tanpa Keterangan</span></td>
                                  <td>:</td>
                                  <td class="text-center">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <span class="small">{{ $nilai2->kehadiran_tanpa_ket }}</span>
                                      </div>
                                      <div class="col-md-4">
                                        <span class="small">Hari</span>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </form><!-- Vertical Form -->
                    @else
                    @endif
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

        //GET DATA NILAI MAPEL SMT2
        var detailNilai2 = {!! json_encode($detail_nilai2) !!}; // Ambil data detail nilai dari PHP dan konversi menjadi JavaScript array
        // Loop melalui setiap baris tabel
        var rows2 = document.querySelectorAll("tr");
        rows2.forEach(function(row2) {
            // Temukan elemen input dengan nama 'id_mapel2[]' dalam setiap baris
            var idMapelInput2 = row2.querySelector('input[name="id_mapel2[]"]');
            
            // Periksa apakah elemen input ditemukan
            if (idMapelInput2) {
                var idMapel2 = idMapelInput2.value; // Ambil nilai dari elemen input
                
                // Cari nilai detail nilai yang cocok dengan id_mapel saat ini
                var matchingDetailNilai2 = detailNilai2.find(function(detail2) {
                    return detail2.id_mapel == idMapel2;
                });
                
                // Jika ditemukan nilai detail nilai yang cocok, atur nilai-nilai input
                if (matchingDetailNilai2) {
                    row2.querySelector('.nilai_rl2').value = matchingDetailNilai2.nilai_rl;
                    row2.querySelector('.nilai_tp2').value = matchingDetailNilai2.nilai_tp;
                    row2.querySelector('.nilai_as2').value = matchingDetailNilai2.nilai_as;
                    row2.querySelector('.ket2').value = matchingDetailNilai2.ket;
                }
            }
        });
    });
</script>
    

</body>
</html>