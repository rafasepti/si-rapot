<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Guru</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Edit Guru</h5>
                  </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Vertical Form -->
                @foreach ($guru as $m)
                <form class="row g-3" action="/guru/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $m->id }}">
                    <input type="hidden" name="kode_guru" value="{{ $m->kode_guru }}">
                    <div class="col-12">
                      <label for="nuptk" class="form-label">NUPTK</label>
                      <input type="number" class="form-control" id="nuptk" name="nuptk" value="{{ $m->nuptk }}" required>
                    </div>
                    <div class="col-12">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ $m->nama_guru }}" required>
                    </div>
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $m->email }}" required>
                    </div>
                    {{-- <div class="col-12">
                      <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                      <select class="form-select" aria-label="Default select example" required name="id_mapel">
                        <option value="" selected>Pilih Mata Pelajaran</option>
                        @foreach ($mapel as $mp)
                          <option value="{{ $mp->id }}" {{$mp->id == $m->id_mapel  ? 'selected' : ''}}>{{ $mp->nama_mapel }}</option>
                        @endforeach
                      </select>
                    </div> --}}
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheckW" name="walikelas" value="1" {{ $m->walikelas == "Ya" ? 'checked' : '' }}>
                        <label class="form-check-label" for="gridCheckW">
                          Wali Kelas
                        </label>
                      </div>
                  </div>
                    <div class="col-12">
                      <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        @foreach ($mapel as $mp)
                        <div class="form-check">
                          <input class="form-check-input" data-mapel-checkbox type="checkbox" id="gridCheck{{ $mp->id }}" name="options[]" value="{{ $mp->id }}" {{ in_array($mp->id, $gurum->pluck('id_mapel')->toArray()) ? 'checked' : '' }}>
                          <label class="form-check-label" for="gridCheck{{ $mp->id }}">
                            {{ $mp->nama_mapel }}
                          </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                      <label for="alamat_guru" class="form-label">Alamat</label>
                      <textarea class="form-control" style="height: 100px" name="alamat_guru" required>{{ $m->alamat_guru }}</textarea>
                    </div>
                    <div class="col-12">
                      <label for="no_telp" class="form-label">No. Telpon</label>
                      <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $m->no_telp }}" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- Vertical Form -->
                @endforeach
              </div>
            </div>
        </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

  <script>
    // Temukan checkbox "Wali Kelas"
    // Definisikan fungsi untuk mengatur status checkbox "Mapel"
    function setMapelCheckboxStatus() {
        // Dapatkan checkbox "Wali Kelas"
        var waliKelasCheckbox = document.getElementById('gridCheckW');
        
        // Dapatkan semua checkbox "Mapel"
        var mapelCheckboxes = document.querySelectorAll('[data-mapel-checkbox]');

        // Jika checkbox "Wali Kelas" dicentang
        if (waliKelasCheckbox.checked) {
            // Nonaktifkan semua checkbox "Mapel" dan atur nilai value menjadi kosong
            mapelCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = true;
                checkbox.checked = false;
            });
        } else {
            // Aktifkan kembali semua checkbox "Mapel"
            mapelCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = false;
            });
        }
    }

    // Panggil fungsi setMapelCheckboxStatus saat halaman dimuat
    window.addEventListener('load', setMapelCheckboxStatus);

    // Tambahkan event listener untuk checkbox "Wali Kelas"
    var waliKelasCheckbox = document.getElementById('gridCheckW');
    waliKelasCheckbox.addEventListener('change', setMapelCheckboxStatus);
  </script>

</body>
</html>