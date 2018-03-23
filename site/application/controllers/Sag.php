<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sag extends CI_Controller {

	public function index($id = null)
	{
		if (!$id) {
			redirect();
		}

		$caseQuery = $this->db->where('c_id', $id)->get('cases');

		$solvedQuery = $this->db->where('s_c_id', $id)->where('s_solved', '1')->get('solved');

		$caseFetch = $this->db->where('c_id', $id)->get('cases')->row();

		if ($solvedQuery->num_rows()) {
			$data['is_solved'] = true;
		}

		if ($this->loader->user) {
			if ($this->input->post('vote')) {
				$voteData = array(
					'v_u_id' => $this->loader->user->u_id,
					'token' => $caseQuery->row()->token
				);
				$this->db->insert('votes', $voteData);
			}

			if ($this->input->post('rvote')) {
				$voteGet = $this->db->where('v_u_id', $this->loader->user->u_id)->where('token', $caseQuery->row()->token);

				if ($voteGet->get('votes')->num_rows()) {
					$this->db->where('v_u_id', $this->loader->user->u_id)
						->where('token', $caseQuery->row()->token)
							->delete('votes');
				}
			}

			if ($caseQuery->num_rows()) {

				if ($this->loader->user) {
					$voteCaseQuery = $this->db->where('v_u_id', $this->loader->user->u_id)->where('token', $caseFetch->token)->get('votes');
					if ($voteCaseQuery->num_rows()) {
						$data['voted'] = true;
					}
				}

				if ($this->loader->user->u_id == $caseQuery->row()->c_owner) {
					$data['is_owner'] = true;
					$solvedQuery = $this->db->where('s_c_id', $id)->where('s_solved', '1')->get('solved');
					if ($solvedQuery->num_rows()) {
						$data['is_solved'] = true;

						if ($this->input->post('nsolved')) {
							$this->db->where('s_c_id', $id)
								->where('s_solved', 1)
									->delete('solved');
							$data['is_solved'] = null;
						}
					}

					if ($this->input->post('solved')) {
						$solvedData = array(
							's_c_id' => $id,
							's_solved' => '1'
						);
						$this->db->insert('solved', $solvedData);
						$data['is_solved'] = true;
					}
				}
			}
		}

		if ($this->input->post('comment')) {
			if ($this->loader->user) {
				$this->form_validation->set_rules('content', 'Kommentar', 'required');

				if ($this->form_validation->run()) {
					$formdata = array(
						'com_c_id' => $id,
						'com_u_id' => $this->loader->user->u_id,
						'com_content' => htmlspecialchars(str_replace("\n", "<br>", $this->input->post('content')))
					);

					$this->db->insert('comments', $formdata);

					$this->db->where('com_id', $this->db->insert_id())
						->update('comments', array(
							'token' => md5('com'.$this->db->insert_id())
						));
				}
			}
		}

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
			$data['votes'] = $this->db->where('token', $caseFetch->token)->get('votes')->num_rows();
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

				$formdata['c_title'] = htmlspecialchars($this->input->post('title'));
				$formdata['c_content'] = htmlspecialchars(str_replace("\n", "<br>", $this->input->post('content')));
				$formdata['c_owner'] = $this->loader->user->u_id;
				$this->db->insert('cases', $formdata);

				$this->db->where('c_id', $this->db->insert_id())
						->update('cases', array(
							'token' => md5('case'.$this->db->insert_id())
						));
			}
		}
		$this->loader->view('sag/opret');
	}
}
