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
                    <h5 class="card-title">Detail Guru</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                @foreach ($guru as $m)
                <form class="row g-3" action="/guru/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $m->id }}">
                    <div class="col-12">
                      <label for="nuptk" class="form-label">NUPTK</label>
                      <input type="number" class="form-control" id="nuptk" name="nuptk" value="{{ $m->nuptk }}" required readonly>
                    </div>
                    <div class="col-12">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ $m->nama_guru }}" required readonly>
                    </div>
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $m->email }}" required readonly>
                    </div>
                    {{-- <div class="col-12">
                      <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                      <input type="text" class="form-control" id="id_mapel" name="id_mapel" value="{{ $m->nama_mapel }}" required readonly>
                    </div> --}}
                    <div class="col-12">
                      <label for="alamat_guru" class="form-label">Alamat</label>
                      <textarea class="form-control" style="height: 100px" name="alamat_guru" required readonly>{{ $m->alamat_guru }}</textarea>
                    </div>
                    <div class="col-12">
                      <label for="no_telp" class="form-label">No. Telpon</label>
                      <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $m->no_telp }}" required readonly>
                    </div>
                </form><!-- Vertical Form -->
                @endforeach
              </div>
            </div>
        </div><!-- End col-md -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Mata Pelajaran Yang Diajar</h5>
  
              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name Mata Pelajaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($gurum as $index => $gm)
                  <tr>
                    <th scope="row">{{ $index+1 }}</th>
                    <td>{{ $gm->nama_mapel }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
  
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

</body>
</html>