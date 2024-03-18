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
                    <h5 class="card-title">Data Guru</h5>
                  </div>
                  @if (Session::get('hak_akses')=='Admin')
                  <div class="col-md-3">
                    <a href="{{ url('guru/tambah/') }}" class="btn btn-primary float-right" style="
                      margin-top: 15px; margin-left: 52px;">
                      <i class="bi bi-plus"></i> Tambah Data
                    </a>
                  </div>
                  @endif
                </div>
                <!-- Table with stripped rows -->
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>NUPTK</th>
                      <th>Nama</th>
                      {{-- <th>Mapel</th> --}}
                      @if (Session::get('hak_akses')=='Admin')
                      <th>Aksi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </div>
        </div><!-- End col-md -->
      </div>
    </section>

  </main><!-- End #main -->

  @include('dynamic/v_footer');

</body>
@if (Session::get('hak_akses')=='Admin')
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('guru/list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nuptk', name: 'nuptk'},
            {data: 'nama_guru', name: 'nama_guru'},
            //{data: 'nama_mapel', name: 'nama_mapel'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
@else
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('guru/list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nuptk', name: 'nuptk'},
            {data: 'nama_guru', name: 'nama_guru'},
            {data: 'nama_mapel', name: 'nama_mapel'},
        ]
    });
    
  });
</script>
@endif

</html>