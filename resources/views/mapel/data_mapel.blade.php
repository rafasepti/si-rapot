<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Mata Pelajaran</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <h5 class="card-title">Data Mata Pelajaran</h5>
                  </div>
                  <div class="col-md-3">
                    <a href="{{ url('mapel/tambah/') }}" class="btn btn-primary float-right" style="
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
                      <th>Nama Mapel</th>
                      <th>KKM</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- <tr>
                      <td>Unity Pugh</td>
                      <td>9958</td>
                      <td>Curicó</td>
                      <td style="text-align: center">
                        <a href="/siswa/edit/" class="btn btn-outline-success">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/siswa/hapus/" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin?')">
                          <i class="bi bi-trash-fill"></i>
                        </a>
                      </td>
                    </tr> --}}
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
        ajax: "{{ url('mapel/list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_mapel', name: 'nama_mapel'},
            {data: 'kkm', name: 'kkm'},
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