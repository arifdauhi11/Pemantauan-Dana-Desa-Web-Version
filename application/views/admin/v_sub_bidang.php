<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sub Bidang
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-archive"></i> Sub Bidang</li>
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
              <button type="button" class="btn btn-primary" data-toggle="modal" onclick="addSubBidang()">
              Tambah Sub Bidang
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
                  <th>Sub Bidang</th>
                  <?php if ($this->session->userdata('role_id') == '8') { ?>
                  <th style="width: 120px;">Action</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>                                      
                    <?php 
                      $no = 1;
                      foreach($subbidang as $b){ 
                      ?>
                    <tr>
                    <td><?php echo $no++ ?></td>                  
                    <td><?php echo $b->sub_bidang ?></td>
                    <?php if ($this->session->userdata('role_id') == '8') { ?>
                    <td>
                      <button class="btn btn-sm btn-warning" onclick="editSubBidang(<?php echo $b->id_sub_bidang ;?>)"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-danger" onclick="deleteSubBidang(<?php echo $b->id_sub_bidang ;?>)"><i class="fa fa-trash"></i> Hapus</button>
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
              <h4 class="modal-title">Tambah Sub Bidang</h4>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id_sub_bidang">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Sub Bidang</label>
                    <div class="col-md-9">
                      <input type="text" name="subBidang" id="subBidang" placeholder="Masukkan Sub Bidang" class="form-control">                      
                      <span id="message_error" class="text-danger"></span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary pull-right" onclick="saveSubBidang()">Submit</button>
            </div>
          </div>
        </div>
      </div>    
</div>
<script type="text/javascript">
      var save_method;
      var table;

      function addSubBidang() {
        save_method = 'add';          
        $('#form')[0].reset();
        $('#modal_form').modal('show');        
      }

      function saveSubBidang() {
        var url;   
        var subBidang = $('#subBidang').val();
        if (subBidang === '') {
          alert('Sub Bidang tidak boleh kosong!');
        }else{
          if (save_method == 'add') {
            url = '<?php echo site_url('bidang/tambahSubBidang') ;?>';
            // location.reload();
          } else {
            url = '<?php echo site_url('bidang/updateSubBidang') ;?>';
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

      function editSubBidang(id) {
        save_method = 'update';        
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('bidang/editSubBidang/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_sub_bidang"]').val(data.id_sub_bidang);
            $('[name="subBidang"]').val(data.sub_bidang);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Sub Bidang');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function deleteSubBidang(id) {
        // hapus data dari database dengan ajax
        if (confirm('Anda yakin akan menghapus data sub bidang ini?')) {
          $.ajax({
          url: "<?php echo site_url('bidang/deleteSubBidang/') ;?>/"+id,
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