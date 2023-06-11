<?php  defined('BASEPATH') or exit('No direct script access allowed');

class Module_Polling extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Aplikasi Polling' 
			),
			'description' => array(
				'en' => 'Polling dll' 
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		 
	}

	public function uninstall()
	{		
		 
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.";
	}
}

/* End of file details.php */
