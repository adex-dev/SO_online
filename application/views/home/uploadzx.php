<script> var judul = "Report AUDIT <?= $this->session->userdata('namastore'); ?>";</script>
<div class="container">
  <div class="row d-md-flex align-content-md-center align-items-md-center min-vh-100">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-none">
          <h1 class="font-interbold mouse"  onclick="window.location.href='<?= site_url('') ?>'">Jaygee Group</h1>
          <div class="d-flex justify-content-end"><button onclick="window.location.href='<?= site_url('logout') ?>'" type="button" class="btn btn-danger btn-sm">Logout</button></div>
        </div>
        <div class="card-body" style="min-height: 300px;">
          <div class="row">
            <div class="col-md-12 mb-3">
              <table class="table">
                <tbody>
                  <tr>
                    <td colspan="2">
                      <h3 class="font-interitalic">Upload Data ZX-30</h3>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <form class="uploadmasteraudit" enctype="multipart/form-data">
                      <div class="d-flex row">
                        <div class="col-md-12 col-sm-6 mt-2">
                          <div class="mb-3">
                            <label for="zx30" class="form-label">Upload Data master csv X-20</label>
                            <input required class="form-control" type="file" name="zx30" multiple>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-6 mt-2"><button type="submit" class="btn btn-sm btn-success mt-2 h-100 w-100 font-interreguler"><i class="fa fa-upload"></i> Upload</button></div>
                      </div>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <h3 class="font-interitalic">Download Sampel Data X-20</h3>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <div class="d-flex row">
                        <div class="col-md-6 col-sm-6 mt-2"><button onclick="window.location.href='<?= site_url('') ?>content/sampel/sampel.xlsx'" class="btn btn-sm btn-warning mt-2 h-100 w-100 font-interreguler">Download sampel</button></div>
                      </div>
                    </td>
                  </tr>
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