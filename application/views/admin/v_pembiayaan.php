<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembiayaan
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-archive"></i> Pembiayaan</li>
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
      <div class="col-md-12">
          <div class="box">
            <?php if ($this->session->userdata('role_id') == '8') { ?>
            <div class="box-header with-border">
              <button type="button" class="btn btn-primary" data-toggle="modal" onclick="addPembiayaan()">
              Tambah Pembiayaan
              </button>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <?php } ?>
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Nama Pembiayaan</th>
                  <?php if ($this->session->userdata('role_id') == '8') { ?>
                  <th style="width: 120px;">Action</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($pembiayaan as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->nama_pembiayaan ?></td>
                    <?php if ($this->session->userdata('role_id') == '8') { ?>
                    <td>
                      <button class="btn btn-sm btn-warning" onclick="editPembiayaan(<?php echo $p->id_pembiayaan ;?>)"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-danger" onclick="deletePembiayaan(<?php echo $p->id_pembiayaan ;?>)"><i class="fa fa-trash"></i> Hapus</button>
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
    <section class="content-header">
      <h1>
        Sub Pembiayaan
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
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
                  <th>Sub Pembiayaan</th>
                  <th>Pembiayaan</th>                  
                  <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($subpembiayaan as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->sub_pembiayaan ?></td>
                    <td><?php echo $p->nama_pembiayaan ?></td>
                    <td>
                      <!-- <button class="btn btn-sm btn-warning" onclick="editKoderek(<?php echo $p->id ;?>)"><i class="fa fa-edit"></i> Edit</button> -->
                      <a class="btn btn-sm btn-danger" href="<?php echo base_url('pembiayaan/hapusSubPembiayaan/'.$p->id_sub_pembiayaan)?>" onclick="return confirm('Anda yakin ingin menghapus data sub pembiayaan ini?')"><i class="fa fa-trash"></i> Hapus</a>
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
              <h3 class="box-title">Tambah Sub Pembiayaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('pembiayaan/tambahSubPembiayaan') ?>" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Sub Pembiayaan</label>
                  <input type="text" name="subPembiayaan" class="form-control" placeholder="Masukkan Sub Pembiayaan" value="<?= set_value('subPembiayaan');?>">
                  <?= form_error('subPembiayaan', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>               
                <div class="form-group">
                  <label>Pembiayaan</label>
                  <select class="form-control" name="pembiayaan" id="pembiayaan">
                    <option selected disabled="">-- Pilih Pembiayaan --</option>
                    <?php 
                    $no = 1;
                    foreach ($pembiayaan as $p) {
                    ?>
                    <option value="<?php echo $p->id_pembiayaan; ?>"><?php echo $p->nama_pembiayaan; ?></option>                    
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
      </div>
      <?php } else { ?>
        <div class="col-md-12">          
          <div class="box">            
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Sub Pembiayaan</th>
                  <th>Pembiayaan</th>                  
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($subpembiayaan as $p){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $p->sub_pembiayaan ?></td>
                    <td><?php echo $p->nama_pembiayaan ?></td>                    
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
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
      <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Tambah Pembiayaan</h4>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id_pembiayaan">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Nama Pembiayaan</label>
                    <div class="col-md-9">
                      <input type="text" name="namaPembiayaan" id="namaPembiayaan" placeholder="Masukkan Nama Pembiayaan" class="form-control">                      
                      <span id="message_error" class="text-danger"></span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary pull-right" onclick="savePembiayaan()">Submit</button>
            </div>
          </div>
        </div>
      </div>    
</div>
<script type="text/javascript">
      var save_method;
      var table;

      function addPembiayaan() {
        save_method = 'add';          
        $('#form')[0].reset();
        $('#modal_form').modal('show');        
      }

      function savePembiayaan() {
        var url;   
        var pembiayaan = $('#namaPembiayaan').val();
        if (pembiayaan === '') {
          alert('Nama Pembiayaan tidak boleh kosong!');
        }else{
          if (save_method == 'add') {
            url = '<?php echo site_url('pembiayaan/tambahPembiayaan') ;?>';
            // location.reload();
          } else {
            url = '<?php echo site_url('pembiayaan/updatePembiayaan') ;?>';
            // location.reload();
          }
        }        

        $.ajax({
          url: url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data) {
            $('#modal_form').modal('hide');            
            location.reload();
          },          
        });
      }

      function editPembiayaan(id) {
        save_method = 'update';        
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('pembiayaan/editPembiayaan/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_pembiayaan"]').val(data.id_pembiayaan);
            $('[name="namaPembiayaan"]').val(data.nama_pembiayaan);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Pembiayaan');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function deletePembiayaan(id) {
        // hapus data dari database dengan ajax
        if (confirm('Anda yakin akan menghapus data ini?')) {
          $.ajax({
          url: "<?php echo site_url('pembiayaan/deletePembiayaan/') ;?>/"+id,
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
    </script>