<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {
    
    public function get_all_products($search = null) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id = produk.kategori_id', 'left');
        $this->db->where('produk.status', 'aktif');
        
        // Tambahkan kondisi pencarian jika parameter search ada
        if ($search) {
            $this->db->group_start();
            $this->db->like('produk.nama_produk', $search);
            $this->db->or_like('kategori.nama_kategori', $search);
            $this->db->or_like('produk.harga', $search);
            $this->db->group_end();
        }
        
        return $this->db->get()->result();
    }
    
    
    public function get_product($id) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id = produk.kategori_id', 'left');
        $this->db->where('produk.id', $id);
        return $this->db->get()->row();
    }
    
    public function create_product($data) {
        // Upload gambar jika ada
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path'] = './uploads/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
            }
        }
        $data['status'] = 'aktif';
        return $this->db->insert('produk', $data);
    }
    
    public function update_product($id, $data) {
        // Ambil data produk lama
        $old_product = $this->get_product($id);
        
        // Upload gambar baru jika ada
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path'] = './uploads/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika bukan default.jpg
                if ($old_product->gambar && $old_product->gambar != 'default.jpg') {
                    $old_image_path = './uploads/produk/' . $old_product->gambar;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
                
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
    }
    
    public function delete_product($id) {
        // Ambil data produk sebelum dihapus
        $product = $this->get_product($id);
        
        // Hapus gambar jika bukan default.jpg
        if ($product->gambar && $product->gambar != 'default.jpg') {
            $image_path = './uploads/produk/' . $product->gambar;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        
        return $this->db->delete('produk', ['id' => $id]);
    }
    
    public function get_available_products() {
        $this->db->where('stok >', 0);
        $this->db->order_by('nama_produk', 'ASC');
        return $this->db->get('produk')->result();
    }

    public function get_low_stock_products($limit = 20) {
    return $this->db->where('stok <', 20)
                    ->order_by('stok', 'ASC')
                    ->limit($limit)
                    ->get('produk')
                    ->result();
    }

    public function delete_produk($id)
{
    return $this->db->delete('produk', ['id' => $id]);
}

public function nonaktifkan_produk($id) {
    return $this->db->update('produk', ['status' => 'nonaktif'], ['id' => $id]);
}

public function aktifkan_produk($id) {
    return $this->db->update('produk', ['status' => 'aktif'], ['id' => $id]);
}



    
} 
