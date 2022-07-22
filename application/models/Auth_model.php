<?php 
class Auth_model extends CI_Model { 
  public function cekuser ($nik,$password){ 
    $this->db->where('nik',$nik);
    $this->db->where('password',$password);
    return $this->db->get('users');
   }
 } 