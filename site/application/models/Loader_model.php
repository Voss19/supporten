<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {

	var $user;

	public function __construct()
	{
		parent::__construct();

		// The mail sending protocol.
		$config['protocol'] = 'smtp';
		// SMTP Server Address for Gmail.
		$config['smtp_host'] = "ssl://smtp.googlemail.com";
		// SMTP Port - the port that you is required
		$config['smtp_port'] = 465;
		// SMTP Username like. (abc@gmail.com)
		$config['smtp_user'] = "snurresturlosson@gmail.com";
		// SMTP Password like (abc***##)
		$config['smtp_pass'] = "PinkBox01";
		// Load email library and passing configured values to email library
		$this->load->library('email', $config);

		if ($this->session->user) {
			$sqlQuery = $this->db->where('u_email', $this->session->user)->get('users');

			if ($sqlQuery->num_rows()) {
				$this->user = $sqlQuery->row();
			}
		}
	}

	public function view($content = 'template/page_not_found', $data = array(), $exit = null)
	{
		if (!$content) {
			$content = 'template/page_not_found';
		}

		if ($this->input->post('search')) {
			$content = 'template/search';
			$sb = explode(" ", $this->input->post('sb'));
			$i = 0;
			foreach ($sb as $key => $value) {
				if ($i == 0) {
					$this->db->like('c_title', $sb[$key]);
					$this->db->or_like('c_content', $sb[$key]);
					$i = 1;
				} else {
					$this->db->or_like('c_title', $sb[$key]);
					$this->db->or_like('c_content', $sb[$key]);
				}
			}
			$sqlQuery = $this->db->get('cases');

			if ($sqlQuery->num_rows()) {
				$data['search'] = $sqlQuery->result_array();
			}
		}

		$data['css'][] = 'main';

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view($content, $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/end', $data);
	}
}
