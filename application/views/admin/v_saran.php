<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Saran
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-comments"></i> Saran</li>
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
            <div class="box-body" style="">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 25px;">#</th>
                  <th>Nama</th>
                  <th>Role</th>
                  <th>Saran</th>
                  <th>Status</th>
                  <th style="width: 120px;">Action</th>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($saran as $s){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $s->nama ?></td>
                    <td><?php echo $s->role ?></td>
                    <td><?php echo $s->saran ?></td>
                    <td>
                      <?php if ($s->status == '0') { ?>
                        <a class="btn btn-sm btn-warning" href="<?php echo base_url('saran/upStatus/'.$s->id_saran.'/'.$s->status)?>"><strong>Approve</strong></a>  
                      <?php } else { ?>
                        <a class="btn btn-sm btn-success" href="<?php echo base_url('saran/upStatus/'.$s->id_saran.'/'.$s->status)?>"><strong>Approved</strong></a>  
                      <?php } ?>                                            
                    </td>
                    <td>
                      <a class="btn btn-sm btn-danger" href="<?php echo base_url('saran/deleteSaran/'.$s->id_saran); ?>" onclick="return confirm('Yakin ingin menghapus saran ini?')"><i class="fa fa-trash"></i> Hapus</a>
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
              <h4 class="modal-title">Tambah Bidang</h4>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id_bidang">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Nama Bidang</label>
                    <div class="col-md-9">
                      <input type="text" name="namaBidang" id="namaBidang" placeholder="Masukkan Nama Bidang" class="form-control">                      
                      <span id="message_error" class="text-danger"></span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary pull-right">Submit</a>
            </div>
          </div>
        </div>
      </div>    
</div>
<script type="text/javascript">
      var save_method;
      var table;

      function addBidang() {
        save_method = 'add';          
        $('#form')[0].reset();
        $('#modal_form').modal('show');        
      }

      function saveBidang() {
        var url;   
        var bidang = $('#namaBidang').val();
        if (bidang === '') {
          alert('Nama Bidang tidak boleh kosong!');
        }else{
          if (save_method == 'add') {
            url = '<?php echo site_url('bidang/tambahBidang') ;?>';
            location.reload();
          } else {
            url = '<?php echo site_url('bidang/updateBidang') ;?>';
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

      function editBidang(id) {
        save_method = 'update';        
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('bidang/editBidang/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_bidang"]').val(data.id_bidang);
            $('[name="namaBidang"]').val(data.nama_bidang);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Bidang');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function deleteBidang(id) {
        // hapus data dari database dengan ajax
        if (confirm('Anda yakin akan menghapus data ini?')) {
          $.ajax({
          url: "<?php echo site_url('bidang/deleteBidang/') ;?>/"+id,
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