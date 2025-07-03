<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('penjualan_model');
    }
    
    public function index() {
        $data['sales'] = $this->penjualan_model->get_all_sales();
        
        $tahun  = $this->input->get('tahun');
        $bulan  = $this->input->get('bulan');
        $minggu = $this->input->get('minggu');

    $this->load->model('Penjualan_model');
    $data['sales'] = $this->Penjualan_model->get_filtered_sales($tahun, $bulan, $minggu);

        $this->load->view('admin/templates/header');
        $this->load->view('admin/penjualan/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    public function view($id) {
        $data['sale'] = $this->penjualan_model->get_sale($id);
        $data['items'] = $this->penjualan_model->get_sale_details($id);
        
        if(!$data['sale']) {
            show_404();
        }
        $this->load->view('admin/penjualan/view', $data);
    }

    public function cetak() {
        $tahun  = $this->input->get('tahun');
        $bulan  = $this->input->get('bulan');
        $minggu = $this->input->get('minggu');
    
        $data['sales'] = $this->penjualan_model->get_filtered_sales($tahun, $bulan, $minggu);
    
        $this->load->view('admin/penjualan/cetak', $data);
    }
    
    
} 
