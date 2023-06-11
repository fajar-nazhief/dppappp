<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @package  	PyroCMS
 * @subpackage  Categories
 * @category  	Module
 */
class Admin extends Admin_Controller {

	/**
	 * The id of post
	 * @access protected
	 * @var int
	 */
	protected $id = 0;

	/**
	 * Array that contains the validation rules
	 * @access protected
	 * @var array
	 */
	protected $validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'lang:blog_title_label',
			'rules' => 'trim|htmlspecialchars|required|max_length[300]'
		),
		array(
			'field' => 'slug',
			'label' => 'lang:blog_slug_label',
			'rules' => 'trim|required|alpha_dot_dash|max_length[300]|callback__check_slug'
		) ,
		array(
			'field' => 'google',
			'label' => 'Google map url',
			'rules' => 'trim'
		) ,
		array(
			'field' => 'category_id',
			'label' => 'lang:blog_category_label',
			'rules' => 'trim|numeric'
		),
		array(
			'field' => 'intro',
			'label' => 'lang:blog_intro_label',
			'rules' => 'trim'
		),
		array(
			'field' => 'body',
			'label' => 'lang:blog_content_label',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'status',
			'label' => 'lang:blog_status_label',
			'rules' => 'trim|alpha'
		),
		array(
			'field' => 'created_on',
			'label' => 'lang:blog_date_label',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'created_on_hour',
			'label' => 'lang:blog_created_hour',
			'rules' => 'trim|numeric|required'
		),
		array(
			'field' => 'created_on_minute',
			'label' => 'lang:blog_created_minute',
			'rules' => 'trim|numeric|required'
		)
				,
                array(
				'field' => 'lat',
				'label'	=> 'Lat',
				'rules'	=> 'trim'
		)
		,
                array(
				'field' => 'ahastag',
				'label'	=> 'Hastag',
				'rules'	=> 'trim'
		)
				,
                array(
				'field' => 'lng',
				'label'	=> 'Lng',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'alamat',
				'label'	=> 'Alamat',
				'rules'	=> 'trim'
		)
				,
                array(
				'field' => 'phone',
				'label'	=> 'Phone',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'operasional',
				'label'	=> 'Oprasional Detail',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'bahasa',
				'label'	=> 'Bahasa',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'date_from',
				'label'	=> 'Tanggal Mulai Event',
				'rules'	=> 'trim|required'
		),
                array(
				'field' => 'date_end',
				'label'	=> 'Tanggal Berakhir Event',
				'rules'	=> 'trim|required'
		),
		array(
		'field' => 'bahasa_event',
		'label'	=> 'bahasa yg digunakan',
		'rules'	=> 'trim'
),
array(
'field' => 'transportasi',
'label'	=> 'transportasi',
'rules'	=> 'trim'
),
array(
'field' => 'parkir',
'label'	=> 'parkir',
'rules'	=> 'trim'
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
		$this->nama_modul = 'event';
		
		$this->load->model('event_m');
		$this->load->model('event_categories_m');
		$this->lang->load('event');
		$this->lang->load('categories');
		unset($_SESSION['bahasa']);
		// Date ranges for select boxes
		@$this->data->hours = array_combine($hours = range(0, 23), $hours);
		$this->data->minutes = array_combine($minutes = range(0, 59), $minutes);

		$this->data->categories = array();
		if ($categories = $this->db->order_by('title')->get('blog_categories')->result())
		{
			foreach ($categories as $category)
			{
				$this->data->categories[$category->id] = $category->title;
			}
		}



		$this->template
         ->set_theme('admin_endless')
			->append_metadata( css('blog.css', 'blog') )
			->set_partial('shortcuts', 'admin/partials/shortcuts');
	}

	/**
	 * Show all created blog posts
	 * @access public
	 * @return void
	 */
	
	public function get_kategori_bahasa($id = 0)
	{
		//header('Content-Type: application/json'); 
		$file_folders = $this->event_categories_m->get_folders($id);
		$folders_tree = array();
		
	    foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$folders_tree[$folder->id]['title'] =  $indent . $folder->title;
			$folders_tree[$folder->id]['id'] =  $folder->id; 
			
		}
		 
		echo json_encode($folders_tree);
	}
	
	function download(){
		
		 $bulan = $this->input->post('bulan');
		 $user = $this->input->post('user');
		
		$this->db->select('blog.*,profiles.first_name, blog_categories.banner as banner,blog_categories.title AS category_title, blog_categories.slug AS category_slug');
		$this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');
		$this->db->join('profiles', 'blog.author_id = profiles.user_id', 'left');
		$this->db->order_by('date_from', 'DESC');
		if(($bulan)){
			
			$this->db->where("FROM_UNIXTIME(created_on, '%m') = ",$bulan);
			$this->db->where("FROM_UNIXTIME(created_on, '%Y') = ",date('Y'));
		}
		
		if(($user)){
			
			$this->db->where("blog.author_id",$user); 
		}
		
		
		$this->db->where('nama_modul',$this->nama_modul);
		 
		 $this->data->res = $this->db->get('blog')->result();
	
       
		
		$this->load->view('admin/download', $this->data);
		
	}


	function download_kalender_event(){
		
		$date_start = $this->input->post('date_from_xls');
		$date_end = $this->input->post('date_end_xls');
	   
	   $this->db->select('blog.*,profiles.first_name, blog_categories.banner as banner,blog_categories.title AS category_title, blog_categories.slug AS category_slug');
	   $this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');
	   $this->db->join('profiles', 'blog.author_id = profiles.user_id', 'left');
	   $this->db->order_by('blog.date_from', 'DESC');
	   if(($date_start)){
		   
		   $this->db->where("blog.date_from >= ",$date_start);
		   $this->db->where("blog.date_from <= ",$date_end);
	   }
	   
	   	   
	   
	   $this->db->where('nama_modul',$this->nama_modul);
		
		$this->data->res = $this->db->get('blog')->result();
   
		//$str = $this->db->last_query();
        //print_r($str);
	   
	   $this->load->view('admin/download_kalender_event', $this->data);
	   
   }

	
	public function index()
	{
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all'); 
			unset($_SESSION['f_category']);
			unset($_SESSION['f_status']); 
			unset($_SESSION['f_keywords']);
			unset($_SESSION['f_bahasa']);
			
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}

		//add post values to base_where if f_module is posted
		$base_where = $this->input->post('f_category') ? $base_where + array('category' => $this->input->post('f_category')) : $base_where;

		$base_where['status'] = $this->input->post('f_status') ? $this->input->post('f_status') : $base_where['status'];

		$base_where = $this->input->post('f_keywords') ? $base_where + array('keywords' => $this->input->post('f_keywords')) : $base_where;

		// Create pagination links
		$total_rows = $this->event_m->count_by($base_where);
		$pagination = create_pagination_endless('admin/'.$this->nama_modul.'/index', $total_rows,20,4);

		// Using this data, get the relevant results
		$blog = $this->event_m->limit($pagination['limit'])->get_many_by_admin($base_where);

		foreach ($blog as &$post)
		{
			$post->author = $this->ion_auth->get_user($post->author_id);
		}

		//do we need to unset the layout because the request is ajax?
		$this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
		$bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa'); 
		 
		$this->template
				->title($this->module_details['name'])
				->set_partial('filters', 'admin/partials/filters')
				->append_metadata(js('admin/filter.js'))
				->set('bahasadb', $bahasaArr)
				->set('pagination', $pagination)
				->set('blog', $blog)
                ->set('total',$total_rows)
				->build('admin/index', $this->data);
	}
	
	
	
	public function search()
	{
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
			unset($_SESSION['f_category_v']);
			unset($_SESSION['f_status_v']); 
			unset($_SESSION['f_keywords_v']); 
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all');

		//add post values to base_where if f_module is posted
		if(($this->input->post('search'))){
			$_SESSION['f_category'] = $this->input->post('f_category');
			$_SESSION['f_status'] = $this->input->post('f_status'); 
			$_SESSION['f_keywords'] = $this->input->post('f_keywords');
			$_SESSION['f_bahasa'] = $this->input->post('f_bahasa'); 
		}
		 
		$base_where = $_SESSION['f_category'] ? $base_where + array('category' => $_SESSION['f_category']) : $base_where;
		$base_where = $_SESSION['f_bahasa'] ? $base_where + array('bahasa' => $_SESSION['f_bahasa']) : $base_where;

		$base_where['status'] = $_SESSION['f_status'] ? $_SESSION['f_status'] : $base_where['status'];

		$base_where = $_SESSION['f_keywords'] ? $base_where + array('keywords' => $_SESSION['f_keywords']) : $base_where;

		// Create pagination links
		$total_rows = $this->event_m->count_search($base_where);
		$pagination = create_pagination_endless('admin/'.$this->nama_modul.'/search', $total_rows,20,4);

		// Using this data, get the relevant results
		$blog = $this->event_m->limit($pagination['limit'])->search($base_where);

		foreach ($blog as &$post)
		{
			$post->author = $this->ion_auth->get_user($post->author_id);
		}

		//do we need to unset the layout because the request is ajax?
		 $bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa'); 

		$this->template
				->title($this->module_details['name'])
				->set_partial('filters', 'admin/partials/filters')
				->append_metadata(js('admin/filter.js'))
				->set('bahasadb', $bahasaArr)
				->set('pagination', $pagination)
				->set('blog', $blog)
                ->set('total',$total_rows)
				->build('admin/index', $this->data);
	}

	/**
	 * Create new post
	 * @access public
	 * @return void
	 */

	public function pilihaneditor($id=0){
		$result = $this->event_m->update($id, array(
				'pilihan_editor'				=> '1' 
			));
		redirect('admin/event');
	}
	
	
	
	
	public function pilihaneditor_stop($id=0){
		$result = $this->event_m->update($id, array(
				'pilihan_editor'				=> '0' 
			));
		redirect('admin/event');
	}

	public function create()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->validation_rules);

		if ($this->input->post('created_on'))
		{
			$created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), $this->input->post('created_on_hour'), $this->input->post('created_on_minute')));
		}

		else
		{
			$created_on = now();
		}

		if ($this->form_validation->run())
		{
			// They are trying to put this live
			if ($this->input->post('status') == 'live')
			{
				role_or_die('blog', 'put_live');
			}
			
		     $arr_from = explode('/',$this->input->post('date_from'));
			$start = $arr_from[2].'/'.$arr_from[1].'/'.$arr_from[0].' 00:00:00';
			
			$arr_end = explode('/',$this->input->post('date_end'));
			$stop = $arr_end[2].'/'.$arr_end[1].'/'.$arr_end[0].' 00:00:00';

			 

			$id = $this->event_m->insert(array(
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
				'category_id'		=> $this->input->post('category_id'),
				'intro'				=> $this->input->post('intro'),
				'body'				=> $this->input->post('body'),
				'status'			=> $this->input->post('status'),
				'date_from'			=>  ($start),
				'date_end'			=>  ($stop),
				'lat'			=> $this->input->post('lat'),
				'lng'			=> $this->input->post('lng'),
				'bahasa'			=> $this->input->post('bahasa'), 
				'alamat'			=> $this->input->post('alamat'),
				'phone'			=> $this->input->post('phone'),
				'operasional'			=> $this->input->post('operasional'),
				'created_on'		=> $created_on,
				'nama_modul' => $this->nama_modul,
				'google'			=> str_replace('width="600"','width="100%"',$this->input->post('google')),
				'author_id'			=> $this->user->id,
				'ahastag'			=> $this->input->post('ahastag'),
				'json_data' 		=> serialize($_POST),
				'transportasi'			=> $this->input->post('transportasi'),
				'parkir'			=> $this->input->post('parkir'),
				'bahasa_event'			=> $this->input->post('bahasa_event'),
			)); 
			if ($id)
			{
				if($this->input->post('bodyeng')){
					 $this->event_m->insert(array(
						'title'				=> $this->input->post('title'),
						'slug'				=> $this->input->post('slug').'-eng',
						'category_id'		=> $this->input->post('category_id'),
						'intro'				=> substr($this->input->post('bodyeng'),0,200),
						'body'				=> $this->input->post('bodyeng'),
						'status'			=> $this->input->post('status'),
						'date_from'			=>  ($start),
						'date_end'			=>  ($stop),
						'lat'			=> $this->input->post('lat'),
						'lng'			=> $this->input->post('lng'),
						'bahasa'			=> 'eng', 
						'alamat'			=> $this->input->post('alamat'),
						'phone'			=> $this->input->post('phone'),
						'operasional'			=> $this->input->post('operasional'),
						'created_on'		=> $created_on,
						'nama_modul' => $this->nama_modul,
						'author_id'			=> $this->user->id,
						'ahastag'			=> $this->input->post('ahastag'),
						'json_data' 		=> serialize($_POST),
						'transportasi'			=> $this->input->post('transportasi'),
				'parkir'			=> $this->input->post('parkir'),
				'bahasa_event'			=> $this->input->post('bahasa_event'),
					));
				}
				
				$this->pyrocache->delete_all('event_m');
				$this->session->set_flashdata('success', sprintf($this->lang->line('blog_post_add_success'), $this->input->post('title')));
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('blog_post_add_error'));
			}

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/'.$this->nama_modul) : redirect('admin/'.$this->nama_modul.'/edit/' . $id);
		}
		else
		{
			// Go through all the known fields and get the post values
			foreach ($this->validation_rules as $key => $field)
			{
				@$post->$field['field'] = set_value($field['field']);
			}
			$post->created_on = $created_on;
		}
			$bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa');
			$file_folders = $this->event_categories_m->get_folders();
		    $folders_tree = array();
		
		
	
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		//$m_hastag=array();
		//$m_hastag 
		$this->data->m_hastag= $this->event_m->get_hastag();
       // print_r($folders_tree);die;
		$this->template
				->title($this->module_details['name'], lang('blog_create_title'))
				->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
				->append_metadata(js('blog_form.js', 'blog'))
				->set('arrBahasa', $bahasaArr)
				->set('post', $post)
				->build('admin/form', $this->data);
	}

	/**
	 * Edit blog post
	 * @access public
	 * @param int $id the ID of the blog post to edit
	 * @return void
	 */
	
	public function rekomendasi($id=0){
		$result = $this->event_m->update($id, array(
				'rekomendasi'				=> '1' 
			));
		redirect('admin/'.$this->nama_modul);
	}
	
	public function rekomendasi_stop($id=0){
		$result = $this->event_m->update($id, array(
				'rekomendasi'				=> '0' 
			));
		redirect('admin/'.$this->nama_modul);
	}
	public function edit($id = 0)
	{
		$id OR redirect('admin/'.$this->nama_modul);

		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->validation_rules);

		$post = $this->event_m->get($id);
		$post->author = $this->ion_auth->get_user($post->author_id);

		// If we have a useful date, use it
		if ($this->input->post('created_on'))
		{
			$created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), $this->input->post('created_on_hour'), $this->input->post('created_on_minute')));
		}

		else
		{
			$created_on = $post->created_on;
		}

		$this->id = $post->id;
		
		if ($this->form_validation->run())
		{
			
			// They are trying to put this live
			if ($post->status != 'live' and $this->input->post('status') == 'live')
			{
				role_or_die('blog', 'put_live');
			}

			$author_id = !($post->author) ? $this->user->id : $post->author_id;
			$arr_from = explode('/',$this->input->post('date_from'));
			$start = $arr_from[2].'/'.$arr_from[1].'/'.$arr_from[0].' 00:00:00';
			
			$arr_end = explode('/',$this->input->post('date_end'));
			$stop = $arr_end[2].'/'.$arr_end[1].'/'.$arr_end[0].' 00:00:00';
			
			
	

	   		
			$datanya = array(
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
				'category_id'		=> $this->input->post('category_id'),
				'intro'				=> $this->input->post('intro'),
				'body'				=> $this->input->post('body'),
				'status'			=> $this->input->post('status'),
				'date_from'			=> ($start),
				'date_end'			=> ($stop),
				'lat'			=> $this->input->post('lat'),
				'lng'			=> $this->input->post('lng'),
				'bahasa'			=> $this->input->post('bahasa'), 
				'alamat'			=> $this->input->post('alamat'),
				'phone'			=> $this->input->post('phone'),
				'operasional'			=> $this->input->post('operasional'),
				'created_on'		=> $created_on,
				'nama_modul' => $this->nama_modul,
				'google'			=> str_replace('width="600"','width="100%"',$this->input->post('google')),
				'ahastag'			=> $this->input->post('ahastag'),
				'json_data' 		=> serialize($_POST),
				'transportasi'			=> $this->input->post('transportasi'),
				'parkir'			=> $this->input->post('parkir'),
				'bahasa_event'			=> $this->input->post('bahasa_event'),
			);
			// echo $this->input->post('ahastag');

			// print_r($datanya);die;
			  $result = $this->event_m->update($id, $datanya);
			 
			if ($result)
			{
				$this->session->set_flashdata(array('success' => sprintf($this->lang->line('blog_edit_success'), $this->input->post('title'))));

				// The twitter module is here, and enabled!
//				if ($this->settings->item('twitter_blog') == 1 && ($post->status != 'live' && $this->input->post('status') == 'live'))
//				{
//					$url = shorten_url('blog/'.$date[2].'/'.str_pad($date[1], 2, '0', STR_PAD_LEFT).'/'.url_title($this->input->post('title')));
//					$this->load->model('twitter/twitter_m');
//					if ( ! $this->twitter_m->update(sprintf($this->lang->line('blog_twitter_posted'), $this->input->post('title'), $url)))
//					{
//						$this->session->set_flashdata('error', lang('blog_twitter_error') . ": " . $this->twitter->last_error['error']);
//					}
//				}
			}
			
			else
			{
				$this->session->set_flashdata(array('error' => $this->lang->line('blog_edit_error')));
			}

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/'.$this->nama_modul) : redirect('admin/'.$this->nama_modul.'/edit/' . $id);
		}

		// Go through all the known fields and get the post values
		foreach (array_keys($this->validation_rules) as $field)
		{
			if (isset($_POST[$field]))
			{
				$post->$field = $this->form_validation->$field;
			}
		}

		$post->created_on = $created_on;
		$bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa');
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		
		$this->data->m_hastag= $this->event_m->get_hastag();
		// Load WYSIWYG editor
		$this->template
				->title($this->module_details['name'], sprintf(lang('blog_edit_title'), $post->title))
				->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
				->append_metadata(js('blog_form.js', 'blog'))
				->set('arrBahasa', $bahasaArr)
				->set('post', $post)
				->build('admin/form_edit', $this->data);
	}
	
	public function ajaxAlamat(){
		if(($_POST["keyword"])) {
			
			$this->db->where('nama_modul','event');
			$this->db->like('alamat',$_POST["keyword"]);
			$res = $this->db->get('blog')->result();
			if($res){
				 
				echo '<ul id="country-list">';
				foreach($res as $dat => $val){
				echo '<li onClick="selectCountry(\''.$val->alamat.'\');">'.$val->alamat.'</li>';
			}
			echo '</ul>';
			}
			
			
		}
	}

	/**
	 * Preview blog post
	 * @access public
	 * @param int $id the ID of the blog post to preview
	 * @return void
	 */
	public function preview($id = 0)
	{
		$post = $this->event_m->get($id);

		$this->template
				->set_layout('modal', 'admin')
				->set('post', $post)
				->build('admin/preview');
	}

	/**
	 * Helper method to determine what to do with selected items from form post
	 * @access public
	 * @return void
	 */
	public function action()
	{
		switch ($this->input->post('btnAction'))
		{
			case 'publish':
				role_or_die('blog', 'put_live');
				$this->publish();
				break;
			
			case 'delete':
				role_or_die('blog', 'delete_live');
				$this->delete();
				break;
			
			default:
				redirect('admin/'.$this->nama_modul);
				break;
		}
	}

	/**
	 * Publish blog post
	 * @access public
	 * @param int $id the ID of the blog post to make public
	 * @return void
	 */
	public function publish($id = 0)
	{
		role_or_die('blog', 'put_live');

		// Publish one
		$ids = ($id) ? array($id) : $this->input->post('action_to');

		if ( ($ids))
		{
			// Go through the array of slugs to publish
			$post_titles = array();
			foreach ($ids as $id)
			{
				// Get the current page so we can grab the id too
				if ($post = $this->event_m->get($id))
				{
					$this->event_m->publish($id);

					// Wipe cache for this model, the content has changed
					$this->pyrocache->delete('event_m');
					$post_titles[] = $post->title;
				}
			}
		}

		// Some posts have been published
		if ( ($post_titles))
		{
			// Only publishing one post
			if (count($post_titles) == 1)
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('blog_publish_success'), $post_titles[0]));
			}
			// Publishing multiple posts
			else
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('event_mass_publish_success'), implode('", "', $post_titles)));
			}
		}
		// For some reason, none of them were published
		else
		{
			$this->session->set_flashdata('notice', $this->lang->line('blog_publish_error'));
		}

		redirect('admin/'.$this->nama_modul);
	}

	/**
	 * Delete blog post
	 * @access public
	 * @param int $id the ID of the blog post to delete
	 * @return void
	 */
	public function delete($id = 0)
	{
		// Delete one
		$ids = ($id) ? array($id) : $this->input->post('action_to');

		// Go through the array of slugs to delete
		if ( ($ids))
		{
			$post_titles = array();
			foreach ($ids as $id)
			{
				// Get the current page so we can grab the id too
				if ($post = $this->event_m->get($id))
				{
					$this->event_m->delete($id);

					// Wipe cache for this model, the content has changed
					$this->pyrocache->delete('event_m');
					$post_titles[] = $post->title;
				}
			}
		}

		// Some pages have been deleted
		if ( ($post_titles))
		{
			// Only deleting one page
			if (count($post_titles) == 1)
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('blog_delete_success'), $post_titles[0]));
			}
			// Deleting multiple pages
			else
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('event_mass_delete_success'), implode('", "', $post_titles)));
			}
		}
		// For some reason, none of them were deleted
		else
		{
			$this->session->set_flashdata('notice', lang('blog_delete_error'));
		}

		redirect('admin/'.$this->nama_modul);
	}

	/**
	 * Callback method that checks the title of an post
	 * @access public
	 * @param string title The Title to check
	 * @return bool
	 */
	public function _check_title($title = '')
	{
		if ( ! $this->event_m->check_exists('title', $title, $this->id))
		{
			$this->form_validation->set_message('_check_title', sprintf(lang('blog_already_exist_error'), lang('blog_title_label')));
			return FALSE;
		}
		
		return TRUE;
	}
	
	/**
	 * Callback method that checks the slug of an post
	 * @access public
	 * @param string slug The Slug to check
	 * @return bool
	 */
	public function _check_slug($slug = '')
	{
		if ( ! $this->event_m->check_exists('slug', $slug, $this->id))
		{
			$this->form_validation->set_message('_check_slug', sprintf(lang('blog_already_exist_error'), lang('blog_slug_label')));
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * method to fetch filtered results for blog list
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
		$results = $this->event_m->search($post_data);

		//set the layout to false and load the view
		$this->template
				->set_layout(FALSE)
				->set('blog', $results)
				->build('admin/index');
	}
}
