# Student project

In the words of my teacher Thomas:
> Make it work, make it better, **_make it awesome_**

## My fav code <3
1. Loader model constructor
```php
var $user;

public function __construct()
{
	parent::__construct();

	if ($this->session->user) {
		$sqlQuery = $this->db->where('u_email', $this->session->user)->get('users');

		if ($sqlQuery->num_rows()) {
			$this->user = $sqlQuery->row();
		}
	}
}
```
2. Comments
```php
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
```
3. Voting
```php
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
```
4. Frontpage
```php
public function index()
{
	// $this->db->order_by('col', 'asc')  # 1,2,3,4,5,6...
	// $this->db->order_by('col', 'desc') # 99,98,97,96...
	$data['top_users'] = $this->db->order_by('points', 'desc')->limit(5)->get('users')->result_array();
	$data['latest_cases'] = $this->db->order_by('c_id', 'desc')->limit(5)->get('cases')->result_array();

	$cases = $this->db->get('cases')->result_array();

	$data['top_cases'] = array();
	
	$i = 0;
	foreach ($cases as $case) {
		$votes = $this->db->where('token', $case['token'])->get('votes');
		$data['top_cases'][$i] = array();
		$data['top_cases'][$i]['votes'] = $votes->num_rows();
		$data['top_cases'][$i]['case'] = $case;

		$i++;
	}
	
	$data['top_cases'] = array_slice(array_reverse($this->arr->subval_sort($data['top_cases'],'votes')), 0, 5);

	$this->loader->view('index', $data);
}
```
