<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Secure_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		if( ! signed_in())
		{
			redirect(site_url('auth/signin'));
		}
	}
}