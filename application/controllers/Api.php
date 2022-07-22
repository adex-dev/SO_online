<?php 
class Api extends CI_Controller { 
  function __construct(){
  parent::__construct();
  
  }
  public function allstore()
  {
    $apilokasi = array();
    $apilokasi =  $this->db->select('kode_store,nama_store')->order_by('nama_store','ASC')->get('prm_store')->result();
    echo json_encode($apilokasi);
  }
  public function alluser()
  {
    $apilokasi = array();
    $apilokasi =  $this->db->get('users')->result();
    echo json_encode($apilokasi);
  }
 } 