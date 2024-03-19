<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Kelas</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Tambah Kelas</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                <form class="row g-3" action="/kelas/store" method="post">
                    {{ csrf_field() }}
                    <div class="col-12">
                      <label for="tingkat" class="form-label">Tingkat</label>
                      <input type="number" class="form-control" id="tingkat" name="tingkat" required>
                    </div>
                    <div class="col-12">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                    </div>
                    <div class="col-12">
                      <label for="id_walikelas" class="form-label">Wali Kelas</label>
                      <select class="form-select" aria-label="Default select example" required name="id_walikelas">
                        <option value="" selected>Pilih Wali Kelas</option>
                        @foreach ($guruBelumWaliKelas as $g)
                        <option value="{{ $g->id }}">{{ $g->nuptk }} || {{ $g->nama_guru }}</option>
                        @endforeach
                        {{-- @foreach ($guru as $mp)
                          <option value="{{ $mp->id }}">{{ $mp->nuptk }} || {{ $mp->nama_guru }}</option>
                        @endforeach --}}
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