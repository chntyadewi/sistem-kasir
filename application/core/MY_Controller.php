<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        // Cek apakah user sudah login dan role-nya admin
        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
    }
} 
