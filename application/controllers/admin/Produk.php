<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->library('form_validation');
    }
    
    public function index() {
        // Ambil parameter pencarian dari URL
        $search = $this->input->get('search');
        
        // Kirim parameter search ke model
        $data['products'] = $this->produk_model->get_all_products($search);
        $data['categories'] = $this->kategori_model->get_all_categories();
        
        $this->load->view('admin/templates/header');
        $this->load->view('admin/produk/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    public function create() {
        $data['categories'] = $this->kategori_model->get_all_categories();
        
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        
        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/produk/create', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'kategori_id' => $this->input->post('kategori_id'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'gambar' => $this->_uploadImage()
            );
            
            if($this->produk_model->create_product($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan');
                redirect('admin/produk');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan produk');
                redirect('admin/produk/create');
            }
        }
    }
    
    public function edit($id) {
        $data['product'] = $this->produk_model->get_product($id);
        $data['categories'] = $this->kategori_model->get_all_categories();
        
        if(!$data['product']) {
            show_404();
        }
        
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        
        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/produk/edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'kategori_id' => $this->input->post('kategori_id'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
            );

            // Cek jika ada gambar yang di upload
            if(!empty($_FILES['gambar']['name'])) {
                // Hapus file lama sebelum upload yang baru
                $old_product = $this->produk_model->get_product($id);
                if($old_product->gambar && $old_product->gambar != 'default.jpg') {
                    $old_image_path = './uploads/produk/' . $old_product->gambar;
                    if(file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
                
                $data['gambar'] = $this->_uploadImage();
            }
            
            if($this->produk_model->update_product($id, $data)) {
                $this->session->set_flashdata('success', 'Produk berhasil diupdate');
                redirect('admin/produk');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengupdate produk');
                redirect('admin/produk/edit/'.$id);
            }
        }
    }
    
    public function delete($id) {
        $product = $this->produk_model->get_product($id);
        
        // // Hapus file gambar jika ada dan bukan default
        // if($product && $product->gambar && $product->gambar != 'default.jpg') {
        //     $image_path = './uploads/produk/' . $product->gambar;
        //     if(file_exists($image_path)) {
        //         unlink($image_path);
        //     }
        // }

        if ($this->produk_model->nonaktifkan_produk($id)) {
            $this->session->set_flashdata('success', 'Produk berhasil dinonaktifkan');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menonaktifkan produk');
        }
        redirect('admin/produk');
    }

    private function _uploadImage() {
        $config['upload_path']          = './uploads/produk/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }

    public function restore($id) {
        if ($this->produk_model->aktifkan_produk($id)) {
            $this->session->set_flashdata('success', 'Produk berhasil diaktifkan kembali');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengaktifkan produk');
        }
        redirect('admin/produk/arsip'); 
    }
    
    public function arsip() {
        $this->db->where('status', 'nonaktif');
        $data['products'] = $this->db->get('produk')->result();
        $data['categories'] = $this->kategori_model->get_all_categories();
    
        $this->load->view('admin/templates/header');
        $this->load->view('admin/produk/arsip', $data);
        $this->load->view('admin/templates/footer');
    }
    
} 
