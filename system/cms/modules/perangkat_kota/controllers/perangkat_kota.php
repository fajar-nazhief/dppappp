<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Perangkat_kota extends Public_Controller
{
	public $limit = 12; // TODO: PS - Make me a settings option
	
	function __construct()
	{
		parent::Public_Controller();		
		 
	}
	
	// news/page/x also routes here
	function index()
	{
	
		$this->db->set_dbprefix('default_');
		$this->template
			->title('Perangkat Kota Jakarta Utara')   
			->build('index');
		 
		 
	}
	 
	
	 
}