<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    public function index() {
        if ($this->session->userdata('logged_in')) {
            if ($this->session->userdata('role') == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('kasir/dashboard');
            }
        }
        $this->load->view('auth/login');
    }
    
    public function login() {
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        
        $user = $this->auth_model->check_login($nama, $password);
        
        if ($user) {
            $userdata = array(
                'user_id' => $user->id,
                'nama' => $user->nama,
                'role' => $user->role,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($userdata);

            // flashdata agar alert hanya muncul sekali
            $this->session->set_flashdata('welcome', 'true');
            
            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('kasir/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Nama atau Password salah');
            redirect('auth');
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
