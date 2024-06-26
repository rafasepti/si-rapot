<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Mata Pelajaran</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Tambah Mata Pelajaran</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="row g-3" action="/mapel/store" method="post">
                    {{ csrf_field() }}
                    <div class="col-12">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                    </div>
                    <div class="col-12">
                      <label for="kategori" class="form-label">Kategori</label>
                      <select class="form-select" aria-label="Default select example" required name="kategori" id="kategori">
                        <option value="" selected>Pilih Kategori</option>
                        <option value="1">1 Kelompok A</option>
                        <option value="2">2 Kelompok B</option>
                      </select>
                    </div>
                    <div class="col-12">
                        <label for="kkm" class="form-label">KKM</label>
                        <input type="number" class="form-control" id="kkm" name="kkm" required>
                    </div>
                    <div class="col-12">
                      <label for="ruang_lingkup" class="form-label">Ruang Lingkup Pembelajaran</label>
                      <textarea class="form-control" style="height: 100px" name="ruang_lingkup" required></textarea>
                    </div>
                    <div class="col-12">
                      <label for="tujuan_pembelajaran" class="form-label">Tujuan Pembelajaran</label>
                      <textarea class="form-control" style="height: 100px" name="tujuan_pembelajaran" required></textarea>
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

</body>
</html>