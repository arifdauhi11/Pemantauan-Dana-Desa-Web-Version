<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Media       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-folder"></i> Media</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="col-md-4">
      <?php        
        if ($this->session->flashdata('message')) { 
          echo '<div id="myalert">' . $this->session->flashdata('message') . '</div>'; // Tampilkan pesannya
        }
      ?>  
      </div>
      <!-- /.row -->
      <!-- Main row -->      
      <div class="row">
      <?php if ($this->session->userdata('role_id') == '1') {?>        
        <div class="col-md-9">
      <?php } else { ?>
        <div class="col-md-12">
      <?php } ?>      
          <div class="box">
            <div class="box-header with-border">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Bidang</th>
                  <th>Gambar</th>
                  <!-- <th style="width: 150px;">Action</th> -->
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($media as $m){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $m->nama_bidang ?></td>
                    <td><img class="img-responsive pad" style="width:500px; height: 250px" src="<?php echo base_url('assets/images/multiple/'); ?><?= $m->nama_gambar ?>"></td>
                    <!-- <td>
                      <button class="btn btn-sm btn-warning" onclick="editBidang(<?php echo $m->id_bidang ;?>)"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-danger" onclick="deleteBidang(<?php echo $m->id_bidang ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                    </td> -->
                    </tr>
                    <?php } ?>                    
                  </tbody>
            </table>
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
      </div>
      <?php if ($this->session->userdata('role_id') == '1') {?>            
        <div class="col-md-3">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Gambar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('media/uploadGambar') ?>" method="post" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Pilih Bidang</label>
                  <select class="form-control" name="bidang">
                    <?php 
                    $no = 1;
                    foreach ($bidang as $b) {
                    ?>
                    <option value="<?php echo $b->id_bidang; ?>"><?php echo $b->nama_bidang; ?></option>                    
                    <?php } ?>
                  </select>                                  
                </div>
                <div class="form-group">
                  <label>Pilih Beberapa Gambar</label>
                  <input type="file" name="gambar[]" class="form-control" multiple>
                  <?= form_error('gambar[]', '<span class="text-danger pl-3">', '</span>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit
                </button>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      <?php } ?>
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>