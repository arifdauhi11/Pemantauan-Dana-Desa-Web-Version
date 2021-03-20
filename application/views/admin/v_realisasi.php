<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Realisasi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-bars"></i> Realisasi</li>
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
              <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"></a></li>              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <table id="tpendapatan" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 10px;">#</th>
                    <th style="width: 100px;">Program / Pembiayaan</th>
                    <th style="width: 90px;">Action</th>
                  </tr>
                  </thead>
                  <tbody>                                      
                      <?php 
                        $no = 1;
                        foreach($detail_program as $p){                          
                        ?>
                      <tr>
                      <td><?php echo $no++ ?></td>                  
                      <td><?php echo $p->detail_program ?></td>                                                
                      <td>
                        <a href="<?php echo base_url('realisasi/rincian/'.$p->id_detail_program.'/'.'2019') ?>" class="btn btn-sm btn-primary" ><strong>Rincian</strong></a>
                      </td>
                      </tr>
                      <?php } ?>                    
                    </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->              
            </div>
            <!-- /.tab-content -->
          </div>

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
      