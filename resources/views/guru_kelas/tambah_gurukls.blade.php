<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      @foreach ($kelas as $k)
        <h1>Kelas {{ $k->tingkat }}-{{ $k->kelas }}</h1>
      @endforeach
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Setting Guru</h5>
                  </div>
                </div>
                <!-- Vertical Form -->
                <form class="row g-3" action="/guru_kelas/store" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                    {{-- <div class="col-12">
                      <label for="id_mapel" class="form-label">Mata Pelajaran Umum</label>
                        @foreach ($mapel as $mp)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck{{ $mp->id }}" name="options[]" value="{{ $mp->id }}" data-mapel-checkbox>
                          <label class="form-check-label" for="gridCheck{{ $mp->id }}">
                            {{ $mp->nama_mapel }}
                          </label>
                        </div>
                        @endforeach
                    </div> --}}
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          {{-- <th scope="col">Pilih</th> --}}
                          <th scope="col">Mata Pelajaran</th>
                          <th scope="col">Guru Pengajar</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($mapels as $mapel)
                          <tr>
                              {{-- <td scope="row">
                                <input class="form-check-input checkbox" type="checkbox" data-select="selectBox{{ $mapel->id }}" id="gridCheck{{ $mapel->id }}" name="options[]" value="{{ $mapel->id }}">
                              </td> --}}
                              <td scope="row">{{ $mapel->nama_mapel }}</td>
                              <td scope="row">
                                <input type="hidden" value="{{ $mapel->id }}" name="id_mapel[]">
                                  <select class="form-select" aria-label="Default select example" required name="id_guru[]" id="selectBox{{ $mapel->id }}">
                                    <option value="">pilih guru</option>
                                    @if(isset($gurus[$mapel->id]))
                                        @foreach($gurus[$mapel->id] as $guru)
                                          <option value="{{ $guru->kode_guru }}">{{ $guru->nama_guru }}</option>
                                        @endforeach
                                    @endif
                                  </select>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
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
    // var checkboxes = document.querySelectorAll('.checkbox');

    // checkboxes.forEach(function(checkbox) {
    //     checkbox.addEventListener('change', function() {
    //         var selectId = this.getAttribute('data-select');
    //         var selectBox = document.getElementById(selectId);

    //         if (this.checked) {
    //             selectBox.disabled = false;
    //         } else {
    //             selectBox.disabled = true;
    //             selectBox.value = '';
    //         }
    //     });
    // });
</script>

</body>
</html>