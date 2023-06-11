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
	
	private $_path 		= '';
	private $_type 		= NULL;
	private $_ext 		= NULL;
	private $_filename	= NULL;
	protected $validation_rules = 
	array(    array(
		'field' => 'category_id',
		'label' => 'category id',
		'rules' => 'trim|required'
	),  array(
		'field' => 'media_id',
		'label' => 'media id',
		'rules' => 'trim|required'
	),  array(
		'field' => 'date',
		'label' => 'date',
		'rules' => 'trim|required'
	),  array(
		'field' => 'title',
		'label' => 'title',
		'rules' => 'trim|required|callback__check_title'
	),  array(
		'field' => 'desc',
		'label' => 'desc',
		'rules' => 'trim|required'
	));	

	/**
	 * The constructor
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		
		parent::Admin_Controller();
		$this->config->load('files');
		$this->db->set_dbprefix('tbl_');
		$this->load->model('my_m');
		$this->load->model('categories_m');
		$this->config->load('app');
		//$this->lang->load('my_lang');
	 
		$this->lang->load('categories');
		$this->MNAME =  $this->config->item('mname');

		// Date ranges for select boxes
		@$this->data->hours = array_combine($hours = range(0, 23), $hours);
		$this->data->minutes = array_combine($minutes = range(0, 59), $minutes);

		$this->data->categories = array();
		if ($categories = $this->categories_m->order_by('category_name')->get_all())
		{
			foreach ($categories as $category)
			{
				$this->data->categories[$category->id] = @$category->title;
			}
		}
		$this->_path = '../dppapp/kliping_source' ;
	 
		$this->load->library('upload', array(
			'upload_path'	=> $this->_path,
			'allowed_types'	=> 'bmp|gif|jpeg|jpg|jpe|png|pdf',
			'file_name'		=> $this->_filename
		));


		$this->template
         ->set_theme('admin_gue') 
			->set_partial('shortcuts', 'admin/partials/shortcuts');
	}

	/**
	 * Show all created blog posts
	 * @access public
	 * @return void
	 */
	
	 public function del_image(){
		$id = $this->uri->segment(4);
		$img_name = $this->uri->segment(5);
	 
         
		$this->db->where('id',$id);
		$data_image = $this->db->get('tbl_kliping')->row();
		$arr_img = json_decode($data_image->source_array);
		 
		foreach($arr_img as $val){
			if($img_name <> $val->name){ 
				$arr[]['name']=$val->name;
			}
		}
			$data = json_encode($arr);
			$dataset = array('source_array'=>$data);
			$this->db->where('id',$id);
			$this->db->update('kliping',$dataset);

			unlink($_SERVER['DOCUMENT_ROOT'].'/srv-5/kliping_source/'.$img_name);
			 
			 

			redirect('admin/kliping/edit/'.$id);
	 }
	 
	public function index()
	{
		
		
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all'); 
			 
		$file_folders = $this->db->get('kliping_category')->result_array();
		 
		
			unset($_SESSION['f_category_v']);
			unset($_SESSION['f_status_v']); 
			unset($_SESSION['f_keywords_v']); 
		$this->data->folders_tree = array(''=>'---PILIH---');
		if($file_folders){
			foreach($file_folders as $folder)
		{
			@$indent = repeater('&raquo; ', $folder->depth);
			@$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		}
		//add post values to base_where if f_module is posted
		$base_where = $this->input->post('f_category') ? $base_where + array('category' => $this->input->post('f_category')) : $base_where;

		$base_where['status'] = $this->input->post('f_status') ? $this->input->post('f_status') : $base_where['status'];

		$base_where = $this->input->post('f_keywords') ? $base_where + array('keywords' => $this->input->post('f_keywords')) : $base_where;

		// Create pagination links
		$total_rows = $this->my_m->count_by($base_where);
		$pagination = create_pagination_endless('admin/'.$this->MNAME.'/index', $total_rows,20,4);

		// Using this data, get the relevant results
		$blog = $this->my_m->limit($pagination['limit'])->get_many_by($base_where);

		foreach ($blog as &$post)
		{
			$post->author = firstname($post->createdby);
		}

		//do we need to unset the layout because the request is ajax?
		$this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';

		$this->template
				->title($this->module_details['name'])
				->set_partial('filters', 'admin/partials/filters')
				->append_metadata(js('admin/filter.js'))
				->set('pagination', $pagination)
				->set('blog', $blog)
                ->set('total',$total_rows)
				->build('admin/index', $this->data);
	}
	
	public function search()
	{
		$file_folders = $this->categories_m->get_folders();
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
		}
		 
		$base_where = $_SESSION['f_category'] ? $base_where + array('category' => $_SESSION['f_category']) : $base_where;

		$base_where['status'] = $_SESSION['f_status'] ? $_SESSION['f_status'] : $base_where['status'];

		$base_where = $_SESSION['f_keywords'] ? $base_where + array('keywords' => $_SESSION['f_keywords']) : $base_where;

		// Create pagination links
		$total_rows = $this->my_m->count_search($base_where);
		$pagination = create_pagination_endless('admin/'.$this->MNAME.'/search', $total_rows,20,4);

		// Using this data, get the relevant results
		$blog = $this->my_m->limit($pagination['limit'])->search($base_where);

		foreach ($blog as &$post)
		{
			$post->author = $this->ion_auth->get_user($post->createdby);
		}

		//do we need to unset the layout because the request is ajax?
		$this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';

		$this->template
				->title($this->module_details['name'])
				->set_partial('filters', 'admin/partials/filters')
				->append_metadata(js('admin/filter.js'))
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
	public function create()
	{ 
		$this->load->library('form_validation');
//print_r($_POST);
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

			if($_FILES['userfile']['name'][0]){
			 
				$filecount=count($_FILES['userfile']['name']);
				
				
			   for($i=0; $i<$filecount; $i++){
				   $_FILES['mediaelement']['name']=$_FILES['userfile']['name'][$i];
				   $_FILES['mediaelement']['type']=$_FILES['userfile']['type'][$i];
				   $_FILES['mediaelement']['tmp_name']=$_FILES['userfile']['tmp_name'][$i];
				   $_FILES['mediaelement']['error']=$_FILES['userfile']['error'][$i];
				   $_FILES['mediaelement']['size']=$_FILES['userfile']['size'][$i];
 
				
				   $imageuploaderres[]=$this->upload->do_upload('mediaelement');
				   $file = $this->upload->data();
				   $image_data=$file;
				   chmod($image_data['full_path'], 777);
				   $config2['image_library'] = 'GD2';
				   $config2['source_image'] = $image_data['full_path'];
				   $config2['new_image'] = $this->_path .'thumb/';
				   $config2['create_thumb'] = TRUE;
				   $config2['maintain_ratio'] = TRUE;
				   $config2['width'] = 250;
				   $config2['height'] = 250;
				   $this->load->library('image_lib', $config2);

				   $this->image_lib->resize();
				   $ff[$i]['name']=$file['file_name']; 
			   }
				
	   $arr_img = json_decode($post->source_array);
		if($post->source_array){
	   foreach($arr_img as $val){
		   ++$i;
			  
			   $ff[$i]['name']=$val->name;
		   
	   }}
			   $post_data = array('category_id'=> $this->input->post('category_id'),
						   'media_id'=> $this->input->post('media_id'),
						   'date'=> $this->input->post('date'),
						   'title'=> $this->input->post('title'),
						   'desc'=> $this->input->post('desc'),
						   'source'=> 'array', 
						   'source_array'=> json_encode($ff), 
						   'img_thumb'=> $this->input->post('img_thumb'),
						   'created_on'=> now(),
						   'createdby'=> $this->user->id,
					   );
 
								   $result = $this->db->insert($this->MNAME, $post_data);

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
					   
								   // Redirect back to the form or main page
								   $this->input->post('btnAction') == 'save_exit' ? redirect('admin/'.$this->MNAME) : redirect('admin/'.$this->MNAME.'/edit/' . $id);
		   }else{
		   }
			
			 
			
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

		$this->template
				->title($this->module_details['name'], lang('blog_create_title'))
				->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
				->append_metadata(js('blog_form.js', 'blog'))
				->set('post', $post)
				->build('admin/form', $this->data);
	}

	/**
	 * Edit blog post
	 * @access public
	 * @param int $id the ID of the blog post to edit
	 * @return void
	 */
	public function edit($id = 0)
	{
		$id OR redirect('admin/'.$this->MNAME);

		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->validation_rules);

		$post = $this->my_m->get($id);
		$post->author = firstname($post->createdby);

		// If we have a useful date, use it
	 
		
		$this->id = $post->id;
		
		if ($this->form_validation->run())
		{
			// They are trying to put this live
			
			
			if($_FILES['userfile']['name'][0]){
			 
				 $filecount=count($_FILES['userfile']['name']);
				 
				 
				for($i=0; $i<$filecount; $i++){
					$_FILES['mediaelement']['name']=$_FILES['userfile']['name'][$i];
					$_FILES['mediaelement']['type']=$_FILES['userfile']['type'][$i];
					$_FILES['mediaelement']['tmp_name']=$_FILES['userfile']['tmp_name'][$i];
					$_FILES['mediaelement']['error']=$_FILES['userfile']['error'][$i];
					$_FILES['mediaelement']['size']=$_FILES['userfile']['size'][$i];
  
				 
					$imageuploaderres[]=$this->upload->do_upload('mediaelement');
					$file = $this->upload->data();
					$image_data=$file;
					chmod($image_data['full_path'], 777);
					$config2['image_library'] = 'GD2';
					$config2['source_image'] = $image_data['full_path'];
					$config2['new_image'] = $this->_path .'thumb/';
					$config2['create_thumb'] = TRUE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 250;
					$config2['height'] = 250;
					$this->load->library('image_lib', $config2);

					$this->image_lib->resize();
					$ff[$i]['name']=$file['file_name']; 
				}
				 
		$arr_img = json_decode($post->source_array);
		 if($post->source_array){
		foreach($arr_img as $val){
			++$i;
			   
				$ff[$i]['name']=$val->name;
			
		}}
				$post_data = array('category_id'=> $this->input->post('category_id'),
							'media_id'=> $this->input->post('media_id'),
							'date'=> $this->input->post('date'),
							'title'=> $this->input->post('title'),
							'desc'=> $this->input->post('desc'),
							'source'=> 'array', 
							'source_array'=> json_encode($ff), 
							'img_thumb'=> $this->input->post('img_thumb'),
							'created_on'=> now(),
							'createdby'=> $this->user->id,
						);

									$this->db->where('id',$id);
									$resul = $this->db->update($this->MNAME, $post_data);

									if ($result)
							{
								$this->session->set_flashdata(array('success' => sprintf($this->lang->line('blog_edit_success'), $this->input->post('title'))));
				
							}
							
							else
							{
								$this->session->set_flashdata(array('error' => $this->lang->line('blog_edit_error')));
							}
			}else{

				$post_data = array('category_id'=> $this->input->post('category_id'),
									'media_id'=> $this->input->post('media_id'),
									'date'=> $this->input->post('date'),
									'title'=> $this->input->post('title'),
									'desc'=> $this->input->post('desc'),  
									'created_on'=> now(),
									'createdby'=> $this->user->id,
								);
									
									$this->db->where('id',$id);
									$this->db->update($this->MNAME, $post_data);

			}

			//sini
		
			 
			 

			 
			
			

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/'.$this->MNAME) : redirect('admin/'.$this->MNAME.'/edit/' . $id);
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
		
		// Load WYSIWYG editor
		$this->template
				->title($this->module_details['name'], sprintf(lang('blog_edit_title'), $post->title))
				->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
				->append_metadata(js('blog_form.js', 'blog'))
				->set('post', $post)
				->set('path',$this->_path)
				->build('admin/form', $this->data);
	}

	/**
	 * Preview blog post
	 * @access public
	 * @param int $id the ID of the blog post to preview
	 * @return void
	 */
	public function preview($id = 0)
	{
		 $this->db->where('id',$id);
		 $this->data->post = $this->db->get($this->MNAME)->row();
		 
	 //echo $field;
	 $this->load->view('admin/preview',$this->data);
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
				redirect('admin/'.$this->MNAME);
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
				if ($post = $this->my_m->get($id))
				{
					$this->my_m->publish($id);

					// Wipe cache for this model, the content has changed
					$this->pyrocache->delete('my_m');
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
				$this->session->set_flashdata('success', sprintf($this->lang->line('my_mass_publish_success'), implode('", "', $post_titles)));
			}
		}
		// For some reason, none of them were published
		else
		{
			$this->session->set_flashdata('notice', $this->lang->line('blog_publish_error'));
		}

		redirect('admin/'.$this->MNAME);
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
				if ($post = $this->my_m->get($id))
				{
					$this->my_m->delete($id);

					// Wipe cache for this model, the content has changed
					$this->pyrocache->delete('my_m');
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
				$this->session->set_flashdata('success', sprintf($this->lang->line('my_mass_delete_success'), implode('", "', $post_titles)));
			}
		}
		// For some reason, none of them were deleted
		else
		{
			$this->session->set_flashdata('notice', lang('blog_delete_error'));
		}

		redirect('admin/'.$this->MNAME);
	}

	/**
	 * Callback method that checks the title of an post
	 * @access public
	 * @param string title The Title to check
	 * @return bool
	 */
	public function _check_title($title = '')
	{
		$this->db->set_dbprefix('tbl_');
		if ( ! $this->my_m->check_exists('title', $title, $this->id))
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
		if ( ! $this->my_m->check_exists('slug', $slug, $this->id))
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
		$results = $this->my_m->search($post_data);

		//set the layout to false and load the view
		$this->template
				->set_layout(FALSE)
				->set('blog', $results)
				->build('admin/index');
	}

	function _check_ext()
	{
		if ( ($_FILES['userfile']['name']))
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

	function pdf(){ 

		 
 

		$this->load->library('Pdf');
		$this->load->view('view_pdf');

  
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information 

// set default header data

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
 

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();
$pdf->Cell(0, 0, 'Laporan Kegiatan', 0, 0, 'C');
$pdf->Ln(); 
$pdf->Cell(0, 0, 'Kliping Media', 0, 0, 'C');
 

$pdf->Write(0, ' ', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln();
$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------
$this->db->set_dbprefix('');
		$this->db->select('tbl_kliping.*,default_profiles.first_name, tbl_kliping_category.category_name');
		$this->db->join('tbl_kliping_category', 'tbl_kliping.category_id = tbl_kliping_category.id', 'left');
		$this->db->join('default_profiles', 'tbl_kliping.createdby = default_profiles.user_id', 'left'); 
		$this->db->where('tbl_kliping.createdby',$this->input->post('user'));
		$this->db->where('MONTH(FROM_UNIXTIME(tbl_kliping.created_on))',$this->input->post('bulan'));
		$this->db->where('YEAR(FROM_UNIXTIME(tbl_kliping.created_on))',$this->input->post('tahun'));
		
		//$this->db->where('nama_modul',$this->nama_modul);
	 $res = $this->db->get('tbl_kliping')->result(); 
	$bulan = bulan($this->input->post('bulan'));
$tbl = 'Bulan : '.$bulan.', '.$this->input->post('tahun').'<p>
<table cellspacing="0" cellpadding="1" border="1">
<tr>
        <td style="text-align:center;width:50px">No.</td>
		<td style="text-align:center;">Judul</td>
		<td style="text-align:center;">Deskripsi</td>
		<td style="text-align:center;">Kategori</td>
		<td style="text-align:center;">Tanggal</td>
        <td style="text-align:center">Photo</td>
		</tr>
		';
		$io=0;
		
		foreach($res as $valp){
			++$io;
			$src='';
			if($valp->source !='array'){
				$src= '<img src="'.base_url().'srv-5/kliping_source/'.$valp->source.'" style="height:50px">';
			}else{
				$src_arr = json_decode($post->source_array);
		 
					foreach($src_arr as $val => $vals){
						$src.= '<img src="'.base_url().'srv-5/kliping_source/'.$vals->name.'" style="height:50px">'; 
					}
			}
			
			$tbl.= '
			<tr>
					<td style="text-align:center;width:50px">'.$io.'</td>
					<td style="text-align:center;">'.$valp->title.'</td>
					<td style="text-align:center;">'.$valp->desc.'</td>
					<td style="text-align:center;">'.$valp->category_name.'</td>
					<td style="text-align:center;">'.date('d-m-Y H:i:s', $valp->created_on).'</td>
					<td style="text-align:center">'.$src.'</td>
					</tr>
					';
		}
		//$tbl .= $this->gentbl($dataarr['today']);
	

$tbl.='</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

 
$pdf->Output('laporan.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
	 }
}
