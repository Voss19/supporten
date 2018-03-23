<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// $this->db->order_by('col', 'asc')  # 1,2,3,4,5,6...
		// $this->db->order_by('col', 'desc') # 99,98,97,96...
		$data['top_users'] = $this->db->order_by('points', 'desc')->limit(5)->get('users')->result_array();
		$data['latest_cases'] = $this->db->order_by('c_id', 'desc')->limit(5)->get('cases')->result_array();

		$cases = $this->db->get('cases')->result_array();

		$data['top_cases'] = array();
		
		$i = 0;
		foreach ($cases as $case) {
			$votes = $this->db->where('token', $case['token'])->get('votes');
			$data['top_cases'][$i] = array();
			$data['top_cases'][$i]['votes'] = $votes->num_rows();
			$data['top_cases'][$i]['case'] = $case;

			$i++;
		}
		
		$data['top_cases'] = array_reverse($this->arr->subval_sort($data['top_cases'],'votes'));

		$this->loader->view('index', $data);
	}
}
