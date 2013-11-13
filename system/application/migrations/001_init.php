<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Init extends CI_Migration
{
	public function up()
	{
		$this->load->helper('file');
		
		$init = file_get_contents('system/sql/bootstrap.sql');
		
		$init = explode('-- COMMAND BREAK --', $init);

		foreach($init as $sql)
		{
			$this->db->query($sql);
		}
	}

	public function down()
	{
		
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