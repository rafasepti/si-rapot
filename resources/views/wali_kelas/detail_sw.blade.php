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
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Semester 2</button>
                          </li>
                        </ul>
                      </div>
                  </div>
                </div>
                <!-- Vertical Form -->
                <div class="tab-content pt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="pills-smt1" role="tabpanel" aria-labelledby="smt1-tab">
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
                                            <select class="form-select" aria-label="Default select example" id="selectMapel" required name="id_mapel">
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
                                            @foreach ($nilai1 as $index => $s)
                                            <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $s->nama_siswa }}</td>
                                            <td>
                                                <input type="hidden" class="form-control" name="id_siswa[]" value="{{ $s->ids }}" required>
                                                <input type="number" class="form-control nilai_rl" name="nilai_rl[]" value="{{ $nilai1[$index]->nilai_rl ?? '' }}" readonly>
                                            </td>
                                            <td><input type="number" class="form-control nilai_tp" name="nilai_tp[]" value="{{ $nilai1[$index]->nilai_tp ?? '' }}"  readonly></td>
                                            <td>
                                                <input type="number" class="form-control nilai_as" name="nilai_as[]" value="{{ $nilai1[$index]->nilai_as ?? '' }}" readonly>
                                            </td>
                                            <td>
                                                <textarea name="ket[]" class="form-control" readonly>{{ $nilai1[$index]->ket ?? '' }}</textarea>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                          </form><!-- Vertical Form -->
                    </div>
                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                          <input type="text" class="form-control" name="nama_kelas2" value="{{ $kelas->tingkat }}-{{ $kelas->kelas }}" disabled>
                                          <input type="hidden" class="form-control" name="id_kelas2" value="{{ $kelas->id }}">
                                      </div>
                                  </div>
                                  </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Thn Ajaran</label>
                                            <div class="col-sm-9">
                                            <input type="hidden" class="form-control" name="id_thn_ajaran2" value="{{ $thn_ajaran->id }}">
                                                <input type="text" class="form-control" name="thn_ajaran2" value="{{ $thn_ajaran->nama_tahun }}" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label col-form-label-sm">Mata Pelajaran</label>
                                            <div class="col-sm-9">
                                            <select class="form-select" aria-label="Default select example" id="selectMapel2" required name="id_mapel2">
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
                                            @foreach ($nilai2 as $index => $s)
                                            <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $s->nama_siswa }}</td>
                                            <td>
                                                <input type="hidden" class="form-control" name="id_siswa[]" value="{{ $s->ids }}" required>
                                                <input type="number" class="form-control nilai_rl2" name="nilai_rl2[]" value="{{ $nilai2[$index]->nilai_rl ?? '' }}" readonly>
                                            </td>
                                            <td><input type="number" class="form-control nilai_tp2" name="nilai_tp2[]" value="{{ $nilai2[$index]->nilai_tp ?? '' }}"  readonly></td>
                                            <td>
                                                <input type="number" class="form-control nilai_as2" name="nilai_as2[]" value="{{ $nilai2[$index]->nilai_as ?? '' }}" readonly>
                                            </td>
                                            <td>
                                                <textarea name="ket2[]" class="form-control" readonly>{{ $nilai2[$index]->ket ?? '' }}</textarea>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                          </form><!-- Vertical Form -->
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
    document.getElementById('selectMapel').addEventListener('change', function() {
      var selectedMapelId = this.value;
  
      // Kirim nilai yang dipilih ke kontroler menggunakan AJAX
      // Ganti URL sesuai dengan URL kontroler Anda
      fetch('/nilai/detail_sw/{id}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sesuaikan dengan token CSRF Anda
        },
        body: JSON.stringify({ id_mapel: selectedMapelId })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Lakukan sesuatu dengan respon dari kontroler jika diperlukan
        console.log(data);
      })
      .catch(error => {
        console.error('There was an error!', error);
      });
    });
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