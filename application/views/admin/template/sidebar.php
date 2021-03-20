<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/images/'); ?><?= $user['image'] ?>" class="img-circle" alt="User Image">
        <p></p>
      </div>
      <div class="pull-left info">
        <p><?= $user['nama'] ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Cari...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->    
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">Menu Utama</li>
          <li class="<?php if ($this->uri->segment(1) == "dashboard") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('dashboard'); ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <?php if ($this->session->userdata('role_id') === '1') : ?>
          <li class="treeview <?php if ($this->uri->segment(1) == "bidang") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "subbidang") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "sumberpendapatan") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "pembiayaan") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "program") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "subprogram") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "koderekening") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "anggaran") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "tahunanggaran") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "realisasi") {
                        echo "active";
                      } ?>" style="height: auto;">
          <a href="#">
            <i class="fa fa-money"></i> <span>Data Dana Desa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php if ($this->uri->segment(1) == "bidang") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('bidang'); ?>">
              <i class="fa fa-archive"></i> <span>Bidang</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "subbidang") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('subbidang'); ?>">
              <i class="fa fa-archive"></i> <span>Sub Bidang</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "sumberpendapatan") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('sumberpendapatan'); ?>">
              <i class="fa fa-money"></i> <span>Sumber Pendapatan</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "pembiayaan") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('pembiayaan'); ?>">
              <i class="fa fa-credit-card"></i> <span>Pembiayaan</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "program") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('program'); ?>">
              <i class="fa fa-tasks"></i> <span>Program</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "subprogram") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('subprogram'); ?>">
              <i class="fa fa-tasks"></i> <span>Sub Program</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "koderekening") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('koderekening'); ?>">
              <i class="fa fa-credit-card"></i> <span>Kode Rekening</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "anggaran") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('anggaran'); ?>">
              <i class="fa fa-money"></i> <span>Anggaran</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "tahunanggaran") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('tahunanggaran'); ?>">
              <i class="fa fa-calendar"></i> <span>Tahun Anggaran</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "realisasi") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('realisasi'); ?>">
              <i class="fa fa-bars"></i> <span>Realisasi</span>
            </a>
          </li>          
          </ul>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "pemdes") {
                      echo "active";
                    } ?>">
          <a href="<?php echo base_url('pemdes'); ?>">
            <i class="fa fa-users"></i> <span>Pemerintah Desa</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "user") {
                      echo "active";
                    } ?>">
          <a href="<?php echo base_url('user'); ?>">
            <i class="ion ion-person-add"></i> <span>Aktivasi Pengguna</span>
          </a>
        </li>        
        <li class="<?php if ($this->uri->segment(1) == "saran") {
                      echo "active";
                    } ?>">
          <a href="<?php echo base_url('saran'); ?>">
            <i class="fa fa-comments"></i> <span>Saran</span>
          </a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "media") {
                      echo "active";
                    } ?>">
          <a href="<?php echo base_url('media'); ?>">
            <i class="fa fa-folder"></i> <span>Media</span>
          </a>
        </li>        
    </ul>
    <?php elseif ($this->session->userdata('role_id') === '3') : ?>
    <ul class="sidebar-menu" data-widget="tree">      
        <li class="<?php if ($this->uri->segment(1) == "program") {
                      echo "active";
                    } ?>">
          <a href="<?php echo base_url('program'); ?>">
            <i class="fa fa-tasks"></i> <span>Program</span>
          </a>
        </li>        
      <?php else : ?>
        <li class="treeview <?php if ($this->uri->segment(1) == "bidang") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "subbidang") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "sumberpendapatan") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "pembiayaan") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "program") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "subprogram") {
                        echo "active";
                      }else if ($this->uri->segment(1) == "koderekening") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "anggaran") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "tahunanggaran") {
                        echo "active";
                      } else if ($this->uri->segment(1) == "realisasi") {
                        echo "active";
                      } ?>" style="height: auto;">
          <a href="#">
            <i class="fa fa-money"></i> <span>Data Dana Desa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php if ($this->uri->segment(1) == "bidang") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('bidang'); ?>">
              <i class="fa fa-archive"></i> <span>Bidang</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "subbidang") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('subbidang'); ?>">
              <i class="fa fa-archive"></i> <span>Sub Bidang</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "sumberpendapatan") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('sumberpendapatan'); ?>">
              <i class="fa fa-money"></i> <span>Sumber Pendapatan</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "pembiayaan") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('pembiayaan'); ?>">
              <i class="fa fa-credit-card"></i> <span>Pembiayaan</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "program") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('program'); ?>">
              <i class="fa fa-tasks"></i> <span>Program</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "subprogram") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('subprogram'); ?>">
              <i class="fa fa-tasks"></i> <span>Sub Program</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "koderekening") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('koderekening'); ?>">
              <i class="fa fa-credit-card"></i> <span>Kode Rekening</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "anggaran") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('anggaran'); ?>">
              <i class="fa fa-money"></i> <span>Anggaran</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "tahunanggaran") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('tahunanggaran'); ?>">
              <i class="fa fa-calendar"></i> <span>Tahun Anggaran</span>
            </a>
          </li>
          <li class="<?php if ($this->uri->segment(1) == "realisasi") {
                        echo "active";
                      } ?>">
            <a href="<?php echo base_url('realisasi'); ?>">
              <i class="fa fa-bars"></i> <span>Realisasi</span>
            </a>
          </li>          
          </ul>
        </li>
      <?php endif; ?>
    </ul>

  </section>
  <!-- /.sidebar -->
</aside>