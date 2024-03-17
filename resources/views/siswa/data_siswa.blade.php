<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Siswa</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Data Siswa</h5>
                  </div>
                  @if (Session::get('hak_akses')=='Admin')
                  <div class="col-md-3">
                    <a href="{{ url('siswa/tambah/') }}" class="btn btn-primary float-right" style="
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
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Angkatan</th>
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
        ajax: "{{ url('siswa/list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nisn', name: 'nisn'},
            {data: 'nama_siswa', name: 'nama_siswa'},
            {data: 'kel', name: 'kel'},
            {data: 'thn_angkatan', name: 'thn_angkatan'},
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
        ajax: "{{ url('siswa/list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nisn', name: 'nisn'},
            {data: 'nama_siswa', name: 'nama_siswa'},
            {data: 'kel', name: 'kel'},
            {data: 'thn_angkatan', name: 'thn_angkatan'},
        ]
    });
    
  });
</script>
@endif
</html>