<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {
    
    public function create_sale($sale_data, $sale_details) {
        $this->db->trans_start();
        
        // Insert ke tabel penjualan
        $this->db->insert('penjualan', $sale_data);
        $sale_id = $this->db->insert_id();
        
        // Insert ke tabel detail_penjualan dan update stok
        foreach($sale_details as $detail) {
            $detail['penjualan_id'] = $sale_id;
            $this->db->insert('detail_penjualan', $detail);
            
            // Update stok produk
            $this->db->set('stok', 'stok-'.$detail['kuantitas'], FALSE);
            $this->db->where('id', $detail['produk_id']);
            $this->db->update('produk');
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        
        return $sale_id;
    }

    public function get_penjualan() {
        $this->db->select('penjualan.*, pengguna.nama as nama_kasir');
        $this->db->from('penjualan');
        $this->db->join('pengguna', 'pengguna.id = penjualan.pengguna_id');
        $this->db->order_by('penjualan.tanggal', 'DESC');
        return $this->db->get()->result();
    }
    
    public function get_sale($id) {
        $this->db->select('penjualan.*, pengguna.nama as nama_kasir');
        $this->db->from('penjualan');
        $this->db->join('pengguna', 'pengguna.id = penjualan.pengguna_id');
        $this->db->where('penjualan.id', $id);
        return $this->db->get()->row();
    }
    
    public function get_sale_details($id) {
        $this->db->select('detail_penjualan.*, produk.nama_produk, produk.harga');
        $this->db->from('detail_penjualan');
        $this->db->join('produk', 'produk.id = detail_penjualan.produk_id');
        $this->db->where('penjualan_id', $id);
        return $this->db->get()->result();
    }
    
    public function get_all_sales() {
        $this->db->select('penjualan.*, pengguna.nama as nama_kasir');
        $this->db->from('penjualan');
        $this->db->join('pengguna', 'pengguna.id = penjualan.pengguna_id');
        $this->db->order_by('penjualan.tanggal', 'DESC');
        return $this->db->get()->result();
    }
    
    public function count_todays_transactions() {
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        return $this->db->count_all_results('penjualan');
    }
    
    public function sum_todays_sales() {
        $this->db->select_sum('total');
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        $result = $this->db->get('penjualan')->row();
        return $result ? $result->total : 0;
    }
    
    public function get_todays_transactions() {
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('penjualan')->result();
    }
    
    public function get_user_transactions($user_id) {
        $this->db->where('pengguna_id', $user_id);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('penjualan')->result();
    }

    public function get_filtered_sales($tahun = null, $bulan = null, $minggu = null) {
        $this->db->select('penjualan.*, pengguna.nama as nama_kasir');
        $this->db->from('penjualan');
        $this->db->join('pengguna', 'pengguna.id = penjualan.pengguna_id', 'left');
        
        if ($tahun) {
            $this->db->where('YEAR(penjualan.tanggal)', $tahun);
        }
        if ($bulan) {
            $this->db->where('MONTH(penjualan.tanggal)', $bulan);
        }
        if ($minggu) {
            $this->db->where('WEEK(penjualan.tanggal, 1) =', $minggu);
        }
        
        $this->db->order_by('penjualan.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_detail($id) {
        $this->db->select('penjualan.*, pengguna.nama as nama_kasir');
        $this->db->from('penjualan');
        $this->db->join('pengguna', 'pengguna.id = penjualan.pengguna_id');
        $this->db->where('penjualan.id', $id);
        $sale = $this->db->get()->row();
    
        $this->db->select('detail_penjualan.*, produk.nama_produk, produk.harga');
        $this->db->from('detail_penjualan');
        $this->db->join('produk', 'produk.id = detail_penjualan.produk_id');
        $this->db->where('detail_penjualan.penjualan_id', $id);
        $items = $this->db->get()->result();
    
        return [
            'sale' => $sale,
            'items' => $items
        ];
    }
    
    
} 
