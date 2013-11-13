<?php 
/*
All application code, styles and layouts
Copyright 2013 Phil Stephens
All rights reserved
phil@othertribe.com for more information
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {

	public function index()
	{
		$this->template->build('site/index');
	}
}