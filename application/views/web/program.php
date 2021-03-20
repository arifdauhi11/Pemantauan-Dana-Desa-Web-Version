<div class="page-title grey">
    <div class="container">
        <div class="title-area text-center">
            <h2 id="titleTahun">Program Tahun Anggaran <?php echo $this->uri->segment(3); ?></h2>
            <div class="bread">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                    <li class="active">Program</li>
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
                                <?php if ($aprogram) { ?>
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th class="text-center">
                                            Nama Program
                                        </th>
                                        <th class="text-center">
                                            Bidang
                                        </th>
                                        <th class="text-center">
                                            Sub Bidang
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
                                        foreach ($aprogram as $p) { 
                                        $semula = "Rp. " . number_format($p->anggaran_semula,2,',','.');
                                        $menjadi = "Rp. " . number_format($p->anggaran_menjadi,2,',','.'); 
                                        ?>
                                                                                    
                                    <tr>
                                        <td><?php echo $no++?></td>
                                        <td><?php echo $p->nama_program ?></td>
                                        <td><?php echo $p->nama_bidang ?></td>
                                        <td><?php echo $p->sub_bidang ?></td>
                                        <td><?php echo $semula?></td>
                                        <td><?php echo $menjadi?></td>
                                        <td><?php
                                            if ($menjadi == "Rp. 0,00") {
                                                echo "Rp. 0,00";
                                            } else {
                                                echo "Rp. ". number_format(abs($p->anggaran_semula - $p->anggaran_menjadi),2,',','.');
                                            }
                                        ?>                                            
                                        </td>
                                    </tr> 

                                    <?php } ?>
                                    <!-- <tr>
                                        <td></td>
                                        <td>Jumlah PENDAPATAN</td>
                                        <td><?php $sum = 0;
                                            foreach($aprogram as $p)
                                            {
                                               $sum+= $p->anggaran_semula;
                                            }
                                            echo $sum = "Rp. " . number_format($sum,2,',','.'); ?>
                                        </td>
                                        <td><?php $sum = 0;
                                            foreach($aprogram as $p)
                                            {
                                               $sum+= $p->anggaran_menjadi;
                                            }
                                            echo $sum = "Rp. " . number_format($sum,2,',','.'); ?>
                                        </td>
                                        <td><?php $sum = 0;
                                            foreach($aprogram as $p)
                                            {   
                                               $bb = $p->anggaran_semula - $p->anggaran_menjadi;
                                               $sum+= $bb;
                                            }
                                            echo "Rp. ". number_format(abs($sum),2,',','.'); ?>
                                        </td>
                                    </tr> -->
                                </tbody>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="content-widget">                                            
                                            <blockquote>Data program untuk tahun anggaran <?php echo $this->uri->segment(3); ?> belum tersedia.</blockquote>
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
        window.location = '<?php echo base_url('web/program/') ?>'+tahun+'/'+'<?php echo $this->uri->segment(4) ?>';
      }
</script>