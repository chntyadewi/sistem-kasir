<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url'); // Memuat URL helper
	}

	public function index() {
		$this->load->view('admin/index');
    }
}