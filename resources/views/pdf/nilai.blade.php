<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="{{asset('template')}}/assets/img/favicon.png" rel="icon">
    <link href="{{asset('template')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    {{-- datatables --}}
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="{{asset('template')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('template')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('template')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('template')}}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{asset('template')}}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{asset('template')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{asset('template')}}/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="{{asset('template')}}/assets/css/style.css" rel="stylesheet">
  </head>
<body>
  <main>

    <div class="pagetitle">
    </div><!-- End Page Title -->

    <section class="">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <div class="card-title text-center mb-3">
                        Raport Siswa
                    </div>
                  </div>
                </div>
                    <!-- Vertical Form -->
                    <form class="row g-3" action="/nilai/store" method="post">
                      {{ csrf_field() }}
                      <div class="row">
                          <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="{{ $siswa->id }}">
                          <div class="col-sm-6">
                            <div class="row mb-1">
                                <label for="inputText" class="col-sm-4 col-form-label col-form-label-sm">Nama Siswa</label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7">
                                  {{ $siswa->nama_siswa }}
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="inputText" class="col-sm-4 col-form-label col-form-label-sm">NISN</label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7">
                                  {{ $siswa->nisn }}
                                </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="row mb-1">
                                <label for="inputText" class="col-sm-4 col-form-label col-form-label-sm">Kelas</label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7">
                                    {{ $siswa->kel }}
                                    <input type="hidden" class="form-control" name="id_kelas" id="id_kelas" value="{{ $siswa->id_kelas }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label for="inputText" class="col-sm-4 col-form-label col-form-label-sm">Thn Ajaran</label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7">
                                    {{ $thn_ajaran->nama_tahun }}
                                </div>
                            </div>
                            <div class="row mb-1">
                              <label for="inputText" class="col-sm-4 col-form-label col-form-label-sm">Semester</label>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7">
                                  1
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="mb-1"></div>
                      <div class="row">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="col-sm-1 text-center">No.</th>
                              <th class="col-sm-4 text-center">Mata Pelajaran</th>
                              <th class="col-sm-2 text-center">NAS</th>
                              <th class="col-sm-5 text-center">Keterangan</th>
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
                                <td class="text-center">
                                  <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $m->id }}" required>
                                  <input type="number" class="form-control nilai_akhir" name="nilai_akhir[]" value="" disabled>
                                </td>
                                <td>
                                  <textarea name="ket[]" class="form-control ket" disabled></textarea>
                                </td>
                              </tr>
                            @endforeach
                      </table>
                      <table class="table table-striped table-bordered">
                            <tr>
                              <th colspan="6">Kelompok B</th>
                            </tr>
                            @foreach ($mapelb as $index => $mb)
                              <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $mb->nama_mapel }}</td>
                                <td>
                                  <input type="hidden" class="form-control" name="id_mapel[]" value="{{ $mb->id }}" required>
                                  <input type="number" class="form-control nilai_akhir" name="nilai_akhir[]" value="" disabled>
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
                              <td class="col-sm-5">
                                {{ $nilai1->catatan }}
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
                                  <td class="col-sm-2"><span class="small">Sakit</span></td>
                                  <td>:</td>
                                  <td>
                                    <span class="small">{{ $nilai1->kehadiran_sakit }}&nbsp;Hari</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="col-sm-2"><span class="small">Izin</span></td>
                                  <td>:</td>
                                  <td>
                                    <span class="small">{{ $nilai1->kehadiran_izin }}&nbsp;Hari</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="col-sm-2"><span class="small">Tanpa Keterangan</span></td>
                                  <td>:</td>
                                  <td>
                                    <span class="small">{{ $nilai1->kehadiran_tanpa_ket }}&nbsp;Hari</span>
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
                      <div class="row">
                          <div class="col-sm-6">
                              <p class="mt-4" style="margin-bottom: 80px;">Orang Tua/Wali,</p>
                              <p>(________________________)</p>
                          </div>
                          <div class="col-sm-6 ms-auto text-end">
                              <p class="mb-1">{{ date('d M Y') }}</p>
                              <p style="margin-bottom: 80px;">Wali Kelas,</p>
                              <p class="mb-0">{{ Session::get('nama') }}</p>
                              <p class="mt-0">NIP. {{ Session::get('nuptk') }}</p>
                          </div>
                      </div>
            </div>
        </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  
  {{-- datatables --}}
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('template')}}/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{asset('template')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('template')}}/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="{{asset('template')}}/assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{asset('template')}}/assets/vendor/quill/quill.min.js"></script>
  <script src="{{asset('template')}}/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{asset('template')}}/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{asset('template')}}/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


  <!-- Template Main JS File -->
  <script src="{{asset('template')}}/assets/js/main.js"></script>

  
  <script>
    window.onload = function() {
        window.print();
    }

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
                  var nilaiAkhirInput = row.querySelector('.nilai_akhir');
                  var nilaiKetInput = row.querySelector('.ket');
                  if (nilaiAkhirInput) {
                      var nilaiAkhirValue = matchingDetailNilai.nilai_akhir;
                      var nilaiKetValue = matchingDetailNilai.ket;
                      nilaiAkhirInput.outerHTML = '<p class="nilai_akhir">' + nilaiAkhirValue + '</p>';
                      nilaiKetInput.outerHTML = '<p class="ket">' + nilaiKetValue + '</p>';
                  }
                    row.querySelector('.nilai_akhir').value = matchingDetailNilai.nilai_akhir;
                    row.querySelector('.ket').value = matchingDetailNilai.ket;
                }
            }
        });
    });

   
</script>
    

</body>
</html>