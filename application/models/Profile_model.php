<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function get_profile($id) {
        return $this->db->get_where('pengguna', ['id' => $id])->row();
    }

    public function update_profile($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pengguna', $data);
    }

    public function check_password($id, $current_password) {
        $user = $this->get_profile($id);
        return password_verify($current_password, $user->kata_sandi);
    }
}
