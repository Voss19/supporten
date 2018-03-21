<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// $this->db->order_by('col', 'asc')  # 1,2,3,4,5,6...
		// $this->db->order_by('col', 'desc') # 99,98,97,96...
		$data['top_users'] = $this->db->order_by('points', 'desc')->limit(5)->get('users')->result_array();
		$data['latest_cases'] = $this->db->order_by('c_id', 'desc')->limit(5)->get('cases')->result_array();
		$this->loader->view('index', $data);
	}
}
