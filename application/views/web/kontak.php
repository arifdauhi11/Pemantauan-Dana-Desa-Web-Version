<div class="page-title grey">
    <div class="container">
        <div class="title-area text-center">
            <h2>Kontak</h2>
            <div class="bread">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                    <li class="active">Kontak</li>
                </ol>
            </div><!-- end bread -->
        </div><!-- /.pull-right -->
    </div>
</div><!-- end page-title -->

<section class="section white">
    <div class="container">
        <div class="general-title text-center">
            <h4>Kontak Details</h4>
            <p class="lead">Kirimkan saran anda</p>
            <hr>
        </div><!-- end general title -->

        <div class="row">
            <div class="col-md-8">
                <div class="appoform-wrapper noborder">

                    <div class="contact_form">
                        <?php if ($this->session->flashdata('alert')) {
                            echo $this->session->flashdata('alert');
                         } ?>
                        <form id="contactform" class="row" action="<?php echo base_url('web/saranAction') ?>" name="contactform" method="post">
                            <fieldset class="row-fluid appoform">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="nik" class="form-control" placeholder="NIK" required="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" name="saran" id="comments" rows="6" placeholder="Masukkan Saran" required=""></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <button type="submit" value="SEND" id="submit" class="btn btn-primary btn-block btn-lg"> Kirim Saran</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div><!-- end form-container -->
            </div><!-- end col -->
            <div class="col-md-4">
                <div class="workinghours">
                    <ul>                        
                        <li>Telepon <span>+62 852 9720 1300</span></li>
                        <li>E-Mail <span>admin@pddtimteng.com</span></li>
                        <li>Website <span>pddtimteng.com</span></li>
                    </ul>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end section -->