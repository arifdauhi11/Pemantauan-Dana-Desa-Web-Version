<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->


<!-- Mirrored from showwp.com/demos/ws-garden/index-boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Oct 2019 10:57:06 GMT -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <title><?php echo $judul; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assetsweb/images/icon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assetsweb/images/apple-touch-icon-152x152.png">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/rs-plugin/css/settings.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/css/carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/style.css">

    <!-- COLORS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assetsweb/css/custom.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="boxed">

    <div id="loader">
        <div class="loader-container">
            <img src="<?php echo base_url(); ?>assetsweb/images/block.gif" alt="" class="loader-site spinner" width="75px" height="75px">
        </div>
    </div>

    <div id="wrapper">
        <div class="topbar clearfix">
            <div class="container">
                <div class="row-fluid">
                    <div class="col-md-4 text-left">
                        <div class="social">
                            <a href="#" data-tooltip="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-tooltip="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-tooltip="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" data-tooltip="tooltip" data-placement="bottom" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                            <a href="#" data-tooltip="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                            <a href="#" data-tooltip="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                        </div><!-- end social -->
                    </div><!-- end left -->
                    <div class="col-md-8 text-right">
                        <p>
                            <strong><i class="fa fa-phone"></i></strong> +62 812 345 678 90 &nbsp;&nbsp;
                            <strong><i class="fa fa-envelope"></i></strong> <a href="mailto:info@sidandes.000webhostapp.com">info@pddtimteng.com</a>&nbsp;&nbsp;
                            <input type="button" class="btn btn-default" value="Login" onclick="window.open('<?php echo base_url('auth') ?>')">
                        </p>
                    </div><!-- end left -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end topbar -->

        <header class="header">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <nav class="navbar yamm navbar-default">
                            <div class="container-full">
                                <div class="navbar-table">
                                    <div class="navbar-cell">
                                        <div class="navbar-header">
                                            <a class="navbar-brand" href="<?php echo site_url() ?>beranda"><img src="<?php echo base_url(); ?>assetsweb/images/logo.png" height="80px" width="220px" alt="Ova"></a>
                                        </div><!-- end navbar-header -->
                                    </div><!-- end navbar-cell -->

                                    <div class="navbar-cell stretch">
                                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                            <div class="navbar-cell">
                                                <ul class="nav navbar-nav navbar-right">
                                                    <li><a href="<?php echo site_url() ?>beranda" class="<?php if ($this->uri->segment(1) == "") {
                                                                                                                echo "active";
                                                                                                            }elseif ($this->uri->segment(1) == "beranda") {
                                                                                                                echo "active";
                                                                                                            } ?>">Beranda</a>
                                                    </li>
                                                    <li><a href="<?php echo site_url('web/dandes/'.date("2019")) ?>" class="<?php if ($this->uri->segment(2) == "dandes") {
                                                                                                            echo "active";
                                                                                                        } ?>">Dana Desa</a>
                                                    </li>
                                                    <li><a href="<?php echo site_url() ?>web/galeri" class="<?php if ($this->uri->segment(2) === "galeri") {
                                                                                                            echo "active";
                                                                                                        } ?>">Galeri</a></li>
                                                    <li><a href="<?php echo site_url() ?>tentang" class="<?php if ($this->uri->segment(1) === "tentang") {
                                                                                                                echo "active";
                                                                                                            } ?>">Tentang</a></li>
                                                    <li><a href="<?php echo site_url() ?>kontak" class="<?php if ($this->uri->segment(1) == "kontak") {
                                                                                                            echo "active";
                                                                                                        } ?>">Kontak</a></li>
                                                </ul>
                                            </div><!-- end navbar-cell -->
                                        </div><!-- /.navbar-collapse -->
                                    </div><!-- end navbar cell -->
                                </div><!-- end navbar-table -->
                            </div><!-- end container fluid -->
                        </nav><!-- end navbar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </header>