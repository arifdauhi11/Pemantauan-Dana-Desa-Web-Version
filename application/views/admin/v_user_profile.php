  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1136px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil Pengguna
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user"></i> Profil Pengguna</li>
      </ol>
    </section>    
    <!-- Main content -->
    <section class="content">
      <div id="myalert">
      <?php echo $this->session->flashdata('alert', false); ?>
      </div>
      <div class="row">                        
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a href="#activity" data-toggle="tab" aria-expanded="true">Update Profil</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <form class="form-horizontal" action="<?php echo base_url('profile/updateProfil') ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">NIK</label>
                    <div class="col-sm-10">
                      <input type="number" value="<?= $user['nik'] ?>" class="form-control" id="nik" name="nik" readonly="">
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?= $user['nama'] ?>" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Role</label>

                    <div class="col-sm-10">
                      <input type="text" value="<?= $user['role'] ?>" class="form-control" id="role" name="role" readonly="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Foto Profil</label>

                    <div class="col-sm-10">
                      <img src="<?= base_url('assets/images/').$user['image']; ?>" class="img-thumbnail" style="width: 200px; height: 200px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label"></label>
                    <div class="col-sm-3">                      
                      <div class="custom-file">
                        <input type="file" class="form-control custom-file-input" id="image" name="image">
                        <!-- <label type="hidden" class="custom-file-label" for="image"></label> -->
                      </div>                      
                    </div>
                  </div>                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input class="btn btn-primary" type="submit" value="Update">
                      <!-- <button type="submit" class="btn bg-navy">Edit</button> -->
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <div class="col-md-3">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Update Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('profile/updatePassword') ?>" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Password Lama</label>
                  <input type="password" class="form-control" name="lama" placeholder="Masukkan Password Lama">
                  <?= form_error('lama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" class="form-control" name="baru" placeholder="Masukkan Password Baru">
                  <?= form_error('baru', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password Baru</label>
                  <input type="password" class="form-control" name="konfir" placeholder="Masukkan Konfirmasi Password Baru">
                  <?= form_error('konfir', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <input class="btn btn-primary" type="submit" value="Update">
              </form>              
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>