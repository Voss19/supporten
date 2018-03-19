<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {

	public function to_login()
	{
		if (!$this->session->user) {
			redirect('bruger/login');
		}
	}

	public function is_logged_in()
	{
		if ($this->session->user) {
			redirect();
		}
	}
}
