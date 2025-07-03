<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php'; // ini manggil libraireies
require APPPATH . 'libraries/Format.php';


class Kategori extends RestController {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    // GET: api/kategori
    public function index_get() {
        $id = $this->get('id');

        if ($id === NULL) {
            $data = $this->Kategori_model->get_all_categories();
        } else {
            $data = $this->Kategori_model->get_category($id);
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // POST: api/kategori
    public function index_post() {
        $data = [
            'id' => $this->post('id'),
            'nama_kategori' => $this->post('nama_kategori')
        ];

        if ($this->Kategori_model->create_category($data)) {
            $this->response([
                'status' => true,
                'message' => 'Kategori berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal menambahkan kategori'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // PUT: api/kategori/{id}
    public function index_put() {
        $id = $this->put('id');
        $data = [
            'nama_kategori' => $this->put('nama_kategori')
        ];

        if ($this->Kategori_model->update_category($id, $data)) {
            $this->response([
                'status' => true,
                'message' => 'Kategori berhasil diperbarui'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal memperbarui kategori'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

     public function index() {
        $this->load->model('Kategori_model');
        $data = $this->Kategori_model->get_all();
        echo json_encode($data);
    }
    // DELETE: api/kategori/{id}
    public function index_delete() {
        $id = $this->delete('id');

        if ($id === NULL) {
            $this->response([
                'status' => false,
                'message' => 'ID tidak boleh kosong'
            ], RestController::HTTP_BAD_REQUEST);
        }

        if ($this->Kategori_model->delete_category($id)) {
            $this->response([
                'status' => true,
                'message' => 'Kategori berhasil dihapus'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Kategori gagal dihapus'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
