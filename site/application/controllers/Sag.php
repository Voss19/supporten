<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sag extends CI_Controller {

	public function index($id = null)
	{
		if (!$id) {
			redirect();
		}

		if ($this->input->post('comment')) {
			if ($this->loader->user) {
				$this->form_validation->set_rules('content', 'Kommentar', 'required');

				if ($this->form_validation->run()) {
					$formdata = array(
						'com_c_id' => $id,
						'com_u_id' => $this->loader->user->u_id,
						'com_content' => $this->input->post('content')
					);

					$this->db->insert('comments', $formdata);
				}
			}
		}

		$caseQuery = $this->db->where('c_id', $id)->get('cases');

		if ($caseQuery->num_rows()) {
			$data['case'] = $caseQuery->row();

			$userQuery = $this->db->where('u_id', $caseQuery->row()->c_owner)->get('users');

			$data['owner'] = $userQuery->row();
		}

		$commentQuery = $this->db->where('com_c_id', $id)->get('comments');

		if ($commentQuery->num_rows()) {
			$data['comments'] = $commentQuery->result_array();

			foreach ($data['comments'] as $key => $comment) {
				$data['comments'][$key]['user'] = $this->db->where('u_id', $comment['com_u_id'])->get('users')->row();
			}

			$data['comments'] = array_reverse($data['comments']);
		}

		if ($caseQuery->num_rows()) {
			$this->loader->view('sag/index', $data);
		} else {
			$this->loader->view();
		}
	}

	public function opret()
	{
		$this->sess->to_login();

		if ($this->input->post('opret')) {
			$this->form_validation->set_rules('title','Titel','required');
			$this->form_validation->set_rules('content','Beskrivelse','required');

			if ($this->form_validation->run()) {
				$config['upload_path']			= FCPATH.'assets/images/cases';
				$config['allowed_types']		= 'gif|jpg|png';
				$config['max_size']				= 8192;
				$config['max_width']			= 1920;
				$config['max_height']			= 1080;
				$config['encrypt_name']			= true;
				$config['file_ext_tolower']		= true;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('img')){
					$formdata['c_image'] = $this->upload->data('file_name');
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
