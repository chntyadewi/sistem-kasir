<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('pengguna_model');
        $this->load->library(['form_validation', 'upload']);

        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('admin/dashboard');
        }
    }

    public function index() {
        $data['users'] = $this->pengguna_model->get_all_users();
        $this->load->view('admin/templates/header');
        $this->load->view('admin/pengguna/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function create() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');
        $this->form_validation->set_rules('kata_sandi', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,pengguna]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $role = $this->input->post('role');
            $folder = ($role == 'admin') ? 'admin' : 'kasir';

            // Upload gambar
            $gambar = '';
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path']   = './uploads/profile/' . $folder;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = 2048;
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar')) {
                    $gambar = $this->upload->data('file_name');
                }
            }

            $data = [
                'nama'       => $this->input->post('nama'),
                'email'      => $this->input->post('email'),
                'kata_sandi' => password_hash($this->input->post('kata_sandi'), PASSWORD_DEFAULT),
                'role'       => $role,
                'gambar'     => $gambar
            ];

            if ($this->pengguna_model->create_user($data)) {
                $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan');
                redirect('admin/pengguna');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan pengguna');
                redirect('admin/pengguna');
            }
        }
    }

    public function edit($id) {
        $data['user'] = $this->pengguna_model->get_user($id);
        if (!$data['user']) show_404();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$id.']');
        if ($this->input->post('kata_sandi')) {
            $this->form_validation->set_rules('kata_sandi', 'Password', 'min_length[6]');
        }
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,pengguna]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $role = $this->input->post('role');
            $folder = ($role == 'admin') ? 'admin' : 'kasir';

            $gambar = $data['user']->gambar;
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path']   = './uploads/profile/' . $folder;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = 2048;
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar')) {
                    // Hapus gambar lama jika ada
                    if ($gambar && file_exists('./uploads/profile/' . $data['user']->role . '/' . $gambar)) {
                        unlink('./uploads/profile/' . $data['user']->role . '/' . $gambar);
                    }
                    $gambar = $this->upload->data('file_name');
                }
            }

            $updateData = [
                'nama'   => $this->input->post('nama'),
                'email'  => $this->input->post('email'),
                'role'   => $role,
                'gambar' => $gambar
            ];

            if ($this->input->post('kata_sandi')) {
                $updateData['kata_sandi'] = password_hash($this->input->post('kata_sandi'), PASSWORD_DEFAULT);
            }

            if ($this->pengguna_model->update_user($id, $updateData)) {
                $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui');
                redirect('admin/pengguna');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui pengguna');
                redirect('admin/pengguna');
            }
        }
    }

    public function delete($id) {
        $user = $this->pengguna_model->get_user($id);

        if (!$user) {
            $this->session->set_flashdata('error', 'Pengguna tidak ditemukan');
            redirect('admin/pengguna');
        }

        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun sendiri');
            redirect('admin/pengguna');
        }

        if (!empty($user->gambar)) {
            $folder = ($user->role == 'admin') ? 'admin' : 'kasir';
            $filePath = './uploads/profile/' . $folder . '/' . $user->gambar;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        if ($this->pengguna_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'Pengguna berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pengguna');
        }
        redirect('admin/pengguna');
    }

    public function check_unique_email($email, $id) {
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        $user = $this->db->get('pengguna')->row();
        if ($user) {
            $this->form_validation->set_message('check_unique_email', 'Email sudah digunakan oleh pengguna lain.');
            return FALSE;
        }
        return TRUE;
    }
}
