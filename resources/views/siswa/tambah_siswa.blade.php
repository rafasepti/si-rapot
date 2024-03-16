<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Siswa</h1>
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
                            <button class="nav-link active" id="pills-siswa-tab" data-bs-toggle="pill" data-bs-target="#pills-siswa" type="button" role="tab" aria-controls="pills-siswa" aria-selected="true">Data Siswa</button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-wali-tab" data-bs-toggle="pill" data-bs-target="#pills-wali" type="button" role="tab" aria-controls="pills-wali" aria-selected="false">Data Wali</button>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                  <div class="tab-content pt-2" id="myTabContent">
                    <!-- Data Siswa -->
                    <div class="tab-pane fade show active" id="pills-siswa" role="tabpanel" aria-labelledby="siswa-tab">
                      <div class="row g-3">
                        {{-- {{ csrf_field() }} --}}
                        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                        <input type="hidden" class="form-control" id="kode_siswa" name="kode_siswa" value="{{ $kode_siswa }}" readonly required>
                        <div class="col-12">
                          <label for="nisn" class="form-label">NISN</label>
                          <input type="number" class="form-control" id="nisn" name="nisn" required>
                        </div>
                        <div class="col-12">
                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                        </div>
                        <div class="col-12">
                          <label for="id_kelas" class="form-label">Kelas</label>
                          <select class="form-select" aria-label="Default select example" required name="id_kelas" id="id_kelas">
                            <option value="" selected>Pilih Kelas</option>
                            @foreach ($kelas as $k)
                              <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->kelas }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="col-12">
                          <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                        </div>
                        <div class="col-12">
                          <label for="jk" class="form-label">Jenis Kelamin</label>
                          <select class="form-select" aria-label="Default select example" required name="jk" id="jk">
                            <option value="" selected>Pilih Jenis Kelamin</option>
                            <option>Laki-Laki</option>
                            <option>Perempuan</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="agama" class="form-label">Agama</label>
                          <select class="form-select" aria-label="Default select example" required name="agama" id="agama">
                            <option value="" selected>Pilih Agama</option>
                            <option>Islam</option>
                            <option>Kristen Protestan</option>
                            <option>Kristen Katolik</option>
                            <option>Hindu</option>
                            <option>Budha</option>
                            <option>Konghucu</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="pendidikan_sebelum" class="form-label">Pendidikan Sebelumnya</label>
                          <input type="text" class="form-control" id="pendidikan_sebelum" name="pendidikan_sebelum" required>
                        </div>
                        <div class="col-12">
                          <label for="alamat_siswa" class="form-label">Alamat</label>
                          <textarea class="form-control" style="height: 100px" name="alamat_siswa" id="agama" required></textarea>
                        </div>
                        <div class="col-12">
                          <label for="thn_angkatan" class="form-label">Tahun angkatan</label>
                          <input type="number" class="form-control" id="thn_angkatan" name="thn_angkatan" required>
                        </div>    
                        <div class="text-center">
                          <button type="submit" id="saveSiswa" class="btn btn-primary">Submit</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                      </div>
                    </div><!-- Data Siswa -->
                    <!-- Data Wali -->
                    <div class="tab-pane fade" id="pills-wali" role="tabpanel" aria-labelledby="wali-tab">
                      <form class="row g-3" action="/siswa/store" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="{{ $kode_siswa }}" readonly required>
                        <div class="col-12">
                          <label for="nama_wali" class="form-label">Nama Wali</label>
                          <input type="text" class="form-control" id="nama_wali" name="nama_wali" required>
                        </div>
                        <div class="col-12">
                          <label for="pekerjaan_wali" class="form-label">Pekerjaan</label>
                          <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" required>
                        </div>
                        <div class="col-12">
                          <label for="alamat_wali" class="form-label">Alamat</label>
                          <textarea class="form-control" style="height: 100px" name="alamat_wali" required></textarea>
                        </div>
                        <div class="col-12">
                          <label for="no_telp" class="form-label">No. Telp</label>
                          <input type="number" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                        <div class="col-12">
                          <label for="sebagai" class="form-label">Sebagai</label>
                          <select class="form-select" aria-label="Default select example" required name="sebagai">
                            <option>Ayah</option>
                            <option>Ibu</option>
                            <option>Wali</option>
                          </select>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                      </form>
                    </div><!-- Data Siswa -->
                  </div><!-- End Pills Tabs -->
                </div>
              </div>
          </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

  <script>
    $(document).ready(function() {
        $('#saveSiswa').on('click', function() {
          var kode_siswa = $('#kode_siswa').val();
          var nisn = $('#nisn').val();
          var id_kelas = $('#id_kelas').val();
          var nama_siswa = $('#nama_siswa').val();
          var tempat_lahir = $('#tempat_lahir').val();
          var tgl_lahir = $('#tgl_lahir').val();
          var jk = $('#jk').val();
          var agama = $('#agama').val();
          var pendidikan_sebelum = $('#pendidikan_sebelum').val();
          var alamat_siswa = $('#alamat_siswa').val();
          var thn_angkatan = $('#thn_angkatan').val();
          if(kode_siswa!="" && nisn!="" && id_kelas!="" && nama_siswa!=""){
            /*  $("#butsave").attr("disabled", "disabled"); */
              $.ajax({
                  url: "/siswa/store",
                  type: "POST",
                  data: {
                      _token: $("#csrf").val(),
                      type: 1,
                      "kode_siswa": kode_siswa,
                      "nisn": nisn,
                      "id_kelas": id_kelas,
                      "nama_siswa": nama_siswa,
                      "tempat_lahir": tempat_lahir,
                      "tgl_lahir": tgl_lahir,
                      "jk": jk,
                      "agama": agama,
                      "pendidikan_sebelum": pendidikan_sebelum,
                      "alamat_siswa": alamat_siswa,
                      "thn_angkatan": thn_angkatan
                  },
                  cache: false,
                  success: function(dataResult){
                      console.log(dataResult);
                      var dataResult = JSON.parse(dataResult);
                      if(dataResult.statusCode==200){
                        window.location = "/siswa/store";				
                      }
                      else if(dataResult.statusCode==201){
                         alert("Error occured !");
                      }
                      
                  }
              });
          }
          else{
              alert('Please fill all the field !');
          }
      });
    });
    </script>

</body>
</html>