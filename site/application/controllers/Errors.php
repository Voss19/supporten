<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	public function err_404()
	{
		$this->output->set_status_header('404');
		$data['title'] = "404 Side ikke fundet";
		$this->loader->view(null, $data);
	}
}
