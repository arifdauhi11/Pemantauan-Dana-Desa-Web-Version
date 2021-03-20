<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemerintah Desa
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-users"></i> Pemerintah Desa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="col-md4">
      <?php        
        if ($this->session->flashdata('message')) { 
          echo '<div id="myalert">' . $this->session->flashdata('message') . '</div>'; // Tampilkan pesannya
        }
      ?>  
      </div>
      <!-- /.row -->
      <!-- Main row -->      
      <div class="row">        
        <div class="col-md-9">          
          <div class="box">            
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th style="width: 150px;">Nama</th>
                  <th>Jabatan</th>
                  <th>Foto</th>
                  <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($pemdes as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->nama_pemdes ?></td>
                    <td><?php echo $p->jabatan ?></td>
                    <td>
                      <img style="width: 200px; height: 200px" src="<?php echo base_url('assets/images/pemdes/'). $p->foto ?>">
                    </td>
                    <td>
                      <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger" href="<?php echo base_url('pemdes/hapus/').$p->id_pemdes?>"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                    </tr>
                    <?php } ?>                    
                  </tbody>
            </table>
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Pemerintah Desa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('pemdes/tambah') ?>" method="post" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="namaPemdes" class="form-control" placeholder="Masukkan Nama" value="<?= set_value('namaPemdes');?>">
                  <?= form_error('namaPemdes', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan" value="<?= set_value('jabatan');?>">
                  <?= form_error('jabatan', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>
                <div class="form-group">
                  <label>Foto</label>
                  <div class="custom-file">
                        <input type="file" required="" class="form-control custom-file-input" id="image" name="image">
                        <!-- <label type="hidden" class="custom-file-label" for="image"></label> -->
                      </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit
                </button>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->      
</div>