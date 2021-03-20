<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Anggaran
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><i class="fa fa-money"></i> Anggaran</li>
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
      <?php if ($this->session->userdata('role_id') == '8') { ?>
        <div class="row">                
          <div class="col-md-12">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Anggaran</h3>              
              </div>                        
              <!-- /.box-header -->
              <div class="box-body">  
                <div class="input-group input-group-sm">
                     <select id="anggaran" class="form-control">
                      <option value="pendapatan">Pendapatan</option>
                      <option value="bidang">Bidang</option>
                      <option value="pembiayaan">Pembiayaan</option>
                      <option value="program">Program</option>
                      <option value="subProgramTahun">Sub Program / Sub Pembiayaan Pertahun</option>
                      <option value="subProgram">Sub Program / Sub Pembiayaan Perbulan</option>
                     </select>
                      <span class="input-group-btn">
                        <button onclick="cek()" class="btn btn-info btn-flat">Show</button>
                      </span>
                </div>
                <br>
                <form id="form_anggaran" action="<?php echo base_url('anggaran/tambah') ?>" method="post">
                  <!-- text input -->
                  <div id="pendapatan" class="form-group">
                    <label>Sumber Pendapatan</label>
                      <select class="form-control" id="p" name="pendapatan">
                      <option disabled="" selected="">-- Pilih Sumber Pendapatan --</option>
                      <?php 
                      $no = 1;
                      foreach ($pendapatan as $p) {
                      ?>
                      <option value="<?php echo $p->id_pendapatan; ?>"><?php echo $p->sumber_pendapatan; ?></option>                    
                      <?php } ?>
                    </select>                  
                  </div>
                  <div id="bidang" class="form-group">
                    <label>Bidang</label>
                      <select class="form-control" id="b" name="bidang">
                        <option disabled="" selected="">-- Pilih Bidang --</option>
                      <?php 
                      $no = 1;
                      foreach ($bidang as $b) {
                      ?>
                      <option value="<?php echo $b->id_bidang; ?>"><?php echo $b->nama_bidang; ?></option>                    
                      <?php } ?>
                    </select>                  
                  </div>
                  <div id="pembiayaan" class="form-group">
                    <label>Pembiayaan</label>
                      <select class="form-control" id="biaya" name="pembiayaan">
                      <option disabled="" selected="">-- Pilih Pembiayaan --</option>
                      <?php 
                      $no = 1;
                      foreach ($pembiayaan as $p) {
                      ?>
                      <option value="<?php echo $p->id_pembiayaan; ?>"><?php echo $p->nama_pembiayaan; ?></option>                    
                      <?php } ?>
                    </select>                  
                  </div>
                  <div id="program" class="form-group">
                    <label>Program</label>
                      <select class="form-control" id="program" name="program">
                        <option disabled="" selected="">-- Pilih Program --</option>
                      <?php 
                      $no = 1;
                      foreach ($program as $p) {
                      ?>
                      <option value="<?php echo $p->id; ?>"><?php echo $p->nama_program; ?></option>                    
                      <?php } ?>
                    </select>                  
                  </div>
                  <div id="subProgram" class="form-group">
                    <label>Sub Program / Sub Pembiayaan</label>                  
                      <select class="form-control" id="subProgramBulan" name="subProgram">
                      <option disabled="" selected="">-- Pilih Sub Program / Sub Pembiayaan --</option>
                      <?php 
                      $no = 1;
                      foreach ($subprogram as $p) {
                      ?>
                      <option value="<?php echo $p->id_realisasi; ?>"><?php echo $p->realisasi; ?> ( <?php echo $p->parent; ?> )</option>                    
                      <?php } ?>
                    </select>                  
                  </div>
                  <div id="subProgramTahun" class="form-group">                
                    <label>Sub Program / Sub Pembiayaan</label>
                      <select class="form-control" id="subProgram" name="subProgramTahun">
                      <option disabled="" selected="">-- Pilih Sub Program / Sub Pembiayaan --</option>
                      <?php 
                      $no = 1;                      
                      foreach ($subprogram as $p) {
                      ?>
                      <option value="<?php echo $p->id_realisasi; ?>"><?php echo $p->realisasi; ?> ( <?php echo $p->parent; ?> )</option>                                        
                      <?php } ?>
                    </select>                  
                  </div>
                  <div class="form-group">
                    <label>Anggaran</label>
                    <input type="hidden" name="perubahan">                    
                    <input type="number" name="anggaran" class="form-control" placeholder="Masukkan Anggaran">
                    <?= form_error('anggaran', '<span class="text-danger pl-3">', '</span>'); ?>                  
                  </div>
                  <div class="form-group">
                    <label>Tahun Anggaran</label>
                    <select class="form-control" id="t" name="tahun">
                      <?php 
                      $no = 1;
                      foreach ($tahun as $t) {
                      ?>
                      <option value="<?php echo $t->id_tahun; ?>"><?php echo $t->tahun; ?></option>                    
                      <?php } ?>
                    </select>                  
                  </div>
                  <div id="bulan" class="form-group">
                    <label>Bulan</label>
                    <select class="form-control" id="bu" name="bulan">
                      <?php 
                      $no = 1;
                      foreach ($bulan as $t) {
                      ?>
                      <option value="<?php echo $t->id_bulan; ?>"><?php echo $t->bulan; ?></option>                    
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
        <div class="row">        
          <div class="col-md-12">          
            <div class="box">            
              <div class="box-body" style="">
                <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Pendapatan</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Bidang</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Pembiayaan</a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Program</a></li>
                <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Sub Program / Sub Pembiayaan Pertahun</a>
                </li>
                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Sub Program / Sub Pembiayaan Perbulan</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <table id="tpendapatan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 100px;">Pendapatan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 60px;">Tahun</th>
                      <th style="width: 90px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($apendapatan as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->sumber_pendapatan ?></td>                                                
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranP(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <table id="tbidang" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 120px;">Bidang</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 70px;">Tahun</th>
                      <th style="width: 90px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($abidang as $b){ 
                            $semula = "Rp. " . number_format($b->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($b->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $b->nama_bidang ?></td>                          
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($b->anggaran_semula - $b->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $b->tahun ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranB(<?php echo $b->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $b->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  <table id="tpembiayaan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 120px;">Pembiayaan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 70px;">Tahun</th>
                      <th style="width: 90px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($apembiayaan as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->nama_pembiayaan ?></td>                          
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranPembiayaan(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_4">
                  <table id="tprogram" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 100px;">Nama Program</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 60px;">Tahun</th>                 
                      <th style="width: 90px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($aprogram as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->nama_program ?></td>                                                
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranProgram(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_5">
                  <table id="tsubprogram" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 250px">Sub Program / Sub Pembiayaan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 100px;">Serapan</th>
                      <th style="width: 60px;">Tahun</th>                 
                      <th style="width: 60px;">Bulan</th>                 
                      <th style="width: 90px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($asubprogram as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                            $serapan = "Rp. " . number_format($p->serapan,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->realisasi ?> ( <?php echo $p->parent ?> )</td>
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>                        
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $serapan ?></td>
                        <td><?php echo $p->tahun ?></td>
                        <td><?php echo $p->bulan ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranSubProgram(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_6">
                  <table id="tsubprogramtahun" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 200px">Sub Program / Sub Pembiayaan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 60px;">Tahun</th>                 
                      <th style="width: 90px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($asubprogramtahun as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->realisasi ?> ( <?php echo $p->parent ?> )</td>
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranSubProgramTahun(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
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
      <?php } else { ?>      
        <div class="row">        
          <div class="col-md-12">          
            <div class="box">            
              <div class="box-body" style="">
                <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Pendapatan</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Bidang</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Pembiayaan</a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Program</a></li>
                <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Sub Program / Sub Pembiayaan Pertahun</a>
                </li>
                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Sub Program / Sub Pembiayaan Perbulan</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <table id="tpendapatan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 100px;">Pendapatan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 60px;">Tahun</th>
                      <?php if ($this->session->userdata('role_id') == '8') { ?>
                      <th style="width: 90px;">Action</th>
                      <?php } ?>                        
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($apendapatan as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->sumber_pendapatan ?></td>                                                
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranP(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        <?php } ?>                        
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <table id="tbidang" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 120px;">Bidang</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 70px;">Tahun</th>
                      <?php if ($this->session->userdata('role_id') == '8') { ?>
                      <th style="width: 90px;">Action</th>
                      <?php } ?>                        
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($abidang as $b){ 
                            $semula = "Rp. " . number_format($b->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($b->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $b->nama_bidang ?></td>                          
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($b->anggaran_semula - $b->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $b->tahun ?></td>
                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranB(<?php echo $b->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $b->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        <?php } ?>                        
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  <table id="tpembiayaan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 120px;">Pembiayaan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 70px;">Tahun</th>
                      <?php if ($this->session->userdata('role_id') == '8') { ?>
                      <th style="width: 90px;">Action</th>
                      <?php } ?>                        
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($apembiayaan as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->nama_pembiayaan ?></td>                          
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranPembiayaan(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        <?php } ?>                        
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_4">
                  <table id="tprogram" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 100px;">Nama Program</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 60px;">Tahun</th>   
                      <?php if ($this->session->userdata('role_id') == '8') { ?>
                      <th style="width: 90px;">Action</th>
                      <?php } ?>                                      
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($aprogram as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->nama_program ?></td>                                                
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranProgram(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        <?php } ?>                        
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_5">
                  <table id="tsubprogram" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 250px">Sub Program / Sub Pembiayaan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 100px;">Serapan</th>
                      <th style="width: 60px;">Tahun</th>                 
                      <th style="width: 60px;">Bulan</th>  
                      <?php if ($this->session->userdata('role_id') == '8') { ?>
                      <th style="width: 90px;">Action</th>
                      <?php } ?>                                       
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($asubprogram as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                            $serapan = "Rp. " . number_format($p->serapan,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->realisasi ?> ( <?php echo $p->parent ?> )</td>
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $serapan ?></td>
                        <td><?php echo $p->tahun ?></td>
                        <td><?php echo $p->bulan ?></td>
                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranSubProgram(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        <?php } ?>                        
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_6">
                  <table id="tsubprogramtahun" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 200px">Sub Program / Sub Pembiayaan</th>
                      <th style="width: 100px;">Anggaran Semula</th>
                      <th style="width: 100px;">Anggaran Menjadi</th>
                      <th style="width: 120px;">Bertambah / Berkurang</th>
                      <th style="width: 60px;">Tahun</th>  
                      <?php if ($this->session->userdata('role_id') == '8') { ?>
                      <th style="width: 90px;">Action</th>
                      <?php } ?>                                       
                    </tr>
                    </thead>
                    <tbody>                                      
                        <?php 
                          $no = 1;
                          foreach($asubprogramtahun as $p){ 
                            $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                            $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                          ?>
                        <tr>
                        <td><?php echo $no++ ?></td>                  
                        <td><?php echo $p->realisasi ?> ( <?php echo $p->parent ?> )</td>
                        <td><?php echo $semula ?></td>
                        <td><?php echo $menjadi ?></td>
                        <td><?php 
                          if ($menjadi == "Rp. 0,00") {
                            echo "Rp. 0,00";
                          } else {
                            echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                          }?>
                        </td>
                        <td><?php echo $p->tahun ?></td>
                        <?php if ($this->session->userdata('role_id') == '8') { ?>
                        <td>
                          <button class="btn btn-sm btn-warning" onclick="editAnggaranSubProgramTahun(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deleteAnggaran(<?php echo $p->id_anggaran ;?>)"><i class="fa fa-trash"></i> Hapus</button>
                        </td>
                        <?php } ?>                        
                        </tr>
                        <?php } ?>                    
                      </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-content -->
            </div>

              </div>
              <!-- ./box-body -->
            </div>
            <!-- /.box -->
          </div>        
        </div>
      <?php } ?>      
    </section>
    <!-- /.content -->
      <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Tambah Anggaran</h4>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" name="id_anggaran">
                <input type="hidden" name="edit_pendapatan">
                <input type="hidden" name="edit_bidang">
                <input type="hidden" name="edit_pembiayaan">
                <input type="hidden" name="edit_program">
                <input type="hidden" name="edit_subprogram">
                <input type="hidden" name="edit_subprogramtahun">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-2" id="labelAnggaran">Pendapatan</label>
                    <div class="col-md-10">
                      <input type="text" name="apendapatan" placeholder="Masukkan Pendapatan" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Anggaran</label>
                    <div class="col-md-10">
                      <input type="hidden" name="aaanggaran">
                      <input type="text" name="aanggaran" placeholder="Masukkan Anggaran" class="form-control" id="rupiah">
                    </div>
                  </div>
                  <div class="form-group" id="formSerapan">
                    <label class="control-label col-md-2">Serapan</label>
                    <div class="col-md-10">
                      <input type="text" name="aserapan" id="serapan" placeholder="Masukkan Serapan" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Tahun</label>
                    <div class="col-md-10">
                      <input type="text" name="atahun" id="tahuna" placeholder="Masukkan Tahun" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group" id="formBulan">
                    <label class="control-label col-md-2">Bulan</label>
                    <div class="col-md-10">
                      <input type="text" name="abulan" id="bulana" placeholder="Masukkan Bulan" class="form-control" readonly>
                    </div>
                  </div>                  
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary pull-right" onclick="saveAnggaran()">Submit</button>
            </div>
          </div>
        </div>
      </div>    
</div>

    <script type="text/javascript">
      var save_method;
      var table;

      function tes() {
        var p = $('#pendapatan').val();
        var b = $('#bidang').val();

        alert(p);
        alert(b);

      }

      function cek() {
        var a = $('#anggaran').val();
        if (a == 'bidang') {
          $('#bidang').show();          
          $('#pendapatan').hide();
          $('#pembiayaan').hide();
          $('#program').hide();
          $('#subProgram').hide();
          $('#subProgramTahun').hide();
          $('#bulan').hide();
        }else if (a == 'pendapatan') {
          $('#pendapatan').show();
          $('#bidang').hide();
          $('#program').hide();
          $('#pembiayaan').hide();
          $('#subProgram').hide();
          $('#subProgramTahun').hide();          
          $('#bulan').hide();
        } else if (a == 'program') {
          $('#program').show();
          $('#bidang').hide();
          $('#pendapatan').hide();
          $('#pembiayaan').hide();
          $('#subProgramTahun').hide();          
          $('#subProgram').hide();
          $('#bulan').hide();
        } else if (a == 'pembiayaan') {
          $('#pembiayaan').show();
          $('#bidang').hide();
          $('#program').hide();
          $('#pendapatan').hide();
          $('#subProgramTahun').hide();          
          $('#subProgram').hide();
          $('#bulan').hide();
        } else if (a == 'subProgram') {
          $('#subProgram').show();
          $('#bidang').hide();
          $('#pembiayaan').hide();
          $('#program').hide();
          $('#subProgramTahun').hide();          
          $('#pendapatan').hide();
          $('#bulan').show();
        } else if (a == 'subProgramTahun') {
          $('#subProgramTahun').show();
          $('#bidang').hide();
          $('#pembiayaan').hide();
          $('#program').hide();
          $('#subProgram').hide();          
          $('#pendapatan').hide();
          $('#bulan').hide();
        }

        $('#form_anggaran').slideDown('slows');
      }

      function addAnggaran() {
        save_method = 'add';        
        $('#form')[0].reset();
        $('#modal_form').modal('show');
      }

      function saveAnggaran() {
        var url;
        var a = $('#rupiah').val();
        console.log(a);
        var b = $('[name="aaanggaran"]').val(a);
        console.log(a);

        if (save_method == 'add') {
          url = '<?php echo site_url('koderekening/tambahKoderek') ;?>';
        } else {
          url = '<?php echo site_url('anggaran/updateAnggaran') ;?>';
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
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal saat menambah atau mengedit data!');
          }
        });
      }

      function editAnggaranP(id) {                
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('anggaran/editAnggaranP/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_anggaran"]').val(data.id_anggaran);
            $('[name="edit_pendapatan"]').val(data.id_pendapatan);
            $('[name="edit_bidang"]').val(data.id_bidang);
            $('[name="edit_pembiayaan"]').val(data.id_pembiayaan);
            $('[name="edit_program"]').val(data.id_program);
            $('[name="edit_subprogram"]').val(data.id_realisasi);
            $('[name="apendapatan"]').val(data.sumber_pendapatan);
            $('[name="aanggaran"]').val(data.anggaran_menjadi);
            $('[name="atahun"]').val(data.tahun);

            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Anggaran Pendapatan');
            $('#labelAnggaran').text('Pendapatan');
            $('#formBulan').hide();
            $('#formSerapan').hide();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function editAnggaranProgram(id) {                
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('anggaran/editAnggaranProgram/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_anggaran"]').val(data.id_anggaran);
            $('[name="edit_pendapatan"]').val(data.id_pendapatan);
            $('[name="edit_bidang"]').val(data.id_bidang);
            $('[name="edit_program"]').val(data.id);
            $('[name="edit_pembiayaan"]').val(data.id_pembiayaan);
            $('[name="edit_subprogram"]').val(data.id_realisasi);
            $('[name="apendapatan"]').val(data.nama_program);
            $('[name="aanggaran"]').val(data.anggaran_menjadi);
            $('[name="atahun"]').val(data.tahun);

            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Anggaran Program');
            $('#labelAnggaran').text('Program');
            $('#formBulan').hide();
            $('#formSerapan').hide();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function editAnggaranSubProgram(id) {                
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('anggaran/editAnggaranSubProgram/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_anggaran"]').val(data.id_anggaran);
            $('[name="edit_pendapatan"]').val(data.id_pendapatan);
            $('[name="edit_bidang"]').val(data.id_bidang);
            $('[name="edit_program"]').val(data.id_program);
            $('[name="edit_subprogram"]').val(data.id_realisasi);
            $('[name="edit_pembiayaan"]').val(data.id_pembiayaan);
            $('[name="apendapatan"]').val(data.realisasi+" ( "+data.parent+" )");
            $('[name="aanggaran"]').val(data.anggaran_menjadi);
            $('[name="aserapan"]').val(data.serapan);
            $('[name="atahun"]').val(data.tahun);
            $('[name="abulan"]').val(data.bulan);

            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Anggaran Sub Program');
            $('#labelAnggaran').text('Sub Program');
            $('#formBulan').show();
            $('#formSerapan').show();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function editAnggaranSubProgramTahun(id) {                
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('anggaran/editAnggaranSubProgramTahun/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_anggaran"]').val(data.id_anggaran);
            $('[name="edit_pendapatan"]').val(data.id_pendapatan);
            $('[name="edit_bidang"]').val(data.id_bidang);
            $('[name="edit_program"]').val(data.id_program);
            $('[name="edit_subprogram"]').val(data.id_realisasi);
            $('[name="edit_subprogramtahun"]').val(data.id_realisasi_pertahun);
            $('[name="edit_pembiayaan"]').val(data.id_pembiayaan);
            $('[name="apendapatan"]').val(data.realisasi+" ( "+data.parent+" )");
            $('[name="aanggaran"]').val(data.anggaran_menjadi);
            $('[name="atahun"]').val(data.tahun);
            $('#formBulan').hide();
            $('#formSerapan').hide();
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Anggaran Sub Program Pertahun');
            $('#labelAnggaran').text('Sub Program');            
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function editAnggaranPembiayaan(id) {                
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('anggaran/editAnggaranPembiayaan/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_anggaran"]').val(data.id_anggaran);
            $('[name="edit_pendapatan"]').val(data.id_pendapatan);
            $('[name="edit_bidang"]').val(data.id_bidang);
            $('[name="edit_pembiayaan"]').val(data.id_pembiayaan);
            $('[name="edit_subprogram"]').val(data.id_realisasi);
            $('[name="edit_program"]').val(data.id_program);
            $('[name="apendapatan"]').val(data.nama_pembiayaan);
            $('[name="aanggaran"]').val(data.anggaran_menjadi);
            $('[name="atahun"]').val(data.tahun);

            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Anggaran Pembiayaan');
            $('#labelAnggaran').text('Pembiayaan');
            $('#formBulan').hide();
            $('#formSerapan').hide();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function editAnggaranB(id) {                
        save_method = 'update';
        $('#form')[0].reset();

        //Load data dari ajax
        $.ajax({
          url: "<?php echo site_url('anggaran/editAnggaranB/') ;?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_anggaran"]').val(data.id_anggaran);
            $('[name="edit_pendapatan"]').val(data.id_pendapatan);
            $('[name="edit_bidang"]').val(data.id_bidang);
            $('[name="edit_program"]').val(data.id_program);
            $('[name="edit_pembiayaan"]').val(data.id_program);
            $('[name="apendapatan"]').val(data.nama_bidang);
            $('[name="aanggaran"]').val(data.anggaran_menjadi);
            $('[name="atahun"]').val(data.tahun);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Anggaran Bidang');
            $('#labelAnggaran').text('Bidang');
            $('#formBulan').hide();
            $('#formSerapan').hide();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal mendapatkan data dari ajax!');
          }
        });
      }

      function deleteAnggaran(id) {
        // hapus data dari database dengan ajax
        if (confirm('Anda yakin akan menghapus data ini?')) {
          $.ajax({
          url: "<?php echo site_url('anggaran/deleteAnggaran/') ;?>/"+id,
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
      