<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bruger extends CI_Controller {

	public function upload()
	{
		if ($this->input->post()) {
			$config['upload_path']          = FCPATH.'assets/images/profilepictures';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 8192;
			$config['max_width']            = 1920;
			$config['max_height']           = 1080;
			$config['encrypt_name']			= true;
			$config['file_ext_tolower']		= true;

			$this->load->library('upload', $config);

			if($this->upload->do_upload()){
				
			}
		}
	}
	public function update($u_id = null){
		if(!$u_id){
			redirect();
		}
		$this->db->where('u_id',$u_id);
		$sqlQuery = $this->db->get('users');
		if($sqlQuery->num_rows()){
			$data = $sqlQuery->row_array();
		}else{
			redirect();
		}

		$data['all_groups'] = $this->db->get('groups')->result_array();
		$data['groupassignments'] = $this->db->where('ga_uid',$u_id)->get('groupassignments')->result_array();

		$groupassignments = array();
		foreach($data['groupassignments'] as $value){
			$groupassignments[] = $value['ga_gid'];
		}

		foreach($data['all_groups'] as $key => $value){
			if(in_array($value['g_id'],$groupassignments)){
				$data['all_groups'][$key]['checked'] = "checked";
			}
		}

		if($this->input->post()){
			$dbFetch = $this->db->where('u_id',$u_id)->get('users')->row();
			if(password_verify($this->input->post('formCurrentPassword'),$dbFetch->u_password)){
				$this->form_validation->set_rules('formEmail','E-Mail','required|valid_email');
				if($this->input->post('formPassword') || $this->input->post('formPasswordRepeat')){
					$this->form_validation->set_rules('formPassword','Password','required|trim');
					$this->form_validation->set_rules('formPasswordRepeat','Repeated Password','required|trim|matches[formPassword]');
				}
				$this->form_validation->set_rules('formFirstname','First Name','trim');
				$this->form_validation->set_rules('formLastname','Last Name','trim');
				$this->form_validation->set_rules('formWebsite','Website','trim|valid_url');
				$this->form_validation->set_rules('formPhone','Phone Number','trim|numeric');
				$this->form_validation->set_rules('formAddress','Address','trim');
				$this->form_validation->set_rules('formCity','City','trim');
				$this->form_validation->set_rules('formZip','Zipcode','trim|alpha_numeric');
				$this->form_validation->set_rules('formCountry','Country','trim');
				$this->form_validation->set_rules('formFacebook','Facebook','trim|valid_url');
				$this->form_validation->set_rules('formTwitter','Twitter','trim');
				$this->form_validation->set_rules('formLinkedIn','LinkedIn','trim|valid_url');
				$this->form_validation->set_rules('formInstagram','Instagram','trim');

				if($this->form_validation->run()){
					$form_data['u_email'] = $this->input->post('formEmail');
					if($this->input->post('formPassword')){
						$form_data['u_password'] = password_hash($this->input->post('formPassword'), PASSWORD_DEFAULT);
					}
					$form_data['u_firstname'] = $this->input->post('formFirstname');
					$form_data['u_lastname'] = $this->input->post('formLastname');
					$form_data['u_website'] = $this->input->post('formWebsite');
					$form_data['u_phone'] = $this->input->post('formPhone');
					$form_data['u_address'] = $this->input->post('formAddress');
					$form_data['u_city'] = $this->input->post('formCity');
					$form_data['u_zipcode'] = $this->input->post('formZip');
					$form_data['u_country'] = $this->input->post('formCountry');
					$form_data['u_facebook'] = $this->input->post('formFacebook');
					$form_data['u_twitter'] = $this->input->post('formTwitter');
					$form_data['u_linkedin'] = $this->input->post('formLinkedIn');
					$form_data['u_instagram'] = $this->input->post('formInstagram');

					$config['upload_path']          = FCPATH.'assets/images/profilepictures';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 8192;
					$config['max_width']            = 1920;
					$config['max_height']           = 1080;
					$config['encrypt_name']			= true;
					$config['file_ext_tolower']		= true;

					$this->load->library('upload', $config);

					if(count($this->input->post('formGroups')) > 0){
						$this->db->where('ga_uid',$u_id)->delete('groupassignments');
						foreach($this->input->post('formGroups') as $group_id){
							$this->db->insert('groupassignments',array('ga_uid' => $u_id,'ga_gid' => $group_id));
						}
					}

					if($this->upload->do_upload('formProfilepicture')){
						if($data['u_profilepicture']){
							$currentProfilePicture = $this->db->where('p_id',$data['u_profilepicture'])->get('profilepictures')->row()->p_image;
							unlink(FCPATH."assets/images/profilepictures/".$currentProfilePicture);
							$this->db->where('p_id',$data['u_profilepicture'])->delete('profilepictures');
						}

						#$this->db->insert('profilepictures',array('p_image'=>$this->upload->data('file_name')));
						$form_data['u_profilepicture'] = $this->db->insert_id();
					}

					#$this->db->where('u_id',$u_id);
					#$this->db->update('users',$form_data);
					#redirect();
				}
			}
		}
		$data['css'] = 	array(
							array(	'link'			=>	base_url('assets/css/styles.css'))
						);
		$this->model_loader->load_view('user_update',$data);
	}
}