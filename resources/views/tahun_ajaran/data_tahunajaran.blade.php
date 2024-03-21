<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tahun Ajaran</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    @if($thn_aktif != "")
                      <h5 class="card-title">Tahun Ajaran Aktif : {{ $thn_aktif->nama_tahun }}</h5>
                    @else
                      <h5 class="card-title">Tahun Ajaran Aktif : </h5>
                    @endif
                  </div>
                  <div class="col-md-3">
                    <a href="{{ url('tahunajaran/tambah/') }}" class="btn btn-primary float-right" style="
                      margin-top: 15px; margin-left: 52px;">
                      <i class="bi bi-plus"></i> Tambah Data
                    </a>
                  </div>
                </div>
                <!-- Table with stripped rows -->
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Tahun</th>
                      <th>Mulai</th>
                      <th>Selesai</th>
                      <th>Aksi</th>
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
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('tahunajaran/list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_tahun', name: 'nama_tahun'},
            {
              data: 'mulai', 
              name: 'mulai',
              render: function(data) {
                  return moment(data).format('DD/M/YYYY'); // Mengubah format tanggal menggunakan moment.js
              }
            },
            {
              data: 'selesai', 
              name: 'selesai',
              render: function(data) {
                  return moment(data).format('DD/M/YYYY'); // Mengubah format tanggal menggunakan moment.js
              }},
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
</html>