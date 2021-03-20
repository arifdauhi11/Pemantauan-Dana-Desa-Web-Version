<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pendapatan
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-archive"></i> Pendapatan</li>
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
              <button type="button" class="btn btn-primary" data-toggle="modal" onclick="addPendapatan()">
              Tambah Pendapatan
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
                                    <th>Sumber Pendapatan</th>
                                    <!-- <th>Anggaran</th> -->
                                    <?php if ($this->session->userdata('role_id') == '8') { ?>
                                    <th style="width: 120px;">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pendapatan as $p) {
                                    // $anggaran = number_format($p->anggaran,0,",",".");
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $p->sumber_pendapatan ?></td>
                                        <!-- <td><?php echo 'Rp. '.$anggaran ?></td> -->
                                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                                        <td>
                                            <button class="btn btn-sm btn-warning" onclick="editPendapatan(<?php echo $p->id_pendapatan; ?>)"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger" onclick="deletePendapatan(<?php echo $p->id_pendapatan; ?>)"><i class="fa fa-trash"></i> Hapus</button>
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
      <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Tambah Pendapatan</h4>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id_pendapatan">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4">Sumber Pendapatan</label>
                    <div class="col-md-8">
                      <input type="text" name="sumberPendapatan" id="sumberPendapatan" placeholder="Masukkan Sumber Pendapatan" class="form-control">                      
                      <span id="message_error" class="text-danger"></span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary pull-right" onclick="savePendapatan()">Submit</button>
            </div>
          </div>
        </div>
      </div>    
</div>
<script type="text/javascript">
      var save_method;
      var table;

      function addPendapatan() {
        save_method = 'add';          
        $('#form')[0].reset();
        $('#modal_form').modal('show');        
      }

      function savePendapatan() {
        var url;   
        var pendapatan = $('#sumberPendapatan').val();
        if (pendapatan === '') {
          alert('Sumber Pendapatan tidak boleh kosong!');
        }else{
          if (save_method == 'add') {
            url = '<?php echo site_url('sumberpendapatan/tambah') ;?>';
            location.reload();
          } else {
            url = '<?php echo site_url('sumberpendapatan/update') ;?>';
            location.reload();
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

      function editPendapatan(id) {
        save_method = 'update';        
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('sumberpendapatan/edit/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_pendapatan"]').val(data.id_pendapatan);
            $('[name="sumberPendapatan"]').val(data.sumber_pendapatan);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Pendapatan');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function deletePendapatan(id) {
        // hapus data dari database dengan ajax
        if (confirm('Anda yakin akan menghapus data ini?')) {
          $.ajax({
          url: "<?php echo site_url('sumberpendapatan/delete/') ;?>/"+id,
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