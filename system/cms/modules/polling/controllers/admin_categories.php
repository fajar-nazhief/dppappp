<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_categories extends Admin_Controller
{
	protected $rules=array(
			       array(
				 'field' => 'title',
				 'label' => 'Nama',
				 'rules' => 'required'
				 
				),
			        array(
				 'field' => 'polling_name',
				 'label' => 'Nama Polling',
				 'rules' => 'required'
				 
				),
				 array(
				 'field' => 'header_polling',
				 'label' => 'Header Polling',
				 'rules' => 'required'
				 
				)
			       );
	function __construct()
	{
		parent::Admin_Controller();
		$this->load->model('banner_categories_m');
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}
	
	// Admin: List all banner_categories
	function index()
	{
		// Create pagination links
		$total_rows = $this->banner_categories_m->countCategories();
		$this->data->pagination = create_pagination('admin/banner_categories/index', $total_rows);		
		// Using this data, get the relevant results
		$this->data->banner_categories = $this->banner_categories_m->getCategories(array('limit' => $this->data->pagination['limit']));	
		

		//pagination from search
		if(@$_POST['search']){
		redirect('admin/banner_categories/index/0/'.$_POST['search']);
		}else{
		$this->template->build('admin/banner_categories/index', $this->data);
		}
		return;
	}
	
	// Admin: Create a new Category
	function create()
	{
		$this->load->library('form_validation');  
		$this->form_validation->set_rules($this->rules); 
		
		if ($this->form_validation->run())
		{
			if (  $this->banner_categories_m->newCategory($_POST) )
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_add_success'));
			}			
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_add_error'));
			}
			redirect('admin/polling/categories');		
		}
		
		 
		 
		$this->template->build('admin/banner_categories/form', $this->data);
	}
	
	// Admin: Edit a Category
	function edit($slug = '')
	{	
		if (!$slug)
		{
			redirect('admin/polling/categories');
		}
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules($this->rules); 
		
		if ($this->form_validation->run())
		{		
			if ($this->banner_categories_m->updateCategory($_POST, $slug))
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_edit_success'));
			}		
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
			}
			redirect('admin/polling/categories');
		}		
		$this->data->category = $this->banner_categories_m->getCategory($slug);		
		 
		  
		$this->template->build('admin/banner_categories/form', $this->data);
	}	

	function translate($slug = '')
	{	
		if (!$slug)
		{
			redirect('admin/banner_categories/index');
		}
		$this->load->library('form_validation');
		$rules['title_en'] = 'trim|required'; 

		$this->form_validation->set_rules($rules);
		$this->form_validation->set_fields();
		
		if ($this->form_validation->run())
		{		
			if ($this->banner_categories_m->updateCategory_en($_POST, $slug))
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_translate_success'));
			}		
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_translate_error'));
			}
			redirect('admin/banner_categories/index');
		}		
		$this->data->category = $this->banner_categories_m->getCategory($slug);		
		foreach(array_keys($rules) as $field)
		{
			if(isset($_POST[$field])) $this->data->category->$field = $this->form_validation->$field;
		}
		  
		$this->template->build('admin/form', $this->data);
	}	
	
	// Admin: Delete a Category
	function delete($slug = '')
	{	
		$slug_array = (!empty($slug)) ? array($slug) : $this->input->post('delete');
		
		// Delete multiple
		if(!empty($slug_array))
		{
			$deleted = 0;
			$to_delete = 0;
			foreach ($slug_array as $slug) 
			{
				if($this->banner_categories_m->deleteCategory($slug))
				{
					$deleted++;
				}
				else
				{
					$this->session->set_flashdata('error', sprintf($this->lang->line('cat_mass_delete_error'), $slug));
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
		redirect('admin/banner_categories/index');
	}	
	
	// Callback: from create()
	function _check_title($title = '')
	{
		if ($this->banner_categories_m->checkTitle($title))
		{
			$this->form_validation->set_message('_check_title', sprintf($this->lang->line('cat_already_exist_error'), $title));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>