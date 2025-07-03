<?php
use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Produk extends RestController {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
    }

    public function index_get() {
        $search = $this->get('search');
        $produk = $this->Produk_model->get_all_products($search);
        $this->response($produk, 200);
    }

    public function detail_get($id) {
        $produk = $this->Produk_model->get_product($id);
        if ($produk) {
            $this->response($produk, 200);
        } else {
            $this->response(['status' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }
    }

    public function tambah_post()
{
    $data = [
        'nama_produk' => $this->post('nama_produk'),
        'harga' => $this->post('harga'),
        'stok' => $this->post('stok'),
        'kategori_id' => $this->post('kategori_id'),
    ];

    if ($this->Produk_model->create_product($data)) {
        $this->response(['status' => true, 'message' => 'Produk berhasil ditambahkan'], 201);
    } else {
        $this->response(['status' => false, 'message' => 'Gagal menambah produk'], 400);
    }
}

public function ubah_put($id)
{
    $data = [
        'nama_produk' => $this->put('nama_produk'),
        'harga' => $this->put('harga'),
        'stok' => $this->put('stok'),
        'kategori_id' => $this->put('kategori_id'),
    ];

    if ($this->Produk_model->update_product($id, $data)) {
        $this->response(['status' => true, 'message' => 'Produk berhasil diubah'], 200);
    } else {
        $this->response(['status' => false, 'message' => 'Gagal mengubah produk'], 400);
    }
}

public function hapus_delete($id)
{
    if (!$id) {
        $this->response(['status' => false, 'message' => 'ID wajib diisi'], 400);
        return;
    }

    $deleted = $this->Produk_model->delete_produk($id);

    if ($deleted) {
        $this->response(['status' => true, 'message' => 'Produk berhasil dihapus']);
    } else {
        $this->response(['status' => false, 'message' => 'Gagal menghapus produk'], 500);
    }
}



}
