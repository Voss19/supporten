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

	public function view($content = 'template/page_not_found', $data = array())
	{
		if (!$content) {
			$content = 'template/page_not_found';
		}

		$data['css'][] = 'main';

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view($content, $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/end', $data);
	}
}
