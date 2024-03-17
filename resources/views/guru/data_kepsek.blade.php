<!DOCTYPE html>
<html lang="en">
  
<body>
  @include('dynamic/v_header');
  @include('dynamic/v_sidebar');
  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Kepala Sekolah</h1>
    </div><!-- End Page Title -->
  
      <section class="section profile">
        <div class="row">
          <div class="col-xl-12">
  
            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
  
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>
  
                </ul>
                <div class="tab-content pt-2">
  
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profile Details</h5>
  
                    <form>
                        <div class="row mb-3">
                          <label for="nuptk" class="col-md-4 col-lg-3 col-form-label">NUPTK</label>
                          <div class="col-md-8 col-lg-9">
                              <input type="number" class="form-control" id="nuptk" name="nuptk" readonly>
                          </div>
                        </div>
    
                        <div class="row mb-3">
                          <label for="nama_guru" class="col-md-4 col-lg-3 col-form-label">Nama Kepala Sekolah</label>
                          <div class="col-md-8 col-lg-9">
                              <input type="text" class="form-control" id="nama_guru" name="nama_guru" readonly>
                          </div>
                        </div>
    
                        <div class="row mb-3">
                          <label for="alamat_guru" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                          <div class="col-md-8 col-lg-9">
                              <textarea class="form-control" style="height: 100px" name="alamat_guru" readonly></textarea>
                          </div>
                        </div>
    
                        <div class="row mb-3">
                          <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">No. Telpon</label>
                          <div class="col-md-8 col-lg-9">
                              <input type="number" class="form-control" id="no_telp" name="no_telp" readonly>
                          </div>
                        </div>
                      </form><!-- End Profile Edit Form -->
  
                  </div>
  
                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <div class="alert alert-info alert-dismissible fade show" id="message" role="alert">
                      
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
  
                    <!-- Profile Edit Form -->
                    <form action="{{ url('kepsek') }}" method="post" id="form1">
                      <div class="row mb-3">
                        <label for="nuptk" class="col-md-4 col-lg-3 col-form-label">NUPTK</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="number" class="form-control" id="nuptk" name="nuptk" required>
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="nama_guru" class="col-md-4 col-lg-3 col-form-label">Nama Kepala Sekolah</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="alamat_guru" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea class="form-control" style="height: 100px" name="alamat_guru" required></textarea>
                        </div>
                      </div>
  
                      <div class="row mb-3">
                        <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">No. Telpon</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="number" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                      </div>
  
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form><!-- End Profile Edit Form -->
  
                  </div>
  
                </div><!-- End Bordered Tabs -->
  
              </div>
            </div>
  
          </div>
        </div>
      </section>   
  </main><!-- End #main -->

  @include('dynamic/v_footer');

  <script type="text/javascript">
    $(document).ready(function(){
      $('#message').hide();

      //SISWA
      $('#form1').on('submit', function(event){
        event.preventDefault();
        jQuery.ajax({
          url:"{{ url('kepsek') }}",
          data: jQuery('#form1').serialize(),
          type: 'post',

          success:function(result)
          {
            $('#message').show();
            $('#message').css('display','block');
            jQuery('#message').html(result.message);
          }
        })
      });
    });
  </script>

</body>
</html>