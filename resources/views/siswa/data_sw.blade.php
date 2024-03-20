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
                    @if ($siswa_kel != "")
                        <h5 class="card-title">Data Siswa Kelas {{ $siswa_kel->tingkat }}-{{ $siswa_kel->kelas }}</h5>           
                    @else
                        <h5 class="card-title">Data Siswa Kelas -</h5>           
                    @endif
                  </div>
                </div>
                <!-- Table with stripped rows -->
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Angkatan</th>
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
        ajax: {
          url: "{{ url('kelaswali/list') }}",
          data: function (d) {
            d.id_kelas = $('#id_kelas').val();
          }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nisn', name: 'nisn'},
            {data: 'nama_siswa', name: 'nama_siswa'},
            {data: 'thn_angkatan', name: 'thn_angkatan'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });

    $('#id_kelas').change(function() {
      table.draw();
    });
    
  });
</script>
</html>