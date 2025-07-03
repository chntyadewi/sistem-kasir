<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {
    

    public function get_all() {
        return $this->db->get('kategori')->result();
    }
    public function get_all_categories() {
        return $this->db->get('kategori')->result();
    }
    
    public function get_category($id) {
        return $this->db->get_where('kategori', ['id' => $id])->row();
    }
    
    public function create_category($data) {
        return $this->db->insert('kategori', $data);
    }
    
    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kategori', $data);
    }
    
    public function delete_category($id) {
        return $this->db->delete('kategori', ['id' => $id]);
    }

    
} 
