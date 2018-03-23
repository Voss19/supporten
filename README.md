# Student project

In the words of my teacher Thomas:
> Make it work, make it better, **make it awesome**

## My fav code <3
1. Loader model constructor
```php
var $user;

public function __construct()
{
	parent::__construct();

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

	if ($this->session->user) {
		$sqlQuery = $this->db->where('u_email', $this->session->user)->get('users');

		if ($sqlQuery->num_rows()) {
			$this->user = $sqlQuery->row();
		}
	}
}
```
2. View 'Sag'
```php
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
```