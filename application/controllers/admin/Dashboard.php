<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
    }
    
    public function index() {
        // Data untuk dashboard
        $data['total_produk'] = $this->db->count_all('produk');
        $data['total_kategori'] = $this->db->count_all('kategori');
        $data['total_penjualan'] = $this->db->count_all('penjualan');
        // $data['total_pengguna'] = $this->db->count_all('pengguna');

        $data['low_stock_products'] = $this->produk_model->get_low_stock_products();
        
        // Load view dashboard
        $this->load->view('admin/templates/header'); 
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
} 
