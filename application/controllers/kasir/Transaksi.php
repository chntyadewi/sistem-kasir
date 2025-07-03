<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        date_default_timezone_set('Asia/Makassar'); 
        
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        if($this->session->userdata('role') !== 'pengguna') {
            redirect('auth/login');
        }
        
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->model('kategori_model');
        $this->load->model('produk_model');
        $this->load->model('penjualan_model');
    }
    
    public function index() {
        $search = $this->input->get('search');
        $data['products'] = $this->produk_model->get_all_products($search);
        echo "<!-- Debug: " . json_encode($data['products']) . " -->";
        
        $data['categories'] = $this->kategori_model->get_all_categories();

        $data['products'] = $this->produk_model->get_all_products($search);
        
        $this->load->view('kasir/templates/header');
        $this->load->view('kasir/transaksi/index', $data);
        $this->load->view('kasir/templates/footer');
    }
    
    public function process() {
        $items = json_decode($this->input->post('items'), true);
        $total = $this->input->post('total');
        $bayar = $this->input->post('bayar');
        
        if(empty($items)) {
            $this->session->set_flashdata('error', 'Tidak ada item yang dipilih');
            redirect('kasir/transaksi');
        }
        
        if($bayar < $total) {
            $this->session->set_flashdata('error', 'Jumlah pembayaran kurang');
            redirect('kasir/transaksi');
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
            redirect('kasir/transaksi/struk/'.$sale_id);
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses transaksi');
            redirect('kasir/transaksi');
        }
    }
    
    public function struk($id) {
        $data['sale'] = $this->penjualan_model->get_sale($id);
        $data['items'] = $this->penjualan_model->get_sale_details($id);
        
        if(!$data['sale']) {
            show_404();
        }
        
        $this->load->view('kasir/transaksi/struk', $data);
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
    
    public function view($id) {
        $data['detail'] = [
            'sale' => $this->penjualan_model->get_sale($id),
            'items' => $this->penjualan_model->get_sale_details($id)
        ];
        $data['sale'] = $data['detail']['sale'];
        $data['items'] = $data['detail']['items'];
        $this->load->view('kasir/transaksi/view', $data);
    }
    
    
} 
