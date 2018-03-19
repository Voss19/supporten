<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bruger extends CI_Controller {

	public function index()
	{
		$this->sess->to_login();
		$data['img'] = 'test';
		$this->loader->view('bruger/index', $data);
	}
	
	public function login()
	{
		$this->sess->is_logged_in();

		if ($this->input->post('login')) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run()) {
				$formemail = $this->input->post('email');
				$formpassword = $this->input->post('password');

				$this->db->where('u_email', $formemail);
				$this->db->where('u_email', $formemail);
				$sqlQuery = $this->db->get('users');

				if ($sqlQuery->num_rows()) {
					$dbFetch = $sqlQuery->row();

					if ($dbFetch->u_active == 0) {
						redirect();
					}

					if (password_verify($formpassword, $dbFetch->u_password)) {
						$this->session->set_userdata("user", $formemail);
						redirect();
					}
				}
			}
		}

		if ($this->input->post('opret')) {
			$this->form_validation->set_rules('fname', 'Fornavn', 'required');
			$this->form_validation->set_rules('lname', 'Efternavn', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.u_email]');
			$this->form_validation->set_rules('password', 'Adgangskode', 'required');
			$this->form_validation->set_rules('rpassword', 'Gentag adgangskode', 'required|matches[password]');

			if ($this->form_validation->run()) {
				$formemail = $this->input->post('email');
				$formpassword = $this->input->post('password');
				$token = md5($formemail);

				// The mail sending protocol.
				$config['protocol'] = 'smtp';
				// SMTP Server Address for Gmail.
				$config['smtp_host'] = "ssl://smtp.googlemail.com";
				// SMTP Port - the port that you is required
				$config['smtp_port'] = 465;
				// SMTP Username like. (abc@gmail.com)
				$config['smtp_user'] = "snurresturlosson@gmail.com";
				// SMTP Password like (abc***##)
				$config['smtp_pass'] = "PinkBox01";
				// Load email library and passing configured values to email library
				$this->load->library('email', $config);

				// Sender email address
				$this->email->set_newline("\r\n");
				$this->email->from("snurresturlosson@gmail.com", "Thomas");
				// Receiver email address.for single email
				$this->email->to($formemail);
				// Subject of email
				$this->email->subject("Hey DO!");
				// Message in email
				$this->email->message(base_url('bruger/aktiver/').$token);

				$formdata = array(
							'u_email'				=>		$formemail,
							'u_password'			=>		password_hash($formpassword, PASSWORD_DEFAULT),
							'u_first_name'			=>		$this->input->post('fname'),
							'u_last_name'			=>		$this->input->post('lname'),
							'token'					=>		$token
						);
				$this->db->insert('users', $formdata);
			}
		}

		$this->loader->view('bruger/login');
	}

	public function aktiver($token = null)
	{
		$this->sess->is_logged_in();

		if (!$token || $this->loader->user->u_active !== 1) {
			redirect();
		}

		if ($this->loader->user->token == $token) {
			$this->db->where('token', $token)
				->update('users',
					array(
						'u_active'		=>		1
					));
			redirect('bruger/login');
		}
	}
}



































