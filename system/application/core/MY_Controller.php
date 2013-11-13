<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->template
			->enable_parser(FALSE)
			->set_layout('default')
			->set_partial('form_errors', 'partials/form_errors')
			->append_metadata( css('bootstrap.min.css') )
			->append_metadata( '<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript"></script>' )
			->append_metadata( js('bootstrap.min.js') );
	}

	protected function is_ajax()
	{
		return $this->input->is_ajax_request();
	}
	
	public function set_to_zero($str)
	{
		return (empty($str)) ? '0' : $str;
	}
	
	protected function model($name)
	{
		$name = $name . MODEL_SUFFIX;
		
		// is there a module involved
		$model_name = explode('/', $name);
		
		if ( ! isset($this->{end($model_name)}) )
		{
			$this->load->model($name, '', TRUE);
		}

		return $this->{end($model_name)};
	}
}


/**
 * Returns the CI object.
 *
 * Example: ci()->db->get('table');
 *
 * @staticvar	object	$ci
 * @return		object
 */
function ci()
{
	return get_instance();
}