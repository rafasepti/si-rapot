<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Siswa</h1>
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
                      <div class="alert alert-info alert-dismissible fade show" id="message" role="alert">
                      
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @foreach ($siswa as $s)
                      <form class="row g-3" action="{{ url('siswa/update') }}" method="post" id="form1">
                        @csrf
                        <input type="hidden" class="form-control" id="kode_siswa" name="kode_siswa" value="{{ $s->kode_siswa }}" readonly required>
                        <div class="col-12">
                          <label for="nisn" class="form-label">NISN</label>
                          <input type="number" class="form-control" id="nisn" name="nisn" required value="{{ $s->nisn }}">
                        </div>
                        <div class="col-12">
                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required value="{{ $s->nama_siswa }}">
                        </div>
                        <div class="col-12">
                          <label for="id_kelas" class="form-label">Kelas</label>
                          <select class="form-select" aria-label="Default select example" required name="id_kelas" id="id_kelas">
                            <option value="" selected>Pilih Kelas</option>
                            @foreach ($kelas as $k)
                              <option value="{{ $k->id }}" {{$k->id == $s->id_kelas  ? 'selected' : ''}}>{{ $k->tingkat }} - {{ $k->kelas }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required value="{{ $s->tempat_lahir }}">
                        </div>
                        <div class="col-12">
                          <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required value="{{ $s->tgl_lahir }}">
                        </div>
                        <div class="col-12">
                          <label for="jk" class="form-label">Jenis Kelamin</label>
                          <select class="form-select" aria-label="Default select example" required name="jk" id="jk">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option {{$s->jk == 'Laki-Laki'  ? 'selected' : ''}}>Laki-Laki</option>
                            <option {{$s->jk == 'Perempuan'  ? 'selected' : ''}}>Perempuan</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="agama" class="form-label">Agama</label>
                          <select class="form-select" aria-label="Default select example" required name="agama" id="agama">
                            <option value="">Pilih Agama</option>
                            <option {{$s->agama == "Islam"  ? 'selected' : ''}}>Islam</option>
                            <option {{$s->agama == "Kristen Protestan"  ? 'selected' : ''}}>Kristen Protestan</option>
                            <option {{$s->agama == "Kristen Katolik"  ? 'selected' : ''}}>Kristen Katolik</option>
                            <option {{$s->agama == "Hindu"  ? 'selected' : ''}}>Hindu</option>
                            <option {{$s->agama == "Budha"  ? 'selected' : ''}}>Budha</option>
                            <option {{$s->agama == "Konghucu"  ? 'selected' : ''}}>Konghucu</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="pendidikan_sebelum" class="form-label">Pendidikan Sebelumnya</label>
                          <input type="text" class="form-control" id="pendidikan_sebelum" name="pendidikan_sebelum" required value="{{ $s->pendidikan_sebelum }}">
                        </div>
                        <div class="col-12">
                          <label for="alamat_siswa" class="form-label">Alamat</label>
                          <textarea class="form-control" style="height: 100px" name="alamat_siswa" id="alamat_siswa" required>{{ $s->alamat_siswa }}</textarea>
                        </div>
                        <div class="col-12">
                          <label for="thn_angkatan" class="form-label">Tahun angkatan</label>
                          <input type="number" class="form-control" id="thn_angkatan" name="thn_angkatan" required value="{{ $s->thn_angkatan }}">
                        </div>
                        <div class="col-12">
                          <label for="id_ekskul" class="form-label">Ekstrakurikuler</label>
                          <select class="form-select" aria-label="Default select example" required name="id_ekskul" id="id_ekskul">
                            <option value="" selected>Pilih Ekskul</option>
                            @foreach ($ekskul as $e)
                              <option value="{{ $e->id }}"  {{$e->id == $s->id_ekskul  ? 'selected' : ''}}>{{ $e->nama_ekskul }}</option>
                            @endforeach
                          </select>
                        </div>     
                        <div class="text-center">
                          <button type="submit" id="saveSiswa" class="btn btn-primary">Submit</button>
                          <button type="reset" id="resetSiswa" class="btn btn-secondary">Reset</button>
                        </div>
                      </form>
                      @endforeach
                    </div><!-- Data Siswa -->
                    <!-- Data Wali -->
                    <div class="tab-pane fade" id="pills-wali" role="tabpanel" aria-labelledby="wali-tab">
                      <div class="alert alert-info alert-dismissible fade show" id="message2" role="alert">
                      
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <form class="row g-3" action="{{ url('siswa/update') }}" method="post" id="form2">
                        @csrf
                        @if ($countWali >= 1)
                          @foreach ($wali as $w)
                          <input type="hidden" id="tipe" name="tipe" value="update">
                          <input type="hidden" id="id_wali" name="id_wali" value="{{ $w->id }}">
                          <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="{{ $w->id_siswa }}">
                          <div class="col-12">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" required value="{{ $w->nama_wali }}">
                          </div>
                          <div class="col-12">
                            <label for="pekerjaan_wali" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" required value="{{ $w->pekerjaan_wali }}">
                          </div>
                          <div class="col-12">
                            <label for="alamat_wali" class="form-label">Alamat</label>
                            <textarea class="form-control" style="height: 100px" name="alamat_wali" required>{{ $w->alamat_wali }}</textarea>
                          </div>
                          <div class="col-12">
                            <label for="no_telp" class="form-label">No. Telp</label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp" required value="{{ $w->no_telp }}">
                          </div>
                          <div class="col-12">
                            <label for="sebagai" class="form-label">Sebagai</label>
                            <select class="form-select" aria-label="Default select example" required name="sebagai">
                              <option {{$w->sebagai == "Ayah"  ? 'selected' : ''}}>Ayah</option>
                              <option {{$w->sebagai == "Ibu"  ? 'selected' : ''}}>Ibu</option>
                              <option {{$w->sebagai == "Wali"  ? 'selected' : ''}}>Wali</option>
                            </select>
                          </div>
                          @endforeach
                        @else
                          <input type="hidden" id="id_siswa" name="id_siswa" value="{{ $kode_siswa }}">
                          <input type="hidden" id="tipe" name="tipe" value="tambah">
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
                        @endif
                        <div class="text-center">
                          <button type="submit" id="saveWali" class="btn btn-primary">Submit</button>
                          <button type="reset" id="resetWali" class="btn btn-secondary">Reset</button>
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

  <script type="text/javascript">
    $(document).ready(function(){
      $('#message').hide();
      $('#message2').hide();

      //SISWA
      $('#form1').on('submit', function(event){
        event.preventDefault();

        $("#saveSiswa").attr("disabled", "disabled");
        $("#resetSiswa").attr("disabled", "disabled");
        jQuery.ajax({
          url:"{{ url('siswa/update') }}",
          data: jQuery('#form1').serialize(),
          type: 'post',

          success:function(result)
          {
            $('#message').show();
            $('#message').css('display','block');
            jQuery('#message').html(result.message);
          }
        })
      });

      //WALI
      $('#form2').on('submit', function(event){
        event.preventDefault();

        $("#saveWali").attr("disabled", "disabled");
        $("#resetWali").attr("disabled", "disabled");
        jQuery.ajax({
          url:"{{ url('siswa/update') }}",
          data: jQuery('#form2').serialize(),
          type: 'post',

          success:function(result)
          {
            $('#message2').show();
            $('#message2').css('display','block');
            jQuery('#message2').html(result.message);
          }
        })
      });
    });
  </script>
</body>
</html>