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