  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sub Program       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-tasks"></i> Sub Program</li>
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
      <?php if ($this->session->userdata('role_id') == '8') { ?>
        <div class="col-md-9">          
          <div class="box">            
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Sub Program</th>
                  <th>Program</th>                  
                  <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($subprogram as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->sub_program ?></td>
                    <td><?php echo $p->nama_program ?></td>
                    <td>
                      <!-- <button class="btn btn-sm btn-warning" onclick="editKoderek(<?php echo $p->id ;?>)"><i class="fa fa-edit"></i> Edit</button> -->
                      <a class="btn btn-sm btn-danger" href="<?php echo base_url('program/hapusSubProgram/'.$p->id_sub_program)?>" onclick="return confirm('Anda yakin ingin menghapus data sub program ini?')"><i class="fa fa-trash"></i> Hapus</a>
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
              <h3 class="box-title">Tambah Sub Program</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('program/tambahSubProgram') ?>" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Sub Program</label>
                  <input type="text" name="subProgram" class="form-control" placeholder="Masukkan Sub Program" value="<?= set_value('subProgram');?>">
                  <?= form_error('subProgram', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>               
                <div class="form-group">
                  <label>Nama Program</label>
                  <select class="form-control" name="program" id="program">
                    <option selected disabled="">-- Pilih Program --</option>
                    <?php 
                    $no = 1;
                    foreach ($program as $p) {
                    ?>
                    <option value="<?php echo $p->id; ?>"><?php echo $p->nama_program; ?></option>                    
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
      <?php } else { ?>
        <div class="col-md-12">          
          <div class="box">            
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Sub Program</th>
                  <th>Program</th>                  
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($subprogram as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->sub_program ?></td>
                    <td><?php echo $p->nama_program ?></td>                    
                    </tr>
                    <?php } ?>                    
                  </tbody>
            </table>
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
      <?php } ?>       
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>