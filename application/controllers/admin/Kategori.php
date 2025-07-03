<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('kategori_model');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $data['categories'] = $this->kategori_model->get_all_categories();
        
        
        $this->load->view('admin/templates/header');
        $this->load->view('admin/kategori/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function create() {
    $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[kategori.nama_kategori]', [
        'is_unique' => 'Nama kategori sudah digunakan',
        'required' => 'Nama kategori harus diisi'
    ]);

    if ($this->form_validation->run() == FALSE) {
        // Simpan pesan error ke session flashdata dan redirect kembali ke halaman index
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/kategori');
    } else {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );

        if ($this->kategori_model->create_category($data)) {
            $this->session->set_flashdata('success', 'Jenis Produk berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan Jenis Produk');
        }
        redirect('admin/kategori');
    }
}

    
    // public function create() {
    //     $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[kategori.nama_kategori]');
        
    //     if($this->form_validation->run() == FALSE) {
    //         $this->load->view('admin/templates/header');
    //         $this->load->view('admin/templates/sidebar');
    //         $this->load->view('admin/kategori/create');
    //         $this->load->view('admin/templates/footer');
    //     } else {
    //         $data = array(
    //             'nama_kategori' => $this->input->post('nama_kategori')
    //         );
            
    //         if($this->kategori_model->create_category($data)) {
    //             $this->session->set_flashdata('success', 'Jenis Produk berhasil ditambahkan');
    //             redirect('admin/kategori');
    //         } else {
    //             $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan Jenis Produk');
    //             redirect('admin/kategori/create');
    //         }
    //     }
    // }
    
    public function edit($id) {
        $data['category'] = $this->kategori_model->get_category($id);
        
        if(!$data['category']) {
            show_404();
        }
        
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 
            'required|callback_check_unique_category['.$id.']');
        
        if($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/kategori/edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori')
            );
            
            if($this->kategori_model->update_category($id, $data)) {
                $this->session->set_flashdata('success', 'Jenis Produk berhasil diupdate');
                redirect('admin/kategori');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengupdate Jenis Produk');
                redirect('admin/kategori/edit/'.$id);
            }
        }
    }
    
    public function delete($id) {
        if($this->kategori_model->delete_category($id)) {
            $this->session->set_flashdata('success', 'Jenis Produk berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus Jenis Produk');
        }
        redirect('admin/kategori');
    }
    
    public function check_unique_category($str, $id) {
        $this->db->where('nama_kategori', $str);
        $this->db->where('id !=', $id);
        $category = $this->db->get('kategori')->row();

        if($category) {
            // Ganti pesan error untuk callback ini
            $this->form_validation->set_message('check_unique_category', '%s sudah digunakan. Silakan pakai nama lain.');
            return FALSE;
        }

    return TRUE;
}

} 
