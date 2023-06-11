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
		$this->load->model('categories_m');
		$this->db->set_dbprefix('tbl_');
		$this->config->load('app');
		$this->MNAME = $this->config->item('mname');
		
	    $this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	
		// Set the validation rules
		$this->validation_rules = array(
			 array(
				'field' => 'gall_cat_title',
				'label' => 'Judul',
				'rules' => 'trim|required'
			) ,array(
				'field' => 'gall_cat_desc',
				'label' => 'Judul',
				'rules' => 'trim'
			) 
		);
		
		// Load the validation library along with the rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->validation_rules);
	//	$this->_path = '../srv-5/images/gallery/' ;
	 
	    $this->_path =  realpath("."). '/uploads/potret-wilayah' ;
		 
		$this->load->library('upload', array(
			'upload_path'	=> $this->_path,
			'allowed_types'	=> 'bmp|gif|jpeg|jpg|jpe|png|pdf',
			'file_name'		=> $this->_filename
		));

		$this->template
         ->set_theme('admin_gue');
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
		if($this->input->post('search')){ 
			$this->db->like('gall_cat_title',$this->input->post('search'));
		} 
		
		$this->db->from('gall_cat'); 
		$total_rows = $this->db->count_all_results();
		$pagination = create_pagination('admin/'.$this->MNAME.'/categories/index', $total_rows,50,5);
			
		// Using this data, get the relevant results
		if($this->input->post('search')){
			$this->categories_m->like('gall_cat_title',$this->input->post('search'));
		} 
		$categories = $this->categories_m->order_by('gall_cat_id','DESC')->limit($pagination['limit'])->get_all();

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
		 
		
		// Validate the data
		if ($this->form_validation->run())
		{
			if ( !$this->upload->do_upload('userfile'))
			{
				$status		= 'error';
				$message	= $this->upload->display_errors();


			}else{

				$file = $this->upload->data();
				$image_data=$file;
				chmod($image_data['full_path'], 0755);
				$config2['image_library'] = 'GD2';
				$config2['source_image'] = $image_data['full_path'];
				$config2['new_image'] = $this->_path ;
				$config2['create_thumb'] = FALSE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 250;
				$config2['height'] = 250;
				$this->load->library('image_lib', $config2);

				$this->image_lib->resize();
		// They are trying to put this live
		 
		$post_data = array(
		'gall_cat_title'=> $this->input->post('gall_cat_title'),
		'gall_cat_desc'=> $this->input->post('gall_cat_desc'),
		'gall_cat_cover'=> $file['file_name'],
		'created_on'=> now(),
		'createdby'=> $this->user->id,
	);
		 
		 
		   $this->db->insert('gall_cat', $post_data);
			$id = $this->db->insert_id();

		if ($id)
		{
			$this->pyrocache->delete_all('my_m');
			$this->session->set_flashdata('success', sprintf($this->lang->line('blog_post_add_success'), $this->input->post('title')));
		}
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('blog_post_add_error'));
		}
	}

			redirect('admin/'.$this->MNAME.'/categories');
		}
		
		// Loop through each validation rule
		foreach($this->validation_rules as $rule)
		{
			@$category->{$rule['field']} = set_value($rule['field']);
		}
		
		// Render the view	
		$this->data->category =& $category;	
		$this->template->title($this->module_details['name'], lang('cat_create_title'))
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
	  
		// Get the category
		$this->db->where('gall_cat_id',$id);
		$category = $this->db->get('gall_cat')->row();
		
		// ID specified?
		$category or redirect('admin/'.$this->MNAME.'/categories/index');
		
		// Validate the results
		if ($this->form_validation->run())
		{		
			if ( !$this->upload->do_upload('userfile'))
			{
				$status		= 'error';
				 $message	= $this->upload->display_errors();
			
				if($message == '<p>You did not select a file to upload.</p>'){
					 $nofile=true;
					$post_data = array('gall_cat_title'=> $this->input->post('gall_cat_title'),
								'gall_cat_desc'=> $this->input->post('gall_cat_desc') ,
								'created_on'=> now(),
								'createdby'=> $this->user->id,
							);
								
								$this->db->where('gall_cat_id',$id);
								$this->db->update('gall_cat', $post_data);
				}
				 

			}else{

				$file = $this->upload->data();
				$image_data=$file;
				chmod($image_data['full_path'], 0755);
				$config2['image_library'] = 'GD2';
				$config2['source_image'] = $image_data['full_path'];
				$config2['new_image'] = $this->_path ;
				$config2['create_thumb'] = FALSE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 250;
				$config2['height'] = 250;
				$this->load->library('image_lib', $config2);

				$this->image_lib->resize();
		// They are trying to put this live
		 
		$post_data = array( 
			'gall_cat_title'=> $this->input->post('gall_cat_title'),
								'gall_cat_desc'=> $this->input->post('gall_cat_desc') ,
		'gall_cat_cover'=> $file['file_name'] ,
		'created_on'=> now(),
		'createdby'=> $this->user->id,
	);

				$this->db->where('gall_cat_id',$id);
				$resul = $this->db->update('gall_cat', $post_data);
				 
				if ($result)
		{
			$this->session->set_flashdata(array('success' => sprintf($this->lang->line('blog_edit_success'), $this->input->post('title'))));

		}
		
		else
		{
			$this->session->set_flashdata(array('error' => $this->lang->line('blog_edit_error')));
		}

			}
			redirect('admin/'.$this->MNAME.'/categories/index');
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
		$this->template->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))->title($this->module_details['name'], sprintf(lang('cat_edit_title'), $category->title))
						->build('admin/categories/form', $this->data);
	}	

	/**
	 * Delete method, deletes an existing category (obvious isn't it?)
	 * @access public
	 * @param int id The ID of the category to edit 
	 * @return void
	 */

	function _check_ext()
	{
		if ( ! empty($_FILES['userfile']['name']))
		{
			$ext		= pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
			$allowed	= $this->config->item('files_allowed_file_ext');

			foreach ($allowed as $type => $ext_arr)
			{				
				if (in_array(strtolower($ext), $ext_arr))
				{
					$this->_type		= $type;
					$this->_ext			= implode('|', $ext_arr);
					$this->_filename	= trim(url_title($_FILES['userfile']['name'], 'dash', TRUE), '-');

					break;
				}
			}

			if ( ! $this->_ext)
			{
				$this->form_validation->set_message('_check_ext', lang('files.invalid_extension'));
				return FALSE;
			}
		}		
		elseif ($this->method === 'upload')
		{
			$this->form_validation->set_message('_check_ext', lang('files.upload_error'));
			return FALSE;
		}

		return TRUE;
	}
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
				if($this->db->where('gall_cat_id',$id)->delete('gall_cat'))
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
		
		redirect('admin/'.$this->MNAME.'/categories/index');
	}
		
	/**
	 * Callback method that checks the title of the category
	 * @access public
	 * @param string title The title to check
	 * @return bool
	 */
	public function _check_title($title = '')
	{
		$cektitle = $this->categories_m->check_title($title);
		$asli = strtolower(url_title($this->input->post('title_asli')));
	//echo $asli.'=='.$cektitle;
		if (!empty($cektitle))
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
			$id = $this->categories_m->insert_ajax($_POST);
			
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