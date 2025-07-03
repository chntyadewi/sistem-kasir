<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {
    
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
        // Ambil data riwayat transaksi untuk kasir yang sedang login
        $id_kasir = $this->session->userdata('id');
        $data['sales'] = $this->penjualan_model->get_penjualan($id_kasir); // Mengubah nama method sesuai yang ada di model
        $tahun  = $this->input->get('tahun');
        $bulan  = $this->input->get('bulan');
        $minggu = $this->input->get('minggu');

    $this->load->model('Penjualan_model');
    $data['sales'] = $this->Penjualan_model->get_filtered_sales($tahun, $bulan, $minggu);

        
        $this->load->view('kasir/templates/header');
        $this->load->view('kasir/transaksi/riwayat', $data);
        $this->load->view('kasir/templates/footer');
    }

    public function struk($id) {
        // Ambil data penjualan dan item yang dibeli
        $data['sale'] = $this->penjualan_model->get_sale_by_id($id);
        $data['items'] = $this->penjualan_model->get_sale_items($id);

        // Pastikan struk milik kasir yang sedang login
        if($data['sale']->id_kasir != $this->session->userdata('id')) {
            redirect('kasir/riwayat');
        }

        $this->load->view('kasir/transaksi/struk', $data);
    }

    
}
