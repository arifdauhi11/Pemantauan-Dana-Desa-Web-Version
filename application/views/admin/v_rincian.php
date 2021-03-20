<?php $idSubProg = '';
      $se = '';
      $me = '';
      $ju = 0;
      foreach ($rincianTahunSub2 as $key => $value) {
        $se = $value->anggaran_semula;
        $me = $value->anggaran_menjadi;
        if ($value->anggaran_menjadi > 0) {
          $ju += $me;        
        }else{
          $ju += $se;          
        }
      }      
      
      $id = $this->uri->segment(3);
      $tahun1 = $this->uri->segment(4);
      $jSerapan = 0;
      $jA = 0;
      foreach ($rincianTahunSub2 as $key => $value) {        
        $idSub = $value->id_realisasi;
        $subProg = $this->m_anggaran->rincianTahunSub($id,$idSub,$tahun1)->result();
        foreach ($subProg as $key => $value) {          
          $jSerapan += $value->serapan;
        }                
      }
      $jumlahSerapan = "Rp. " . number_format($jSerapan,2,',','.');
      echo $jumlahSerapan;
      // die;
?>
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
      <div class="col-md-4">
        <div class="form-group">
          <label>Lihat tahun lainnya</label>
          <select class="form-control" onchange="myFunction()" id="mySelect">
            <?php $no = 1; foreach ($tahun as $key) { ?>
            <option value="<?php echo $key->tahun ?>" <?php if ($this->uri->segment(4) == $key->tahun) {
              echo "selected";
            } ?>><?php echo $key->tahun ?></option>
            <?php } ?>              
          </select>
        </div>
      </div>
      <div class="col-md4">
      <?php        
        if ($this->session->flashdata('message')) { 
          echo '<div id="myalert">' . $this->session->flashdata('message') . '</div>'; // Tampilkan pesannya
        }
      ?>  
      </div>      
      <!-- Main row -->                  
      <!-- /.row (main row) -->
      <div class="row">
        <div class="col-xs-12">          
          <div class="box">
            <?php if ($rincianTahun) { ?>
              <?php $no = 1; foreach ($rincianTahun as $row) {
                  $semulaTahunan = "Rp. " . number_format($row->anggaran_semula,2,',','.');
                  $menjadiTahunan = "Rp. " . number_format($row->anggaran_menjadi,2,',','.');
                  if ($row->anggaran_menjadi > 0) {
                    $persentaseTahunan = $row->anggaran_menjadi / $row->anggaran_menjadi * 100;                    
                  } else {
                    $persentaseTahunan = $row->anggaran_semula / $row->anggaran_semula * 100;
                  }
                 ?>
            <!-- <div class="box-header"> -->
              <center><h3>Program / Pembiayaan</h3></center>              
              <div class="box-body">
              <table class="table table-striped table-bordered">                                                              
                <tr>
                  <th class="text-center" style="width: 10px">#</th>
                  <th class="text-center">Program</th>
                  <th class="text-center" style="width: 200px">Anggaran</th>
                  <th class="text-center" style="width: 200px">Terserap</th>
                  <th class="text-center" style="width: 200px">Sisa</th>
                  <th class="text-center" style="width: 150px">Tahun</th>
                </tr>    
                <tr>
                  <td class="text-center">#</td>
                  <td class="text-center"><?php echo $row->rincian_anggaran_program ?></td>
                  <td class="text-center">
                    <?php if ($row->anggaran_menjadi > 0) {
                      echo $menjadiTahunan;
                    } else {
                      echo $semulaTahunan;
                    } ?>
                  </td>
                  <td class="text-center">
                    <?php echo $jumlahSerapan ?>
                  </td>
                  <td class="text-center">
                    <?php if ($row->anggaran_menjadi > 0) {
                      $sisa = "Rp. " . number_format($row->anggaran_menjadi - $jSerapan,2,',','.');                      
                      echo $sisa;
                    } else {
                      $sisa = "Rp. " . number_format($row->anggaran_semula - $jSerapan,2,',','.');                      
                      echo $sisa;
                    } ?>
                  </td>
                  <td class="text-center">
                    <?php echo $this->uri->segment(4) ?>
                  </td>
                </tr>                                            
              </table>
              </div>
              <br>
              <center><h3>Sub Program / Pembiayaan Pertahun</h3></center>
              <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center" style="width: 10px">#</th>
                  <th class="text-center">Sub Program / Pembiayaan</th>
                  <th class="text-center" style="width: 200px">Anggaran</th>
                  <th class="text-center" style="width: 150px">Tahun
                  <th class="text-center" style="width: 40px">Persentase</th>
                  <th class="text-center" style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody> 
                <?php 
                $no = 1;
                $jumlah = 0;
                $jpersentase = 0;
                $kam = 0;
                foreach ($rincianTahunSub2 as $key) {
                    $idSubProg = $key->id_realisasi;
                    $semula = "Rp. " . number_format($key->anggaran_semula,2,',','.');
                    $menjadi = "Rp. " . number_format($key->anggaran_menjadi,2,',','.');  
                    if ($key->anggaran_menjadi > 0) {                     
                     $jumlah += $key->anggaran_menjadi;
                    } else {                     
                     $jumlah += $key->anggaran_semula;
                    }                     
                  ?>               
                <tr>
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-center"><?php echo $key->realisasi; ?></td>
                  <td class="text-center">
                    <?php                   
                   if ($key->anggaran_menjadi > 0) {                     
                     echo $menjadi;
                     $kam = $key->anggaran_menjadi;
                    } else {
                     echo $semula;
                     $kam = $key->anggaran_semula;
                    } ?>
                  </td>
                  <td class="text-center">
                    <?php echo $this->uri->segment(4) ?>
                  </td>
                  <td class="text-center"><span class="badge bg-red">
                    <?php                   
                   if ($row->anggaran_menjadi > 0) {
                      if ($key->anggaran_menjadi > 0) {
                       $persentase = $key->anggaran_menjadi * 100;                                         
                       $p = $persentase / $row->anggaran_menjadi;
                       echo round($p);
                      } else {
                       $persentase = $key->anggaran_semula * 100;                                         
                       $p = $persentase / $row->anggaran_menjadi;
                       echo round($p);
                      }                     
                    } else {
                     if ($key->anggaran_menjadi > 0) {
                       $persentase = $key->anggaran_menjadi * 100;                                         
                       $p = $persentase / $row->anggaran_semula;
                       echo round($p);
                      } else {
                       $persentase = $key->anggaran_semula * 100;                                         
                       $p = $persentase / $row->anggaran_semula;
                       echo round($p);
                      }
                    } ?>%</span></td>
                    <td>
                      <button onclick="detailSub('<?php echo $key->id_realisasi ?>')" class="btn btn-primary btn-sm"><i class="fa fa-search-plus"></i><strong> Detail</strong></button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>   
                <tfoot>
                <tr>
                  <th class="text-center" style="width: 10px">#</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center" style="width: 200px">
                    <?php echo "Rp. ". number_format($jumlah, 2, ',', '.');?>
                  </th>
                  <th class="text-center" style="width: 150px">Tahun</th>
                  <th class="text-center" style="width: 40px"><span class="badge bg-red">
                    <?php if ($row->anggaran_menjadi > 0) {
                      $subPerTahun = $jumlah / $row->anggaran_menjadi * 100;                      
                    } else {
                      $subPerTahun = $jumlah / $row->anggaran_semula * 100;                      
                    }echo round($subPerTahun); ?>%</span></th>
                    <th></th>
                </tr>
                </tfoot>             
              </table>
            </div>  
              <br>
              <div id="subProgramPerbulan">
                <center><h3>Sub Program / Pembiayaan Perbulan</h3></center>
                <!-- </div> -->
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center" style="width: 10px">#</th>
                      <th class="text-center" style="width: 200px">Sub Program / Pembiayaan</th>
                      <th class="text-center" style="width: 200px">Anggaran</th>
                      <th class="text-center" style="width: 200px">Serapan</th>
                      <th class="text-center" style="width: 200px">Sisa</th>
                      <th class="text-center" style="width: 150px">Tahun <span class="badge bg-green">Bulan</span></th>
                      <th class="text-center" style="width: 40px">Persentase</th>
                    </tr>
                    </thead>
                    <tbody id="tableSubProgram">  
                      
                    </tbody>   
                    <tfoot>
                    <tr>
                      <th class="text-center" style="width: 10px">#</th>
                      <th class="text-center">Jumlah</th>
                      <th class="text-center" style="width: 200px" id="thJumlah">afaf</th>
                      <th></th>
                      <th></th>
                      <th class="text-center" style="width: 150px">Tahun <span class="badge bg-green">Bulan</span></th>
                      <th class="text-center" style="width: 40px"><span id="thJumlahPersen" class="badge bg-red"></span></th>
                    </tr>
                    </tfoot>             
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <br>
              <div id="subPP">
                <center><h3>Sub Program / Pembiayaan Perbulan</h3></center>
                <!-- </div> -->
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row" id="subProgramPerbulan2">
                    
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
          </div>
          <?php } ?>
          <!-- /.box -->
          <?php } else { ?>
              <div class="box-header">
              <h1>Data belum tersedia</h1>
              </div>
            <?php } ?>
        </div>
        <!-- /.col -->
      </div>      
    </section>
    <!-- /.content -->      
</div>    
<script type="text/javascript">
  window.onload = function () {
    $('#subProgramPerbulan').hide();
    $('#subPP').hide();
  }  

  function detailSub(idSub) {
    // $('#subProgramPerbulan').slideUp();
    $('#subPP').slideUp();
    var id = '<?php echo $this->uri->segment(3) ?>';
    var tahun = '<?php echo $this->uri->segment(4) ?>';    
    $('#subProgramPerbulan2').empty();
    $.ajax({
      url: "<?php echo site_url('realisasi/detailSub/') ;?>"+id+'/'+idSub+'/'+tahun,
      type: "GET",
      dataType: "JSON",
      success: function(data) {        
        if (data != '') {
          $('#tableSubProgram').slideDown();          
          $('#subPP').slideDown();
        } else {
          alert("Data belum tersedia!");
        }
        var no = 1;
        var jParent = 0;
        var asemula = 0;
        var amenjadi = 0;
        var realisasi = '';
        var anggaran = '';
        var semula = '';
        var menjadi = '';
        var serapan = '';
        var tahun = '';
        var bulan = '';
        var jumlah = '';
        var p = 0;
        var jP = 0;
        for (var i = 0; i < data.length; i++) {                
          jParent = data[i].anggaran;
          asemula = data[i].asemula;
          amenjadi = data[i].amenjadi;
          jumlah = data[i].jumlah;
          if (amenjadi > 0) {
            p = amenjadi / jParent * 100;
          } else {
            p = asemula / jParent * 100;
          }
          realisasi = data[i].realisasi;
          semula = data[i].semula;
          menjadi = data[i].menjadi;
          if (menjadi = 'Rp. 0,00') {
            anggaran = semula;
          } else {
            anggaran = menjadi;
          }
          serapan = data[i].serapan;
          sisa = data[i].sisa;
          tahun = data[i].tahun;
          bulan = data[i].bulan;
          jP += p;          
          $('#tableSubProgram').append('<tr><td>'+no+++'</td><td>'+realisasi+'</td><td>'+anggaran+'</td><td>'+serapan+'</td><td>'+sisa+'</td><td>'+tahun+' <span class="badge bg-green">'+bulan+'</span></td><td><span class="badge bg-red">'+Math.round(p)+'%</span></td></tr>');
          $('#subProgramPerbulan2').append('<div class="col-md-6"><div class="box box-success"><div class="box-body box-profile"><h3 class="profile-username text-center">'+realisasi+'</h3><p class="text-muted text-center">'+tahun+'</p><ul class="list-group list-group-unbordered"><li class="list-group-item"><b>Bulan</b> <a class="pull-right badge bg-green">'+bulan+'</a></li><li class="list-group-item"><b>Anggaran</b> <a class="pull-right">'+anggaran+'</a></li><li class="list-group-item"><b>Serapan</b> <a class="pull-right">'+serapan+'</a></li><li class="list-group-item"><b>Sisa</b> <a class="pull-right">'+sisa+'</a></li></ul></div></div></div>');
          }

        $('#thJumlah').text(jumlah);
        $('#thJumlahPersen').text(Math.round(jP)+'%');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Gagal mendapatkan data dari ajax!');
        console.log(jqXHR);        
        console.log(textStatus);        
        console.log(errorThrown);                
      }
    });
  }
  
  function myFunction() {   
      var tahun = $('#mySelect').val();
      window.location = '<?php echo base_url('realisasi/rincian/') ?>'+'<?php echo $this->uri->segment(3) ?>/'+tahun;
  }

</script>    