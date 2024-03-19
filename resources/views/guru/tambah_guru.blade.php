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
                    <h5 class="card-title">Tambah Guru</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                <form class="row g-3" action="/guru/store" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="id_guru" name="id_guru" value="{{ $kode_guru }}" readonly required>
                    <div class="col-12">
                      <label for="nuptk" class="form-label">NUPTK</label>
                      <input type="number" class="form-control" id="nuptk" name="nuptk" required>
                    </div>
                    <div class="col-12">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                    </div>
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button class="input-group-text" type="button" id="show-password"><i class="bi bi-eye-fill"></i></button>
                      </div>
                      {{-- <button class="btn btn-outline-secondary" type="button" id="show-password">Lihat Password</button> --}}
                    </div>
                    {{-- <div class="col-12">
                      <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                      <select class="form-select" aria-label="Default select example" required name="id_mapel">
                        <option value="" selected>Pilih Mata Pelajaran</option>
                        @foreach ($mapel as $mp)
                          <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                        @endforeach
                      </select>
                    </div> --}}
                    <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheckW" name="walikelas" value="1">
                          <label class="form-check-label" for="gridCheckW">
                            Wali Kelas
                          </label>
                        </div>
                    </div>
                    <div class="col-12">
                      <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        @foreach ($mapel as $mp)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck{{ $mp->id }}" name="options[]" value="{{ $mp->id }}" data-mapel-checkbox>
                          <label class="form-check-label" for="gridCheck{{ $mp->id }}">
                            {{ $mp->nama_mapel }}
                          </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                      <label for="alamat_guru" class="form-label">Alamat</label>
                      <textarea class="form-control" style="height: 100px" name="alamat_guru" required></textarea>
                    </div>
                    <div class="col-12">
                      <label for="no_telp" class="form-label">No. Telpon</label>
                      <input type="number" class="form-control" id="no_telp" name="no_telp" required>
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
    document.getElementById('show-password').addEventListener('click', function() {
      var passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
      } else {
        passwordInput.type = 'password';
        this.innerHTML = '<i class="bi bi-eye-fill"></i>';
      }
    });

    // Temukan checkbox "Wali Kelas"
    var waliKelasCheckbox = document.getElementById('gridCheckW');

    // Tambahkan event listener untuk checkbox "Wali Kelas"
    waliKelasCheckbox.addEventListener('change', function() {
        // Dapatkan semua checkbox "Mapel"
        var mapelCheckboxes = document.querySelectorAll('[data-mapel-checkbox]');

        // Jika checkbox "Wali Kelas" dicentang
        if (this.checked) {
            // Nonaktifkan semua checkbox "Mapel"
            mapelCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = true;
                checkbox.checked = false;
                checkbox.value = "";
            });
        } else {
            // Aktifkan kembali semua checkbox "Mapel"
            mapelCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = false;
            });
        }
    });
  </script>

</body>
</html>