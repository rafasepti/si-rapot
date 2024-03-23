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
                    <h5 class="card-title">Detail Mata Pelajaran</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                @foreach ($mapel as $m)
                <form class="row g-3" action="/mapel/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $m->id }}">
                    <div class="col-12">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="{{ $m->nama_mapel }}" required readonly>
                    </div>
                    <div class="col-12">
                      <label for="tingkat" class="form-label">Kategori</label>
                      <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $m->kategori }} {{ $m->kategori == 1 ? 'Kelompok A' : 'Kelompok B' }}" required readonly>
                    </div>
                    <div class="col-12">
                        <label for="kkm" class="form-label">KKM</label>
                        <input type="number" class="form-control" id="kkm" name="kkm" value="{{ $m->kkm }}" required readonly>
                    </div>
                    <div class="col-12">
                      <label for="ruang_lingkup" class="form-label">Ruang Lingkup Pembelajaran</label>
                      <textarea class="form-control" style="height: 100px" name="ruang_lingkup" required readonly>{{ $m->ruang_lingkup }}</textarea>
                    </div>
                    <div class="col-12">
                      <label for="tujuan_pembelajaran" class="form-label">Tujuan Pembelajaran</label>
                      <textarea class="form-control" style="height: 100px" name="tujuan_pembelajaran" required readonly>{{ $m->tujuan_pembelajaran }}</textarea>
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