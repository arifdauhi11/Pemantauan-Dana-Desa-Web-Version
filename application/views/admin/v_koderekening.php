<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kode Rekening
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-credit-card"></i> Kode Rekening</li>
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
                  <th style="width: 150px;">Kode Rekening</th>
                  <th>Nama Akun</th>
                  <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($koderek as $k){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $k->kode_rek ?></td>
                    <td><?php echo $k->nama_akun ?></td>
                    <td>
                      <button class="btn btn-sm btn-warning" onclick="editKoderek(<?php echo $k->id_rek ;?>)"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-danger" onclick="deleteKoderek(<?php echo $k->id_rek ;?>)"><i class="fa fa-trash"></i> Hapus</button>
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
              <h3 class="box-title">Tambah Kode Rekening</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('koderekening/tambah') ?>" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Kode Rekening</label>
                  <input type="number" name="kdRek" class="form-control" placeholder="Masukkan Kode Rekening" value="<?= set_value('kdRek');?>">
                  <?= form_error('kdRek', '<span class="text-danger pl-3">', '</span>'); ?>                  
                </div>
                <div class="form-group">
                  <label>Nama Akun</label>
                  <input type="text" name="akun" class="form-control" placeholder="Masukkan Nama Akun" value="<?= set_value('akun');?>">
                  <?= form_error('akun', '<span class="text-danger pl-3">', '</span>'); ?>                  
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
    <script type="text/javascript">
      var save_method;
      var table;

      function addKoderek() {
        save_method = 'add';        
        $('#form')[0].reset();
        $('#modal_form').modal('show');
      }

      function saveKoderek() {
        var url;

        // if ($('#kr').val() > 0 ) {
        //   if ($('#kr').val() == $('#kr').val()) {}
        //   alert($("sama");
        // }

        if (save_method == 'add') {
          url = '<?php echo site_url('koderekening/tambahKoderek') ;?>';
        } else {
          if ($('#kr').val() > 0) {
            location.reload();
          }
          url = '<?php echo site_url('koderekening/updateKoderek') ;?>';
          // location.reload();
        }

        $.ajax({
          url: url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data) {
            $('#modal_form').modal('hide');
            location.reload();
          }
        });
      }

      function editKoderek(id) {
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('koderekening/editKoderek/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_rek"]').val(data.id_rek);
            $('[name="kodeRek"]').val(data.kode_rek);
            $('[name="namaAkun"]').val(data.nama_akun);

            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Kode Rekening');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function deleteKoderek(id) {
        // hapus data dari database dengan ajax
        if (confirm('Anda yakin akan menghapus data ini?')) {
          $.ajax({
          url: "<?php echo site_url('koderekening/deleteKoderek/') ;?>/"+id,
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
      <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Tambah Kode Rekening</h4>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id_rek">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Kode Rekening</label>
                    <div class="col-md-9">
                      <input type="number" name="kodeRek" id="kr" placeholder="Masukkan Kode Rekening" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Nama Akun</label>
                    <div class="col-md-9">
                      <input type="text" name="namaAkun" id="na" placeholder="Masukkan Nama Akun" class="form-control">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary pull-right" onclick="saveKoderek()">Submit</button>
            </div>
          </div>
        </div>
      </div>    
</div>