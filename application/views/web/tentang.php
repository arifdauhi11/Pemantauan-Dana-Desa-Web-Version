<section class="section darkbg fullscreen paralbackground parallax" style="background-image:url('upload/parallax_01.jpg');" data-img-width="1688" data-img-height="1125" data-diff="100">
    <div class="overlay lightoverlay"></div>
    <div class="container">
        <div class="title-area text-center">
            <h2>Tentang</h2>
            <div class="bread">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                    <li class="active">Tentang</li>
                </ol>
            </div><!-- end bread -->
        </div><!-- /.pull-right -->
    </div>
</section><!-- end page-title -->

<section class="section white">
    <div class="container about-us">
        <div class="general-title text-center">
            <h4>SELAMAT DATANG DI WEBSITE <br>PENGAWASAN DANA DESA TIMBUOLO TENGAH</h4>
            <p class="lead">Listed below reasons to choose us! We are active we are professional!</p>
            <hr>
        </div><!-- end general title -->
        <div class="text-center">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since theown printer took.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since theown printer took. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since theown printer took. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since theown printer took.</p>
        </div>
        <hr class="invis">
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