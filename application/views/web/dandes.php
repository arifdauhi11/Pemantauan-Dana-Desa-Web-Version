<div class="page-title grey">
    <div class="container">
        <div class="title-area text-center">
            <h2>Dana Desa</h2>
            <div class="bread">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                    <li class="active">Dana Desa</li>
                </ol>
            </div><!-- end bread -->
        </div><!-- /.pull-right -->
    </div>
</div><!-- end page-title -->
<section class="section white">
    <div class="container">
        <div class="general-title text-center">
            <h4>Anggaran Bidang</h4>
            <p class="lead">List anggaran bidang tahun <?= $this->uri->segment(3) ?></p>
        </div><!-- end general title -->
        <div class="general-title text-center">
        
        <p class="lead">Lihat tahun lainnya
        </p>
        <hr>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-1"></div>

            <div class="col-md-2">
            <div class="row">                                    
                <select class="form-control text-center" id="mySelect" onchange="myFunction()">     
                    <?php $no = 1; foreach ($ta as $t) { ?>                                                
                        <option value="<?php echo $t->tahun ?>" <?php if ($this->uri->segment(3) == $t->tahun) {
                            echo 'selected=""';
                        } ?>><?php echo $t->tahun ?></option>
                    <?php } ?>
                </select>
                <br>

                </div>
            </div>
        </div>
        <?php if ($abidang) { ?>                    
        <div class="pricing-tables">
            <div class="row">
                <?php $no = 0;
                    $jbidang = $this->db->count_all('t_bidang');
                    foreach ($abidang as $a) {
                    $rupiah = number_format($a->anggaran_semula,0,",",".");
                    if ($jbidang <= 4) {?>                     
                <div class="col-sm-4 col-md-6">
                    <div class="plan" style="background: #f7f8fa;">
                        <div class="head">
                            <h2><?php echo $a->nama_bidang ?></h2>
                        </div>
                        <div class="price">
                            <h3><span class="symbol">Rp</span><?php echo $rupiah ?></h3>
                            <h5>Tahun <?php echo $a->tahun ?></h5>
                        </div>
                        <a href="<?php echo base_url('web/program/'.$a->tahun."/".$a->id_bidang) ?>" class="btn btn-default">Rincian</a>
                    </div>
                </div>
                <?php }else { ?>
                <div class="col-sm-4 col-md-4">
                    <div class="plan" style="background: #f7f8fa;">
                        <div class="head">
                            <h2><?php echo $a->nama_bidang ?></h2>
                        </div>
                        <div class="price">
                            <h3><span class="symbol">Rp</span><?php echo $rupiah ?></h3>
                            <h5>Tahun <?php echo $a->tahun ?></h5>
                        </div>
                        <a href="<?php echo base_url('web/program/'.$a->tahun."/".$a->id_bidang) ?>" class="btn btn-default">Rincian</a>
                    </div>
                </div>
                <?php } }?>
            </div> <!-- row-->
        </div> <!-- pricing-tables -->
        <?php } else { ?>
            <center>                
                <div>                
                    <blockquote>Data bidang untuk tahun anggaran <?php echo $this->uri->segment(3); ?> belum tersedia.</blockquote>
                </div>
            </center>
        <?php } ?>

    </div><!-- end container -->
</section><!-- end section -->
<script type="text/javascript">

    function myFunction() {   
        var tahun = $('#mySelect').val();
        window.location = '<?php echo base_url('web/dandes/') ?>'+tahun;
      }
</script>