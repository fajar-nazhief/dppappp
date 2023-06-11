<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	protected $rules=array(
				array(
				 'field' => 'title',
				 'label' => 'Nama',
				 'rules' => 'required'
				 
				),
				array(
				 'field' => 'txtUrl',
				 'label' => 'Url',
				 'rules' => 'required'
				 
				),
				array(
				 'field' => 'txtUrut',
				 'label' => 'Urutan',
				 'rules' => 'numeric|required'
				 
				)
			       );
	function __construct()
	{
		parent::Admin_Controller();
		$this->load->model('banner_m');
		$this->lang->load('banner');
		$this->load->model('banner_categories_m');
		$this->load->model('banner_client_m');
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
		$catData=$this->banner_categories_m->getCategories();
		if(!empty($catData)){
		foreach($catData as $data => $val){
			$this->data->resCat[$val->id] = $val->title;
		}
		}
		$this->_path = FCPATH  . 'uploads/Banner/';
	}
	
	// Admin: List all banner
	function index()
	{
		 
		// Create pagination links
		$this->data->total_rows = $this->banner_m->countBanner();
		$this->data->pagination = create_pagination('admin/polling/index', $this->data->total_rows,20,4);		
		// Using this data, get the relevant results
		$this->data->banner = $this->banner_m->getBanners(array('limit' => $this->data->pagination['limit']));	
		

		//pagination from search
		if(@$_POST['search']){
		redirect('admin/polling/search/'.$_POST['search']);
		}else{
		$this->template->build('admin/index', $this->data);
		}
		return;
	}
	
	function search()
	{
		// Create pagination links
		$this->data->total_rows = $this->banner_m->countBanner();
		$this->data->pagination = create_pagination('admin/polling/search/'.$this->uri->segment(4), $this->data->total_rows,20,5);		
		// Using this data, get the relevant results
		$this->data->banner = $this->banner_m->getBanners(array('limit' => $this->data->pagination['limit']));	
		
 
		return $this->template->build('admin/index', $this->data);
		 
		 
	}
	
	// Admin: Create a new Category
	function create()
	{
		$this->load->library('form_validation');  
		$this->form_validation->set_rules($this->rules); 
		
		if ($this->form_validation->run())
		{
			if ( ! empty($_FILES['userfile']['name']))
			{
				$this->input->post('txtImg'); $_FILES['userfile']['name'];
				// Setup upload config
				$type='i';
				$allowed =array('i'=>'bmp|gif|jpeg|jpg|jpe|png|tiff|tif');// $this->config->item('files_allowed_file_ext');print_r($allowed);
				$config['upload_path'] = $this->_path;
				$config['allowed_types'] = $allowed['i'];
				
				
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('userfile'))
				{
					$data->messages['notice'] = $this->upload->display_errors();
				}else{
					$img = array('upload_data' => $this->upload->data());
					$dataForm=array(
					'title'	=> $this->input->post('title'), 
					'category_id'=> $this->input->post('txtCat'),
					'link_url'=> $this->input->post('txtUrl'),
					'link_file'=> $img['upload_data']['file_name'],
					'urutan' => $this->input->post('txtUrut'),
					'simpan' => $this->input->post('txtSimpan'),
					'createdby'=> $this->input->post('user'),
					'datecreated'=>date('Y/m/d H:i:s'),
					'slug'	=> url_title(strtolower($this->input->post('title')))
					);
					
					if ($this->banner_m->newBanner($dataForm))
						{
							$this->session->set_flashdata('success', $this->lang->line('cat_edit_success'));
						}		
						else
						{
							$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
						}
				}
			}
			redirect('admin/polling/index');		
		}
		
		 
		 
		$this->template->build('admin/form', $this->data);
	}
	
	function imageSection(){
	$this->data->inputan=$_POST['queryString'];
    return $this->load->view('admin/view_image',$this->data);
	}
	

	// Admin: Edit a Category
	function edit($slug = '')
	{	
		if (!$slug)
		{
			redirect('admin/polling/index');
		}
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules($this->rules); 
		
		if ($this->form_validation->run())
		{
			if ( ! empty($_FILES['userfile']['name']))
			{
				$this->input->post('txtImg'); $_FILES['userfile']['name'];
				// Setup upload config
				$type='i';
				$allowed =array('i'=>'bmp|gif|jpeg|jpg|jpe|png|tiff|tif');// $this->config->item('files_allowed_file_ext');print_r($allowed);
				$config['upload_path'] = $this->_path;
				$config['allowed_types'] = $allowed['i'];
				
				
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('userfile'))
				{
					$data->messages['notice'] = $this->upload->display_errors();
				}else{
					$img = array('upload_data' => $this->upload->data());
					$dataForm=array(
					'title'	=> $this->input->post('title'), 
					'category_id'=> $this->input->post('txtCat'),
					'link_url'=> $this->input->post('txtUrl'),
					'link_file'=> $img['upload_data']['file_name'],
					'updateby' => $this->input->post('user'),
					'dateupdates'=>date('Y/m/d H:i:s'),
					'urutan' => $this->input->post('txtUrut'),
					'simpan' => $this->input->post('txtSimpan'),
					'slug'	=> url_title(strtolower($this->input->post('title')))
					);
					
					if ($this->banner_m->updateBanner($dataForm, $slug))
						{
							$this->session->set_flashdata('success', $this->lang->line('cat_edit_success'));
						}		
						else
						{
							$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
						}
				}
			} else{
				if($this->input->post('txtImg') <> ''){
					$dataForm=array(
					'title'	=> $this->input->post('title'), 
					'category_id'=> $this->input->post('txtCat'),
					'link_url'=> $this->input->post('txtUrl'), 
					'urutan' => $this->input->post('txtUrut'), 
					'updateby' => $this->input->post('user'),
					'dateupdates'=>date('Y/m/d H:i:s'),
					'simpan' => $this->input->post('txtSimpan'),
					'slug'	=> url_title(strtolower($this->input->post('title')))
					);
					if ($this->banner_m->updateBanner($dataForm, $slug))
						{
							$this->session->set_flashdata('success', $this->lang->line('cat_edit_success'));
						}		
						else
						{
							$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
						}
				}
			}
			//exit;
			redirect('admin/polling/index');
			
		} 
		
		$this->data->category = $this->banner_m->getBanner($slug);		 
		$this->template->build('admin/form', $this->data);
	}	

	function translate($slug = '')
	{	
		if (!$slug)
		{
			redirect('admin/polling/index');
		}
		$this->load->library('form_validation');
		$this->load->library('frontpage');
		$rules['title_en'] = 'trim|required'; 
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_fields();
		
		if ($this->form_validation->run())
		{		
			if ($this->banner_m->updateBanner_en($_POST, $slug))
			{
				$this->session->set_flashdata('success', $this->lang->line('cat_translate_success'));
			}		
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('cat_translate_error'));
			}
			redirect('admin/polling/index');
		}
		
		$this->data->category = $this->banner_m->getBanner($slug);		
		foreach(array_keys($rules) as $field)
		{
			if(isset($_POST[$field])) $this->data->category->$field = $this->form_validation->$field;
		}
		 
		$this->data->category->directory=$this->frontpage->ListDir('./application/public/img/Banner');
		$this->data->category->banner_category=$this->banner_categories_m->listSection();
		$this->data->category->client=$this->banner_client_m->listSection();
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
				if($this->banner_m->deleteBanner($slug))
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
		redirect('admin/polling/index');
	}	
	
	// Callback: from create()
	function _check_title($title = '')
	{
		if ($this->banner_m->checkTitle($title))
		{
			$this->form_validation->set_message('_check_title', sprintf($this->lang->line('cat_already_exist_error'), $title));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function voting(){
		 
		if($this->input->post('vote') <> ''){
					
					 $this->load->model('poll_m');
					if ($this->poll_m->insert_poll_admin($_POST))
						{
							$this->session->set_flashdata('success', 'Polling telah ditambah');
						}		
						else
						{
							$this->session->set_flashdata('error', $this->lang->line('cat_edit_error'));
						}
				}
				
				redirect('admin/polling/index');
	}
}
?>