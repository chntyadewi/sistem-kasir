<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profile_model');
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }

    public function index() {
        $id = $this->session->userdata('user_id');
        $data['user'] = $this->Profile_model->get_profile($id);
        $this->load->view('admin/templates/header');
        $this->load->view('admin/profile/edit_profile', $data);
        $this->load->view('admin/templates/footer');
    }

    public function update() {
        $id = $this->session->userdata('user_id');
        $user = $this->Profile_model->get_profile($id);

        $data = [
            'nama' => $this->input->post('nama', TRUE),
        ];

        $current_pass = $this->input->post('current_password');
        $new_pass     = $this->input->post('new_password');
        $confirm_pass = $this->input->post('confirm_password');

        if ($current_pass && $new_pass && $confirm_pass) {
            if (!$this->Profile_model->check_password($id, $current_pass)) {
                $this->session->set_flashdata('error', 'Password saat ini salah');
                redirect('admin/profile');
            }

            if ($new_pass !== $confirm_pass) {
                $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok');
                redirect('admin/profile');
            }

            $data['kata_sandi'] = password_hash($new_pass, PASSWORD_DEFAULT);
        }

        if (!empty($_FILES['gambar']['name'])) {
            // Konfigurasi upload
            $config['upload_path']   = './uploads/profile/admin/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['file_name']     = 'user_' . $id . '_' . time();
        
            $this->load->library('upload', $config);
        
            // Coba upload
            if ($this->upload->do_upload('gambar')) {
                // Jika upload berhasil, hapus gambar lama (kecuali default)
                if ($user->gambar && $user->gambar != 'pic.jpg') {
                    $old_path = './uploads/profile/admin/' . $user->gambar;
                    if (file_exists($old_path)) {
                        unlink($old_path); 
                    }
                }
        
                // Simpan nama gambar baru
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/profile');
            }
        }        

        $this->Profile_model->update_profile($id, $data);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
        redirect('admin/profile');
    }
}
