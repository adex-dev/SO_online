<script> var judul = "Report AUDIT <?= $this->session->userdata('namastore'); ?>";</script>
<div class="container-fluid px-md-5">
  <div class="row d-md-flex align-content-md-center align-items-md-center min-vh-100">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-none">
          <h1 class="font-interbold mouse" onclick="window.location.href='<?= site_url('') ?>'">Jaygee Group <br><span class="fs-6 mt-0"><?= $this->session->userdata('namastore'); ?></span></h1><br>
          <div class="row">
            <div class="col-md-3 col-sm-6"><div class="d-flex justify-content-between mx-2"><span>TOTAL QTY :</span><h5><?= $buataudit->onhand_qty ?></h5></div></div>
            <div class="col-md-4 col-sm-6"><div class="d-flex justify-content-between mx-2"><span>TOTAL ONHAND SCAN GLOBAL :</span><h5 class="totalscanglobal"><?= !empty($buataudit->onhand_scan) ? $buataudit->onhand_scan : '0' ?></h5></div></div>
            <div class="col-md-5 col-sm-6"><div class="d-flex justify-content-between mx-2"><span>TOTAL ONHAND SCAN INDIVIDU :</span><h5 class="scanindividu"><?= !empty($buataudit2->onhand_scan) ? $buataudit2->onhand_scan : '0' ?></h5></div></div>
          </div>
        </div>
        <div class="card-body" style="min-height: 300px;">
          <div class="row">
            <div class="col-md-12 mb-3">
              <form action="">
                <input type="text" name="scanartikel" autocomplete="empty" autofocus class="form-control form-control-sm mb-3 d-md-none d-sm-block scaner" placeholder="scan disini...">
              </form>
              <table class="table table-bordered w-100">
                <tbody>
                 <tr>
                   <td>Barcode :</td>
                   <td><span class="ean"></span></td>
                 </tr>
                 <tr>
                   <td>ITEM ID :</td>
                   <td><span class="itemid"></span></td>
                 </tr>
                 <tr>
                   <td>NAMA ITEM :</td>
                   <td><span class="item_description"></span></td>
                 </tr>
                 <tr>
                   <td>WAIST :</td>
                   <td><span class="waist "></span></td>
                 </tr>
                 <tr>
                   <td>INSEAM :</td>
                   <td><span class="inseam "></span></td>
                 </tr>
                 <tr>
                   <td>KATEGORI :</td>
                   <td><span class="category"></span></td>
                 </tr>
                 <tr>
                   <td>ONHAND SCANNER /item :</td>
                   <td><span class="onhand_scan"></span></td>
                 </tr>
                 <tr>
                   <td>STOK ONHAND /item :</td>
                   <td><span class="onhand_qty"></span></td>
                 </tr>
                 <tr>
                   <td>HASIL SCAN /item :</td>
                   <td><span class="nikscan"></span></td>
                 </tr>
                </tbody>
              </table>
              <?php $dt = $this->db->select('status')->where(['periode'=>$this->session->userdata('tanggal'),'kode_store'=>$this->session->userdata('store')])->limit(1)->order_by('ean',"DESC")->get('prm_stock'); ?>
              <?php if ($this->session->userdata('level')=='auditor' || $this->session->userdata('level')=='admin') : ?>
                <?php if ($dt->num_rows()>0) : ?>
                  <?php if ($dt->row()->status=='BELUM') : ?>
                  <div class="row">
                    <div class="col-md-4 col-sm-4  mb-3">
                      <button type="button" data-popupmodal="tndatangan" data-tanggal="<?= $this->session->userdata('tanggal'); ?>" data-store="<?= $this->session->userdata('store'); ?>" class="btn btn-primary w-100 mb-sm-3 btnmodal">Close Audit</button>
                    </div>
                    <div class="col-md-4 col-sm-4 mb-3">
                      <button class="btn btn-primary w-100 mb-sm-3 btnmodal" data-popupmodal="uploadmanual">Article No Ean</button>
                    </div>
                    <div class="col-md-4 col-sm-4 mb-3">
                      <button class="btn btn-info w-100 mb-sm-3 btnmodal" data-popupmodal="addarticle">ADD Article Manual</button>
                    </div>
                  </div>
              <?php endif ?>
              <?php endif ?>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4  d-none d-md-block">
      <div class="card">
      <div class="card-header bg-none">
        <input autocomplete="empty" name="searchaudit" type="text" class="form-control form-control-sm" placeholder="Search...">
      </div>
        <div class="card-body d-flex justify-content-center">
          <img src='<?= base_url() ?>content/src/images/bg.jpg' alt='icon bg' class='w-100 loginbg position-relative' loading='lazy'>
          <div class="position-absolute bottom-70 w-75">
            <div class="d-flex">
            <input name="scanartikel" autocomplete="empty" autofocus type="text" class="form-control form-control-sm mx-2 scaner" placeholder="Scan Disini..">
            <img src='<?= base_url() ?>content/src/images/barcode.jpg' alt='icon bg' class='loginbg position-relative rounded' style="width: 50px; height: 50px;"loading='lazy'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>