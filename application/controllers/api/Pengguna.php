<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Pengguna extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengguna_model');
    }

public function login_post()
{
   log_message('debug', 'LOGIN POST DIPANGGIL');

    $nama = $this->post('nama');
    $password = $this->post('password');

    if (!$nama || !$password) {
        return $this->response([
            'status' => false,
            'message' => 'Nama dan password wajib diisi'
        ], 400);
    }

    $user = $this->Pengguna_model->get_user_by_nama($nama);

    if ($user) {
        if (password_verify($password, $user->kata_sandi)) {
            unset($user->kata_sandi); // jangan kirim password kembali

            return $this->response([
                'status' => true,
                'message' => 'Login berhasil',
                'user' => $user
            ], 200);
        } else {
            return $this->response([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
        }
    } else {
        return $this->response([
            'status' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }
}


    
}
