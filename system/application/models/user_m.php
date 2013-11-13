<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends MY_Model
{
	protected $before_create = array('process_fullname', 'hash_password');
	protected $before_update = array('hash_password');

	protected $invite_code;

	public function __construct()
	{
		parent::__construct();
	}

	public function process_fullname($data)
	{
		if( ! empty($data['user_name']))
		{
			$name = explode(' ', $data['user_name']);

			$data['user_firstname'] = array_shift($name);
			$data['user_lastname'] = implode(' ', $name);

			unset($data['user_name']);
		}

		return $data;
	}

	public function hash_password($data)
	{
		if( ! empty($data['user_password']))
		{
			$this->load->library('PasswordHash', array(8, FALSE));

			$data['user_password'] = $this->passwordhash->HashPassword($data['user_password']);
		}

		return $data;
	}
	
	public function do_signin($email, $password, $keep_signed_in = FALSE)
	{
		$this->load->library('PasswordHash', array(8, FALSE));

		$this->is_paranoid();
		
		$user = $this->db->where('user_email', $email)
						->get('users')
						->row();

		if( ! empty($user) && $this->passwordhash->CheckPassword($password, $user->user_password))
		{
			$this->signin($user, $keep_signed_in);

			return TRUE;
		}

		return FALSE;
	}

	public function auto_signin($user_id)
	{
		$user = $this->get($user_id);

		if( ! empty($user))
		{
			$this->signin($user);

			return $user;
		}

		return FALSE;
	}

	private function signin($user, $keep_signed_in = FALSE)
	{
		$this->session->set_userdata('user', $user);

		// Set login
		$this->db->insert('logins', array(
										'login_user_id'		=> $user->user_id, 
										'login_ip_address'	=> $this->input->ip_address()
										));

		// Set the stacks session var
		$this->set_session_stacks($user->user_id);

		if($keep_signed_in)
		{
			$this->load->helper('cookie');

			$cookie = array(
			    'name'   => 'ci_auto_signin',
			    'value'  => $user->user_id,
			    'expire' => '1300000'
			);

			set_cookie($cookie);

			$foo = get_cookie('ss_auto_signin');

			
		}
	}

}