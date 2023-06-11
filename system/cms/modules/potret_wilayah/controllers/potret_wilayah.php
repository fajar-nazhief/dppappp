<?php  defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Comments controller (frontend)

 *

 * @author 		Phil Sturgeon, Yorick Peterse - PyroCMS Dev Team

 * @package 	PyroCMS

 * @subpackage 	Comments module

 * @category 	Modules

 */

class Potret_wilayah extends Public_Controller {



	/**

	 * An array containing the validation rules

	 * @access private

	 * @var array

	 */

	 



	/**

	 * Constructor method

	 * @access public

	 * @return void

	 */

	public function __construct()

	{

		parent::Public_Controller();

		$this->db->set_dbprefix('tbl_');

		$this->theme = $this->settings->default_theme;

		// Load the required classes

	 

	}



	/**

	 * Create a new comment

	 * @access public

	 * @param string $module The module (what module?)

	 * @param int $id The ID (what ID?)

	 * @return void

	 */



	function index($slug = '')

	{	

		 

		// Get category data 

		$this->db->select(' count(*)as jml');

		$jgal = $this->db->get('gall_cat')->row();

		   
		$this->data->pagination = create_pagination('potret_wilayah/index',$jgal->jml ,12, 3);

		//print_r( $this->data->pagination['limit']);

		 

		// Get the current page of news articles

		if (isset($this->data->pagination['limit']) && is_array($this->data->pagination['limit'])){

			$this->db->limit($this->data->pagination['limit'][0],$this->data->pagination['limit'][1]);

		} elseif (isset($params['limit'])){

			$this->db->limit($this->data->pagination['limit']);

		}

			

		$this->db->order_by('gall_cat_id',"DESC");



		$this->data->news = $this->db->get('gall_cat')->result();

		//print_r( $this->data->news);

		// Set meta description based on article titles

		 

		$this->db->set_dbprefix('default_');

		// Build the page

		$this->template	

			->build( $this->theme.'/category', $this->data );

	}



	function view($slug = '')

	{	



		if(!$slug) redirect('potret_wilayah');

		 

		// Get category data 

		 

		   

		 

		 

			$this->db->select('gallery.*,gall_cat.gall_cat_title as judul');

		$this->db->order_by('id',"ASC");

		$this->db->join('gall_cat','gall_cat.gall_cat_id = gallery.gall_cat_id');

		$this->db->where('gallery.gall_cat_id',$slug);



		$this->data->news = $this->db->get('gallery')->result();

		//print_r( $this->data->news);

		// Set meta description based on article titles

		 

		$this->db->set_dbprefix('default_');

		// Build the page

		$this->template	

			->build(  $this->theme.'/view', $this->data );

	}



	  



}