<?php $p = $this->db->get('t_program')->result(); 
      $jumlahProgram = count($p);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <?php if($this->session->userdata('role_id')==='1'):?>
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $jumlahBidang['jumlahBidang']; ?></h3>

              <p>Bidang</p>
            </div>
            <div class="icon">
              <i class="fa fa-archive"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $jumlahProgram ?></h3>

              <p>Program</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $inactive['inactive']; ?></h3>

              <p>Aktivasi Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <?php elseif($this->session->userdata('id_level')==='2'):?>
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">                
                <h3><?php echo $jumlahProgram ?></h3>

                <p>Program</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
            </div>
          </div>
        <?php else:?>
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $jumlahProgram ?></h3>

              <p>Program</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
          </div>
        </div>
        <?php endif;?>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
            <div class="col-md-5">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Galeri</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <?php $no = 0;
                    foreach ($media as $m) {?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $no++ ?>" class=""></li>
                    <?php }?>
                    <!-- <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li> -->
                  </ol>
                  <div class="carousel-inner">
                    <?php $no = 0;
                      foreach ($media as $m) {?>                    
                    <div class="item <?php if($m->id_gambar == '1'){
                      echo "active";
                    } ?>">
                      <img style="width: 500px;height: 250px" src="<?php echo base_url('assets/images/multiple/')?><?php echo $m->nama_gambar; ?>" alt="First slide">

                      <div class="carousel-caption">
                        <?php echo $m->nama_bidang; ?>
                      </div>
                    </div>
                    <?php }?>                    
                  </div>
                  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                  </a>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          <!-- /.box -->
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>