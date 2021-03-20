  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Program       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-tasks"></i> Program</li>
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
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Program</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('program/tambah') ?>" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Nama Program</label>
                  <input type="text" name="namaProgram" class="form-control" placeholder="Masukkan Nama Program" value="<?= set_value('namaProgram');?>">
                  <?= form_error('namaProgram', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>               
                <div class="form-group">
                  <label>Nama Bidang</label>
                  <select class="form-control" name="bidang" id="bidang">
                    <option selected disabled="">-- Pilih Bidang --</option>
                    <?php 
                    $no = 1;
                    foreach ($bidang as $b) {
                    ?>
                    <option value="<?php echo $b->id_bidang; ?>"><?php echo $b->nama_bidang; ?></option>                    
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Sub Bidang</label>
                  <select class="form-control" name="subbidang" id="subbidang">
                    <option selected disabled="">-- Pilih Sub Bidang --</option>
                    <?php 
                    $no = 1;
                    foreach ($subbidang as $b) {
                    ?>
                    <option value="<?php echo $b->id_sub_bidang; ?>"><?php echo $b->sub_bidang; ?></option>                    
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
      <?php } ?>  
      </div>
      <div class="row">        
        <div class="col-md-12">          
          <div class="box">            
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Nama Program</th>
                  <th>Bidang</th>
                  <th>Sub Bidang</th>
                  <?php if ($this->session->userdata('role_id') == '8') { ?>
                  <th style="width: 150px;">Action</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($program as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->nama_program ?></td>
                    <td><?php echo $p->nama_bidang ?></td>
                    <td>
                      <?php echo $p->sub_bidang; ?>
                    </td>
                    <?php if ($this->session->userdata('role_id') == '8') { ?>
                    <td>
                      <!-- <button class="btn btn-sm btn-warning" onclick="editKoderek(<?php echo $p->id ;?>)"><i class="fa fa-edit"></i> Edit</button> -->
                      <a class="btn btn-sm btn-danger" href="<?php echo base_url('program/hapus/'.$p->id)?>" onclick="return confirm('Anda yakin ingin menghapus data program ini?')"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                    <?php } ?>
                    </tr>
                    <?php } ?>                    
                  </tbody>
            </table>
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>        
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
  // window.onload = function () {
  //   $('#subbidang').hide();   
  // }
  function myFunction() {
    var bidang = $('#bidang').val();
    var b = bidang.toString();
    if (b == '60') {      
      $('#subbidang').show();       
    }

    if (b == '53') {      
      $('#subbidang').show();       
    }    

    if (b == '46') {      
      $('#subbidang').hide();       
    }

    if (b == '48') {      
      $('#subbidang').hide();       
    }
  }
</script>