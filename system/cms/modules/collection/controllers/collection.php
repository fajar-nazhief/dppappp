<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class collection extends Public_Controller
{
	public $limit = 10; // TODO: PS - Make me a settings option
	
	function __construct()
	{
		parent::Public_Controller();		
		$this->load->model('collection_m');
		$this->load->model('collection_categories_m');
		$this->load->model('comments/comments_m');
		$this->load->model('navigation/navigation_m');  
		$this->load->helper('text');
		$this->lang->load('collection');
	}
	
	// collection/page/x also routes here
	function index()
	{
		 
			redirect('home');
		 
		 
	}
	
	
	
	function category($slug = '')
	{	
		if(!$slug) redirect('collection');
		unset($_SESSION['namablog']);
		// Get category data
		$category = $this->collection_categories_m->get_by('slug', $slug);
		
		if(!$category) show_404();
		
		$this->data->category =& $category;
		$this->data->article->category_id=$category->id;
		$this->data->article->navigation_group_id=$category->navigation_group_id;
		// Count total collection articles and work out how many pages exist
		$this->data->pagination = create_pagination('collection/category/'.$slug, $this->collection_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
		)), $this->limit, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of collection articles
		$this->data->collection = $this->collection_m->limit($this->data->pagination['limit'])->get_many_by(array(
			'category'=>$slug,
			'status' => 'live'
		));
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->collection);
		$this->data->title=$category->title;
		$this->data->submenu='';
		if($category->navigation_group_id){
			$this->data->submenu=$this->get_menu($category->navigation_group_id);
		}
		
		//get for slider
		$catid=$category->id; 
		 
		$params=array('catid'=>$catid,'limit'=>array('5','0'));
		$this->data->categories = $this->collection_m->get_all($params);
		
		// Build the page
		$this->template->title($this->module_details['name'], $category->title )		
			->set_metadata('description', $category->title.'. '.$meta['description'] )
			->set_metadata('keywords', $category->title )
			->set_breadcrumb( lang('collection_collection_title'), 'collection')
			->set_breadcrumb( $category->title )		
			->build( 'category', $this->data );
	}
	
	function penulis($slug = '')
	{	
		if(!$slug) redirect('collection');
		 
		// Count total collection articles and work out how many pages exist
		$this->data->pagination = create_pagination('collection/penulis/'.$slug, $this->collection_m->count_by(array(
			'penulis'=>$slug,
			'status' => 'live'
		)), $this->limit, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of collection articles
		$this->data->collection = $this->collection_m->limit($this->data->pagination['limit'])->get_many_by(array(
			'penulis'=>$slug,
			'status' => 'live'
		));
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->collection);
		$this->data->title='Penulis';
		$this->data->submenu='';
		 
		//print_r($this->data->collection);
		// Build the page
		if(!empty($this->data->collection[0]->intro_en)){
			$_SESSION['namablog']=$this->data->collection[0]->intro_en;
		}
		
		$this->template
			->title('twittlander @'.@$_SESSION['namablog'])
			->build('penulis', $this->data );
	}
	
	function archive_collection($year = NULL, $month = '01')
	{	
		if(!$year) $year = date('Y');		
		$month_date = new DateTime($year.'-'.$month.'-01');
		$this->data->pagination = create_pagination('collection/archive/'.$year.'/'.$month, $this->collection_m->count_by(array('year'=>$year,'month'=>$month)), $this->limit, 5);
		$this->data->collection = $this->collection_m->limit($this->data->pagination['limit'])->get_many_by(array('year'=> $year,'month'=> $month));
		$this->data->month_year = $month_date->format("F 'y");
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->collection);

		$this->template->title( $this->data->month_year, $this->lang->line('collection_archive_title'), $this->lang->line('collection_collection_title'))		
			->set_metadata('description', $this->data->month_year.'. '.$meta['description'])
			->set_metadata('keywords', $this->data->month_year.', '.$meta['keywords'])
			->set_breadcrumb($this->lang->line('collection_collection_title'), 'collection')
			->set_breadcrumb($this->lang->line('collection_archive_title').': '.$month_date->format("F 'y"))
			->build('archive', $this->data);
	}
	
	// Public: View an article
	function view($slug = '')
	{	
		if (!$slug or !$article = $this->collection_m->get_by('slug', $slug))
		{
			redirect('collection');
		}
		
		if($article->status != 'live' && !$this->ion_auth->is_admin())
		{
			redirect('collection');
		}
		
		// IF this article uses a category, grab it
		if($article->category_id > 0)
		{
			$article->category = $this->collection_categories_m->get( $article->category_id );
			 
			$this->data->catid=$article->category->navigation_group_id;
		}
		
		// Set some defaults
		else
		{
			$article->category->id = 0;
			$article->category->slug = '';
			$article->category->title = '';
		}
		//print_r($article->category);
		$this->session->set_flashdata(array('referrer'=>$this->uri->uri_string));	
		
		$this->data->article =& $article;
 
		 
		
		
		 
		 if(!empty($article)){
			 $page=$article->id;
			 $_SESSION['namablog']=$article->createdby;
		 }
		
		if(!isset($_SESSION['halaman'][$page]))
		{
		    $_SESSION['halaman'][$page]=1;
		    //.$this->session->halaman($page);//=$_SESSION[$page]=1;
		    $this->db->set('klik', 'klik+1', FALSE)
			 ->where('id', $article->id)
			 ->update('collection');
		}
		
		$limits=Array ( '0' => 2,'1' => 0 );//print_r($article); echo $article->category->slug;
		$this->data->collection = $this->collection_m->limit($limits)->get_many_by(array(
				'category'=>$article->category->slug,
				'status' => 'live',
				'not_id' => $article->id
			));//print_r($this->data->collection);
		
	  
		 $this->data->keyword= $this->collection_m->get_many_by(array(
			'keyword'=> str_replace('%20',' ',$article->keyword),
			'status' => 'live',
			'limit'=>'5',
			'order_by_id' => 'DESC'
		));
		 
		 $this->data->nid=$article->id;
		$this->template->set_breadcrumb($article->title, 'collection/'.date('Y/m', $article->created_on).'/'.$article->slug);
		$this->template->title($article->title)
		->set_metadata('description', $article->title)
		->set_metadata('keywords', $this->data->article->category->title.' '.$this->data->article->title)
		->build('view', $this->data);
	}
	
	function viewid($slug = '')
	{	
		if (!$slug or !$article = $this->collection_m->get($slug))
		{
			redirect('collection');
		}
		
		if($article->status != 'live' && !$this->ion_auth->is_admin())
		{
			redirect('collection');
		}
		
		// IF this article uses a category, grab it
		if($article->category_id > 0)
		{
			$article->category = $this->collection_categories_m->get( $article->category_id );
			 
			$this->data->catid=$article->category->navigation_group_id;
		}
		
		// Set some defaults
		else
		{
			$article->category->id = 0;
			$article->category->slug = '';
			$article->category->title = '';
		}
		//print_r($article->category);
		$this->session->set_flashdata(array('referrer'=>$this->uri->uri_string));	
		
		$this->data->article =& $article;
 
		 
		if($article->category_id > 0)
		{
			$this->template->set_breadcrumb($article->category->title, 'collection/category/'.$article->category->slug);
		}
		
		 
		 if(!empty($article)){
			 $page=$article->id;
			 $_SESSION['namablog']=$article->createdby;
		 }
		
		if(!isset($_SESSION['halaman'][$page]))
		{
		    $_SESSION['halaman'][$page]=1;
		    //.$this->session->halaman($page);//=$_SESSION[$page]=1;
		    $this->db->set('klik', 'klik+1', FALSE)
			 ->where('id', $article->id)
			 ->update('collection');
		}
		
		$limits=Array ( '0' => 2,'1' => 0 );//print_r($article); echo $article->category->slug;
		$this->data->collection = $this->collection_m->limit($limits)->get_many_by(array(
				'category'=>$article->category->slug,
				'status' => 'live',
				'not_id' => $article->id
			));//print_r($this->data->collection);
		
		$this->data->nid=$article->id;
		
		$this->template->set_breadcrumb($article->title, 'collection/'.date('Y/m', $article->created_on).'/'.$article->slug);
		$this->template->title($article->title)
		->set_metadata('description', $article->title)
		->set_metadata('keywords', $this->data->article->category->title.' '.$this->data->article->title)
		->build('view', $this->data);
	}	
	
	// Private methods not used for display
	private function _articles_metadata(&$articles = array())
	{
		$keywords = array();
		$description = array();
		
		// Loop through articles and use titles for meta description
		if(!empty($articles))
		{
			foreach($articles as &$article)
			{
				if($article->category_title)
				{
					$keywords[$article->category_id] = $article->category_title .', '. $article->category_slug;
				}
				$description[] = $article->title; 
			}
		}
		
		return array(
			'keywords' => implode(', ', $keywords),
			'description' => implode(', ', $description)
		);
	}
	
	function get_menu($id="")
	{
		 
	}
	
	function get_menu_parent($id="")
	{
		
		$parent = $this->navigation_m->get_menu(array('id'=>$id));
		foreach($parent as $idparent){
			$parent_id=$idparent->parent;
		}
		if(!empty($parent_id)){
		$links = $this->navigation_m->get_menu(array('parent'=> $parent_id ));

		$list = ' <div style="margin-bottom:5px;padding-top:5px;border-top:1px solid #d3d3d3;">
				<ul >';
		$array = array();

		if ($links)
		{
			$i = 1;//print_r($links);
			 
			foreach ($links as $link)
			{
				$attributes['target'] = $link->target;
				$attributes['class']  = $link->class;
				$val=$link;
				switch($val->link_type)
				{
					case 'uri':
						$val->url = site_url($val->uri);
					break;

					case 'module':
						$val->url = site_url($val->module_name);
					break;

					case 'page':
						  
								if ($page = $this->pages_m->get_by(array_filter(array(
									'id'		=> $val->page_id,
									'status'	=> (is_subclass_of(ci(), 'Public_Controller') ? 'live' : NULL)
								))))
								{
									$val->url = site_url($page->uri);
									$val->is_home = $page->is_home;
								}
								else
								{
									unset($result[$key]);
								}
					break;
				} 
					 
					 
					$list .= ' <li style="display:inline;padding:0px 7px;;border-right:1px solid #d3d3d3" id="'.$link->title.'" >'.anchor($val->url, $link->title, ' ');
					
					$list.='</li>'.PHP_EOL;
					$i++;
					
				 
			}
			 $list.='</ul></div>';
		}
		

    	return   $list;
		}else{
			return false;
		}
	}
	
	function get_menu_sub($id="")
	{
		 
		 
		 
		$links = $this->navigation_m->get_menu(array('parent'=> $id ));

		$list = ' <div style="margin-bottom:5px;padding-bottom:5px">
				<ul >';
		$array = array();

		if ($links)
		{
			$i = 1;//print_r($links);
			 
			foreach ($links as $link)
			{
				$attributes['target'] = $link->target;
				$attributes['class']  = $link->class;
				$val=$link;
				switch($val->link_type)
				{
					case 'uri':
						$val->url = site_url($val->uri);
					break;

					case 'module':
						$val->url = site_url($val->module_name);
					break;

					case 'page':
						  
								if ($page = $this->pages_m->get_by(array_filter(array(
									'id'		=> $val->page_id,
									'status'	=> (is_subclass_of(ci(), 'Public_Controller') ? 'live' : NULL)
								))))
								{
									$val->url = site_url($page->uri);
									$val->is_home = $page->is_home;
								}
								else
								{
									unset($result[$key]);
								}
					break;
				} 
					 
					 
					$list .= ' <li style="display:inline;padding:0px 7px;;border-right:1px solid #d3d3d3" id="'.$link->title.'" >'.anchor($val->url, $link->title, ' ');
					
					$list.='</li>'.PHP_EOL;
					$i++;
					
				 
			}
			 $list.='</ul></div>';
			 return   $list;
		}else{
			return false;
		}
		

    	
		 
	}
	
	
	function keyword($slug = '')
	{	 
		  
		$this->data->pagination = create_pagination('collection/keyword/'.$slug, $this->collection_m->count_by(array(
			'keyword'=> str_replace('%20',' ',$slug),
			'status' => 'live'
		)), $this->limit, 4);
		 
		
		$this->data->berita = $this->collection_m->get_many_by(array(
			'keyword'=> str_replace('%20',' ',$slug),
			'status' => 'live',
			'limit'=>$this->data->pagination['limit'],
			'order_by_id' => 'DESC'
		));
		 
		
		
		if(!$this->data->berita){
			redirect('home');
		}
		// Set meta description based on article titles
		 
		$this->data->title=$slug;
		$this->data->submenu='';
		$this->data->article='';
		
		// Build the page
		$this->template->title($this->module_details['name'], $this->data->title )	 
			->set_metadata('keywords', $this->data->title )  
			->build( 'keyword', $this->data );
	}
	
	function search(){
		redirect('collection/archive/'.$this->input->post('thn').'/'.$this->input->post('bln').'/'.$this->input->post('tgl')); 
	}
	
	function archive($year = NULL, $month = '',$day="")
	{	
		   if(!$year) $year = date('Y');
		   if(!$month) $month = date('m');
		   if(!$day) $day = date('d');
		   
		 
			$month_date = new DateTime($year.'-'.$month.'-01');
			$this->data->pagination = create_pagination('collection/archive/'.$year.'/'.$month.'/'.$day, $this->collection_m->count_by_arsip(array('year'=>$year,'month'=>$month,'day'=>$day)), $this->limit, 6);
			$this->data->berita = $this->collection_m
			->get_many_by_arsip(array('year'=> $year,'month'=> $month,'day'=>$day,'limit'=>$this->data->pagination['limit']));
			$this->data->month_year = $month_date->format("F 'y");
		 
		
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->collection);
		for($ix=1;$ix<=31;$ix++){
			if($ix<=12){
				$blnx[$ix]=bulan($ix);
			}
			$tgldat[$ix]=$ix;
		}
		for($t=2008;$t<=date('Y')+1;$t++){
			$thnx[$t]=$t;
		}
		$this->data->tgldat=$tgldat;
		$this->data->blnx=$blnx;
		$this->data->thnx=$thnx;
		$this->template->title( $this->data->month_year, $this->lang->line('collection_archive_title'), $this->lang->line('collection_collection_title'))		
			->set_metadata('description', $this->data->month_year.'. '.$meta['description'])
			->set_metadata('keywords', $this->data->month_year.', '.$meta['keywords'])
			->set_breadcrumb($this->lang->line('collection_collection_title'), 'collection')
			->set_breadcrumb($this->lang->line('collection_archive_title').': '.$month_date->format("F 'y"))
			->build('archive', $this->data);
	}
	
	 
}