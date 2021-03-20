<div class="page-title grey">
    <div class="container">
        <div class="title-area text-center">
            <h2>Galeri</h2>
            <div class="bread">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                    <li class="active">Galeri</li>
                </ol>
            </div><!-- end bread -->
        </div><!-- /.pull-right -->
    </div>
</div><!-- end page-title -->

<section class="section white">
            <div class="container">
                <div class="row module-wrapper grid-layout text-center">
                    <?php $no = 0;
                        foreach ($galeri as $g) {?>                         
                    <div class="col-md-4 col-sm-4 shop-item">
                        <div class="entry">
                            <img class="img-responsive" src="<?php echo base_url('assets/images/multiple/') ?><?php echo $g->nama_gambar ?>" style="width: 400px; height: 300px" alt="">
                            <div class="magnifier">
                                <div class="buttons">
                                    <a class="st" rel="bookmark" data-rel="prettyPhoto" href="<?php echo base_url('assets/images/multiple/') ?><?php echo $g->nama_gambar ?>"><span class="fa fa-search"></span></a>
                                    <a class="st" rel="bookmark" href="gallery-single.html"><span class="fa fa-link"></span></a>
                                </div>
                            </div><!-- end magnifier -->
                        </div><!-- end entry -->
                        <h4><a href="gallery-single.html"><?php echo $g->nama_bidang ?></a></h4>
                    </div><!-- end gallery-item -->
                    <?php } ?>
                </div><!-- end row -->

                <br>

                <!-- <nav class="pagi clearfix text-center">
                    <ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul>
                </nav> -->

            <?php echo $pagination; ?>        

            </div><!-- end container -->
        </section>