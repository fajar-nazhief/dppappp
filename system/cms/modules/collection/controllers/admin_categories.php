<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
		$this->load->model('collection_categories_m');
		$this->load->models(array('files/file_m', 'files/file_folders_m'));
		$this->lang->load('categories');
		$this->load->model('navigation/navigation_m');
		$this->lang->load('collection');
		
	    $this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	
		// Set the validation rules
		$this->validation_rules = array(
			array(
				'field' => 'title',
				'label' => lang('categories.title_label'),
				'rules' => 'trim|required'
			),array(
				'field' => 'slug',
				'label' => 'Slug',
				'rules' => 'trim|required|callback__group_check'
			),array(
				'field' => 'position',
				'label' => 'Posisi Urutan',
				'rules' => 'trim'
			),array(
				'field' => 'uri',
				'label' => 'URL',
				'rules' => 'trim'
			),array(
				'field' => 'show',
				'label' => 'Show',
				'rules' => 'trim'
			),array(
				'field' => 'banner',
				'label' => 'banner',
				'rules' => 'trim'
			)
		);
		
		// Load the validation library along with the rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->validation_rules);
		
		$all_modules				= $this->module_m->get_all(array('is_frontend'=>true));

		//only allow modules that user has permissions for
		foreach($all_modules as $module)
		{
			if(in_array($module['slug'], $this->permissions) OR $this->user->group == 'admin') $modules[] = $module;
		}
		
		$this->data->modules_select = array_for_select($modules, 'slug', 'name');
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
		$total_rows = $this->collection_categories_m->count_all();
		$pagination = create_pagination('admin/collection/categories/index', $total_rows,20,5);
			
		// Using this data, get the relevant results
		$categories = $this->collection_categories_m->limit($pagination['limit'])->get_all();
		
		if(!empty($_POST['search'])){
			redirect('admin/collection/categories/search/'.$_POST['search']);
		}
		$this->template
			->title($this->module_details['name'], lang('cat_list_title'))
			->set('categories', $categories)
			->set('pagination', $pagination)
			->build('admin/categories/index', $this->data);
	}
	
	public function search()
	{
		$this->pyrocache->delete_all('modules_m');
		// Create pagination links
		$total_rows = $this->collection_categories_m->count_data();
		$pagination = create_pagination('admin/collection/categories/search/'.$this->uri->segment(5), $total_rows,10,6);
			
		// Using this data, get the relevant results
		$terkait=$this->collection_categories_m->get_terkait();
		foreach($terkait as $data_terkait => $val_terkait){
			$cat_id=$val_terkait->idc;
			$this->data->terkait[$cat_id]=$val_terkait->jml;
		}
		
		$categories = $this->collection_categories_m->get_all($pagination['limit']);

		$this->template
			->title($this->module_details['name'], lang('cat_list_title'))
			->set('categories', $categories)
			->set('pagination', $pagination)
			->build('admin/categories/index', $this->data);
	}
	
	/**
	 * Create method, creates a new category
	 * @access public
	 * @return void
	 */
	public function create()
	{
		$file_folders = $this->collection_categories_m->get_folders();
		$folders_tree = array();
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		
		// Validate the data
		if ($this->form_validation->run())
		{
			$img='';
			 
			$this->collection_categories_m->insert($_POST)
				? $this->session->set_flashdata('success', sprintf( lang('cat_add_success'), $this->input->post('title')) )
				: $this->session->set_flashdata(array('error'=> lang('cat_add_error')));
				
				
			redirect('admin/collection/categories');
		}
		
		// Loop through each validation rule
		foreach($this->validation_rules as $rule)
		{
			$category->{$rule['field']} = set_value($rule['field']);
		}
		
		// Render the view
		$this->data->navigation_tree = $this->navigation_m->get_links();
		$this->data->category =& $category;	
		$this->template->title($this->module_details['name'], lang('cat_create_title'))
		->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
			->append_metadata( js('collection_form.js', 'collection') )
						->build('admin/categories/form', $this->data);	
	}
	
	function buat_folder(){
		 
		
		$get_id=$this->file_folders_m->get_where('file_folders',array('slug'=>$this->uri->segment(5),'parent_id'=>'1'))->row();
		if(!empty($get_id)){
			
			$data = array(
			        
			       'folder_id' => $this->uri->segment(5)
			    );

			$this->db->where('slug', $this->uri->segment(5));
			$this->db->update('collection_categories', $data); 
		}else{
			$this->file_folders_m->insert(array(
					'name'			=> $this->uri->segment(5),
					'slug'=>$this->uri->segment(5),
					'parent_id'		=> 1,
					'date_added'	=> now()
				));
			
			$data = array(
			        
			       'folder_id' => $this->uri->segment(5)
			    );

			$this->db->where('slug', $this->uri->segment(5));
			$this->db->update('collection_categories', $data); 
		}
		 redirect('admin/files#!path=artikel/'.$this->uri->segment(5).'&filter=');
	}
	/**
	 * Edit method, edits an existing category
	 * @access public
	 * @param int id The ID of the category to edit 
	 * @return void
	 */
	public function edit($id = 0)
	{	
		// Get the category
		$file_folders = $this->collection_categories_m->get_folders();
		$folders_tree = array();
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		$category = $this->collection_categories_m->get($id);
		
		// ID specified?
		$category or redirect('admin/collection/categories/index');
		//$category->title ."!=". url_title(strtolower(trim($this->input->post('slug'))));
		if (strtolower(trim($category->slug)) != url_title(strtolower(trim($this->input->post('slug')))))
		{
			$this->validation_rules[1]['rules'] .= '|callback__group_check';
		}else{
			$this->validation_rules[1]['rules'] = '|trim';
		}
		
		$this->form_validation->set_rules($this->validation_rules);
		// Validate the results
		if ($this->form_validation->run())
		{		
			$this->collection_categories_m->update($id, $_POST)
				? $this->session->set_flashdata('success', sprintf( lang('cat_edit_success'), $this->input->post('title')) )
				: $this->session->set_flashdata(array('error'=> lang('cat_edit_error')));
			
			redirect('admin/collection/categories/index');
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
		$this->data->navigation_tree = $this->navigation_m->get_links();
		$this->data->category =& $category;
		$this->template->title($this->module_details['name'], sprintf(lang('cat_edit_title'), $category->title))
		->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
			->append_metadata( js('collection_form.js', 'collection') )
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
		$id_array = (!empty($id)) ? array($id) : $this->input->post('action_to');
		
		// Delete multiple
		if(!empty($id_array))
		{
			$deleted = 0;
			$to_delete = 0;
			foreach ($id_array as $id) 
			{
				if($this->collection_categories_m->delete($id))
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
		
		redirect('admin/collection/categories/index');
	}
		
	/**
	 * Callback method that checks the title of the category
	 * @access public
	 * @param string title The title to check
	 * @return bool
	 */
	public function _check_title($title = '')
	{
		if ($this->collection_categories_m->check_title($title))
		{
			$this->form_validation->set_message('_check_title', sprintf($this->lang->line('cat_already_exist_error'), $title));
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
			$id = $this->collection_categories_m->insert_ajax($_POST);
			
			if($id > 0)
			{
				$message = sprintf( lang('cat_add_success'), $this->input->post('title'));
			}
			else
			{
				$message = lang('cat_add_error');
			}
			
			$json = array('message' => $message,
					'title' => $this->input->post('title'),
					'category_id' => $id,
					'status' => 'ok'
					);
			echo json_encode($json);
		}	
		else
		{		
			// Render the view
			$errors = validation_errors();
			$form = $this->load->view('admin/categories/form', $this->data, TRUE);
			if(empty($errors))
			{
				
				echo $form;
			}
			else
			{
				$json = array('message' => $errors,
					      'status' => 'error',
					      'form' => $form
					     );
				echo json_encode($json);
			}
		}
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
	
	public function _group_check($group)
	{
		$group=url_title(strtolower($group));
		if ( ! $this->collection_categories_m->check_title($group))
		{
			$this->form_validation->set_message('_group_check', 'Judul sudah ada,Judul Tidak boleh sama');
			return FALSE;
		}
		return TRUE;
	}
}