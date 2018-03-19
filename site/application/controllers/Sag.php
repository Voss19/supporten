<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sag extends CI_Controller {

	public function opret()
	{
		$this->sess->to_login();
		$this->loader->view('sag/opret');
	}
}
