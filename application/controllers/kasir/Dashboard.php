<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('penjualan_model');
        
        // Cek login
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        // Cek role
        if($this->session->userdata('role') != 'pengguna') {
            redirect('auth');
        }
    }
    
    public function index() {
        // Data untuk dashboard kasir
        $data['transaksi_hari_ini'] = $this->penjualan_model->count_todays_transactions();
        $data['total_penjualan_hari_ini'] = $this->penjualan_model->sum_todays_sales();
        
        $this->load->view('kasir/templates/header');
        $this->load->view('kasir/dashboard', $data);
        $this->load->view('kasir/templates/footer');
    }
} 
