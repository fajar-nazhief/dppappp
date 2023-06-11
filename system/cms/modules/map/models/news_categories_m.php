<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Categories model
 *
 * @package		PyroCMS
 * @subpackage	Categories Module
 * @category	Modules
 * @author		Phil Sturgeon - PyroCMS Dev Team
 */
class News_categories_m extends MY_Model
{
	/**
	 * Insert a new category into the database
	 * @access public
	 * @param array $input The data to insert
	 * @return string
	 */
	public function insert($input = array())
    {
    	$this->load->helper('text');
    	parent::insert(array(
        	'title'=>$input['title'],
        	'slug'=>url_title(strtolower(convert_accented_characters($input['title'])))
        ));
        
        return $input['title'];
    }
    
    function get_all($params=array())
    { 
	if($this->uri->segment(4)=='search'){
		$where_condition=$this->uri->segment(5); 
		    $query =$this->db->query("
					SELECT * FROM `news_categories` where title like '%".$where_condition."%'  
					UNION
					SELECT * FROM `news_categories` where slug like '%".$where_condition."%'
					LIMIT ".$params[1].",".$params[0]);
		    return $query->result();
	}else{
	  if(!empty($params['id'])){
		$this->db->where('id',$params['id']);
	  }
	  
	  if(!empty($params['order'])){
		$this->order_by($params['order'],'ASC');
	  }else{
		$this->order_by('title','ASC');
	  }
		return $this->db->get('news_categories')->result();
	}
           
        //return $this->db->get('news_categories')->result();
    }
    
	/**
	 * Update an existing category
	 * @access public
	 * @param int $id The ID of the category
	 * @param array $input The data to update
	 * @return bool
	 */
    public function update($id, $input)
	{
		return parent::update($id, array(
            'title'	=> $input['title'],
            'slug'	=> url_title(strtolower(convert_accented_characters($input['title'])))
		));
    }

	/**
	 * Callback method for validating the title
	 * @access public
	 * @param string $title The title to validate
	 * @return mixed
	 */
	public function check_title($title = '')
	{
		return parent::count_by('slug', url_title($title)) === 0;
	}
	
	/**
	 * Insert a new category into the database via ajax
	 * @access public
	 * @param array $input The data to insert
	 * @return int
	 */
	public function insert_ajax($input = array())
	{
		$this->load->helper('text');
		return parent::insert(array(
				'title'=>$input['title'],
				//is something wrong with convert_accented_characters?
				//'slug'=>url_title(strtolower(convert_accented_characters($input['title'])))
				'slug' => url_title(strtolower($input['title']))
				));
	}
	
	function count_data($params=array()){
		if($this->uri->segment(4)=='search'){
		$where_condition=$this->uri->segment(5); 
		    $query =$this->db->query("
					SELECT * FROM `news_categories` where title like '%".$where_condition."%'  
					UNION
					SELECT * FROM `news_categories` where slug like '%".$where_condition."%'
					 "); 
		    return  $query->num_rows();
		} 
		
	}
}