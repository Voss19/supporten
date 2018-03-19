<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {

	var $user;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->user) {
			$sqlQuery = $this->db->where('u_email', $this->session->user)->get('users');

			if ($sqlQuery->num_rows()) {
				$this->user = $sqlQuery->row();
			}
		}
	}

	public function view($content = 'template/page_not_found', $data = array())
	{
		if (!$content) {
			$content = 'template/page_not_found';
		}
		
		if ($this->session->user) {
			$data['user'] = $this->user;
		}

		$data['css'][] = 'main';

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view($content, $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/end', $data);
	}
}
