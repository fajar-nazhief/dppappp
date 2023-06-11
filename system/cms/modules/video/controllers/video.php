<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Video extends Public_Controller
{
	public $limit = 12; // TODO: PS - Make me a settings option
	
	function __construct()
	{
		parent::Public_Controller();	
		$this->theme = $this->settings->default_theme;	
		 
	}
	
	// news/page/x also routes here
	function index()
	{
		$this->db->set_dbprefix('tbl_');
		 

		$this->data->pagination = create_pagination('video/index/',$this->db->count_all_results('video'), 20, 3);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles
		$this->db->limit($this->data->pagination['limit'][0], $this->data->pagination['limit'][1]);
		$this->db->order_by('id','DESC');
		$post = $this->db->get('video')->result();
		 
		
		$this->db->set_dbprefix("");
		$this->db->select('count(*) as jml,default_news_categories.title,tbl_video.category_id');
	   
		$this->db->join('default_news_categories','default_news_categories.id=tbl_video.category_id');
		$this->db->group_by('default_news_categories.title,tbl_video.category_id');
		$this->data->res = $this->db->get('tbl_video')->result();


		$this->db->set_dbprefix('default_');

		
		$this->template
			->title('Video Jakarta Utara')  
			->set('news', $post)
			->build($this->theme.'/index',$this->data);
		 
		 
	}

	function category()
	{
		$this->db->set_dbprefix('tbl_');
		 $id=$this->uri->segment('3');

		 $this->db->where('category_id',$id);
		$jml=$this->db->count_all_results('video');

		$this->data->pagination = create_pagination('video/index/'.$id.'/',$jml, 20, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles
		$this->db->limit($this->data->pagination['limit'][0], $this->data->pagination['limit'][1]);
		$this->db->where('category_id',$id);
		$this->db->order_by('id','DESC');
		$post = $this->db->get('video')->result();
		 
		
		$this->db->set_dbprefix("");
		$this->db->select('count(*) as jml,default_news_categories.title,tbl_video.category_id');
	   
		$this->db->join('default_news_categories','default_news_categories.id=tbl_video.category_id');
		$this->db->group_by('default_news_categories.title,tbl_video.category_id');
		$this->data->res = $this->db->get('tbl_video')->result();


		$this->db->set_dbprefix('default_');

		
		$this->template
			->title('Video Jakarta Utara')  
			->set('news', $post)
			->build($this->theme.'/index',$this->data);
		 
		 
	}
	 
	
	 
}