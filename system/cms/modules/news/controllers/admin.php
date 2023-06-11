<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('simple_html_dom.php');

/**

 *

 * @package  	PyroCMS

 * @subpackage  Categories

 * @category  	Module

 * http://10.15.3.177/

 */

class Admin extends Admin_Controller

{

	/**

	 * Array that contains the validation rules

	 * @access protected

	 * @var array

	 */

	protected $validation_rules = array(

		array(

			'field'   => 'title',

			'label'   => 'lang:news_title_label',

			'rules'   => 'trim|htmlspecialchars|required'

			),

		array(

			'field'   => 'title_en',

			'label'   => 'foto caption',

			'rules'   => 'trim'

			),array(

				'field'   => 'arsipkan',
	
				'label'   => 'arsipkan',
	
				'rules'   => 'trim'
	
				),

		array(

			'field'	=> 'slug',

			'label'	=> 'lang:news_slug_label',

			'rules' => 'trim'

		),

		array(

			'field' => 'category_id',

			'label' => 'lang:news_category_label',

			'rules' => 'trim|numeric'

		),

		array(

			'field' => 'body',

			'label' => 'Body',

			'rules' => 'trim|required'

		),array(

			'field'	=> 'js',

			'label'	=> 'JS',

			'rules'	=> 'trim'

		),

		array(

			'field' => 'status',

			'label' => 'lang:news_status_label',

			'rules' => 'trim|alpha'

		),

		array(

			'field' => 'created_on',

			'label' => 'lang:news_date_label',

			'rules' => 'trim|required'

		),

		array(

		  'field' => 'created_on_hour',

		  'label' => 'lang:news_created_hour',

		  'rules' => 'trim|numeric|required'

		),

		array(

			'field' => 'created_on_minute',

			'label' => 'lang:news_created_minute',

			'rules' => 'trim|numeric|required'

		),

		array(

			'field' => 'navigation_group_id',

			'label' => 'Group Navigasi',

			'rules' => 'trim'

		) ,

		array(

			'field' => 'keyword',

			'label' => 'Keyword',

			'rules' => 'trim'

		),

		array(

			'field' => 'foto',

			'label' => 'Foto',

			'rules' => 'trim'

		),

		array(

			'field' => 'google',

			'label' => 'google',

			'rules' => 'trim'

		)

	);



	/** 

	 * The constructor

	 * @access public

	 * @return void

	 */

	public function __construct()

	{

		parent::Admin_Controller();

		

		$this->load->model('news_m');

		$this->load->model('news_categories_m');

		$this->lang->load('news'); 

		$this->lang->load('categories');

		

		// Date ranges for select boxes

		@$this->data->hours = array_combine($hours = range(0, 23), $hours);

		$this->data->minutes = array_combine($minutes = range(0, 59), $minutes);

		

		$this->data->categories = array(0 => '');

		if ($categories = $this->news_categories_m->get_all())

		{

			foreach($categories as $category)

			{

				$this->data->categories[$category->id] = $category->title;

			}

		}

		$this->template

         ->set_theme('admin_gue') 

			->set_partial('shortcuts', 'admin/partials/shortcuts');

	}

	

	function pilih($id=""){

			$this->db->set('pilihan_editor', '1', FALSE)

			 ->where('id', $id)

			 ->update('news');

			 redirect('admin/news');

	}

	

	function headline($id=""){

			$this->db->set('headline', '1', FALSE)

			 ->where('id', $id)

			 ->update('news');

			 redirect('admin/news');

	}

	

	function selesai($id=""){

			$this->db->set('pilihan_editor', '0', FALSE)

			 ->where('id', $id)

			 ->update('news');

			 redirect('admin/news');

	}

	

	function headline_selesai($id=""){

			$this->db->set('headline', '0', FALSE)

			 ->where('id', $id)

			 ->update('news');

			 redirect('admin/news');

	}

	/**

	 * Show all created news articles

	 * @access public

	 * @return void

	 */

	public function index()

	{

		$file_folders = $this->news_categories_m->get_folders();

		$folders_tree = array();

		foreach($file_folders as $folder)

		{

			$indent = repeater('&raquo; ', $folder->depth);

			$this->data->folders_tree[$folder->id] = $indent . $folder->title;

		}

		

		 if($this->uri->segment(3) != 'index'){

			@$_SESSION['cari']='';

		 }

		// Create pagination links

		if(@$_SESSION['cari']){

			$this->db->like('news.title',$_SESSION['cari']);

		

		}



		if((@$_SESSION['category'])){

			$this->db->like('news.category_id',$_SESSION['category']);

		}

		

		$this->data->total = $total_rows = $this->news_m->count_by(array('show_future'=>TRUE, 'status' => 'all'));

		$pagination = create_pagination('admin/news/index', $total_rows);

		 

		// Using this data, get the relevant results

		if(@$_SESSION['cari']){

			$this->db->like('news.title',$_SESSION['cari']);

			

			

		}



		if((@$_SESSION['category'])){

			$this->db->like('news.category_id',$_SESSION['category']);

		}

		$news = $this->news_m->limit($pagination['limit'])->get_many_by(array(

			'show_future' => TRUE,

			'status' => 'all'

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

			->build('admin/index', $this->data);

	}

	function setnav($id=""){

		$news = $this->db->where('id',$id)->get('news')->row();
		$uri = date('Y/m', $news->created_on).'/'.$news->slug;

		$arr= array(
			'uri' => base_url().'news/'.$uri
		);

		$this->db->where('id',$news->category_id);
		$this->db->update('news_categories',$arr);
		redirect('admin/news');
	}

	function setnavcat($id=""){

		$news = $this->db->where('id',$id)->get('news_categories')->row();
		$uri = 'news/category/'.$news->slug;

		$arr= array(
			'uri' => base_url().$uri
		);

		$this->db->where('id',$news->id);
		$this->db->update('news_categories',$arr);
		redirect('admin/news');
	}

	

	public function search()

	{

		// Create pagination links

		$_SESSION['cari']=$_POST['search'];

		$_SESSION['category']=$_POST['category'];

		 redirect('admin/news/index/');

	}

	

	public function resetsearch()

	{

		// Create pagination links

		$_SESSION['cari']='';

		$_SESSION['category']='0';

		 redirect('admin/news/index/');

	}

	/**

	 * Create new article

	 * @access public

	 * @return void

	 */

	public function create()

	{

		$this->load->library('form_validation');

		$file_folders = $this->news_categories_m->get_folders();

		$folders_tree = array();

		foreach($file_folders as $folder)

		{

			$indent = repeater('&raquo; ', $folder->depth);

			$this->data->folders_tree[$folder->id] = $indent . $folder->title;

		}

		

		//append the check slug callback function to rules array

		$this->validation_rules[1]['rules'] .= '|callback__check_slug';

		$this->form_validation->set_rules($this->validation_rules);

		

		if ($this->input->post('created_on'))

		{     $created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), $this->input->post('created_on_hour'), $this->input->post('created_on_minute')));

		

			 

			 }

 

		

		if ($this->form_validation->run())

		{

			//print_r($this->input->post('chunk_slug'));

			

      $date = $this->input->post('date');

			 

			

      $date =  explode('/', $date); 

	  $this->load->library('upload', array(

				'upload_path'	=> '../srv-5/images/berita/',

				'allowed_types'	=> 'gif|jpg|png|jpeg' 

			)); 

			// File upload error

			if ( !$this->upload->do_upload('foto'))

			{

				$file['file_name'] = '';

			}else{

				$file = $this->upload->data();

				$file['file_name'] = $file['file_name'];

			}

	 

      $id = $this->news_m->insert(array(

				'title'			=> $this->input->post('title'),

				'title_en'			=> $this->input->post('title_en'),

				'slug'			=> url_title($this->input->post('title')),

				'category_id'		=> $this->input->post('category_id'),

				'intro'			=> substr(htmltotext($this->input->post('body')),0,200).'...',

				'foto'=> $file['file_name'],

				'body'			=> $this->input->post('body'),

				'status'		=> $this->input->post('status'),

				'lat'			=> $this->input->post('txtLat'),

				'lng'		=> $this->input->post('txtLang'),

				'created_on'		=> $created_on,

				'created_on_hour'	=> str_pad($this->input->post('created_on_hour'), 2, '0', STR_PAD_LEFT),

				'created_on_minute'	=> $this->input->post('created_on_minute'),

				'navigation_group_id' => $this->input->post('navigation_group_id'), 

				'keyword'		=> $this->input->post('keyword'),

				'google'		=> $this->input->post('google'),

				'createdby'			=> $this->user->id

			));

    	

			if($id)

			{

			 

				$this->pyrocache->delete_all('news_m');

				$this->session->set_flashdata('success', sprintf($this->lang->line('news_article_add_success'), $this->input->post('title')));

			}

			else

			{

				$this->session->set_flashdata('error', $this->lang->line('news_article_add_error'));

			}



			// Redirect back to the form or main page

			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/news') : redirect('admin/news/edit/'.$id);

		}



		else

		{

			@$article->chunks = array((object) array(

				'id' => 'NEW',

				'slug' => 'default',

				'body' => '',

				'type' => 'wysiwyg-advanced',

			));

			

		

			// Go through all the known fields and get the post values

			foreach($this->validation_rules as $key => $field)

			{

				$article->$field['field'] = set_value($field['field']);

			}

			

			@$article->created_on =  ($created_on);

		}

		

		//self::_form_data();

		 $data['page'] = & $page;

		$data['parent_page'] = & $parent_page;

		$this->template

			->title($this->module_details['name'], lang('news_create_title'))

			->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )

			->append_metadata( js('codemirror/codemirror.js') )

			->append_metadata( js('form.js', 'news') )

			->set('article', $article) 

			->build('admin/form',$data);

	}

	

	public function ambilberita()

	{

		$this->load->library('form_validation');

		

		//append the check slug callback function to rules array 



		$this->form_validation->set_rules('title', 'title', 'required');

		

		if ($this->input->post('created_on'))

		{

			  $created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), $this->input->post('created_on_hour'), $this->input->post('created_on_minute')));

		}

		$arrv=array();

		if($this->input->post('title')){

		$arrv=array_values(array_filter($this->input->post('title')));

		}

		if (count($arrv) <> 0)

		{

			foreach($arrv as $keydom => $valdom ){

				$html = file_get_html($valdom);

				$keyworddom=$this->input->post('keyword');

				$kateg=$this->input->post('category_id');

				if($this->input->post('sumber') =='detik'){

				$foto='detik.com';

				foreach($html->find('h1') as $e)

				$title= $this->html2text($e->innertext);

				

				foreach($html->find('div.artikel2') as $e)

				$body = $this->detik($e->innertext) ;

				}

				 $intro=substr($this->html2text($body),0,400);

				

					$date = $this->input->post('date');

					

					$date =  explode('/', $date);

				      $title = htmltotext($title);

					$id = $this->news_m->insert(array(

								  'title'			=> $title,

								  'title_en'			=> $foto,

								  'slug'			=> url_title($title),

								  'category_id'		=> $kateg[$keydom],

								  'intro'			=> $intro,

								  'body'			=> $body,

								  'status'		=> $this->input->post('status'),

								  'created_on'		=> $created_on,

								  'created_on_hour'	=> $this->input->post('created_on_hour'),

								  'created_on_minute'	=> $this->input->post('created_on_minute'),

								  'navigation_group_id' => $this->input->post('navigation_group_id'),

								  'keyword'		=> $keyworddom[$keydom]

							  ));

					  

							  if($id)

							  {

							   

							   

								  $this->pyrocache->delete_all('news_m');

								  $this->session->set_flashdata('success', sprintf($this->lang->line('news_article_add_success'), $this->input->post('title')));

							  }

							  else

							  {

								  $this->session->set_flashdata('error', $this->lang->line('news_article_add_error'));

							  }

				//echo $valdom;

			}

			

			 

			//print_r($this->input->post('chunk_slug'));

			



			// Redirect back to the form or main page

			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/news') : redirect('admin/news/edit/'.$id);

		}



		else

		{

			$article->chunks = array((object) array(

				'id' => 'NEW',

				'slug' => 'default',

				'body' => '',

				'type' => 'wysiwyg-advanced',

			));

			

		

			// Go through all the known fields and get the post values

			foreach($this->validation_rules as $key => $field)

			{

				$article->$field['field'] = set_value($field['field']);

			}

		}

		

		//self::_form_data();

		 $data['page'] = & $page;

		$data['parent_page'] = & $parent_page;

		$this->template

			->title($this->module_details['name'], lang('news_create_title'))

			->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )

			->append_metadata( js('codemirror/codemirror.js') )

			->append_metadata( js('form.js', 'news') )

			->set('article', $article) 

			->build('admin/form_ambil',$data);

	}

	

	/**

	 * Edit news article

	 * @access public

	 * @param int $id the ID of the news article to edit

	 * @return void

	 */

	



function html2text($content=""){

	$content = preg_replace("/<img[^>]+\>/i", " ", $content); 

return $content;

}



function download(){

		

	$bulan = $this->input->post('bulan');

	$user = $this->input->post('user');

 

 $this->db->select('news.*,profiles.first_name,news_categories.title AS category_title, news_categories.slug AS category_slug');

 $this->db->join('news_categories', 'news.category_id = news_categories.id', 'left');

 $this->db->join('profiles', 'news.createdby = profiles.user_id', 'left');

 $this->db->order_by('created_on', 'DESC');

 if(($bulan)){

	 

	 $this->db->where("FROM_UNIXTIME(created_on, '%m') = ",$bulan);

	 $this->db->where("FROM_UNIXTIME(created_on, '%Y') = ",date('Y'));

 }

 

 if(($user)){

	 

	 $this->db->where("news.createdby",$user); 

 }

 

  

	

	$this->data->res = $this->db->get('news')->result();



		

 

 $this->load->view('admin/download', $this->data);

 

}





function detik($content=""){

	//$content = preg_replace('{<div class="leftarticle"> (.+?)</div>}s', " ", $content);

        //$content = preg_replace('{<div class="articleshare2"> (.+?)</div>}s', " ", $content);

         //$content = preg_replace('{<div id="bacajugabox" class="box_artikel2 box_artikel3">(.+?)</div>}s', " ", $content);

          //$content = preg_replace('{<div class="baca_juga2 f12">(.+?)</div>}s', " ", $content);

            $img=$this->strip_image_news($content);

            $content = preg_replace('{<iframe width="630" height="100" frameborder="0" style="overflow:hidden;" class="frame_iklan_baris" src="http://adsbox.detik.com/iklanbaris/kanalbox/IB_bottom_article.php"></iframe>}s', " ", $content);

            $content = preg_replace('{<ul class="list_fotovideo">(.+?)</ul>}s', " ", $content);

            $content = preg_replace('{<div[^>]+\>(.+?)</div>}s', " ", $content);

            $content = preg_replace('{<a[^>]+\>(.+?)</a>}s', " ", $content);

         

        

        

        return '<img '.$img.'> '.$this->html2text($content).' <br> Sumber: Detik.com';

}





function strip_image_news($content=""){

	

	$contenttograbimagefrom = $content;

	$firstImage = "";

	$output = preg_match_all('/(?<!_)src=([\'"])?(.*?)\\1/', $contenttograbimagefrom, $ContentImages);

     // echo'<pre>'; print_r($ContentImages);

	return $firstImage = @$ContentImages[0] [2]; // To grab the first image

	//$image_array = @getimagesize(SERVER_DIR.$firstImage);

	 

}



	public function edit($id = 0)

	{//echo $_POST['coba'];exit;



		$file_folders = $this->news_categories_m->get_folders();

		$folders_tree = array();

		foreach($file_folders as $folder)

		{

			$indent = repeater('&raquo; ', $folder->depth);

			$this->data->folders_tree[$folder->id] = $indent . $folder->title;

		}

		 

    $date = $this->input->post('date');

    

    $date =  explode('/', $date);

  

    $id OR redirect('admin/news');

		

		$this->load->library('form_validation');

		

		$this->form_validation->set_rules($this->validation_rules);

			

		$article = $this->news_m->get($id);

		$article->chunks = $this->news_m->where('section_id',$id)->get_chunk();

		//print_r($article->chunks);

		// If we have a useful date, use it 

		if ($this->input->post('created_on'))

		{

			  $created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), str_pad($this->input->post('created_on_hour'), 2, '0', STR_PAD_LEFT), $this->input->post('created_on_minute')));

		

		

		}



		else

		{

			$created_on = now();

		}

		

		if ($this->form_validation->run())

		{

			

			

			 $file['file_name'] = $article->foto;

			 

			if(($_FILES['foto']['name'] != '') && ($_FILES['foto']['name'] != $article->foto)){

			 

				

				$this->load->library('upload', array(

					'upload_path'	=> '../srv-5/images/berita/',

					'allowed_types'	=> 'gif|jpg|png|jpeg' 

				)); 

				// File upload error

				if ( !$this->upload->do_upload('foto'))

				{

					$file['file_name'] = '';

				}else{

					$file = $this->upload->data();

					$file['file_name'] = $file['file_name'];

				}

			}

			//echo str_pad($this->input->post('created_on_hour'), 2, '0', STR_PAD_LEFT);exit;

			$result = $this->news_m->update($id, array(

				'title'			=> $this->input->post('title'),

				'title_en'			=> $this->input->post('title_en'),

				'slug'			=> $this->input->post('slug'),

				'category_id'		=> $this->input->post('category_id'),

				'intro'			=> substr(htmltotext($this->input->post('body')),0,200).'...',

				'foto'=> $file['file_name'],

				'body'			=> $_POST['body'],

				'status'		=> $this->input->post('status'), 

				'lat'			=> $this->input->post('txtLat'),

				'lng'		=> $this->input->post('txtLang'),

				'created_on'	=> $created_on,

				'navigation_group_id' => $this->input->post('navigation_group_id'),

				'created_on_hour'	=> str_pad($this->input->post('created_on_hour'), 2, '0', STR_PAD_LEFT),

				'created_on_minute'	=> $this->input->post('created_on_minute'), 

				'google'		=> $this->input->post('google'),

				'keyword'		=> $this->input->post('keyword')

				));

			

				//arcived
				$archive_data = array(

					'title'			=> $article->title,
	
					'slug'			=> $article->slug,
	
					'category_id'		=> $article->category_id,
	
					'intro'			=> $article->intro,
	
					'foto'=> $article->foto,
	
					'body'			=> $article->body,
	
					'status'		=> $article->status, 
	
					'lat'			=> $article->lat,
	
					'lng'		=> $article->lng,
	
					'created_on'	=> $article->created_on,
	
					'google'		=> $article->google,
	
					'keyword'		=> $article->keyword,
					'section_id' => $article->id,
					'dateupdates' => date('Y-m-d H:i:s')
				);

				if($this->input->post('arsipkan')=='2'){

					$this->db->insert('news_his',$archive_data );
				}

			if ($result)

			{

			if(($article->chunks)){

			$chunk_slugs = array_values($this->input->post('chunk_slug'));

			$chunk_ids = array_values($this->input->post('chunk_id'));

			$chunk_bodies = array_values($this->input->post('chunk_body'));

			$chunk_types = array_values($this->input->post('chunk_type'));

			

			$article->chunks = array();

			for ($i = 0; $i < count($chunk_slugs); $i++)

			{

				// Nothing in here?

				if (empty($chunk_slugs[$i]) and ! strip_tags($chunk_bodies[$i])) continue;

				

				// Strip PHP from chunks

				$chunk_bodies[$i] = str_replace(array(

					'<?php ', '?>'

				), array(

					'&lt;?', '?&gt;'

				), $chunk_bodies[$i]);

				

				$article->chunks = (object) array(

					'id' => $i,

					'slug' => ($chunk_slugs[$i]) ? $chunk_slugs[$i] : '',

					'chunk_id' => ($chunk_ids[$i]) ? $chunk_ids[$i] : '',

					'type' => ($chunk_types[$i]) ? $chunk_types[$i] : '',

					'body' => $chunk_bodies[$i],

				);

				

				$this->news_m->update($article->chunks->chunk_id, array(

				'title'			=> $article->chunks->slug,

				'slug'			=> url_title($article->chunks->slug),

				'category_id'		=> $this->input->post('category_id'),

				'intro'			=> $this->input->post('intro'),

				'body'			=> $article->chunks->body,

				'status'		=> $this->input->post('status'), 

				'lat'			=> $this->input->post('txtLat'),

				'lng'		=> $this->input->post('txtLang'),

				'created_on'	=> $created_on,

				'navigation_group_id' => $this->input->post('navigation_group_id'),

				'created_on_hour'	=> $this->input->post('created_on_hour'),

				'created_on_minute'	=> $this->input->post('created_on_minute'),

				'katakunci'		=> $this->input->post('katakunci'),

				'keyword'		=> $this->input->post('keyword')

				));

			}

			}

			

				$this->session->set_flashdata(array('success'=> sprintf($this->lang->line('news_edit_success'), $this->input->post('title'))));

				

				// The twitter module is here, and enabled!

				if ($this->settings->item('twitter_news') == 1 && ($article->status != 'live' && $this->input->post('status') == 'live'))

				{

					$url = shorten_url('news/'.$date[2].'/'.str_pad($date[0], 2, '0', STR_PAD_LEFT).'/'.url_title($this->input->post('title')));

					$this->load->model('twitter/twitter_m');

					if ( ! $this->twitter_m->update(sprintf($this->lang->line('news_twitter_posted'), $this->input->post('title'), $url)))

					{

						$this->session->set_flashdata('error', lang('news_twitter_error') . ": " . $this->twitter->last_error['error']);

					}

				}

				// End twitter code

			}

			

			else

			{

				$this->session->set_flashdata(array('error'=> $this->lang->line('news_edit_error')));

			}

			

			// Redirect back to the form or main page

			$this->input->post('btnAction') == 'save_exit'

				? redirect('admin/news')

				: redirect('admin/news/edit/'.$id);

		}

		

		// Go through all the known fields and get the post values

		foreach(array_keys($this->validation_rules) as $field)

		{

			if (isset($_POST[$field])) $article->$field = $this->form_validation->$field;

			

		}    	

		 

		// Load WYSIWYG editor

		$this->template

				->title($this->module_details['name'], sprintf(lang('blog_edit_title'), $article->title))

				->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))

				->append_metadata( js('codemirror/codemirror.js') )

				->append_metadata(js('form.js', 'news'))

			 

			->set('article', $article)

			->build('admin/form');

	}	

	

	/**

	* Preview news article

	* @access public

	* @param int $id the ID of the news article to preview

	* @return void

	*/

	public function preview($id = 0)

	{

		$article = $this->news_m->get($id);



		$this->template

			->set_layout('modal', 'admin')

			->set('article', $article)

			->build('admin/preview');

	}

	

	/**

	 * Helper method to determine what to do with selected items from form post

	 * @access public

	 * @return void

	 */

	public function action()

	{

		switch($this->input->post('btnAction'))

		{

			case 'publish':

				$this->publish();

			break;

			case 'delete':

				$this->delete();

			break;

			default:

				redirect('admin/news');

			break;

		}

	}

	

	/**

	 * Publish news article

	 * @access public

	 * @param int $id the ID of the news article to make public

	 * @return void

	 */

	public function publish($id = 0)

	{

		// Publish one

		$ids = ($id) ? array($id) : $this->input->post('action_to');

		

		if ( ($ids))

		{

			// Go through the array of slugs to publish

			$article_titles = array();

			foreach ($ids as $id)

			{

				// Get the current page so we can grab the id too

				if ($article = $this->news_m->get($id) )

				{

					$this->news_m->publish($id);

					

					// Wipe cache for this model, the content has changed

					$this->cache->delete('news_m');				

					$article_titles[] = $article->title;

				}

			}

		}

	

		// Some articles have been published

		if ( ($article_titles))

		{

			// Only publishing one article

			if ( count($article_titles) == 1 )

			{

				$this->session->set_flashdata('success', sprintf($this->lang->line('news_publish_success'), $article_titles[0]));

			}			

			// Publishing multiple articles

			else

			{

				$this->session->set_flashdata('success', sprintf($this->lang->line('news_mass_publish_success'), implode('", "', $article_titles)));

			}

		}		

		// For some reason, none of them were published

		else

		{

			$this->session->set_flashdata('notice', $this->lang->line('news_publish_error'));

		}

		

		redirect('admin/news');

	}

	

	/**

	 * Delete news article

	 * @access public

	 * @param int $id the ID of the news article to delete

	 * @return void

	 */

	public function delete($id = 0)

	{

		// Delete one

		$ids = ($id) ? array($id) : $this->input->post('action_to');

		

		// Go through the array of slugs to delete

		if ( ($ids))

		{

			$article_titles = array();

			foreach ($ids as $id)

			{

				// Get the current page so we can grab the id too

				if ($article = $this->news_m->get($id) )

				{

					$this->news_m->delete($id);

					

					// Wipe cache for this model, the content has changed

					$this->pyrocache->delete('news_m');				

					$article_titles[] = $article->title;

				}

			}

		}

		

		// Some pages have been deleted

		if ( ($article_titles))

		{

			// Only deleting one page

			if ( count($article_titles) == 1 )

			{

				$this->session->set_flashdata('success', sprintf($this->lang->line('news_delete_success'), $article_titles[0]));

			}			

			// Deleting multiple pages

			else

			{

				$this->session->set_flashdata('success', sprintf($this->lang->line('news_mass_delete_success'), implode('", "', $article_titles)));

			}

		}		

		// For some reason, none of them were deleted

		else

		{

			$this->session->set_flashdata('notice', lang('news_delete_error'));

		}

		

		redirect('admin/news');

	}

	

	/**

	 * Callback method that checks the slug of an article

	 * @access public

	 * @param string slug The Slug to check

	 * @return bool

	 */

	public function _check_slug($slug = '')

	{

		if ( ! $this->news_m->check_slug($slug))

		{

			$this->form_validation->set_message('_check_slug', lang('news_already_exist_error'));

			return FALSE;

		}

		

		return TRUE;

	}

	

	/**

	 * method to fetch filtered results for news list

	 * @access public

	 * @return void

	 */

	public function ajax_filter()

	{

		$category = $this->input->post('f_category');

		$status = $this->input->post('f_status');

		$keywords = $this->input->post('f_keywords');

	

		$post_data = array();

	

		if ($status == 'live' OR $status == 'draft')

		{

			$post_data['status'] = $status;

		}

	

		if ($category != 0)

		{

			$post_data['category_id'] = $category;

		}

	

		//keywords, lets explode them out if they exist

		if ($keywords)

		{

			$post_data['keywords'] = $keywords;

		}

		$results = $this->news_m->search($post_data);

	

		//set the layout to false and load the view

		$this->template

			->set_layout(FALSE)

			->set('news', $results)

			->build('admin/index');

	}

	

}