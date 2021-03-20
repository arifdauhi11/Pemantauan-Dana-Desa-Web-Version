<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tahun Anggaran
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-calendar"></i> Tahun Anggaran</li>
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
              Tambah Tahun Anggaran
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
                                    <th>Tahun Anggaran</th>
                                    <!-- <th>Anggaran</th> -->
                                    <?php if ($this->session->userdata('role_id') == '8') { ?>
                                    <th style="width: 120px;">Action</th>
                                    <?php } ?>                          
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($tahun as $t) {
                                    // $anggaran = number_format($t->anggaran,0,",",".");
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $t->tahun ?></td>
                                        <!-- <td><?php echo 'Rp. '.$anggaran ?></td> -->
                                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                                        <td>
                                            <button class="btn btn-sm btn-warning" onclick="editPendapatan(<?php echo $t->id_tahun; ?>)"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-danger" onclick="deletePendapatan(<?php echo $t->id_tahun; ?>)"><i class="fa fa-trash"></i> Hapus</button>
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
                <input type="hidden" name="id_tahun">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4">Tahun Anggaran</label>
                    <div class="col-md-8">
                      <input type="number" name="tahunAnggaran" id="tahunAnggaran" placeholder="Masukkan Tahun Anggaran" class="form-control">                      
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
        var pendapatan = $('#tahunAnggaran').val();
        if (pendapatan === '') {
          alert('Tahun Anggaran tidak boleh kosong!');
        }else{
          if (save_method == 'add') {
            url = '<?php echo site_url('tahunAnggaran/tambah') ;?>';
          } else {
            if ($('#tahunAnggaran').val() > 0) {
              location.reload();
            }
            url = '<?php echo site_url('tahunAnggaran/update') ;?>';
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
          url: "<?php echo site_url('tahunAnggaran/edit/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_tahun"]').val(data.id_tahun);
            $('[name="tahunAnggaran"]').val(data.tahun);
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
          url: "<?php echo site_url('tahunAnggaran/delete/') ;?>/"+id,
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