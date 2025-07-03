<?php
use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

class Detail_penjualan extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_penjualan_model');
    }

    // GET: /detail_penjualan
    public function index_get($id = null)
    {
        if ($id === null) {
            $data = $this->Detail_penjualan_model->get_all();
        } else {
            $data = $this->Detail_penjualan_model->get_by_id($id);
        }

        if ($data) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(['message' => 'Data tidak ditemukan'], RestController::HTTP_NOT_FOUND);
        }
    }

    // POST: /detail_penjualan
    public function index_post()
    {
        $data = [
            'penjualan_id' => $this->post('penjualan_id'),
            'produk_id'    => $this->post('produk_id'),
            'kuantitas'    => $this->post('kuantitas'),
            'subtotal'     => $this->post('subtotal'),
        ];

        if ($this->Detail_penjualan_model->insert($data)) {
            $this->response(['message' => 'Data berhasil ditambahkan'], RestController::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Gagal menambahkan data'], RestController::HTTP_BAD_REQUEST);
        }
    }

    // PUT: /detail_penjualan/{id}
    public function index_put($id)
    {
        $data = [
            'penjualan_id' => $this->put('penjualan_id'),
            'produk_id'    => $this->put('produk_id'),
            'kuantitas'    => $this->put('kuantitas'),
            'subtotal'     => $this->put('subtotal'),
        ];

        if ($this->Detail_penjualan_model->update($id, $data)) {
            $this->response(['message' => 'Data berhasil diubah'], RestController::HTTP_OK);
        } else {
            $this->response(['message' => 'Gagal mengubah data'], RestController::HTTP_BAD_REQUEST);
        }
    }

    // DELETE: /detail_penjualan/{id}
    public function index_delete($id)
    {
        if ($this->Detail_penjualan_model->delete($id)) {
            $this->response(['message' => 'Data berhasil dihapus'], RestController::HTTP_OK);
        } else {
            $this->response(['message' => 'Gagal menghapus data'], RestController::HTTP_BAD_REQUEST);
        }
    }
}
