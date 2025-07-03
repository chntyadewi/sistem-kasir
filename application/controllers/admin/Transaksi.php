<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar'); 
        $this->load->model('kategori_model');
        $this->load->model('produk_model');
        $this->load->model('penjualan_model');
    }
    
    public function index() {
        // Ambil parameter pencarian dari URL
        $search = $this->input->get('search');

        
        $data['categories'] = $this->kategori_model->get_all_categories();

        $data['products'] = $this->produk_model->get_all_products($search);
        
        
        $this->load->view('admin/templates/header');
        $this->load->view('admin/transaksi/index', $data);
        $this->load->view('admin/templates/footer');
        
    }
    
    public function process() {
        $items = json_decode($this->input->post('items'), true);
        $total = $this->input->post('total');
        $bayar = $this->input->post('bayar');
        
        if(empty($items)) {
            $this->session->set_flashdata('error', 'Tidak ada item yang dipilih');
            redirect('admin/transaksi');
        }
        
        if($bayar < $total) {
            $this->session->set_flashdata('error', 'Jumlah pembayaran kurang');
            redirect('admin/transaksi');
        }
        
        $sale_data = array(
            'tanggal' => date('Y-m-d H:i:s'),
            'no_invoice' => $this->buatnoinvoice(),
            'total' => $total,
            'bayar' => $bayar,
            'kembali' => $bayar - $total,
            'pengguna_id' => $this->session->userdata('user_id')
        );
        
        $sale_details = array();
        foreach($items as $item) {
            $sale_details[] = array(
                'produk_id' => $item['id'],
                'kuantitas' => $item['qty'],
                'subtotal' => $item['subtotal']
            );
        }
        
        $sale_id = $this->penjualan_model->create_sale($sale_data, $sale_details);
        
        if($sale_id) {
            redirect('admin/transaksi/struk/'.$sale_id);
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses transaksi');
            redirect('admin/transaksi');
        }
    }
    
    public function struk($id) {
        $data['sale'] = $this->penjualan_model->get_sale($id);
        $data['items'] = $this->penjualan_model->get_sale_details($id);
        
        if(!$data['sale']) {
            show_404();
        }
        
        $this->load->view('admin/transaksi/struk', $data);
    }

    function buatnoinvoice()
    {
        $kata = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $tahun = date('Y');
        $bulan = date('m');
        $nomoracak = substr(str_shuffle($kata), 0, 4);	
        $noTransaksi = "EZW-" . $tahun . $bulan . "-" . $nomoracak;
        return $noTransaksi;
    }
} 
