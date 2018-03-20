<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sag extends CI_Controller {

	public function opret()
	{
		$this->sess->to_login();

		if ($this->input->post()) {
			$this->form_validation->set_rules('title','Titel','required');
			$this->form_validation->set_rules('content','Beskrivelse','required');

			if ($this->form_validation->run()) {
				echo "rj";
				if ($this->input->post('img')) {
					echo "le";
					$config['upload_path']			= FCPATH.'assets/images/cases';
					$config['allowed_types']		= 'gif|jpg|png';
					$config['max_size']				= 8192;
					$config['max_width']			= 1920;
					$config['max_height']			= 1080;
					$config['encrypt_name']			= true;
					$config['file_ext_tolower']		= true;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload()){
						echo "le";
						$formdata['c_image'] = $this->upload->data('file_name');
					}
				}

				$formdata['c_title'] = $this->input->post('title');
				$formdata['c_content'] = $this->input->post('content');
				$formdata['c_owner'] = $this->loader->user->u_id;
				$this->db->insert('cases', $formdata);
			}
		}
		$this->loader->view('sag/opret');
	}
}
