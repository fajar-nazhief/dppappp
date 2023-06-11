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

	protected $validation_rules =  array(  array(

		'field' => 'gall_cat_id',

		'label' => 'gall cat id',

		'rules' => 'trim|required'

	),  array(

		'field' => 'title_caption',

		'label' => 'title caption',

		'rules' => 'trim|required'

	) );	

	/**

	 * The constructor

	 * @access public

	 * @return void

	 */

	public function __construct()

	{

		parent::Admin_Controller();

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



		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->validation_rules);

		$this->_path =  realpath("."). '/uploads/potret-wilayah' ;
	 

		$this->load->library('upload', array(

			'upload_path'	=> $this->_path,

			'allowed_types'	=> 'bmp|gif|jpeg|jpg|jpe|png|pdf',

			'file_name'		=> @$this->_filename

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

	

	 

	public function index()

	{

		redirect('admin/potret_wilayah/categories');

		exit;

		//set the base/default where clause

		$base_where = array('show_future' => TRUE, 'status' => 'all'); 

			 

		 

		

			unset($_SESSION['f_category_v']);

			unset($_SESSION['f_status_v']); 

			unset($_SESSION['f_keywords_v']); 

		 

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

			$post->author =firstname($post->createdby);

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





	public function listdata()

	{

		

		

		//set the base/default where clause

		$base_where = array('show_future' => TRUE, 'status' => 'all'); 

			 

		 

		

			unset($_SESSION['f_category_v']);

			unset($_SESSION['f_status_v']); 

			unset($_SESSION['f_keywords_v']); 

		 

		//add post values to base_where if f_module is posted

		$base_where = $this->uri->segment(4) ? $base_where + array('category' => $this->uri->segment(4)) : $base_where;



		$base_where['status'] = $this->input->post('f_status') ? $this->input->post('f_status') : $base_where['status'];



		$base_where = $this->input->post('f_keywords') ? $base_where + array('keywords' => $this->input->post('f_keywords')) : $base_where;



		// Create pagination links

		$total_rows = $this->my_m->count_by($base_where);

		$pagination = create_pagination_endless('admin/'.$this->MNAME.'/index', $total_rows,20,5);



		// Using this data, get the relevant results

		$blog = $this->my_m->limit($pagination['limit'])->order_by('id','DESC')->get_many_by($base_where);



		foreach ($blog as &$post)

		{

			$blog->author =firstname($post->createdby);

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

				$config2['create_thumb'] = TRUE;

				$config2['maintain_ratio'] = TRUE;

				$config2['width'] = 250;

				$config2['height'] = 250;

				$this->load->library('image_lib', $config2);



				$this->image_lib->resize();

		// They are trying to put this live

		 

		$post_data = array(

		'gall_cat_id'=> $this->input->post('gall_cat_id'),

		'title_caption'=> $this->input->post('title_caption'),

		'img_thumb'=> $file['file_name'],

		'created_on'=> now(),

		'createdby'=> $this->user->id,

	);

		 

		 

		   $this->db->insert('gallery', $post_data);

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



			redirect('admin/'.$this->MNAME.'/listdata/'.$this->input->post('gall_cat_id'));

		}

		

		// Loop through each validation rule

		foreach($this->validation_rules as $rule)

		{

			@$category->{$rule['field']} = set_value($rule['field']);

		}

		

		// Render the view	 

		$this->template->build('admin/form', $this->data);	

	}



	/**

	 * Edit blog post

	 * @access public

	 * @param int $id the ID of the blog post to edit

	 * @return void

	 */

	public function edit($id = 0)

	{

	// Get the category

	$id=$this->uri->segment(5);

	$this->db->where('id',$id);

	$category = $this->db->get('gallery')->row();

	

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

			$config2['create_thumb'] = TRUE;

			$config2['maintain_ratio'] = TRUE;

			$config2['width'] = 250;

			$config2['height'] = 250;

			$this->load->library('image_lib', $config2);



			$this->image_lib->resize();

	// They are trying to put this live

	 

	$post_data = array(

		'gall_cat_id'=> $this->input->post('gall_cat_id'),

		'title_caption'=> $this->input->post('title_caption'),

		'img_thumb'=> $file['file_name'],

		'created_on'=> now(),

		'createdby'=> $this->user->id,

	);



			$this->db->where('id',$id);

			$resul = $this->db->update('gallery', $post_data);

			 

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

//	$this->data->category =& $category;

	 

	$this->template->set('post',$category)->build('admin/form');

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



		if ( ! empty($ids))

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

		if ( ! empty($post_titles))

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

		if ( ! empty($ids))

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

		if ( ! empty($post_titles))

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



		redirect('admin/'.$this->MNAME.'/listdata/'.$this->uri->segment(5));

	}



	/**

	 * Callback method that checks the title of an post

	 * @access public

	 * @param string title The Title to check

	 * @return bool

	 */

	public function _check_title($title = '')

	{

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

$pdf->Cell(0, 0, 'Photo Galeri', 0, 0, 'C');

 



$pdf->Write(0, ' ', '', 0, 'C', true, 0, false, false, 0);

$pdf->Ln();

$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);



$pdf->SetFont('helvetica', '', 8);



// -----------------------

$this->db->set_dbprefix('');

		$this->db->select('tbl_gallery.*,default_profiles.first_name,tbl_gall_cat.gall_cat_title');

		$this->db->join('tbl_gall_cat', 'tbl_gallery.gall_cat_id = tbl_gall_cat.gall_cat_id', 'left');

		$this->db->join('default_profiles', 'tbl_gallery.createdby = default_profiles.user_id', 'left'); 

		$this->db->where('tbl_gallery.createdby',$this->input->post('user'));

		$this->db->where('MONTH(FROM_UNIXTIME(tbl_gallery.created_on))',$this->input->post('bulan'));

		$this->db->where('YEAR(FROM_UNIXTIME(tbl_gallery.created_on))',$this->input->post('tahun'));

		

		//$this->db->where('nama_modul',$this->nama_modul);

	 $res = $this->db->get('tbl_gallery')->result(); 

	$bulan = bulan($this->input->post('bulan'));

$tbl = 'Bulan : '.$bulan.', '.$this->input->post('tahun').'<p>

<table cellspacing="0" cellpadding="1" border="1">

<tr>

        <td style="text-align:center;width:50px">No.</td>

        <td style="text-align:center;">Judul</td>

		<td style="text-align:center;">Kategori</td>

		<td style="text-align:center;">Tanggal</td>

        <td style="text-align:center">Photo</td>

		</tr>

		';

		$io=0;

		foreach($res as $valp){

			++$io;

			$tbl.= '

			<tr>

					<td style="text-align:center;width:50px">'.$io.'</td>

					<td style="text-align:center;">'.$valp->title_caption.'</td>

					<td style="text-align:center;">'.$valp->gall_cat_title.'</td>

					<td style="text-align:center;">'.date('d-m-Y H:i:s', $valp->created_on).'</td>

					<td style="text-align:center"><img src="../srv-5/images/gallery/'.$valp->img_thumb.'" style="height:50px"></td>

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

