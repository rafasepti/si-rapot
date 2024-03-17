<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tahun Ajaran</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Tambah Tahun Ajaran</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                <form class="row g-3" action="/tahunajaran/store" method="post">
                    {{ csrf_field() }}
                    <div class="col-12">
                        <label for="nama_tahun" class="form-label">Nama Tahun</label>
                        <input type="text" class="form-control" id="nama_tahun" name="nama_tahun" required placeholder=" cth : 2020/2021">
                    </div>
                    <div class="col-12">
                        <label for="mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="mulai" name="mulai" required>
                    </div>
                    <div class="col-12">
                      <label for="selesai" class="form-label">Tanggal Selesai</label>
                      <input type="date" class="form-control" id="selesai" name="selesai" required>
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