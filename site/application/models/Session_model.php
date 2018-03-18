<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {

	public function redirect()
	{
		if ($this->session->user) {
			redirect('bruger/login');
		}
	}
}
