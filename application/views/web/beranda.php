<section class="section grey">
    <div class="container">
        <div class="general-title text-center">
            <h4>Pendapatan Desa</h4>
            <p class="lead">List pendapatan Desa tahun <?= $tahun ?></p>
            <hr>
        </div><!-- end general title -->

        <div class="row module-wrapper text-center">
            <?php $no = 0;
             foreach ($apendapatan as $a) {
             $rupiah = number_format($a->anggaran_semula,2,",","."); ?>             
            <div class="col-md-6 col-sm-3 why-us">
                <!-- <img src="<?php echo base_url(); ?>assetsweb/images/icons/money.png" alt="" class="wow fadeIn">                     -->
                <div class="plan">
                    <strong><?php echo $a->sumber_pendapatan ?></strong>
                    <div class="price">
                        <h4><span class="symbol">Rp</span><?php echo $rupiah ?></h4>
                    </div>
                </div>
            </div><!-- end col -->
            <?php } ?>  
            <div class="col-md-4"></div>          
            <div class="col-md-4 col-sm-3 why-us">
                <div class="plan">
                    <strong>JUMLAH</strong>
                    <div class="price">
                        <?php $jumlah = number_format($jumlah['jumlah'] ,2,",","."); ?>
                        <h4><span class="symbol">Rp</span><?= $jumlah ?></h4>
                    </div>
                    <a class="btn btn-primary" href="<?php echo site_url('web/pendapatan/'.$tahun) ?>">Rincian</a>
                </div>
            </div><!-- end col -->
            <div class="col-sm-4"></div>
        </div><!-- end module-wrapper -->
    </div><!-- end container -->
</section><!-- end section -->

<section class="section white">
    <div class="container">
        <div class="general-title text-center">
            <h4>Anggaran Bidang</h4>
            <p class="lead">List anggaran bidang tahun <?= $tahun ?></p>
            <hr>
        </div><!-- end general title -->
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
    </div><!-- end container -->
</section><!-- end section -->

<section class="section grey">
    <div class="container">
        <div class="general-title text-center">
            <h4>Pemerintah Desa</h4>
            <p class="lead">List Pemerintah Desa</p>
            <hr>
        </div><!-- end general title -->        
        <div class="row module-wrapper text-center">            
            <div class="col-md-12">
                <div class="content-widget">
                    <div class="media-element">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <?php foreach ($pemdes as $p) {?>
                                        <div class="col-md-3 col-sm-3 team-member">
                                            <div class="entry">
                                                <img style="width: 440px; height: 300px" class="img-responsive" src="<?php echo base_url('assets/images/pemdes/').$p->foto; ?>" alt="">                                            
                                            </div><!-- end entry -->
                                            <h4><?php echo $p->nama_pemdes ?></h4>
                                            <p><?php echo $p->jabatan ?></p>
                                        </div><!-- end team_member -->                                        
                                    <?php } ?>
                                </div>                                
                            </div>
                        </div>
                    </div><!-- end blog-image -->
                </div><!-- end content-widget -->
            </div>
        </div><!-- row -->
    </div><!-- end container -->
</section><!-- end section -->

<section class="section white padding-bottom">
    <div class="container">
        <div class="general-title text-center">
            <h4>Saran Warga</h4>
            <p class="lead">List saran warga</p>
            <hr>
        </div><!-- end general title -->

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row testimonials">
                    <?php $no = 1;
                        foreach ($saran as $s) { ?>
                        <div class="col-sm-4">
                            <blockquote>
                                <p class="clients-words"><?php echo $s->saran ?></p>
                                <span class="clients-name text-primary">— <?php echo $s->nama ?></span>
                                <img class="img-circle img-thumbnail" src="<?php echo base_url('assets/images/'.$s->image); ?>" alt="">
                            </blockquote>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div><!-- end container -->
</section><!-- end section -->