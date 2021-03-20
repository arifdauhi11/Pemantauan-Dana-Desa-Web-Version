  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aktivasi Pengguna
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('auth'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Aktivasi Pengguna</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="col-md4">
    <?php        
        if ($this->session->flashdata('status')) { 
          echo '<div id="myalert">' . $this->session->flashdata('status') . '</div>'; // Tampilkan pesannya
        }
    ?>
    <?php        
        if ($this->session->flashdata('hapus')) { 
          echo '<div id="myalert">' . $this->session->flashdata('hapus') . '</div>'; // Tampilkan pesannya
        }
    ?>  
    </div>
      <div class="row">
        <div class="col-md-9">
          <div class="box">            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>NIK</th>
                  <th>Nama</th>                  
                  <th>Role</th>
                  <th>Status</th>                
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($auser as $u){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $u->nik ?></td>
                    <td><?php echo $u->nama ?></td>
                    <td><?php echo $u->role ?></td>
                    <td>
                      <?php 
                        if ($u->id_role != 1) {?>
                      <?php 
                        $status = $u->is_active;
                        if ($status == 1) {?>
                          <a href="<?php echo base_url('user/updateStatus/'.'?sid='.$u->id_pengguna.'&sval='.$u->is_active); ?>" class="btn btn-sm btn-success ajax"><i class="fa fa-check"></i> Aktif </a> 
                        <?php } else { ?>
                          <a href="<?php echo base_url('user/updateStatus/'.'?sid='.$u->id_pengguna.'&sval='.$u->is_active); ?>" class="btn btn-sm btn-default ajax"> <i class="fa fa-close"></i> Tidak Aktif </a> 
                        <?php } ?>                            
                      <?php }else{?>
                          <?php 
                        $status = $u->is_active;
                        if ($status == 1) {?>
                          <button href="<?php echo base_url('user/updateStatus/'.'?sid='.$u->id_pengguna.'&sval='.$u->is_active); ?>" class="btn btn-sm btn-success ajax" disabled><i class="fa fa-check"></i> Aktif </button> 
                        <?php } else { ?>
                          <button href="<?php echo base_url('user/updateStatus/'.'?sid='.$u->id_pengguna.'&sval='.$u->is_active); ?>" class="btn btn-sm btn-default ajax" disabled> <i class="fa fa-close"></i> Tidak Aktif </button> 
                        <?php } ?>
                      <?php } ?>
                                            
                    </td>
                    <td>
                        <!-- <a href="<?php echo base_url('user/edit/'.$u->nik); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit </a> -->
                        <?php 
                          if ($u->id_role == 1) {?>
                            <button href="<?php echo base_url('user/hapus/'.'?nik='.$u->nik); ?>" class="btn btn-sm btn-danger ajax" disabled><i class="fa fa-trash"></i> Hapus</button>
                        <?php }else{?>    
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $u->nik ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        <?php } ?>
                        </td>                      
                    </tr>
                    <?php } ?>                    
                  </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('user/tambah') ?>" method="post">
                <!-- text input -->
                <div class="text-center form-group">
                <small class="text-danger pl-3">password default = pdd123</small>                  
                </div>
                <div class="form-group">
                  <label>NIK</label>
                  <input type="number" name="nik" class="form-control" placeholder="Masukkan NIK Pengguna" value="<?= set_value('nik');?>">
                  <?= form_error('nik', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>
                <div class="form-group">
                  <label>Nama Pengguna</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Pengguna" value="<?= set_value('nama');?>">
                  <?= form_error('nama', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>
                <div class="form-group">                  
                  <label>Role</label>
                  <select class="form-control" id="role" name="role">
                    <?php 
                    $no = 1;
                    foreach ($role as $r) {
                    ?>
                    <option value="<?php echo $r->id; ?>"><?php echo $r->role; ?></option>                    
                    <?php } ?>
                  </select>                  
                </div>
                <button type="submit" class="btn btn-primary">Submit
                </button>
              </form>
            </div>  
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  
  function cek() {
    if ($('#role').val() !== "3") {
    $('#example1').hide();
    }else{
      
    }
  }
  function deleteUser(nik) {
    // hapus data dari database dengan ajax
    if (confirm('Anda yakin akan menghapus data ini?')) {
      $.ajax({
      url: "<?php echo site_url('user/deleteUser/') ;?>/"+nik,
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal menghapus data!');
      }
    });
    }
  }
  
  $(function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  $('#mystatus').delay('slow').slideDown('slow').delay(4100).slideUp(600);
  $(function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  $('#hapus').delay('slow').slideDown('slow').delay(4100).slideUp(600);
</script>