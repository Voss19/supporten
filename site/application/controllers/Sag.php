<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sag extends CI_Controller {

	public function opret()
	{
		$this->sm->redirect();
		$this->loader->load('sag/opret');
	}
}
