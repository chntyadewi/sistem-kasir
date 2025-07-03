<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{

	public function get_user_by_nama($nama)
{
    return $this->db->get_where('pengguna', ['nama' => $nama])->row();
}



	public function get_all_users()
	{
		return $this->db->get('pengguna')->result();
	}

	public function get_user($id)
	{
		return $this->db->get_where('pengguna', ['id' => $id])->row();
	}

	public function create_user($data)
	{
		return $this->db->insert('pengguna', $data);
	}

	public function update_user($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('pengguna', $data);
	}

	public function delete_user($id)
	{
		return $this->db->delete('pengguna', ['id' => $id]);
	}

	public function check_email($email, $id = null)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('email', $email);
		return $this->db->get('pengguna')->num_rows() > 0;
	}
}