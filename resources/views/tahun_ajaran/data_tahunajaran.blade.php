<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tahun Ajaran</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Data Tahun Ajaran</h5>
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
            {data: 'mulai', name: 'mulai'},
            {data: 'selesai', name: 'selesai'},
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