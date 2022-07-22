<?php if ($this->input->get('isimodal') == 'tndatangan') { ?>
  <?php $rs = $this->db->select('nama_store')->where('kode_store', $this->input->get('store'))->get('prm_store')->row(); ?>
  <div class="modal fade" id="tndatangan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1>Tanda Tangan Digital</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <?= $rs->nama_store ?>
                </div>
                <form class="formauditcomplete">
                  <hr>
                  <div class="mb-3 px-2">
                    <label for="periode" class="form-label">Periode</label>
                    <input readonly autocomplete="empty" type="text" value="<?= $this->input->get('periode'); ?>" class="form-control" name="periode" placeholder="Enter Name">
                    <input type="hidden" value="<?= $this->input->get('uid') ?>" name="idstore">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="auditor" class="form-label">Nik Auditor</label>
                    <input required autocomplete="empty" type="number" class="form-control" name="auditor" placeholder="Enter Nik">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="stafname" class="form-label">Staff Name Store</label>
                    <input required autocomplete="empty" type="text" class="form-control" name="stafname" placeholder="Enter Name">
                  </div>
                  <div class="mb-3 px-2">
                    <button type="submit" class="btn btn-primary w-100">Post Data</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
<?php } else if ($this->input->get('isimodal') == 'buatuser') { ?>
  <div class="modal fade" id="buatuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="card">
                <form class="buatuser">
                  <hr>
                  <div class="mb-3 px-2">
                    <label for="nikuser" class="form-label">Nik</label>
                    <input required autofocus autocomplete="empty" type="number" class="form-control" name="nikuser" placeholder="Enter Nik">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="namauser" class="form-label">NAMA</label>
                    <input required autocomplete="empty" type="text" class="form-control" name="namauser" placeholder="Enter Nama">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="nikpassword" class="form-label">Password</label>
                    <input required autocomplete="empty" type="password" class="form-control" name="nikpassword" placeholder="Enter Password">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="leveluser" class="form-label">Level User</label>
                    <select required class="form-select form-select-sm" name="leveluser">
                      <option value="">PILIH LEVEL USER</option>
                      <option value="admin">ADMIN</option>
                      <option value="auditor">AUDITOR</option>
                      <option value="subauditor">SUB AUDITOR</option>
                    </select>
                  </div>
                  <div class="mb-3 px-2">
                    <button type="submit" class="btn btn-primary w-100">Register </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
<?php } else if ($this->input->get('isimodal') == 'edituser') { ?>
  <?php $nama = $this->db->select('nama')->where('nik', $this->input->get('uid', true))->get('users')->row()->nama; ?>
  <div class="modal fade" id="edituser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="card">
                <form class="edituser">
                  <hr>
                  <div class="mb-3 px-2">
                    <label for="nikuser" class="form-label">Nik</label>
                    <input readonly required autofocus autocomplete="empty" type="number" class="form-control" value="<?= $this->input->get('uid', true); ?>" name="nikuser" placeholder="Enter Nik">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="namauser" class="form-label">NAMA</label>
                    <input required autocomplete="empty" type="text" class="form-control" value="<?= $nama ?>" name="namauser" placeholder="Enter Nama">
                  </div>
                  <div class="mb-3 px-2">
                    <button type="submit" class="btn btn-primary w-100">Change Name</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
<?php } else if ($this->input->get('isimodal') == 'uploadmanual') { ?>
  <div class="modal fade" id="uploadmanual" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1>List Code Article No Ean</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="card">
                <table class="table table-bordered">
                  <thead>
                    <th>Item ID</th>
                    <th>Item Description</th>
                    <th>Waist</th>
                    <th>INSEAM</th>
                    <th>TOTAL QTY</th>
                    <th>INPUT ONHAND SCAN</th>
                  </thead>
                  <tbody>
                    <?php $dt = $this->db->select('item_id,kode_store,periode,item_description,waist,inseam,ean,onhand_qty,onhand_scan,status')->where(['kode_store' => $this->session->userdata('store'), 'periode' => $this->session->userdata('tanggal'), 'ean' => ""])->get('prm_stock')->result(); ?>
                    <?php foreach ($dt as  $value) : ?>
                      <tr>
                        <td><?= $value->item_id ?></td>
                        <td><?= $value->item_description ?></td>
                        <td><?= $value->waist ?></td>
                        <td><?= $value->inseam ?></td>
                        <td><?= $value->onhand_qty ?></td>
                        <td><input <?= $value->status == 'BELUM' ? '' : 'readonly' ?> type="number" data-itemid="<?= $value->item_id ?>" value="<?= !empty($value->onhand_scan) ? $value->onhand_scan : 0 ?>" data-waist="<?= $value->waist ?>" data-inseam="<?= $value->inseam ?>" data-desckrip="<?= $value->item_description ?>" class="form-control form-control-sm <?= $value->status == 'BELUM' ? 'inputmanualchange' : '' ?>" placeholder="addvalue" min="0"></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.inputmanualchange').change(function(e) {
        e.preventDefault();
        let isi = $(this).val();
        let itemid = $(this).data('itemid')
        let inseam = $(this).data('inseam')
        let waist = $(this).data('waist')
        let desckrip = $(this).data('desckrip')
        let formdata = {
          isi: isi,
          itemid: itemid,
          inseam: inseam,
          waist: waist,
          desckrip: desckrip
        }
        if (isi != '') {
          $.ajax({
            type: "POST",
            url: hostname + "homeproses/updatamanual",
            data: formdata,
            dataType: "json",
            success: function(response) {

            }
          });
        } else {
          Swal.fire({
            text: "tidak boleh kosong",
            icon: "error",
            showCancelButton: false,
            confirmButton: true,
          });
        }
      });
    });
  </script>
<?php } else if ($this->input->get('isimodal') == 'editmanual') { ?>
  <div class="modal fade" id="editmanual" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="editmanual">
            <div class="mb-3 px-2">
              <label for="nikuser" class="form-label">ean</label>
              <input readonly required autofocus autocomplete="empty" type="number" class="form-control" value="<?= $this->input->get('ean', true); ?>" name="ean" placeholder="Enter Nik">
            </div>
            <div class="mb-3 px-2">
              <label for="kodestore" class="form-label d-none">kodestore</label>
              <input readonly required autofocus autocomplete="empty" type="hidden" class="form-control" value="<?= $this->input->get('kodestore', true); ?>" name="kodestore" placeholder="Enter Nik">
            </div>
            <div class="mb-3 px-2">
              <label for="periode" class="form-label">Periode</label>
              <input readonly required autocomplete="empty" type="text" class="form-control" value="<?= $this->input->get('periode', true) ?>" name="periode" placeholder="Enter Nama">
            </div>
            <div class="mb-3 px-2">
              <label for="onhand" class="form-label">Onhand Scand</label>
              <input required autofocus autocomplete="empty" type="number" class="form-control" value="<?= $this->input->get('onhand', true) ?>" name="onhand" placeholder="Value Onhand Scand">
            </div>
            <div class="mb-3 px-2">
              <button type="submit" class="btn btn-primary w-100">Update Manual</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
<?php } else if ($this->input->get('isimodal') == 'addarticle') { ?>
  <div class="modal fade" id="addarticle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="addarticle">
            <div class="mb-3 px-2">
              <label for="nikuser" class="form-label">ean</label>
              <input autofocus autocomplete="empty" type="number" class="form-control" name="ean" placeholder="Enter Barcode">
            </div>
            <div class="mb-3 px-2">
              <label for="kodestore" class="form-label">Item ID</label>
              <input required autofocus autocomplete="empty" type="text" class="form-control" name="item_id" placeholder="Enter Item ID">
            </div>
            <div class="mb-3 px-2">
              <label for="waist" class="form-label">waist</label>
              <input autocomplete="empty" type="text" class="form-control" name="waist" placeholder="Enter waist">
            </div>
            <div class="mb-3 px-2">
              <label for="inseam" class="form-label">inseam</label>
              <input autocomplete="empty" type="text" class="form-control" name="inseam" placeholder="Enter inseam">
            </div>
            <div class="mb-3 px-2">
              <label for="item_description" class="form-label">item description</label>
              <input required autocomplete="empty" type="text" class="form-control" name="item_description" placeholder="Enter item description">
            </div>
            <div class="mb-3 px-2">
              <label for="brand" class="form-label">brand</label>
              <input autocomplete="empty" type="text" class="form-control" name="brand" placeholder="Enter brand">
            </div>
            <div class="mb-3 px-2">
              <label for="category" class="form-label">category</label>
              <input autocomplete="empty" type="text" class="form-control" name="category" placeholder="Enter category">
            </div>
            <div class="mb-3 px-2">
              <label for="kelas" class="form-label">kelas</label>
              <input autocomplete="empty" type="text" class="form-control" name="kelas" placeholder="Enter kelas">
            </div>
            <div class="mb-3 px-2">
              <label for="subkelas" class="form-label">subkelas</label>
              <input autocomplete="empty" type="text" class="form-control" name="subkelas" placeholder="Enter subkelas">
            </div>
            <div class="mb-3 px-2">
              <label for="bin" class="form-label">bin</label>
              <input autocomplete="empty" type="text" class="form-control" name="bin" placeholder="Enter bin">
            </div>
            <div class="mb-3 px-2">
              <label for="onhand_qty" class="form-label">onhand_qty</label>
              <input required autocomplete="empty" type="text" class="form-control" name="onhand_qty" placeholder="Enter onhand_qty">
            </div>
            <div class="mb-3 px-2">
              <label for="onhand" class="form-label">Onhand Scand</label>
              <input required autofocus autocomplete="empty" type="number" class="form-control" value="<?= $this->input->get('onhand', true) ?>" name="onhand" placeholder="Value Onhand Scand">
            </div>
            <div class="mb-3 px-2">
              <button type="submit" class="btn btn-primary w-100">SUBMIT</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
<?php }else if ($this->input->get('isimodal') == 'gantipassword') { ?>
  <?php $nama = $this->db->select('nama')->where('nik', $this->input->get('uid', true))->get('users')->row()->nama; ?>
  <div class="modal fade" id="gantipassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="card">
                <form class="gantipassword">
                  <hr>
                  <div class="mb-3 px-2">
                    <label for="nikuser" class="form-label">Nik</label>
                    <input readonly required autofocus autocomplete="empty" type="number" class="form-control" value="<?= $this->input->get('uid', true); ?>" name="nikuser" placeholder="Enter Nik">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="namauser" class="form-label">NAMA</label>
                    <input readonly required autocomplete="empty" type="text" class="form-control" value="<?= $nama ?>" name="namauser" placeholder="Enter Nama">
                  </div>
                  <div class="mb-3 px-2">
                    <label for="newpass" class="form-label">Password Baru</label>
                    <input  required autocomplete="empty" type="password" class="form-control" name="newpass" placeholder="Enter Password">
                  </div>
                  <div class="mb-3 px-2">
                    <button type="submit" class="btn btn-primary w-100">Change Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?> ?>