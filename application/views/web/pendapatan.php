<div class="page-title grey">
    <div class="container">
        <div class="title-area text-center">
            <h2 id="titleTahun">Pendapatan Tahun Anggaran <?php echo $this->uri->segment(3); ?></h2>
            <div class="bread">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                    <li class="active">Pendapatan</li>
                </ol>
            </div><!-- end bread -->
        </div><!-- /.pull-right -->
    </div>
</div><!-- end page-title -->
<section class="section white">
    <div class="container">        
        <div class="col-md-12">
            <div class="content-widget">
                            <div class="general-title text-center">
                            <!-- <h4>Pendapatan Desa</h4> -->
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
                            </div><!-- end general title -->                        
                            <table class="table table-bordered">
                                <?php if ($apendapatan) { ?>
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th class="text-center">
                                            Pendapatan
                                        </th>
                                        <th class="text-center">
                                            Anggaran Semula
                                        </th>
                                        <th class="text-center">
                                            Anggaran Menjadi
                                        </th>
                                        <th class="text-center">
                                            Bertambah / Berkurang
                                        </th>
                                    </tr>                                    
                                </thead>                                
                                <tbody>            
                                    <?php 
                                        $no = 1;
                                        foreach ($apendapatan as $p) { 
                                        $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                                        $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                                        ?>
                                                                                    
                                    <tr>
                                        <td><?php echo $no++?></td>
                                        <td><?php echo $p->sumber_pendapatan ?></td>
                                        <td><?php echo $semula?></td>
                                        <td><?php echo $menjadi?></td>
                                        <td><?php echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.'); ?></td>
                                    </tr> 

                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td>Jumlah PENDAPATAN</td>
                                        <td><?php $sum = 0;
                                            foreach($apendapatan as $p)
                                            {
                                               $sum+= $p->anggaran_semula;
                                            }
                                            echo $sum = "Rp. " . number_format($sum,2,',','.'); ?>
                                        </td>
                                        <td><?php $sum = 0;
                                            foreach($apendapatan as $p)
                                            {
                                               $sum+= $p->anggaran_menjadi;
                                            }
                                            echo $sum = "Rp. " . number_format($sum,2,',','.'); ?>
                                        </td>
                                        <td><?php $sum = 0;
                                            foreach($apendapatan as $p)
                                            {   
                                               $bb = $p->anggaran_semula - $p->anggaran_menjadi;
                                               $sum+= $bb;
                                            }
                                            echo "Rp. ". number_format(abs($sum),2,',','.'); ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="content-widget">                                            
                                            <blockquote>Data pendapatan untuk tahun anggaran <?php echo $this->uri->segment(3); ?> belum tersedia.</blockquote>
                                        </div><!-- end content-widget -->
                                    </div>
                                <?php } ?>
                            </table>
                        </div><!-- end content-widget -->
                    </div><!-- end col -->
    </div><!-- end container -->
</section><!-- end section -->
<script type="text/javascript">

    function myFunction() {   
        var tahun = $('#mySelect').val();
        window.location = '<?php echo base_url('web/pendapatan/') ?>'+tahun;
    }
</script>