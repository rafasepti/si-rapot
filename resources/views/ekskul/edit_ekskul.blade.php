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
                    <h5 class="card-title">Edit Extrakurikuler</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                @foreach ($ekskul as $t)
                <form class="row g-3" action="/ekskul/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ $t->id }}">
                    <div class="col-12">
                        <label for="nama_ekskul" class="form-label">Nama Tahun</label>
                        <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul" required value="{{ $t->nama_ekskul }}" placeholder=" cth : 2020/2021">
                    </div>
                    <div class="col-12">
                      <label for="id_guru" class="form-label">Guru</label>
                      <select class="form-select" aria-label="Default select example" required name="id_guru">
                        <option value="" selected>Pilih Guru</option>
                        @foreach ($guru as $g)
                        <option value="{{ $g->id }}" {{$g->id == $t->id_guru  ? 'selected' : ''}}>{{ $g->nuptk }} || {{ $g->nama_guru }}</option>
                        @endforeach
                      </select>
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