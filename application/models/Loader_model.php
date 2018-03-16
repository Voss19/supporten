<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {

	public function load($content = 'page_not_found', $data = array())
	{
		$this->load->view('css');
		echo phpinfo();
	}
}
