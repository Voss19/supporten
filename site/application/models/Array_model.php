<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Array_model extends CI_Model {

	public function subval_sort($a, $subkey) {

		foreach ($a as $k => $v) {
			$b[$k] = strtolower($v[$subkey]);
		}

		asort($b);

		foreach ($b as $key => $val) {
			$c[$key] = $a[$key];
		}
		
		return $c;
	}
}