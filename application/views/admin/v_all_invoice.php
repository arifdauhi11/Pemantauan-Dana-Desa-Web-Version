    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Invoice</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard') ?>">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Invoice
                  </li>
                </ol>
              </div>
            </div>
          </div>          
        </div>
        <div class="row">
          <div class="col-md-12">            
            <div id="myalert">
            <?php if ($this->session->flashdata('alert')) {
              echo $this->session->flashdata('alert');
            } ?>
            </div>
          </div>
        </div>        
        <br>
        <div class="row">
          <div class="col-md-12">
            <div class="card buatInvoice" id="cardBuatInvoice">
              <div class="card-header">
                <h4 class="card-title">Buat Invoice <?php echo "Hy" ?></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>                
              </div>
              <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <form id="formInvoice" class="form" method="POST" action="<?php echo base_url('invoice/add_action/'.$pelanggan->id_pelanggan) ?>">
                      <div class="form-body">
                        <div class="form-group">
                          <label for="userinput5">No. Invoice</label>
                          <div class="row">
                            <div class="col-md-6">
                              <input name="invoice1" class="form-control border-primary pull-right" type="text" placeholder="M2N-GTO.<?php echo date('Y') ?>.INV." disabled="">
                            </div>
                            <div class="col-md-3">
                              <input name="invoice2" class="form-control border-primary pull-right" type="number" placeholder="00" value="<?= set_value('invoice2');?>">
                            </div>
                            <div class="col-md-3">
                              <input name="invoice3" class="form-control border-primary pull-right" type="number" placeholder="000" value="<?= set_value('invoice3');?>">
                            </div>
                          </div>
                          <?php echo form_error('invoice2', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>                            
                          <?php echo form_error('invoice3', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Nama Pelanggan</label>
                          <input name="namaPL" class="form-control border-primary" type="text" placeholder="Nama Pelanggan" readonly="" value="<?= $pelanggan->nama_pelanggan ?>">
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Alamat Pelanggan</label>
                          <input name="alamatPL" class="form-control border-primary" type="text" placeholder="Alamat Pelanggan" readonly="" value="<?= $pelanggan->alamat_pelanggan ?>">
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Tanggal</label>
                          <input name="tanggal" class="form-control border-primary" type="date" placeholder="Tanggal" value="<?= set_value('tanggal') ?>">
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Tahun</label>
                          <input name="tahun" class="form-control border-primary" type="number" placeholder="Tahun" value="<?= set_value('tahun') ?>">
                          <?php echo form_error('tahun', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Total Tagihan</label>
                          <input name="tagihan" class="form-control border-primary" type="number" placeholder="Contoh : 1000000" value="<?= set_value('tagihan');?>">
                          <?php echo form_error('tagihan', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Terbilang</label>
                          <input name="terbilang" class="form-control border-primary" type="text" placeholder="Contoh : Satu Juta Rupiah" value="<?= set_value('terbilang');?>">
                          <?php echo form_error('terbilang', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="userinput5">Bulan</label>
                              <select class="select2 form-control border-primary" multiple="multiple" name="bulan[]" value="<?= set_value('bulan[]');?>">
                                <optgroup label="Pilih Bulan">
                                  <option value="Januari">Januari</option>
                                  <option value="Februari">Februari</option>
                                  <option value="Maret">Maret</option>
                                  <option value="April">April</option>
                                  <option value="Mei">Mei</option>
                                  <option value="Juni">Juni</option>
                                  <option value="Juli">Juli</option>
                                  <option value="Agustus">Agustus</option>
                                  <option value="September">September</option>
                                  <option value="Oktober">Oktober</option>
                                  <option value="November">November</option>
                                  <option value="Desember">Desember</option>
                                </optgroup>                        
                              </select>                  
                              <?php echo form_error('bulan', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>
                        </div>                
                        <div class="form-group">
                          <label for="userinput5">Status Tagihan</label>
                          <fieldset class="radio">
                              <label>
                                <input type="radio" name="radioPL" value="pending" value="<?= set_value('radioPL');?>">
                                Tunda
                              </label>
                              <br>
                              <label>
                                <input type="radio" name="radioPL" value="paid" value="<?= set_value('radioPL');?>">
                                Bayar
                              </label>
                          </fieldset>
                          <?php echo form_error('radioPL', '<p class="badge-default badge-danger block-tag text-left"><small class="block-area white">', '</small></p>'); ?>
                        </div>
                      </div>

                      <div class="form-actions right">
                        <button type="submit" class="btn btn-success mr-1">
                          <i class="ft-save"></i> Save
                        </button>                        
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <script type="text/javascript">      
      
    </script>