<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function __construct()
{
	if ($this->session->user) {
		$user = $this->session->user;
		define('user', $user);
	}
}