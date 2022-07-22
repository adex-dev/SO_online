<?php
class Auth extends CI_Controller {
  function __construct(){
  parent::__construct();
  $this->load->model('Auth_model');
  }
	public function index()
	{
    if ($this->session->userdata('tanggal')) {
      redirect('home');
    }
    $data['store']= $this->db->select('kode_store,nama_store')->order_by('nama_store','ASC')->get('prm_store')->result();
		$this->load->view('login',$data);
	}
  public function ambiltanggal (){ 
    if ($this->input->post()) {
      $tanggal = $this->input->post('tanggallogin',true);
      $this->session->set_userdata('tanggal',$tanggal);
      $msg = ['sukses'=>'ok','audit'=>base_url('home')];
      echo json_encode($msg);
    }
   }
   public function loginproses (){ 
    $store = $this->input->post('storelogin',true);
    $nik = $this->input->post('niklogin',true);
    $password = md5($this->input->post('passwordlogin',true));
    $cek = $this->Auth_model->cekuser($nik,$password);
    $rowstore = $this->db->select('kode_store,nama_store')->where('kode_store',$store)->get('prm_store')->row();
    if ($cek->num_rows()>0) {
      $a = $cek->row();
      if ($a->status=='aktif') {
       $datasesion = [
        'store'=> $rowstore->kode_store,
        'namastore'=> $rowstore->nama_store,
        'nik'=>$nik,
        'nama'=>$a->nama,
        'level'=>$a->level,
      ];
      $this->session->set_userdata($datasesion);
      $msg=['sukses'=>'.'];
      }else{
          $msg=['gagal'=>'User Sudah Tidak Aktif Lagi'];
      }
    }else{
      $msg=['gagal'=>'password atau nik salah'];
    }
    echo json_encode($msg);
   }
   public function logout (){ 
     $this->session->sess_destroy();
     redirect('');
    }
}
