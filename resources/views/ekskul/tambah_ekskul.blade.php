<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Extrakurikuler</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Tambah Extrakurikuler</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                <form class="row g-3" action="/ekskul/store" method="post">
                    {{ csrf_field() }}
                    <div class="col-12">
                        <label for="nama_ekskul" class="form-label">Nama Extrakurikuler</label>
                        <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul" required>
                    </div>
                    <div class="col-12">
                      <label for="id_guru" class="form-label">Guru</label>
                      <select class="form-select" aria-label="Default select example" required name="id_guru">
                        <option value="" selected>Pilih Guru</option>
                        @foreach ($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->nuptk }} || {{ $g->nama_guru }}</option>
                        @endforeach
                      </select>
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