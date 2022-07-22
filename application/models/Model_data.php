<?php
class Model_data extends CI_Model
{
  var $tableuser = 'users'; //nama tabel dari database
  var $searchuser = array('nik', 'nama');
  var $tableauditscanhasil = 'prm_stock';
  var $tableauditscanhasilcompare = 'temp_stock';
  var $column_search_audithasilscan = array('item_description', 'ean', 'item_id');
  var $column_search_audithasilscanCompare = array('ean');
  private function _getTableUser()
  {
    $this->db->select('nik,nama,status,level');
    $this->db->order_by('nama', 'ASC');
    $this->db->from($this->tableuser);
    $i = 0;

    foreach ($this->searchuser as $item) // looping awal
    {
      if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
      {

        if ($i === 0) // looping awal
        {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->searchuser) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
  }

  function getTableUser()
  {
    $this->_getTableUser();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function hitungFilterUser()
  {
    $this->_getTableUser();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function hitung_semuaUser()
  {
    $this->db->from($this->tableuser);
    return $this->db->count_all_results();
  }
  private function _getTableScanhasil_query($a)
  {
    $store = $this->session->userdata('store');
    $this->db->select('ean,item_id,waist,inseam,item_description,onhand_qty,onhand_scan,status,kelas,category,kode_store,periode');
    $this->db->from($this->tableauditscanhasil);
    $this->db->where('kode_store', $store);
    $this->db->where('periode', $a);
    $this->db->order_by('item_id');
    $i = 0;

    foreach ($this->column_search_audithasilscan as $item) // looping awal
    {
      if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
      {

        if ($i === 0) // looping awal
        {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search_audithasilscan) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
  }

  function getTableAuditHasilscansementara($a)
  {
    $this->_getTableScanhasil_query($a);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function hitungFilterAudithasilscan($a)
  {
    $this->_getTableScanhasil_query($a);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function hitung_semuaAudithasilscan($a)
  {
    $this->db->from($this->tableauditscanhasil);
    return $this->db->count_all_results();
  }
  private function _getTableAudit_query($a)
  {
    $store = $this->session->userdata('store');
    $this->db->select('ean,item_id,waist,inseam,item_description,onhand_qty,onhand_scan,status,kelas,category');
    $this->db->from($this->tableauditscanhasil);
    $this->db->where('kode_store', $store);
    $this->db->where('status', 'SELESAI');
    $this->db->where('periode', $a);
    $this->db->order_by('item_id');
    $i = 0;

    foreach ($this->column_search_audithasilscan as $item) // looping awal
    {
      if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
      {

        if ($i === 0) // looping awal
        {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search_audithasilscan) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
  }

  function getTableAudit($a)
  {
    $this->_getTableAudit_query($a);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function hitungFilterAudit($a)
  {
    $this->_getTableAudit_query($a);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function hitung_semuaAudit($a)
  {
    $this->db->from($this->tableauditscanhasil);
    return $this->db->count_all_results();
  }
  public function detail($tanggal, $store)
  {
    $this->db->select('prm_auditor.pihak_2,prm_auditor.periode_audit,prm_auditor.status_audit,c.nama,cc.nama_store');
    $this->db->join('users c', 'c.nik=prm_auditor.pihak_1');
    $this->db->join('prm_store cc', 'cc.kode_store=prm_auditor.kode_store');
    $this->db->where('prm_auditor.periode_audit ', $tanggal);
    $this->db->where('prm_auditor.kode_store', $store);
    return $this->db->get('prm_auditor');
  }
  private function _getTableAuditCompare_query($a)
  {
    $store = $this->session->userdata('store');
    $this->db->select('temp_stock.*,nama');
    $this->db->join('users c','c.nik=temp_stock.nik');
    $this->db->from($this->tableauditscanhasilcompare);
    $this->db->where('temp_stock.kode_store',$store);
    $this->db->where('temp_stock.periode',$a);
    $this->db->order_by('temp_stock.ean','ASC');
    $i = 0;

    foreach ($this->column_search_audithasilscanCompare as $item) // looping awal
    {
      if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
      {

        if ($i === 0) // looping awal
        {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search_audithasilscanCompare) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }
  }

  function getTableAuditCompare($a)
  {
    $this->_getTableAuditCompare_query($a);
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function hitungFilterAuditCompare($a)
  {
    $this->_getTableAuditCompare_query($a);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function hitung_semuaAuditCompare($a)
  {
    $this->db->from($this->tableauditscanhasilcompare);
    return $this->db->count_all_results();
  }
  public function totalget ($tanggal){ 
    $store = $this->session->userdata('store');
    $this->db->select_sum('onhand_qty');
    $this->db->select_sum('onhand_scan');
    $this->db->where('periode',$tanggal);
    $this->db->where('kode_store',$store);
    return $this->db->get('prm_stock');
   }
  public function totalscan ($tanggal){ 
    $store = $this->session->userdata('store');
    $nik = $this->session->userdata('nik');
    $this->db->select_sum('onhand_scan');
    $this->db->where('periode',$tanggal);
    $this->db->where('kode_store',$store);
    $this->db->where('nik',$nik);
    return $this->db->get('temp_stock');
   }
   public function cariproduct($kodestore, $idkode, $tanggalvisit)
   {
     $this->db->select('ean,item_description,item_id,waist,inseam,category,onhand_qty,onhand_scan,status');
     $this->db->where('kode_store', $kodestore);
     $this->db->where('ean', $idkode);
     $this->db->where('periode', $tanggalvisit);
     return $this->db->get('prm_stock');
   }
}
