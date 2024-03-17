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
                    <h5 class="card-title">Edit Tahun Ajaran</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                @foreach ($thn as $t)
                <form class="row g-3" action="/tahunajaran/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ $t->id }}">
                    <div class="col-12">
                        <label for="nama_tahun" class="form-label">Nama Tahun</label>
                        <input type="text" class="form-control" id="nama_tahun" name="nama_tahun" required value="{{ $t->nama_tahun }}" placeholder=" cth : 2020/2021">
                    </div>
                    <div class="col-12">
                        <label for="mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="mulai" name="mulai" required value="{{ $t->mulai }}">
                    </div>
                    <div class="col-12">
                      <label for="selesai" class="form-label">Tanggal Selesai</label>
                      <input type="date" class="form-control" id="selesai" name="selesai" required value="{{ $t->selesai }}">
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

</body>
</html>