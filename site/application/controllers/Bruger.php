<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bruger extends CI_Controller {

	public function index()
	{
		$this->sess->to_login();

		$this->loader->view('bruger/index');
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

				

				// Sender email address
				$this->email->set_newline("\r\n");
				$this->email->from("snurresturlosson@gmail.com", "Thomas");
				// Receiver email address.for single email
				$this->email->to($formemail);
				// Subject of email
				$this->email->subject("Hey DO!");
				// Message in email
				$this->email->message(base_url('bruger/aktiver/').$token);

				$this->email->send();

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

		if (!$token) {
			redirect();
		}

		$sqlQuery = $this->db->where('token', $token)->get('users');

		if ($sqlQuery->num_rows()) {
			if ($sqlQuery->row()->u_active !== '1') {
				$this->db->where('token', $token)
					->update('users',
						array(
							'u_active'		=>		1
						));
				redirect('bruger/login');
			} else {
				$this->loader->view();
			}
		} else {
			$this->loader->view();
		}
	}

	public function opdater()
	{
		$this->sess->to_login();

		if ($this->input->post()) {
			echo "Jeg ville ikke lave mere bruger stuff";
			exit;
		}

		$this->loader->view('bruger/opdater');
	}

	public function profil($id = null)
	{
		if (!$id) {
			redirect();
		}

		$data['user'] = $this->db->where('u_id', $id)->get('users')->row();

		$data['latest_cases'] = $this->db->where('c_owner', $id)->order_by('c_id', 'desc')->limit(5)->get('cases')->result_array();

		$this->loader->view('bruger/profil', $data);
	}
}



































