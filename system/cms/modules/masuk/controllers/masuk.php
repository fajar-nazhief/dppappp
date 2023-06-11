<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masuk extends Public_Controller
{
	public $limit = 5; // TODO: PS - Make me a settings option

	public function __construct()
	{
		parent::__construct();
		 // Set the validation rules
		 
	}

	// blog/page/x also routes here
	public function index()
	{
		  if ( $this->ion_auth->logged_in())
	    {
	    	redirect('admin/news');
		}
		$this->template 
                ->set_theme('admin_endless')
			->set_layout(FALSE)
			->build('admin/login');
		 
	}
	
	public function login(){
		

		if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
		{
			redirect('admin/news');
		}

		$this->form_validation->set_message('_check_login', $this->ion_auth->errors());
		 redirect('masuk');
	}
 
}