<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends Public_Controller
{
	public $limit = 12; // TODO: PS - Make me a settings option
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('news_m');
		$this->load->model('news_categories_m');
		$this->load->model('comments/comments_m');
		$this->load->model('navigation/navigation_m');  
		$this->load->helper('text');
		$this->lang->load('news');
		$this->theme = $this->settings->default_theme;
	}
	
	// news/page/x also routes here
	function index()
	{
		 
			if($this->uri->segment(2) != 'index'){
			@$_SESSION['cari']='';
		 }
		// Create pagination links
		if(@$_SESSION['cari']){
			$this->db->like('news.title',$_SESSION['cari']);
		}
		
		@$this->data->total = $total_rows = $this->news_m->count_by(array( 'status' => 'live'));
		$pagination = create_pagination('news/index', $total_rows,20,3);
		 
		// Using this data, get the relevant results
		if(@$_SESSION['cari']){
			$this->db->like('news.title',$_SESSION['cari']);
		}
		$news = $this->news_m->limit($pagination['limit'])->get_many_by(array(
			 
			'status' => 'live'
		));
		
		foreach ($news as &$post)
		{
			$post->author = $this->ion_auth->get_user($post->createdby);
		}
		
		foreach ($news as &$post)
		{
			$post->updated = $this->ion_auth->get_user($post->updateby);
		}
		
		if((@$_POST['search'])){
			redirect('admin/news/search/'.$_POST['search']);
		}
		
		$this->template
			->title($this->module_details['name'])
			->set('pagination', $pagination)
			->set('news', $news)
			->set('post', $post)
			->build($this->theme.'/category', $this->data);
		 
		 
	}
	
	public function search()
	{
		// Create pagination links
		$_SESSION['cari']=$_POST['q'];
		 redirect('news/index/');
	}
	
	
	
	function category($slug = '')
	{	
		if(!$slug) redirect('news');
		unset($_SESSION['namablog']);
		// Get category data
		$category = $this->news_categories_m->get_by('slug', $slug);
		
		if(!$category) show_404();
	
		$this->data->category =& $category;
		@$this->data->article->category_id=$category->id;
		$this->data->article->navigation_group_id=$category->navigation_group_id;
		// Count total news articles and work out how many pages exist
		$this->data->pagination = create_pagination('news/category/'.$slug, $this->news_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
		)), $this->limit, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles
		$this->data->news = $this->news_m->limit($this->data->pagination['limit'])->get_many_by(array(
			'category'=>$slug,
			'status' => 'live'
		));
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->news);
		$this->data->title=$category->title;
		$this->data->submenu='';
		if($category->navigation_group_id){
			$this->data->submenu=$this->get_menu($category->navigation_group_id);
		}
		
		//get for slider
		$catid=$category->id; 
		 
		$params=array('catid'=>$catid,'limit'=>array('1','0'));
		$this->data->categories = $this->news_m->get_all($params);
		
		// Build the page
		$this->template->title($this->module_details['name'], $category->title )		
			->set_metadata('description', $category->title.'. '.$meta['description'] )
			->set_metadata('keywords', $category->title ) 
			->set_breadcrumb( lang('news_news_title'), 'news')
			->set_breadcrumb( $category->title )		
			->build( $this->theme.'/category', $this->data );
	}
	
	function ajax($slug = '')
	{	
		if(!$slug) redirect('news');
		unset($_SESSION['namablog']);
		// Get category data
		$category = $this->news_categories_m->get_by('slug', $slug);
		
		if(!$category) show_404();
		
		$this->data->category =& $category;
		$this->data->article->category_id=$category->id;
		$this->data->article->navigation_group_id=$category->navigation_group_id;
		// Count total news articles and work out how many pages exist
		$this->data->pagination = create_pagination('news/category/'.$slug, $this->news_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
		)), $this->limit, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles
		$this->data->news = $this->news_m->limit($this->data->pagination['limit'])->get_many_by(array(
			'category'=>$slug,
			'status' => 'live'
		));
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->news);
		$this->data->title=$category->title;
		$this->data->submenu='';
		if($category->navigation_group_id){
			$this->data->submenu=$this->get_menu($category->navigation_group_id);
		}
		
		//get for slider
		$catid=$category->id; 
		 
		$params=array('catid'=>$catid,'limit'=>array('9','0'));
		$this->data->categories = $this->news_m->get_all($params);
		
		// Build the page
		$this->load->view( 'category_ajax',$this->data );
	}
	
	function penulis($slug = '')
	{	
		if(!$slug) redirect('news');
		 
		// Count total news articles and work out how many pages exist
		$this->data->pagination = create_pagination('news/penulis/'.$slug, $this->news_m->count_by(array(
			'penulis'=>$slug,
			'status' => 'live'
		)), $this->limit, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles
		$this->data->news = $this->news_m->limit($this->data->pagination['limit'])->get_many_by(array(
			'penulis'=>$slug,
			'status' => 'live'
		));
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->news);
		$this->data->title='Penulis';
		$this->data->submenu='';
		 
		//print_r($this->data->news);
		// Build the page
		if(($this->data->news[0]->intro_en)){
			$_SESSION['namablog']=$this->data->news[0]->intro_en;
		}
		
		$this->template
			->title('twittlander @'.@$_SESSION['namablog'])
			->build('penulis', $this->data );
	}
	
	function archive_news($year = NULL, $month = '01')
	{	
		if(!$year) $year = date('Y');		
		$month_date = new DateTime($year.'-'.$month.'-01');
		$this->data->pagination = create_pagination('news/archive/'.$year.'/'.$month, $this->news_m->count_by(array('year'=>$year,'month'=>$month)), $this->limit, 5);
		$this->data->news = $this->news_m->limit($this->data->pagination['limit'])->get_many_by(array('year'=> $year,'month'=> $month));
		$this->data->month_year = $month_date->format("F 'y");
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->news);

		$this->template->title( $this->data->month_year, $this->lang->line('news_archive_title'), $this->lang->line('news_news_title'))		
			->set_metadata('description', $this->data->month_year.'. '.$meta['description'])
			->set_metadata('keywords', $this->data->month_year.', '.$meta['keywords'])
			->set_breadcrumb($this->lang->line('news_news_title'), 'news')
			->set_breadcrumb($this->lang->line('news_archive_title').': '.$month_date->format("F 'y"))
			->build('archive', $this->data);
	}
	
	// Public: View an article
	function view($slug = '')
	{	
		if (!$slug or !$article = $this->news_m->get_by('slug', $slug))
		{
			redirect('news');
		}
		
		if($article->status != 'live' && !$this->ion_auth->is_admin())
		{
			redirect('news');
		}
		
		@$this->data->chunks = $this->news_m->where('section_id',$article->id)->get_chunk();
		
		//print_r($article->chunks);
		// IF this article uses a category, grab it
		if($article->category_id > 0)
		{
			$article->category = $this->news_categories_m->get( $article->category_id );
			 
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
 
		 
		
		
		 
		 if(($article)){
			 $page=$article->id;
			 $_SESSION['namablog']=$article->createdby;
		 }
		
		if(!isset($_SESSION['halaman'][$page]))
		{
		    $_SESSION['halaman'][$page]=1;
		    //.$this->session->halaman($page);//=$_SESSION[$page]=1;
		    $this->db->set('klik', 'klik+1', FALSE)
			 ->where('id', $article->id)
			 ->update('news');
		}
		
		$limits=Array ( '0' => 2,'1' => 0 );//print_r($article); echo $article->category->slug;
		$this->data->news = $this->news_m->limit($limits)->get_many_by(array(
				'category'=>$article->category->slug,
				'status' => 'live',
				'not_id' => $article->id
			));//print_r($this->data->news);
		
	  
		 
		  

		$imagesartikel = get_image($article->body);
		$jml = count($imagesartikel[1]);
			if($jml==0){
			$src='http://utara.jakarta.go.id/srv-5/images/berita/'.$article->foto;
			}else{
			$src=$imagesartikel[1][0];
			}

		 $images=$src; 
		$this->data->nid=$article->id;
		$this->template
		->title($article->title)
			->set_breadcrumb($article->title)
			->set_metadata('news_keywords',$article->category->title.', '.$article->title)
			->set_metadata('robots', 'index, follow')
			->set_metadata('googlebot', 'NOODP, all')
			->set_metadata('googlebot-news', 'index, follow')
			->set_metadata('googlebot-image', 'index, follow')
			->set_metadata('fb:app_id', '376955466100726','property') 
			->set_metadata('og:type', 'article','property')
			->set_metadata('article:published_time', date('Y-m-d H:i:s', $article->created_on),'property')
			->set_metadata('og:url', base_url().'news/'.date('Y/m', $article->created_on).'/'.$article->slug,'property')
			->set_metadata('og:title', $article->title,'property') 
			->set_metadata('og:image', $images,'property')
			->set_metadata('twitter:image:src', $images)
			
			->set_metadata('og:image:type','image/jpeg','property')
			->set_metadata('og:image:width', '641','property')
			->set_metadata('og:image:height', '452','property')
			->set_metadata('og:description', trim($article->intro),'property')
			->set('post', $article) 
			->build('root/view', $this->data);
	}


	function arsip($id){
		
		$article = $this->db->where('id',$id)->get('news_his')->row();
		$article->category = $this->news_categories_m->get( $article->category_id );
	 
		$this->template
		->title($article->title)
			->set_breadcrumb($article->title)
			->set_metadata('news_keywords',$article->category->title.', '.$article->title)
			->set_metadata('robots', 'index, follow')
			->set_metadata('googlebot', 'NOODP, all')
			->set_metadata('googlebot-news', 'index, follow')
			->set_metadata('googlebot-image', 'index, follow')
			->set_metadata('fb:app_id', '376955466100726','property') 
			->set_metadata('og:type', 'article','property')
			->set_metadata('article:published_time', date('Y-m-d H:i:s', $article->created_on),'property')
			->set_metadata('og:url', base_url().'news/'.date('Y/m', $article->created_on).'/'.$article->slug,'property')
			->set_metadata('og:title', $article->title,'property') 
			->set_metadata('og:image', $images,'property')
			->set_metadata('twitter:image:src', $images)
			
			->set_metadata('og:image:type','image/jpeg','property')
			->set_metadata('og:image:width', '641','property')
			->set_metadata('og:image:height', '452','property')
			->set_metadata('og:description', trim($article->intro),'property')
			->set('article', $article)
			->set('incategory', $incategory)
			->set('inrecomend', $inrecomend)
			->set('inevent', $inevent)
			->build('root/view', $this->data);
	}
	
	function viewid($slug = '')
	{	
		if (!$slug or !$article = $this->news_m->get($slug))
		{
			redirect('news');
		}
		
		if($article->status != 'live' && !$this->ion_auth->is_admin())
		{
			redirect('news');
		}
		
		// IF this article uses a category, grab it
		if($article->category_id > 0)
		{
			$article->category = $this->news_categories_m->get( $article->category_id );
			 
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
			$this->template->set_breadcrumb($article->category->title, 'news/category/'.$article->category->slug);
		}
		
		 
		 if(($article)){
			 $page=$article->id;
			 $_SESSION['namablog']=$article->createdby;
		 }
		
		if(!isset($_SESSION['halaman'][$page]))
		{
		    $_SESSION['halaman'][$page]=1;
		    //.$this->session->halaman($page);//=$_SESSION[$page]=1;
		    $this->db->set('klik', 'klik+1', FALSE)
			 ->where('id', $article->id)
			 ->update('news');
		}
		
		$limits=Array ( '0' => 2,'1' => 0 );//print_r($article); echo $article->category->slug;
		$this->data->news = $this->news_m->limit($limits)->get_many_by(array(
				'category'=>$article->category->slug,
				'status' => 'live',
				'not_id' => $article->id
			));//print_r($this->data->news);
		
		$this->data->nid=$article->id;
		
		$this->template->set_breadcrumb($article->title, 'news/'.date('Y/m', $article->created_on).'/'.$article->slug);
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
		if(($articles))
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
		if(($parent_id)){
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
		  
		@$this->data->pagination = create_pagination('news/keyword/'.$slug, $this->news_m->count_by(array(
			'keyword'=> str_replace('%20',' ',$slug),
			'status' => 'live'
		)), $this->limit, 4);
		 
		
		$this->data->berita = $this->news_m->get_many_by(array(
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
	
	 
	
	function archive($year = NULL, $month = '',$day="")
	{	
		   if(!$year) $year = date('Y');
		   if(!$month) $month = date('m');
		   if(!$day) $day = date('d');
		   
		 
			$month_date = new DateTime($year.'-'.$month.'-01');
			$this->data->pagination = create_pagination('news/archive/'.$year.'/'.$month.'/'.$day, $this->news_m->count_by_arsip(array('year'=>$year,'month'=>$month,'day'=>$day)), $this->limit, 6);
			$this->data->berita = $this->news_m
			->get_many_by_arsip(array('year'=> $year,'month'=> $month,'day'=>$day,'limit'=>$this->data->pagination['limit']));
			$this->data->month_year = $month_date->format("F 'y");
		 
		
		
		// Set meta description based on article titles
		$meta = $this->_articles_metadata($this->data->news);
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
		$this->template->title( $this->data->month_year, $this->lang->line('news_archive_title'), $this->lang->line('news_news_title'))		
			->set_metadata('description', $this->data->month_year.'. '.$meta['description'])
			->set_metadata('keywords', $this->data->month_year.', '.$meta['keywords'])
			->set_breadcrumb($this->lang->line('news_news_title'), 'news')
			->set_breadcrumb($this->lang->line('news_archive_title').': '.$month_date->format("F 'y"))
			->build('archive', $this->data);
	}

	function json_berita()
	{
		header('Content-Type: application/json');
		
		$this->db->select('news.title as judul,FROM_UNIXTIME(default_news.created_on) as tgl,news.body as content,news.foto as img,news.slug as slug');

		$this->db->where('MONTH(FROM_UNIXTIME(created_on))', date('m'));
		$this->db->where('DAY(FROM_UNIXTIME(created_on))', date('d'));
		$this->db->where('YEAR(FROM_UNIXTIME(created_on))', date('Y'));
		$this->db->where('status', 'live');
		$this->db->order_by('id','DESC');
		$blog = $this->db->get('news')->result_array();

		$result['result']=$blog;
		
		echo json_encode($result);
	}

	function json_agenda()
	{
		header('Content-Type: application/json');
		$this->db->set_dbprefix('tbl_'); 

		$this->db->where('MONTH((tgl_agenda))', date('m'));
		$this->db->where('DAY((tgl_agenda))', date('d'));
		$this->db->where('YEAR((tgl_agenda))', date('Y')); 
		$this->db->order_by('tgl_agenda','DESC');
		$blog = $this->db->get('agenda')->result_array();

		$result['data']=$blog;
		
		echo json_encode($result);
		$this->db->set_dbprefix('default_');
	}

	function json_beritafoto()
	{
		header('Content-Type: application/json');
		$this->db->set_dbprefix('tbl_'); 
 
		$this->db->where('MONTH(FROM_UNIXTIME(created_on))', date('m'));
		$this->db->where('DAY(FROM_UNIXTIME(created_on))', date('d'));
		$this->db->where('YEAR(FROM_UNIXTIME(created_on))', date('Y'));
		$this->db->order_by('created_on','DESC');
		$blog = $this->db->get('tbl_gall_cat')->result_array();

		$result['data']=$blog;
		
		echo json_encode($result);
		$this->db->set_dbprefix('default_');
	}

	function migrasi(){
		$res=$this->db->query("SELECT wp.ID, wpm2.meta_value FROM amz_posts wp INNER JOIN 
		default_amz_postmeta wpm ON (wp.ID = wpm.post_id AND wpm.meta_key = '_thumbnail_id') INNER JOIN default_amz_postmeta wpm2 ON (wpm.meta_value = wpm2.post_id AND wpm2.meta_key = '_wp_attached_file') ORDER BY `wp`.`ID` DESC ")->result();

		foreach($res as $val){
			$img = '<p><img src="https://dppapp.jakarta.go.id/wp-content/uploads/'.$val->meta_value.'"></p>';
			echo '<br>'.$val->ID;
			//$this->db->query("UPDATE default_news set body = CONCAT('".$img."',' ',body) where id=".$val->ID);
		}
	}

	
	 
}