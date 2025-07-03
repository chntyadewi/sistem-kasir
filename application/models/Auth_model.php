<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    public function check_login($nama, $password) {
        $user = $this->db->get_where('pengguna', ['nama' => $nama])->row();
        
        if($user && password_verify($password, $user->kata_sandi)) {
            return $user;
        }
        return false;
    }
} 
