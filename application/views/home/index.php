<div class="container">
  <div class="row d-md-flex align-content-md-center align-items-md-center min-vh-100">
    <div class="col-md-6">
      <div class="card">
       <div class="card-header bg-none">
          <h1 class="font-interbold float-md-start">Jaygee Group</h1>
          <div class="d-flex justify-content-start"><img src='<?= base_url() ?>content/src/images/logo2.jpg' alt='icon bg' class='logo2' loading='lazy'>
          </div>
          <div class="d-flex justify-content-end"><button onclick="window.location.href='<?= site_url('logout') ?>'" type="button" class="btn btn-danger btn-sm">Logout</button><button  type="button" data-popupmodal="gantipassword" data-nikaryawan="<?= $this->session->userdata('nik'); ?>" class="btn btn-warning btn-sm btnmodal mx-2">Change Password</button></div>
        </div>
        <div class="card-body" style="min-height: 300px;">
          <div class="row">
            <div class="col-md-12 mb-3">
              <table class="table">
                <tbody>
                  <tr>
                    <td colspan="2">
                      <h3 class="font-interitalic">Menu Audit</h3>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <div class="d-flex row">
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('buataudit') ?>" class="btn btn-sm btn-primary mt-2 h-100 w-100 font-interreguler">Buat Audit</a></div>
                        <?php if ($this->session->userdata('level')=='auditor' || $this->session->userdata('level')=='admin') : ?>
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('reportaudit') ?>" class="btn btn-sm btn-primary mt-2 h-100 w-100 font-interreguler">Hasil Audit</a></div>
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('compareaudit') ?>" class="btn btn-sm btn-primary mt-2 h-100 w-100 font-interreguler">Compare hasil Audit</a></div>
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('masterscanhasil') ?>" class="btn btn-sm btn-primary mt-2 h-100 w-100 font-interreguler">Report Hasil Upload X-20</a></div>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <h3 class="font-interitalic">Upload Data</h3>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <div class="d-flex row">
                      <?php if ($this->session->userdata('level')=='admin') : ?>
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('uploadmasterstore') ?>" class="btn btn-sm btn-success mt-2 h-100 w-100 font-interreguler">Upload Master Store</a></div><?php endif ?>
                        <?php if ($this->session->userdata('level')=='auditor' || $this->session->userdata('level')=='admin') : ?>
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('uploadzx') ?>" class="btn btn-sm btn-success mt-2 h-100 w-100 font-interreguler">Upload X-20</a></div>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                  <?php if ($this->session->userdata('level')=='admin') : ?>
                  <tr>
                    <td colspan="2">
                      <h3 class="font-interitalic">Setting</h3>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <div class="d-flex row">
                        <div class="col-md-3 col-sm-6 mt-2"><a  href="<?= site_url('masterstore') ?>" class="btn btn-sm btn-warning mt-2 h-100 w-100 font-interreguler">Master Store</a></div>
                        <div class="col-md-3 col-sm-6 mt-2"><a href="<?= site_url('masteruser') ?>" class="btn btn-sm btn-warning mt-2 h-100 w-100 font-interreguler">Master User</a></div>
                      </div>
                    </td>
                  </tr>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6  d-none d-md-block">
      <div class="card">
        <div class="card-body d-flex justify-content-center">
          <img src='<?= base_url() ?>content/src/images/bg.jpg' alt='icon bg' class='w-100 loginbg position-relative' loading='lazy'>
        </div>
      </div>
    </div>
  </div>
</div>