<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug_model extends CI_Model {

	public function post($exit = null)
	{
		echo "<pre>";
			print_r($this->input->post());
		echo "</pre>";

		if ($exit) {
			exit;
		}
	}

	public function session($exit = null)
	{
		echo "<pre>";
			print_r($this->session->userdata());
		echo "</pre>";

		if ($exit) {
			exit;
		}
	}

	public function arr($arr = array(), $exit = null)
	{
		echo "<pre>";
			print_r($arr);
		echo "</pre>";

		if ($exit) {
			exit;
		}
	}
}