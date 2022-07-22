<?php 
class Home extends CI_Controller { 
  function __construct(){
  parent::__construct();
  $this->load->model(array('model_data','Auth_model'));
  cheknologin();
  }
  public function index (){ 
    $this->template->load('home/template', 'home/index');
   }
  public function masterstore (){ 
    $data['store']= $this->db->select('kode_store,nama_store')->get('prm_store')->result();
    $this->template->load('home/template', 'home/masterstore',$data);
   }
  public function masteruser (){ 
    $this->template->load('home/template', 'home/masteruser');
   }
  public function masterscanhasil (){ 
    $this->template->load('home/template', 'home/masterscan');
   }
  public function compareaudit (){ 
    $this->template->load('home/template', 'home/compareaudit');
   }
  public function uploadzx (){ 
    $this->template->load('home/template', 'home/uploadzx');
   }
  public function uploadmasterstore (){ 
    $this->template->load('home/template', 'home/uploadmasterstore');
   }
  public function buataudit (){ 
    $tanggal = $this->session->userdata('tanggal');
    $data['buataudit']=$this->model_data->totalget($tanggal)->row();
    $data['buataudit2']=$this->model_data->totalscan($tanggal)->row();
    $this->template->load('home/template', 'home/buataudit',$data);
   }
  public function reportaudit (){ 
    $tanggal = $this->session->userdata('tanggal');
    $store = $this->session->userdata('store');
    $data['report']=$this->model_data->detail($tanggal,$store)->row();
    $this->template->load('home/template', 'home/reportaudit',$data);
   }
   public function viewmodalweb (){ 
    if ($this->input->is_ajax_request() == true) {
      $msg = ['sukses' => $this->load->view('modal/viewmodal', '', true)];
    }
    echo json_encode($msg);
   }
 } 