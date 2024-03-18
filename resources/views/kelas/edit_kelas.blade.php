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
                    <h5 class="card-title">Edit Kelas</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                @foreach ($kelas as $m)
                    
                @endforeach
                <form class="row g-3" action="/kelas/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $m->id }}">
                    <div class="col-12">
                      <label for="tingkat" class="form-label">Tingkat</label>
                      <input type="number" class="form-control" id="tingkat" name="tingkat" value="{{ $m->tingkat }}" required>
                    </div>
                    <div class="col-12">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $m->kelas }}" required>
                    </div>
                    <div class="col-12">
                      <label for="id_walikelas" class="form-label">Wali Kelas</label>
                      <select class="form-select" aria-label="Default select example" required name="id_walikelas">
                        <option value="" selected>Pilih Wali kelas</option>
                        @foreach ($guru as $g)
                            @if (optional($waliKelasSaatIni)->is($g))
                            <option value="{{ $g->id }}" {{$g->id == $m->id_walikelas  ? 'selected' : ''}}>
                              {{ $g->nuptk }} || {{ $g->nama_guru }}
                            </option>
                            @endif
                        @endforeach
                        {{-- @foreach ($guru as $g)
                          <option value="{{ $g->id }}" {{$g->id == $m->id_walikelas  ? 'selected' : ''}}>{{ $g->nuptk }} || {{ $g->nama_guru }}</option>
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