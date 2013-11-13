<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Secure_Controller {

	public function index()
	{
		$this->template->build('admin/dashboard/index');
	}
}