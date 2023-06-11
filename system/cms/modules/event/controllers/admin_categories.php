<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Categories
 * @category  	Module
 * @author  	Phil Sturgeon - PyroCMS Dev Team
 */
class Admin_Categories extends Admin_Controller
{
	/**
	 * Array that contains the validation rules
	 * @access protected
	 * @var array
	 */
	protected $validation_rules;
	
	/** 
	 * The constructor
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::Admin_Controller();
		$this->nama_modul = 'event';
		$this->load->model('event_categories_m');
		$this->lang->load('categories');
		$this->lang->load('event');
		 
			unset($_SESSION['bahasa']);
	 
	    $this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	
		// Set the validation rules
		$this->validation_rules = array(
			array(
				'field' => 'title',
				'label' => lang('categories.title_label'),
				'rules' => 'trim|required|max_length[20]'
			),array(
				'field' => 'navigation_group_id',
				'label' => 'Parent',
				'rules' => 'trim'
			),
                array(
				'field' => 'bahasa',
				'label'	=> 'Bahasa',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'intro',
				'label'	=> 'Introduction',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'photo',
				'label'	=> 'Photo',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'banner',
				'label'	=> 'Banner',
				'rules'	=> 'trim'
		),
                array(
				'field' => 'slug',
				'label'	=> 'Slug',
				'rules'	=> 'trim|required|callback__check_slug'
		),
		array(
		'field' => 'fa_icon',
		'label'	=> 'fa icon',
		'rules'	=> 'trim'
)
		);
		
		// Load the validation library along with the rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->validation_rules);

		$this->template
         ->set_theme('admin_endless');
	}
	
	/**
	 * Index method, lists all categories
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$this->pyrocache->delete_all('modules_m');
		// Create pagination links
		 
		unset($_SESSION['search']);
		unset($_SESSION['f_bahasa']);
		$this->db->from('blog_categories');
		$this->db->where('module_name',$this->nama_modul);
		$total_rows = $this->db->count_all_results();
		$pagination = create_pagination('admin/'.$this->nama_modul.'/categories/index', $total_rows,50,5);
			
		// Using this data, get the relevant results
		 
		$this->db->where('module_name',$this->nama_modul);
		$categories = $this->event_categories_m->order_by('title')->limit($pagination['limit'])->get_all();
		
		$bahasadb = $this->get_enum_values('default_blog','bahasa');
		 $bahasaArr = array_combine($bahasadb, $bahasadb);
		 
		$this->template
			->title($this->module_details['name'], lang('cat_list_title'))
			->set('bahasadb', $bahasaArr)
			->set('categories', $categories)
			->set('pagination', $pagination)
			->build('admin/categories/index', $this->data);
	}
	
	public function search()
	{
		$this->pyrocache->delete_all('modules_m');
		// Create pagination links

		if($this->input->post('f_bahasa')){
			$_SESSION['f_bahasa']= $this->input->post('f_bahasa');
			
		}
		if($this->input->post('search')){
			$_SESSION['search']= $this->input->post('search');
			
		}
		
		if(isset($_SESSION['search'])){
			$this->db->like('title',$_SESSION['search']);
		}
		
		if(isset($_SESSION['f_bahasa'])){
			$this->db->where('bahasa',$_SESSION['f_bahasa']);
		}
		
		$this->db->from('blog_categories');
		$this->db->where('module_name',$this->nama_modul);
		$total_rows = $this->db->count_all_results();
		$pagination = create_pagination('admin/'.$this->nama_modul.'/categories/search', $total_rows,50,5);
			
		// Using this data, get the relevant results
		if(isset($_SESSION['search'])){
			$this->db->like('title',$_SESSION['search']);
		}
		
		if(isset($_SESSION['f_bahasa'])){
			$this->db->where('bahasa',$_SESSION['f_bahasa']);
		}
		$this->db->where('module_name',$this->nama_modul);
		$categories = $this->event_categories_m->order_by('title')->limit($pagination['limit'])->get_all();
		
		$bahasadb = $this->get_enum_values('default_blog','bahasa');
		 $bahasaArr = array_combine($bahasadb, $bahasadb);
		 
		$this->template
			->title($this->module_details['name'], lang('cat_list_title'))
			->set('bahasadb', $bahasaArr)
			->set('categories', $categories)
			->set('pagination', $pagination)
			->build('admin/categories/index', $this->data);
	}
	
	function get_enum_values( $table, $field )
{
    $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
}
	
	/**
	 * Create method, creates a new category
	 * @access public
	 * @return void
	 */
	public function create()
	{
		$this->load->model('event_m');
		$this->data->folders_tree[0] = array();
		@$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		if(($file_folders)){
			foreach($file_folders as $folder)
			{
				$indent = repeater('&raquo; ', $folder->depth);
				$this->data->folders_tree[$folder->id] = $indent . $folder->title;
			}
		}
		
		// Validate the data
		if ($this->form_validation->run())
		{
			$this->event_categories_m->insert($_POST)
				? $this->session->set_flashdata('success', sprintf( lang('cat_add_success'), $this->input->post('title')) )
				: $this->session->set_flashdata(array('error'=> lang('cat_add_error')));

			redirect('admin/'.$this->nama_modul.'/categories');
		}
		
		// Loop through each validation rule
		foreach($this->validation_rules as $rule)
		{
			@$category->{$rule['field']} = set_value($rule['field']);
		}
		
		// Render the view	
		$this->data->category =& $category;
		$bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa'); 
		$this->template->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))->title($this->module_details['name'], lang('cat_create_title'))
						->set('arrBahasa', $bahasaArr)
						->append_metadata(js('blog_form.js', 'blog'))
						->build('admin/categories/form', $this->data);	
	}
	
	/**
	 * Edit method, edits an existing category
	 * @access public
	 * @param int id The ID of the category to edit 
	 * @return void
	 */
	public function edit($id = 0)
	{
		$this->load->model('event_m');
		$this->data->folders_tree[0] = array();
		
		// Get the category
		$category = $this->event_categories_m->get($id);
		
		$this->db->where('bahasa',$category->bahasa);
		@$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		if(($file_folders)){
			foreach($file_folders as $folder)
			{
				$indent = repeater('&raquo; ', $folder->depth);
				$this->data->folders_tree[$folder->id] = $indent . $folder->title;
			}
		}
		
		// ID specified?
		$category or redirect('admin/'.$this->nama_modul.'/categories/index');
		
		// Validate the results
		if ($this->form_validation->run())
		{		
			$this->event_categories_m->update($id, $_POST)
				? $this->session->set_flashdata('success', sprintf( lang('cat_edit_success'), $this->input->post('title')) )
				: $this->session->set_flashdata(array('error'=> lang('cat_edit_error')));
			
			redirect('admin/'.$this->nama_modul.'/categories/index');
		}
		
		// Loop through each rule
		foreach($this->validation_rules as $rule)
		{
			if($this->input->post($rule['field']) !== FALSE)
			{
				$category->{$rule['field']} = $this->input->post($rule['field']);
			}
		}

		// Render the view
		$this->data->category =& $category;
		$bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa'); 
		$this->template->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))->title($this->module_details['name'], sprintf(lang('cat_edit_title'), $category->title))
						->set('arrBahasa', $bahasaArr)
						->append_metadata(js('blog_form.js', 'blog'))
						->build('admin/categories/form', $this->data);
	}	

	/**
	 * Delete method, deletes an existing category (obvious isn't it?)
	 * @access public
	 * @param int id The ID of the category to edit 
	 * @return void
	 */
	public function delete($id = 0)
	{	
		$id_array = (($id)) ? array($id) : $this->input->post('action_to');
		
		// Delete multiple
		if(($id_array))
		{
			$deleted = 0;
			$to_delete = 0;
			foreach ($id_array as $id) 
			{
				if($this->event_categories_m->delete($id))
				{
					$deleted++;
				}
				else
				{
					$this->session->set_flashdata('error', sprintf($this->lang->line('cat_mass_delete_error'), $id));
				}
				$to_delete++;
			}
			
			if( $deleted > 0 )
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('cat_mass_delete_success'), $deleted, $to_delete));
			}
		}		
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('cat_no_select_error'));
		}
		
		redirect('admin/'.$this->nama_modul.'/categories/index');
	}
		
	/**
	 * Callback method that checks the title of the category
	 * @access public
	 * @param string title The title to check
	 * @return bool
	 */
	public function _check_title($title = '')
	{
		$cektitle = $this->event_categories_m->check_title($title);
		$asli = strtolower(url_title($this->input->post('title_asli')));
	//echo $asli.'=='.$cektitle;
		if (($cektitle))
		{ //echo url_title($this->input->post('title_asli')) .'=='. $cektitle;
			if( $asli == $cektitle){
				echo 'asd';
				return TRUE;
			}else{
				$this->form_validation->set_message('_check_title', sprintf($this->lang->line('cat_already_exist_error'), $title));
			    return FALSE;
			}
			
		}else{
			return TRUE;
		}

		
	}
	
	public function _check_slug($slug = '')
	{
		if ( ! $this->event_m->check_exists('slug', $slug, $this->id))
		{
			$this->form_validation->set_message('_check_slug', sprintf('Category already exist', lang('blog_slug_label')));
			return FALSE;
		}

		return TRUE;
	}
	
	/**
	 * Create method, creates a new category via ajax
	 * @access public
	 * @return void
	 */
	public function create_ajax()
	{
		// Loop through each validation rule
		foreach($this->validation_rules as $rule)
		{
			$category->{$rule['field']} = set_value($rule['field']);
		}
		
		$this->data->method = 'create';
		$this->data->category =& $category;
		
		if ($this->form_validation->run())
		{
			$id = $this->event_categories_m->insert_ajax($_POST);
			
			if($id > 0)
			{
				$message = sprintf( lang('cat_add_success'), $this->input->post('title'));
			}
			else
			{
				$message = lang('cat_add_error');
			}

			return $this->template->build_json(array(
				'message'		=> $message,
				'title'			=> $this->input->post('title'),
				'category_id'	=> $id,
				'status'		=> 'ok'
			));
		}	
		else
		{
			// Render the view
			$form = $this->load->view('admin/categories/form', $this->data, TRUE);

			if ($errors = validation_errors())
			{
				return $this->template->build_json(array(
					'message'	=> $errors,
					'status'	=> 'error',
					'form'		=> $form
				));
			}

			echo $form;
		}
	}
}