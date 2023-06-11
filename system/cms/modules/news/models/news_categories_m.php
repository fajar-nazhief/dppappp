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
	private $_folders = array();
	protected $_table = 'default_news_categories'; 
	 
	function News_categories_m()
	{
		//parent::MY_Model();
		//$this->db=$this->db->dbprefix(''); 
		//$this->db = $this->load->database('shared', TRUE);
	}
	 
	public function insert($input = array())
    {
	$img='';
	if(($img)){$img=$img;}else{
		$parent=$this->db->where('id',$input['navigation_group_id'])->get('news_categories')->row();
		
		$img='';
		if(empty($img)){
			$img='';
		}
		}
    	$this->load->helper('text');
    	parent::insert(array(
        	'title'=>$input['title'],
		'position'	=> $input['position'],
		'uri'	=> $input['uri'],
		'show'	=> $input['show'], 
		'navigation_group_id' => $input['navigation_group_id'],
        	'slug'=>$input['slug'],
		'banner'	=> $input['banner'],
		'left_menu'	=> $input['left_menu']
        ));
        
        return $input['title'];
    }
    
    function get_all($params=array())
    { 
	if($this->uri->segment(4)=='search'){
		$where_condition=$this->uri->segment(5); 
		    $query =$this->db->query("
					SELECT default_news_categories.* FROM `default_news_categories` where title like '%".str_replace('%20','%',($where_condition))."%'  
					UNION
					SELECT default_news_categories.* FROM `default_news_categories` where slug like '%".str_replace('%20','%',($where_condition))."%'
					LIMIT ".$params[1].",".$params[0]);
		    return $query->result();
	}else{
	  if(isset($params['id'])){
		$this->db->where('id',$params['id']);
	  }
	  
	  if(isset($params['order'])){
		$this->order_by($params['order'],'ASC');
	  }else{
		$this->order_by('title','ASC');
	  }
		return $this->db->get('news_categories')->result();
	}
           
        //return $this->db->get('news_categories')->result();
    }
    
    function get_terkait(){
	if($this->uri->segment(4)=='search'){
		$where_condition=$this->uri->segment(5);
	}
return	$this->db->like('title',$where_condition)->get('news_categories')->result();
 //$query =$this->db->query("SELECT count(default_news.id) as jml,default_news_categories.id as idc FROM default_news ,default_news_categories
                   // WHERE default_news.category_id = default_news_categories.id and default_news_categories.title like '%".str_replace('%20','%',($where_condition))."%' group by default_news_categories.id");
	   
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
		$img='';
	       if(($img)){$img=$img;}else{
		$parent=$this->db->where('id',$input['navigation_group_id'])->get('news_categories')->row();
		if(($parent)){
			$img='';
		}
		
			if(empty($img)){
				$img='';
			}
		}
		return parent::update($id, array(
		'title'	=> $input['title'],
		'position'	=> $input['position'],
		'uri'	=> $input['uri'],
		'show'	=> $input['show'],  
	    'navigation_group_id' => $input['navigation_group_id'],
           	'slug'=>$input['slug'],
		'banner'	=> $input['banner'],
		'left_menu'	=> $input['left_menu']
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
				'navigation_group_id' => $input['navigation_group_id'],
				//is something wrong with convert_accented_characters?
				//'slug'=>url_title(strtolower(convert_accented_characters($input['title'])))
				'slug' => url_title(strtolower($input['slug']))
				));
	}
	
	function count_data($params=array()){
		if($this->uri->segment(4)=='search'){
		$where_condition=$this->uri->segment(5); 
		    $query =$this->db->query("
					SELECT * FROM `default_news_categories` where title like '%".str_replace('%20','%',($where_condition))."%'  
					UNION
					SELECT * FROM `default_news_categories` where slug like '%".str_replace('%20','%',($where_condition))."%'
					 "); 
		    return  $query->num_rows();
		} 
		
	}
	
	public function get_link_tree( $params = array())
	{
		// the plugin passes the abbreviation
		 
		
		if ( ($params['order']))
		{
			$this->db->order_by($params['order']);
		}
		else
		{
			$this->db->order_by('position');
		}
		
		
 
		$all_links = $this->db 
			 ->get('news_categories')
			 ->result_array();

		$this->load->helper('url');

		$links = array();
		//print_r($all_links);
		// we must reindex the array first and build urls
		$all_links = $this->make_url_array($all_links);
		foreach ($all_links AS $row)
		{
			$links[$row['id']] = $row;
		}

		unset($all_links);

		$link_array = array();

		// build a multidimensional array of parent > children
		 
		foreach ($links AS $row)
		{
			if (array_key_exists($row['parent_id'], $links))
			{
				// add this link to the children array of the parent link
				$links[$row['parent_id']]['children'][] =& $links[$row['id']];
			}

			if ( ! isset($links[$row['id']]['children']))
			{
				$links[$row['id']]['children'] = array();
			}

			// this is a root link
			if ($row['parent_id'] == 0)
			{
				$link_array[] =& $links[$row['id']];
			}
		}
 
		return $link_array;
	}
	
	public function get_link_tree_vertical($group, $params = array())
	{
		// the plugin passes the abbreviation
		if ( ! is_numeric($group))
		{
			$row = $this->get_group_by('abbrev', $group);
			$group = $row->id;
		}
		
		if ( ($params['order']))
		{
			$this->db->order_by($params['order']);
		}
		else
		{
			$this->db->order_by('position');
		}
 
		$all_links = $this->db->where('parent_id', $group)
			 ->get('news_categories')
			 ->result_array();

		$this->load->helper('url');

		$links = array();
		
		// we must reindex the array first and build urls
		$all_links = $this->make_url_array($all_links);
		foreach ($all_links AS $row)
		{
			$links[$row['id']] = $row;
		}

		unset($all_links);

		$link_array = array();

		// build a multidimensional array of parent > children
		foreach ($links AS $row)
		{
			if (array_key_exists($row['parent'], $links))
			{
				// add this link to the children array of the parent link
				$links[$row['parent']]['children'][] =& $links[$row['id']];
			}

			if ( ! isset($links[$row['id']]['children']))
			{
				$links[$row['id']]['children'] = array();
			}

			// this is a root link
			if ($row['parent'] == 0)
			{
				$link_array[] =& $links[$row['id']];
			}
		}

		return $link_array;
	}
	
	/**
	 * Set the parent > child relations and child order
	 *
	 * @author Jerel Unruh - PyroCMS Dev Team
	 * @param array $link
	 * @return void
	 */
	public function _set_children($link)
	{
		if ($link['children'])
		{
			foreach ($link['children'] as $i => $child)
			{
				$this->db->where('id', str_replace('link_', '', $child['id']));
				$this->db->update($this->_table, array('parent' => str_replace('link_', '', $link['id']), 'position' => $i));
				
				//repeat as long as there are children
				if ($child['children'])
				{
					$this->_set_children($child);
				}
			}
		}
	}
	
	public function get_group_by($what, $value) 
	{
		return $this->db->where($what, $value)->get('navigation_groups')->row();
	}
	
	/**
	 * Return an array of Navigation Groups
	 * 
	 * @access public
	 * @return void
	 */
	public function get_groups() 
	{
		return $this->db->get('navigation_groups')->result();
	}
	
	public function get_links() 
	{
		$this->db->order_by('title','ASC');
		return $this->db->get('news_categories')->result();
	}
	
	public function make_url_array($links)
	{ //print_r($links);
		foreach($links as $key => &$row)
		{
			// If its any other type than a URL, it needs some help becoming one
			switch($row['slug'])
			{
				case 'uri':
					$row['url'] = site_url($row['uri']);
				break;

				case 'module':
					$row['url'] = site_url($row['module_name']);
				break;

				case 'page':
					if ($page = $this->pages_m->get_by(array_filter(array(
						'id'		=> $row['page_id'],
						'status'	=> (is_subclass_of(ci(), 'Public_Controller') ? 'live' : NULL)
					))))
					{
						$row['url'] = site_url($page->uri);
						$row['is_home'] = $page->is_home;
					}
					else
					{
						unset($links[$key]);
					}
				break;
			}
		}

		return $links;
	}
	
	//TREEE
	public function get_folders($id = 0)
	{  
		if ($id)
		{
			$this->folder_tree($id);
		}
		elseif (empty($this->_folder))
		{
			$this->folder_tree();
		}
		
		return $this->_folders;
	}
	
	public function folder_tree($parent_id = 0, $depth = 0, &$arr = array())
	{
		$arr = $arr ? $arr : array(); 
		 
		if ($parent_id === 0)
		{
			$arr	= array();
			$depth	= 0;
		}

		$folders = $this
			->order_by('position')
			->get_many_by(array('navigation_group_id' => $parent_id));
 
		if ( ! $folders)
		{
			return $arr;
		}

		static $root = NULL;

		foreach ($folders as $folder)
		{
			
			if ($depth < 1)
			{
				$root = $folder->id;
			}

//			$folder->name_indent		= repeater('&raquo; ', $depth) . $folder->name;
			$folder->root_id			= $root;
			$folder->depth				= $depth;
			//$folder->count_files		= sizeof($this->db->get_where('files', array('folder_id' => $folder->id))->result());
			$arr[$folder->id]			= $folder;
			$old_size					= sizeof($arr);

			$this->folder_tree($folder->id, $depth+1, $arr);

			//$folder->count_subfolders	= sizeof($arr) - $old_size;
		}

	//	if ($parent_id === 0)
		//{  
			foreach ($arr as $id => &$folder)
			{
				$folder->virtual_path		= $this->_build_asc_segments($id, array(
					'segments'	=> $arr,
					'separator'	=> '/',
					'attribute'	=> 'slug'
				));
			}

			$this->_folders = $arr;
		//}
 
		/*if ($parent_id > 0 && $depth > 1)
		{  
			foreach ($arr as $id => &$folder)
			{
				
			$folder->virtual_path = $this->_folders[$id]->virtual_path;
			}
		}
		*/

		return $arr;
	}
	
	public function _build_asc_segments($id, $options = array()) 
	{
		if ( ! isset($options['segments']))
		{
			return;
		}

		$defaults = array(
			'attribute'	=> 'name',
			'separator'	=> ' &raquo; ',
			'limit'		=> 0
		);

		$options = array_merge($defaults, $options);

		extract($options);

		$arr = array();

		while (isset($segments[$id]))
		{
			array_unshift($arr, $segments[$id]->{$attribute});
			$id = $segments[$id]->parent_id;
		}

		if (is_int($limit) && $limit > 0 && sizeof($arr) > $limit)
		{
			array_splice($arr, 1, -($limit-1), '&#8230;');
		}

		return implode($separator, $arr);
	}
}