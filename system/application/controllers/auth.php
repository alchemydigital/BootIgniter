<?php 
/*
All application code, styles and layouts
Copyright 2013 Phil Stephens
All rights reserved
phil@othertribe.com for more information
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function signin()
	{
		if(signed_in())
		{
			redirect(site_url('admin/dashboard'));
		}

		if($user_id = $this->input->cookie('ci_auto_signin'))
		{
			if($this->model('user')->auto_signin($user_id))
			{
				redirect(site_url('admin/dashboard'));
			}

		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|callback_do_signin');

		if($this->form_validation->run() === FALSE)
		{
			$this->template->build('auth/signin');
		} else
		{
			redirect(site_url('admin/dashboard'));
		}
	}

	public function do_signin($str)
	{
		$this->form_validation->set_message('do_signin', 'That email/password combination is incorrect');
		return $this->model('user')->do_signin($this->input->post('user_email'), $str, $this->input->post('keep_signed_in'));
	}

	public function signout()
	{
		$this->session->sess_destroy();

		$this->load->helper('cookie');

		delete_cookie('ci_auto_signin');

		redirect('auth/signin');
	}
}