<?php
class Homeproses extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    cheknologin();
    $this->load->library('upload');
    $this->load->model(array('model_data', 'Auth_model'));
  }
  public function getdatauser()
  {
    $list = $this->model_data->getTableUser();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $dt) {
      $status = '';
      if ($dt->status == 'aktif') {
        $status = 'checked';
      }
      $auditor = $dt->level == 'auditor' ? 'checked' : '';
      $admin = $dt->level == 'admin' ? 'checked' : '';
      $subeditor = $dt->level == 'subeditor' ? 'checked' : '';
      $no++;
      $row   = array();
      $row[] = '<div class="position-relative w-100"><span class="mousetable btnreset" data-bs-toggle="tooltip" data-bs-placement="bottom" title="reset password"  data-nikaryawan="' . $dt->nik . '">' . $dt->nik . '</span></div>';
      $row[] = '<div class="position-relative w-100"><span class="mousetable btnmodal" data-popupmodal="edituser" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit User"  data-nikaryawan="' . $dt->nik . '">' . $dt->nama . '</span></div>';
      $row[] = '<div class="d-flex justify-content-center w-100"><div class="onoffswitch2"><input type="checkbox" data-pesan="status" data-nikaryawan="' . $dt->nik . '" name="statususer" class="onoffswitch2-checkbox statuscheked" id="status' . $dt->nik . '" ' . $status . '><label class="onoffswitch2-label" for="status' . $dt->nik . '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div></div>';
      $row[] = '<div class="d-flex justify-content-center w-100"><div class="onoffswitch2"><input type="checkbox" data-pesan="auditor" data-nikaryawan="' . $dt->nik . '" name="auditor" class="onoffswitch2-checkbox statuscheked" id="auditor' . $dt->nik . '" ' . $auditor . '><label class="onoffswitch2-label" for="auditor' . $dt->nik . '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div></div>';
      $row[] = '<div class="d-flex justify-content-center w-100"><div class="onoffswitch2"><input type="checkbox" data-pesan="subeditor" data-nikaryawan="' . $dt->nik . '" name="subeditor" class="onoffswitch2-checkbox statuscheked" id="subeditor' . $dt->nik . '" ' . $subeditor . '><label class="onoffswitch2-label" for="subeditor' . $dt->nik . '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div></div>';
      $row[] = '<div class="d-flex justify-content-center w-100"><div class="onoffswitch2"><input type="checkbox" data-pesan="admin" data-nikaryawan="' . $dt->nik . '" name="ADMIN" class="onoffswitch2-checkbox statuscheked" id="admin' . $dt->nik . '" ' . $admin . '><label class="onoffswitch2-label" for="admin' . $dt->nik . '"><span class="onoffswitch2-inner"></span><span class="onoffswitch2-switch"></span></label></div></div>';
      $data[] = $row;
    }
    $output = array(
      "draw"            =>  intval($_POST["draw"]),
      "recordsTotal"    =>  $this->model_data->hitung_semuaUser(),
      "recordsFiltered" => $this->model_data->hitungFilterUser(),
      "data"            => $data,
    );
    echo json_encode($output);
  }
  public function userstatus()
  {
    if ($this->input->post()) {
      $nikaryawan = $this->input->post('nikaryawan', true);
      $status = $this->input->post('status', true);
      $pesan = $this->input->post('pesan', true);
      if ($pesan == 'status') {
        $sukses = $this->db->update('users', ['status' => $status], ['nik' => $nikaryawan]);
      } else if ($pesan == 'auditor') {
        $sukses = $this->db->update('users', ['level' => 'auditor'], ['nik' => $nikaryawan]);
      } else if ($pesan == 'subeditor') {
        $sukses = $this->db->update('users', ['level' => 'subeditor'], ['nik' => $nikaryawan]);
      } else if ($pesan == 'admin') {
        $sukses = $this->db->update('users', ['level' => 'admin'], ['nik' => $nikaryawan]);
      }
      if ($sukses) {
        $msg = ['sukses' => '.'];
      } else {
        $msg = ['gagal' => 'konflik data'];
      }
      echo json_encode($msg);
    }
  }
  public function getdatahasilscan()
  {
    $a = $this->session->userdata('tanggal');;
    $list = $this->model_data->getTableAudit($a);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $dt) {
      $a = $dt->onhand_scan;
      if (empty($dt->onhand_scan)) {
        $a = 0;
      }
      $total = $a - $dt->onhand_qty;
      $row = array();
      $row[] = $dt->ean;
      $row[] = $dt->item_description;
      $row[] = $dt->item_id;
      $row[] = $dt->kelas;
      $row[] = $dt->category;
      $row[] = $dt->waist;
      $row[] = $dt->inseam;
      $row[] = $dt->onhand_qty;
      $row[] = $a;
      $row[] = $total;
      $data[] = $row;
    }
    $output = array(
      "draw"            =>  intval($_POST["draw"]),
      "recordsTotal"    =>  $this->model_data->hitung_semuaAudithasilscan($a),
      "recordsFiltered" => $this->model_data->hitungFilterAudithasilscan($a),
      "data"            => $data,
    );
    echo json_encode($output);
  }
  public function getdatahasilaudit()
  {
    $a = $this->session->userdata('tanggal');
    $list = $this->model_data->getTableAuditHasilscansementara($a);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $dt) {
      $a = $dt->onhand_scan;
      if (empty($dt->onhand_scan)) {
        $a = 0;
      }
      $b = '';
       $c = '';
      if (!empty($dt->ean)) {
        if($dt->status=='BELUM'){
            $b = 'btnmodal2';
             $c = 'data-onhand="' . $a . '" data-popupmodal="editmanual" data-ean="' . $dt->ean . '" data-periode="' . $dt->periode . '" data-kodestore="' . $dt->kode_store . '"';
        }
      }
      $total = $a - $dt->onhand_qty;
      $row = array();
      $row[] = '<span class="mouse ' . $b . '"  ' . $c . ' >' . $dt->ean . '</span>';
      $row[] = $dt->item_description;
      $row[] = $dt->item_id;
      $row[] = $dt->kelas;
      $row[] = $dt->category;
      $row[] = $dt->waist;
      $row[] = $dt->inseam;
      $row[] = $dt->onhand_qty;
      $row[] = $a;
      $row[] = $total;
      $data[] = $row;
    }
    $output = array(
      "draw"            =>  intval($_POST["draw"]),
      "recordsTotal"    =>  $this->model_data->hitung_semuaAudithasilscan($a),
      "recordsFiltered" => $this->model_data->hitungFilterAudithasilscan($a),
      "data"            => $data,
    );
    echo json_encode($output);
  }
  public function getdatahasilcompare()
  {
    $a = $this->session->userdata('tanggal');
    $list = $this->model_data->getTableAuditCompare($a);
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $dt) {
      $querystok = $this->db->select('item_description,kelas,item_id,category,onhand_qty')->where(['ean' => $dt->ean, 'kode_store' => $dt->kode_store])->get('prm_stock')->row();
      $ean = '';
      $item_description = '';
      $item_id = '';
      if (!empty($dt->periode)) {
        $ean = $dt->ean;
      }
      if (!empty($querystok->item_description)) {
        $item_description = $querystok->item_description;
        $item_id = $querystok->item_id;
      }
      $aa = $dt->onhand_scan;
      if (empty($dt->onhand_scan)) {
        $aa = 0;
      }
      $row = array();
      $row[] = $ean;
      $row[] = $item_description;
      $row[] =  $item_id;
      $row[] = $querystok->kelas;
      $row[] = $querystok->category;
      $row[] = $querystok->onhand_qty;
      $row[] = $aa;
      $row[] = $dt->nama;
      $data[] = $row;
    }
    $output = array(
      "draw"            =>  intval($_POST["draw"]),
      "recordsTotal"    =>  $this->model_data->hitung_semuaAuditCompare($a),
      "recordsFiltered" => $this->model_data->hitungFilterAuditCompare($a),
      "data"            => $data,
    );
    echo json_encode($output);
  }

  public function scanproduk()
  {
    $kodestore = $this->session->userdata('store', true);
    $tanggalvisit = $this->session->userdata('tanggal', true);
    $idkode = $this->input->post('scanaudit', true);
    $nik = $this->session->userdata('nik');
    $cariproduct = $this->model_data->cariproduct($kodestore, $idkode, $tanggalvisit);
    if ($cariproduct->num_rows() > 0) {
      $rs = $cariproduct->row();
      $nikscan = $this->db->get_where('temp_stock', ['periode' => $tanggalvisit, 'kode_store' => $kodestore, 'nik' => $nik, 'ean' => $idkode]);
      if ($rs->status == 'BELUM') {
        $onhand_scan = '0';
        if (!empty($rs->onhand_scan)) {
          $onhand_scan = $rs->onhand_scan;
        }
        $a = $onhand_scan + 1;
        $sukses = $this->db->update('prm_stock', ['onhand_scan' => $a], ['kode_store' => $kodestore, 'ean' => $idkode, 'periode' => $tanggalvisit]);
        if ($sukses) {
          $buataudit = $this->model_data->totalget($tanggalvisit)->row();
          $buataudit2 = $this->model_data->totalscan($tanggalvisit)->row();
          $c = '';
          if ($nikscan->num_rows() > 0) {
            $b = '0';
            if (!empty($nikscan->row()->onhand_scan)) {
              $b = $nikscan->row()->onhand_scan;
            }
            $c = $b + 1;
            $this->db->update('temp_stock', ['onhand_scan' => $c], ['kode_store' => $kodestore, 'ean' => $idkode, 'periode' => $tanggalvisit]);
          } else {
            $this->db->insert('temp_stock', ['periode' => $tanggalvisit, 'kode_store' => $kodestore, 'nik' => $nik, 'ean' => $idkode, 'onhand_scan' => '1']);
            $c = 1;
          }
          $msg = ['sukses' => '.', 'itemid' => $rs->item_id, 'ean' => $rs->ean, 'onhand_qty' => $rs->onhand_qty, 'waist' => $rs->waist, 'item_description' => $rs->item_description, 'inseam' => $rs->inseam, 'category' => $rs->category, 'onhand_scan' => $a, 'artikel' => '', 'nikscan' => $c, 'totalscanglobal' => $buataudit->onhand_scan, 'scanindividu' => $buataudit2->onhand_scan];
        }
      } else {
        $msg = ['gagal' => 'produk Sudah di audit', 'artikel' => ''];
      }
    } else {
      $msg = ['gagal' => 'produk tidak ditemukan', 'artikel' => ''];
    }
    echo json_encode($msg);
  }
  public function cariproduk()
  {
    $kodestore = $this->session->userdata('store', true);
    $tanggalvisit = $this->session->userdata('tanggal', true);
    $nik = $this->session->userdata('nik', true);
    $idkode = $this->input->post('searchaudit', true);
    $cariproduct = $this->model_data->cariproduct($kodestore, $idkode, $tanggalvisit);
    $onhand = $this->db->query("select sum(onhand_scan) as totalscan from temp_stock where ean='$idkode' AND periode='$tanggalvisit' AND kode_store='$kodestore' AND nik='$nik'")->row();
    if ($cariproduct->num_rows() > 0) {
      $rs = $cariproduct->row();
      $onhand_scan = '0';
      if (!empty($rs->onhand_scan)) {
        $onhand_scan = $rs->onhand_scan;
      }
      $buataudit = $this->model_data->totalget($tanggalvisit)->row();
      $buataudit2 = $this->model_data->totalscan($tanggalvisit)->row();
      $msg = ['sukses' => '.', 'itemid' => $rs->item_id, 'ean' => $rs->ean, 'onhand_qty' => $rs->onhand_qty, 'waist' => $rs->waist, 'item_description' => $rs->item_description, 'inseam' => $rs->inseam, 'category' => $rs->category, 'onhand_scan' => $onhand_scan, 'artikel' => '', 'nikscan' => $onhand->totalscan, 'totalscanglobal' => $buataudit->onhand_scan, 'scanindividu' => $buataudit2->onhand_scan];
    } else {
      $msg = ['gagal' => 'produk tidak ditemukan', 'artikel' => ''];
    }
    echo json_encode($msg);
  }
  public function prosessignature()
  {
    if ($this->input->post()) {
      $idstore = $this->session->userdata('store');
      $auditor = $this->input->post('auditor', true);
      $periode = $this->input->post('periode', true);
      $stafname = $this->input->post('stafname', true);
      $cek = $this->db->get_where('prm_auditor', ['periode_audit' => $periode, 'kode_store' => $idstore]);
      if ($cek->num_rows() > 0) {
        $msg = ['gagal' => 'Periode ' . $periode . ' Sudah Dilakukan Audit'];
      } else {
        $datainsert = [
          'periode_audit' => $periode,
          'kode_store' => $idstore,
          'pihak_1' => $auditor,
          'pihak_2' => $stafname,
          'status_audit' => 'SELESAI',
        ];
        $this->db->insert('prm_auditor', $datainsert);
        $this->db->update('temp_stock', ['status_audit' => 'SELESAI'], ['periode' => $periode, 'kode_store' => $idstore]);
        $sukses = $this->db->update('prm_stock', ['status' => 'SELESAI'], ['periode' => $periode, 'kode_store' => $idstore]);
        if ($sukses) {
          $msg = ['sukses' => 'Status Audit Berhasil Diselesaikan'];
        }
      }
      echo json_encode($msg);
    }
  }
  public function prosesregister()
  {
    if ($this->input->post()) {
      $nik = $this->input->post('nikuser', true);
      $namauser = $this->input->post('namauser', true);
      $level = $this->input->post('leveluser', true);
      $nikpassword = md5($this->input->post('nikpassword', true));
      if ($this->db->get_where('users', ['nik' => $nik])->num_rows() > 0) {
        $msg = ['gagal' => 'Nik sudah terdaftar.'];
      } else {
        $this->db->insert('users', ['nik' => $nik, 'nama' => $namauser, 'level' => $level, 'password' => $nikpassword]);
        $msg = ['sukses' => 'Berhasil mendaftarkan user'];
      }
      echo json_encode($msg);
    }
  }
  public function resetpassword()
  {
    $nik = $this->input->post('nikaryawan', true);
    $password = md5($this->input->post('nikaryawan', true));
    if ($this->db->select('nik')->where('nik', $nik)->get('users')->num_rows() > 0) {
      $this->db->update('users', ['password' => $password], ['nik' => $nik]);
      $msg = ['sukses' => '.'];
    } else {
      $msg = ['gagal' => 'user tidak ditemukan'];
    }
    echo json_encode($msg);
  }
  public function cangename()
  {
    $nik = $this->input->post('nikuser', true);
    $nama = $this->input->post('namauser', true);
    if ($this->db->select('nik')->where('nik', $nik)->get('users')->num_rows() > 0) {
      $this->db->update('users', ['nama' => $nama], ['nik' => $nik]);
      $msg = ['sukses' => 'berhasil memperbaharui nama'];
    } else {
      $msg = ['gagal' => 'user tidak ditemukan'];
    }
    echo json_encode($msg);
  }
  public function hapusfile()
  {
    $dir = './content/sampel/upload/';
    array_map('unlink', glob("{$dir}*.csv"));
    $msg = 'ok';
    echo json_encode($msg);
  }
  public function insertcsvaudit()
  {
    $tanggal = $this->session->userdata('tanggal', true);
    $store = $this->session->userdata('store', true);
    $config['upload_path'] = './content/sampel/upload/';
    $config['allowed_types'] = 'csv';
    $config['max_size'] = 10000;
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('namafile')) {
      $error = array('error' => $this->upload->display_errors());
      $cek = implode('', $error);
      $msg = ['gagal' => $cek];
    } else {
      $sukses = '';
      $images = $this->upload->data();
      $imagess = $images['file_name'];
      $file_data = fopen("./content/sampel/upload/" . $imagess, 'r');
      fgetcsv($file_data);
      while ($row = fgetcsv($file_data)) {
        $insert_data = array(
          'periode' => $tanggal,
          'kode_store' => trim($row['0']),
          'nama_store' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['1'])),
          'item_id' => trim($row['2']),
          'waist' => trim($row['3']),
          'inseam' => trim($row['4']),
          'item_description' => preg_replace('/[@\.\;\'\?\™\|\®\©\™\®\"\/\,\(\)\']+/', '', trim($row['5'])),
          'ean' => trim($row['6']),
          'brand' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['7'])),
          'category' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['8'])),
          'kelas' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['9'])),
          'subkelas' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['10'])),
          'bin' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['11'])),
          'onhand_qty' => preg_replace('/[@\.\;\'\"\/\,\(\)\']+/', '', trim($row['12'])),
          'onhand_scan' => '0',
          'status' => 'BELUM',
        );
        $datawhere = [
          'periode' => $tanggal,
          'ean' => trim($row['6']),
          'kode_store' => trim($row['0'])
        ];
        $datawhere2 = [
          'periode' => $tanggal,
          'kode_store' => trim($row['0']),
          'item_id' => trim($row['2']),
        ];
        if (trim($row['0']) == $store) {
          if (trim($row['6'] == '')) {
            if ($this->db->get_where('prm_stock', $datawhere2)->num_rows() > 0) {
              $sukses = 'Sudah diupload';
            } else {
              $sukses = $this->db->insert('prm_stock', $insert_data);
            }
          } else {
            if ($this->db->get_where('prm_stock', $datawhere)->num_rows() > 0) {
              $sukses = 'Sudah diupload';
            } else {
              $sukses = $this->db->insert('prm_stock', $insert_data);
            }
          }
        } else {
          $gagal = 'Store Tidak sama dengan Data';
        }
      }
      if ($sukses) {
        $msg = ['sukses' => 'berhasil Upload Data'];
      } else if ($gagal) {
        $msg = ['gagal' => $gagal];
      } else {
        $msg = ['sukses' => 'Sudah diupload'];
      }
    }
    echo json_encode($msg);
  }
  public function insertcsvtoko()
  {
    $config['upload_path'] = './content/sampel/upload/';
    $config['allowed_types'] = 'csv';
    $config['max_size'] = 10000;
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('namafile')) {
      $error = array('error' => $this->upload->display_errors());
      $cek = implode('', $error);
      $msg = ['gagal' => $cek];
    } else {
      $images = $this->upload->data();
      $imagess = $images['file_name'];
      $file_data = fopen("./content/sampel/upload/" . $imagess, 'r');
      fgetcsv($file_data);
      while ($row = fgetcsv($file_data)) {
        $insert_data = array(
          'kode_store' => trim($row['0']),
          'nama_store' => trim($row['1']),
        );
        if ($this->db->get_where('prm_store', ['kode_store' => trim($row['0'])])->num_rows() > 0) {
          $sukses = '';
        } else {
          $sukses = $this->db->insert('prm_store', $insert_data);
        }
      }
      if ($sukses) {
        if (file_exists("./content/sampel/upload/" . $imagess)) {
          unlink("./content/sampel/upload/" . $imagess);
          $msg = ['sukses' => 'berhasil menambahkan Data Store'];
        }
      } else {
        if (file_exists("./content/sampel/upload/" . $imagess)) {
          unlink("./content/sampel/upload/" . $imagess);
          $msg = ['sukses' => 'berhasil menambahkan Data Store'];
        }
      }
    }
    echo json_encode($msg);
  }
  public function updatamanual()
  {
    if ($this->input->post()) {
      $tanggal = $this->session->userdata('tanggal', true);
      $store = $this->session->userdata('store', true);
      $itemid = $this->input->post('itemid', true);
      $inseam = $this->input->post('inseam', true);
      $waist = $this->input->post('waist', true);
      $isi = $this->input->post('isi', true);
      $desckrip = $this->input->post('desckrip', true);
      if (!empty($inseam)) {
        $this->db->update('prm_stock', ['onhand_scan' => $isi], ['periode' => $tanggal, 'kode_store' => $store, 'item_id' => $itemid, 'inseam' => $inseam, 'item_description' => $desckrip]);
      } else if (!empty($waist)) {
        $this->db->update('prm_stock', ['onhand_scan' => $isi], ['periode' => $tanggal, 'kode_store' => $store, 'item_id' => $itemid, 'waist' => $waist, 'item_description' => $desckrip]);
      } else if (!empty($inseam) && !empty($waist)) {
        $this->db->update('prm_stock', ['onhand_scan' => $isi], ['periode' => $tanggal, 'kode_store' => $store, 'item_id' => $itemid, 'waist' => $waist, 'inseam' => $inseam, 'item_description' => $desckrip]);
      } else {
        $this->db->update('prm_stock', ['onhand_scan' => $isi], ['periode' => $tanggal, 'kode_store' => $store, 'item_id' => $itemid, 'item_description' => $desckrip]);
      }
      $msg = 'sukses';
      echo json_encode($msg);
    }
  }
  public function proseseditmanual()
  {
    if ($this->input->post()) {
      $ean = $this->input->post('ean', true);
      $periode = $this->session->userdata('tanggal', true);
      $kodestore = $this->session->userdata('store', true);
      $onhand = $this->input->post('onhand', true);
      $sukses = $this->db->update('prm_stock', ['onhand_scan' => $onhand], ['periode' => $periode, 'ean' => $ean, 'kode_store' => $kodestore]);
      if ($sukses) {
        $msg = ['sukses' => 'berhasil diperbaharui.'];
      } else {
        $msg = ['gagal' => 'gagal diperbaharui.'];
      }
      echo json_encode($msg);
    }
  }
  public function prosesaddarticle()
  {
    if ($this->input->post()) {
      $periode = $this->session->userdata('tanggal', true);
      $kodestore = $this->session->userdata('store', true);
      $store = $this->session->userdata('namastore', true);
      $ean = $this->input->post('ean', true);
      $item_id = $this->input->post('item_id', true);
      $waist = $this->input->post('waist', true);
      $inseam = $this->input->post('inseam', true);
      $item_description = strtolower($this->input->post('item_description', true));
      $brand = $this->input->post('brand', true);
      $category = $this->input->post('category', true);
      $kelas = $this->input->post('kelas', true);
      $subkelas = $this->input->post('subkelas', true);
      $onhand_qty = $this->input->post('onhand_qty', true);
      $bin = $this->input->post('bin', true);
      $onhand = $this->input->post('onhand', true);
      $datainsert = ['periode' => $periode, 'ean' => $ean, 'kode_store' => $kodestore, 'nama_store' => $store, 'item_id' => $item_id, 'waist' => $waist, 'inseam' => $inseam, 'item_description' => $item_description, 'brand' => $brand, 'category' => $category, 'kelas' => $kelas, 'subkelas' => $subkelas, 'bin' => $bin, 'onhand_qty' => $onhand_qty, 'onhand_scan' => $onhand, 'status' => 'BELUM'];
      $where = ['periode' => $periode, 'ean' =>$ean, 'kode_store' => $kodestore, 'item_id' => $item_id];
      $cek = $this->db->get_where('prm_stock', $where);
      if ($cek->num_rows() > 0) {
        $msg = ['gagal' => 'gagal Menambahkan item baru. Item Sudah Tersedia'];
      } else {
        $sukses = $this->db->insert('prm_stock', $datainsert, $where);
        if ($sukses) {
          $msg = ['sukses' => 'sukses Menambahkan item baru.'];
        } else {
          $msg = ['gagal' => 'gagal Menambahkan item baru. Item Sudah Tersedia.'];
        }
      }
      echo json_encode($msg);
    }
  }
   public function gantipassword()
  {
    $nik = $this->input->post('nikuser', true);
    $newpass = $this->input->post('newpass', true);
    if ($this->db->select('nik')->where('nik', $nik)->get('users')->num_rows() > 0) {
      $this->db->update('users', ['password' => md5($newpass)], ['nik' => $nik]);
      $msg = ['sukses' => 'berhasil memperbaharui Password'];
    } else {
      $msg = ['gagal' => 'user tidak ditemukan'];
    }
    echo json_encode($msg);
  }
  
}
