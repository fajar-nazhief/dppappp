<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ukpd extends Public_Controller
{
	public $limit = 12; // TODO: PS - Make me a settings option
	
	function __construct()
	{
		parent::Public_Controller();		
		 
	}
	
	// news/page/x also routes here
	function index()
	{
		$this->db->set_dbprefix('tbl_');
		$post = $this->db->get('ukpd')->result();
		$this->db->set_dbprefix('default_');
		$this->template
			->title('UKPD Jakarta Utara')  
			->set('post', $post)
			->build('index');
		 
		 
	}
	 
	
	 
}