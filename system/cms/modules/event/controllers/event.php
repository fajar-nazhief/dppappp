<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Public_Controller
{
	public $limit = 5; // TODO: PS - Make me a settings option
	private $_folders	= array();
	private $_path 		= '';
	private $_type 		= NULL;
	private $_ext 		= NULL;
	private $_filename	= NULL;
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
		),
		array(
			'field' => 'category_id',
			'label' => 'lang:blog_category_label',
			'rules' => 'trim|numeric|required'
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
		)
	);

	public function __construct()
	{
		parent::Public_Controller();
		$this->load->model('event_m');
		$this->load->model('event_categories_m');
		$this->load->model('comments/comments_m');
		$this->load->helper('text');
		$this->lang->load('event');
		$this->nama_modul = 'event'; 
		 
			  if(($_SESSION['bahasa'])){
				$_SESSION['bahasa'];
			  }else{
				$_SESSION['bahasa']='ind';
			  }
		
	}
	
	public function pilih_bahasa()
	{
		 
		$bahasa = array("ind", "eng", "chn","jp");
		if (in_array($_GET['lang'] , $bahasa))
			{
			  $_SESSION['bahasa']=$_GET['lang'];
			}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		 //redirect('blog');
	}
	
	
	
	public function create()
	{
		//print_r($_POST);
		if(!($this->user->id)){
			redirect('users/login');
		}
		$this->config->load('files');
		$this->_check_dir();
		$this->_path = FCPATH . $this->config->item('files_folder');
		$bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa');
		
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		
		//$this->_ext = $this->config->item('files_allowed_file_ext');
		//$this->_check_dir();
		//echo $this->data->folders = $this->_folders;
		// Setup upload config
		//echo  '>>>'.$this->_ext;
			
		
		
			
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
			$this->load->library('upload', array(
				'upload_path'	=> $this->_path,
				'allowed_types'	=> 'jpg|png|jpeg',
				'file_name'		=> $this->user->id.'_'.now()
			));
			
			$message='';
			$imagetobody='';
		 
			if(($_FILES['userfile1']['size'] <> 0)) {
				
				if ($_FILES['userfile1']['size'] <= '450000' ){
					if ( ! $image1=$this->upload->do_upload('userfile1'))
				{
					 $status		= 'error';
					 $message	= $this->upload->display_errors();
					 $this->session->set_flashdata('error', $message);
					 
	 
				}else{
					$file1 = $this->upload->data();
					$imagetobody .= '<img src="'.base_url().'uploads/default/files/'. $file1['file_name'].'">';
				}
				}else{
			  $message = 'File to large,max 400KB';
			    $this->session->set_flashdata('error', $message);
			}
			 
				
				//echo $_FILES['userfile2']['size'];
			}
			if(($_FILES['userfile2']['size'] <> 0)){
					if($_FILES['userfile2']['size'] <= '450000' ){
						if ( !$this->upload->do_upload('userfile2'))
						{
							 $status		= 'error';
							 $message	= $this->upload->display_errors();
							 $this->session->set_flashdata('error', $message);
							  
			 
						}else{
							$file2 = $this->upload->data();
							$imagetobody .= '<img src="'.base_url().'uploads/default/files/'. $file2['file_name'].'">';
						}
					}else{
					  $message = 'File to large,max 400KB';
						$this->session->set_flashdata('error', $message);
					}
			}
			
			if(($_FILES['userfile3']['size'] <> 0)){
				 if($_FILES['userfile3']['size'] <= '450000' ){
					if ( ! $this->upload->do_upload('userfile3'))
						{
							 $status		= 'error';
							 $message	= $this->upload->display_errors();
							 $this->session->set_flashdata('error', $message);
							 
							
						}else{
							$file = $this->upload->data();
							$imagetobody .= '<img src="'.base_url().'uploads/default/files/'. $file['file_name'].'">';
						}
				 }else{
				$message = 'File to large,max 400KB';
			    $this->session->set_flashdata('error', $message);
			}
				
			}
			
		
					if($message == ''){
							
						
						
						
						// They are trying to put this live
						if ($this->input->post('status') == 'live')
						{
							role_or_die('blog', 'put_live');
						}
						
						$arr_from = explode('/',$this->input->post('date_from'));
						 $start = $arr_from[0].'/'.$arr_from[1].'/'.$arr_from[2];
						
						$arr_end = explode('/',$this->input->post('date_end'));
						$stop = $arr_end[0].'/'.$arr_end[1].'/'.$arr_end[2];
			 
			$bodydata = str_replace(array('<p>','</p>','<br />'),array('<br>','',''),$this->input->post('body'));
			 
			if(( $this->input->post('category_id')==0)){
				$this->session->set_flashdata('error', 'category field is !');
				redirect('event/create');
			}
						$id = $this->event_m->insert(array(
							'title'				=> $this->input->post('title'),
							'slug'				=> $this->input->post('slug'),
							'category_id'		=> $this->input->post('category_id'),
							'intro'				=> substr($bodydata,0,200),
							'body'				=> $bodydata.' <br> '.$imagetobody,
							'status'			=> 'approval',
							'date_from'			=> strtotime($start),
							'date_end'			=> strtotime($stop),
							'lat'			=> $this->input->post('lat'),
							'lng'			=> $this->input->post('lng'),
							'bahasa'			=> $this->input->post('bahasa'), 
							'alamat'			=> $this->input->post('alamat'),
							'phone'			=> $this->input->post('phone'),
							'operasional'			=> $this->input->post('operasional'),
							'created_on'		=> $created_on,
							'nama_modul' => $this->nama_modul,
							'author_id'			=> $this->user->id,
							'json_data' 		=> serialize($_POST)
						));
			
						if ($id)
						{
							$this->pyrocache->delete_all('event_m');
							$this->session->set_flashdata('success', sprintf($this->lang->line('blog_post_add_success').', Waiting for Approval', $this->input->post('title')));
						}
						else
						{
							$this->session->set_flashdata('error', $this->lang->line('blog_post_add_error'));
						}
			
						// Redirect back to the form or main page
						$this->input->post('btnAction') == 'save_exit' ? redirect($this->nama_modul.'/create') : redirect($this->nama_modul.'/create');
					}else{
						foreach ($this->validation_rules as $key => $field)
					{
						@$post->$field['field'] = set_value($field['field']);
					}
					$post->created_on = $created_on;
						
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
		->set('arrBahasa', $bahasaArr)
				->set('post', $post)->build('sendevent',$this->data);
	}
	
	/**
	 * Validate our upload directory.
	 */
	private function _check_dir()
	{
		if (is_dir($this->_path) && is_really_writable($this->_path))
		{
			return TRUE;
		}
		elseif ( ! is_dir($this->_path))
		{
			if ( ! @mkdir($this->_path, 0777, TRUE))
			{
				$this->data->messages['notice'] = lang('file_folders.mkdir_error');
				return FALSE;
			}
			else
			{
				// create a catch all html file for safety
				$uph = fopen($this->_path . 'index.html', 'w');
				fclose($uph);
			}
		}
		else
		{
			if ( ! chmod($this->_path, 0777))
			{
				$this->session->messages['notice'] = lang('file_folders.chmod_error');
				return FALSE;
			}
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Validate upload file name and extension and remove special characters.
	 */
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
	
	public function halaman()
	{  
		 $this->db->where('bahasa','ind');
		$file_folders = $this->event_categories_m->get_folders();
		 @$this->data->file_folders  = $file_folders;
		 
	 
		if(isset($_SESSION['bahasa'])){
			$this->db->where_in('blog.bahasa', array($_SESSION['bahasa'],'und'));
		}
		$this->db->where('status','live');
		$this->db->where('nama_modul','event');
		$this->db->where("DAY(date_from) =",date('d'));
		$this->db->where("MONTH(date_from) =",date('m'));
		$this->db->where("YEAR(date_from)",date('Y'));
		$this->db->limit(10);
		$this->db->order_by('date_from','ASC');
		$this->data->today = $this->db->get('blog')->result();
		
	 
		 
		 // print_r($this->data->today);
		 
		  if(!($this->data->today)){
			if(isset($_SESSION['bahasa'])){
			$this->db->where_in('blog.bahasa', array($_SESSION['bahasa'],'und'));
		}
		$this->db->where('status','live');
		$this->db->where('nama_modul','event');
		$this->db->where("DAY(date_from) >=",date('d'));
		$this->db->where("MONTH(date_from) >=",date('m'));
		$this->db->where("YEAR(date_from)",date('Y'));
		$this->db->limit(10);
		$this->db->order_by('date_from','ASC');
		$this->data->today = $this->db->get('blog')->result();
		
		 }
		//echo strtotime(date('m-d-y'));
		
		
		if($this->uri->segment(3)){
			 
			if(isset($_SESSION['bahasa'])){
			  $this->db->where_in('blog.bahasa', array($_SESSION['bahasa'],'und'));
		   }
		   
		   $this->db->where('status','live');
		   $this->db->where('nama_modul','event');
			$this->db->where("DAY(date_end)>=",$this->uri->segment(3));
			$this->db->where("MONTH(date_end)",date('m'));
			$this->db->where("YEAR(date_end)",date('Y'));
 
		//	$this->db->where("date_end BETWEEN '".date('Y-m-'.$this->uri->segment(3).' 00:00:00')."' AND '".date('Y-m-31 00:00:00')."'");

		//	$this->db->where("date_end BETWEEN '".date('Y-m-'.$this->uri->segment(3).' 00:00:00')."' AND '".date('Y-m-31 00:00:00')."'");
			
		   
			// $this->db->or_where('(date_end) >= ',date('Y-m-'.$this->uri->segment(3).' 00:00:00'));
			 //$this->db->where("DAY(date_from)",$this->uri->segment(3));
			 //$this->db->where("MONTH(date_from)",date('m'));
			// $this->db->where("YEAR(date_from)",date('Y'));
		   // $this->db->where('date_end <= ',date('Y-m-'.$this->uri->segment(3).' 00:00:00'));
		    $this->db->order_by('date_from','ASC');
				$this->data->thismonth = $this->db->get('blog')->result();
				
		  // print_r($this->data->thismonth );
		}else{
			
		 if(isset($_SESSION['bahasa'])){
			$this->db->where_in('blog.bahasa', array($_SESSION['bahasa'],'und'));
		}
		  
		$this->db->where('status','live');
		$this->db->where('nama_modul','event'); 
		$this->db->where("MONTH(date_from)",date('m'));
		$this->db->where("YEAR(date_from)",date('Y')); 
		//$this->db->or_where('(date_end) >= ',date('Y-m-d'.' 00:00:00'));
		$this->db->order_by('date_from','DESC');
		$this->db->limit(37);
		$this->data->thismonth = $this->db->get('blog')->result();
		
		 
		}
		 
		 if(isset($_SESSION['bahasa'])){
			$this->db->where_in('blog.bahasa', array($_SESSION['bahasa'],'und'));
		}
		$this->db->where('status','live');
		 $this->db->where('nama_modul','event');
		 $this->db->where('MONTH(date_from)',date('m'));
		 $this->db->where('YEAR(date_from)',date('Y')); 
		  $this->db->where('DAY(date_from) between 1 and 31');
		  $this->db->or_where('(date_end) >= ',date('Y-m-d'.' 00:00:00')); 
		 
		// $this->db->where("date_from BETWEEN ".strtotime('1-'.date('m').'-'.date('Y'))." AND ".strtotime('31-'.date('m').'-'.date('Y'))."");
		// $this->db->group_by('DAY(FROM_UNIXTIME(date_from))');
		 $tgl_event_bulan_ini = $this->db->select(' DAY((date_from)) as tgl')->get('blog')->result();
		
		 foreach($tgl_event_bulan_ini as $dat => $val){
			$this->data->adaevent[$val->tgl]=$val->tgl;
		 }
		 $this->template
         ->set_layout('index_event') 
        ->build('index_event', $this->data);
	}

	// blog/page/x also routes here
	public function index()
	{
		$this->db->where('bahasa','ind');
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		 
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all');
		$r=$this->event_m->count_by(array('status' => 'live')); 
		@$this->data->pagination = create_pagination_blog('event/page', $this->event_m->count_by(array('status' => 'live')), 20, 3);

		 
		$this->event_m->where("DAY(date_end) >=",date('d'));
		$this->data->blog = $this->event_m->limit($this->data->pagination['limit'])->get_many_by(array('status' => 'live','show_future'=>'TRUE'));

		if(isset($_SESSION['bahasa'])){
		//	$this->db->where('bahasa', $_SESSION['bahasa']);
		} 
			$this->db->where('module_name','event');
			$categoy_lain = $this->db->get('blog_categories')->result();


		// Set meta description based on post titles
		$meta = $this->_posts_metadata($this->data->blog);
//print_r($categoy_lain);
		$this->template
			->title($this->module_details['name'])
			->set_breadcrumb( lang('blog_blog_title'))
			->set_metadata('description', $meta['description'])
			->set_metadata('keywords', $meta['keywords'])
			->set('categoy_lain',$categoy_lain)
			->build('index', $this->data); 
		

	}

	 


	public function search_by_date(){
		$data_arr = explode('_',$this->uri->segment('3'));
		$jan2mar = $data_arr[0];
		$apr2jun = $data_arr[1];
		$jul2sep = $data_arr[2];
		$oct2dec = $data_arr[3];
	
$q='';
$pertama = 0;
$hit=0;
$sql='';

if($jan2mar.$apr2jun.$jul2sep.$oct2dec <> 0000){


		if($jan2mar){
			$pertama=1;
			$last = date('t', mktime(0, 0, 0, 3, 1, date('Y')));;//cal_days_in_month(CAL_GREGORIAN, 3, date('Y')); 
			 $q.="(nama_modul='event' 
			 and bahasa='".$_SESSION['bahasa']."' 
			 and  date_from BETWEEN '".date('Y')."-01-01 00:00:00' AND '".date('Y')."-03-".$last." 23:59:59') or 
			 (nama_modul='event' 
			 and bahasa='".$_SESSION['bahasa']."' 
			 and  date_end BETWEEN '".date('Y')."-01-01 00:00:00' AND '".date('Y')."-03-".$last." 23:59:59')
			 ";
		$hit=1;
		}

		if($apr2jun){
			$last = date('t', mktime(0, 0, 0, 6, 1, date('Y')));
if($hit==1){$sql=' or ';}
			$q.= $sql."(nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' 
			and  date_from BETWEEN '".date('Y')."-04-01 00:00:00' AND '".date('Y')."-06-".$last." 23:59:59') or 
			(nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' 
			and  date_end BETWEEN '".date('Y')."-04-01 00:00:00' AND '".date('Y')."-06-".$last." 23:59:59')
			";
			$hit=1;
		}

		if($jul2sep){
			$last = date('t', mktime(0, 0, 0, 8, 1, date('Y')));
			if($hit==1){$sql=' or ';}
			$q.=$sql."(nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' 
			and  date_from BETWEEN '".date('Y')."-07-01 00:00:00' AND '".date('Y')."-08-".$last." 23:59:59') or 
			(nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' 
			and  date_end BETWEEN '".date('Y')."-07-01 00:00:00' AND '".date('Y')."-08-".$last." 23:59:59')
			";
			$hit=1;
		}

		if($oct2dec){
			$last = date('t', mktime(0, 0, 0, 11, 1, date('Y')));
			if($hit==1){$sql=' or ';}
			$q.= $sql." (nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' 
			and  date_from BETWEEN '".date('Y')."-09-01 00:00:00' AND '".date('Y')."-11-".$last." 23:59:59') or 
			(nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' 
			and  date_end BETWEEN '".date('Y')."-09-01 00:00:00' AND '".date('Y')."-11-".$last." 23:59:59')
			";
			$hit=1;
		}


		$query="select count(*)as jml from default_blog where 
		".$q;
		$res = $this->db->query($query)->row(); 
		
		$pagination = create_pagination_blog('event/search_by_date/'.$this->uri->segment(3), $res->jml, 20, 4);
 

		$query="select * from default_blog where 
		".$q." order by date_from ASC LIMIT ".$pagination['limit'][1].",".$pagination['limit'][0];
		$blog = $this->db->query($query)->result(); 
	 

	}else{
		$query="select count(*)as jml from default_blog where nama_modul='event' 
		and bahasa='".$_SESSION['bahasa']."' and date_from >= '".date('Y-m-d')." 00:00:00'";
		$res = $this->db->query($query)->row(); 
		
		$pagination = create_pagination_blog('event/search_by_date/'.$this->uri->segment(3), $res->jml, 20, 4);
 

		$query="select * from default_blog where 
		nama_modul='event' 
			and bahasa='".$_SESSION['bahasa']."' and date_from >= '".date('Y-m-d')." 00:00:00'  order by date_from ASC LIMIT ".$pagination['limit'][1].",".$pagination['limit'][0];
		$blog = $this->db->query($query)->result(); 
	}


	 
	$this->template
	->title('Jakarta Kalender Event') 
	->set('pagination', $pagination)
	->set('blog', $blog)
	->set('total',$res->jml)
	->build('index_1', $this->data);

	}


	public function index_dev()
	{
		$this->db->where('bahasa','ind');
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		 
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all');

		@$this->data->pagination = create_pagination_blog('event/page', $this->event_m->count_by(array('status' => 'live')), 20, 3);
		$this->data->blog = $this->event_m->limit($this->data->pagination['limit'])->get_many_by(array('status' => 'live','show_future'=>'TRUE'));

		if(isset($_SESSION['bahasa'])){
		//	$this->db->where('bahasa', $_SESSION['bahasa']);
		} 
			$this->db->where('module_name','event');
			$categoy_lain = $this->db->get('blog_categories')->result();


		// Set meta description based on post titles
		$meta = $this->_posts_metadata($this->data->blog);
//print_r($categoy_lain);
		$this->template
			->title($this->module_details['name'])
			->set_breadcrumb( lang('blog_blog_title'))
			->set_metadata('description', $meta['description'])
			->set_metadata('keywords', $meta['keywords'])
			->set('categoy_lain',$categoy_lain)
			->build('index_dev', $this->data);
	
	
	
		

	}

	public function start_end(){  
		 
	  	$_SESSION['date_from']=$this->input->post('start');
	 	$_SESSION['date_end']=$this->input->post('end');
		$_SESSION['f_category']='';
	 
	redirect('event/search');
	}
	
	 public function search()
	{

		//count
		$this->db->where('status','live');
		$this->db->where('bahasa',$_SESSION['bahasa']);
		$this->db->where('nama_modul','event'); 
		$this->db->where("DATE(date_from) >=",$_SESSION['date_from']); 
		$this->db->or_where('DATE(date_end) <=',$_SESSION['date_end']); 
		$this->db->where("DATE(date_from) >=",$_SESSION['date_from']); 
		$this->db->where('status','live');
		$this->db->where('bahasa',$_SESSION['bahasa']);
		$this->db->where('nama_modul','event');  
		$this->db->order_by('date_from','ASC');
		$total = $this->db->count_all_results('blog');

		@$this->data->pagination = create_pagination_blog('event/search', $total, 20, 3);


		$this->db->where('status','live');
		$this->db->where('bahasa',$_SESSION['bahasa']);
		$this->db->where('nama_modul','event'); 
		$this->db->where("DATE(date_from) >=",$_SESSION['date_from']); 
		$this->db->or_where('DATE(date_end) <=',$_SESSION['date_end']); 
		$this->db->where("DATE(date_from) >=",$_SESSION['date_from']); 
		$this->db->where('status','live');
		$this->db->where('bahasa',$_SESSION['bahasa']);
		$this->db->where('nama_modul','event');  
		$this->db->order_by('date_from','ASC');
		if (isset($this->data->pagination['limit']) && is_array($this->data->pagination['limit'])){

			$this->db->limit($this->data->pagination['limit'][0], $this->data->pagination['limit'][1]);
		}

		$blog = $this->db->get('default_blog')->result();
		 
  //   print_r($this->db->last_query());  
		$this->template
				->title('event')   
				->set('blog', $blog)
                ->set('total',$total)
				->build('index', $this->data);
	}
	
	public function search_download()
	{
		 $this->db->where('bahasa','ind');
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		 
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all');

		//add post values to base_where if f_module is posted
	 
			 unset($_SESSION['f_category']);
		  unset($_SESSION['f_keywords']);
		  unset($_SESSION['date_from']);
		  unset($_SESSION['date_end']);
			
			$_SESSION['f_category'] = $this->input->post('f_category');
			$_SESSION['f_keywords'] = $this->input->post('f_keywords');
			$_SESSION['date_from'] = $this->input->get('date_from');
			 $_SESSION['date_end'] = $this->input->get('date_end');
		 
		 
		@$base_where = $_SESSION['f_category'] ? $base_where + array('category' => $_SESSION['f_category']) : $base_where; 
		@$base_where = $_SESSION['f_keywords'] ? $base_where + array('keywords' => $_SESSION['f_keywords']) : $base_where;
		@$base_where = $_SESSION['date_from'] ? $base_where + array('date_from' => $_SESSION['date_from']) : $base_where;
		@$base_where = $_SESSION['date_end'] ? $base_where + array('date_end' => $_SESSION['date_end']) : $base_where;
		
		// Create pagination links
		 
		// Using this data, get the relevant results
		$this->data->blog = $this->event_m->search($base_where);

		 

		//do we need to unset the layout because the request is ajax?
		 $bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa'); 

		$this->load 
				->view('download', $this->data);
	}

	public function category($slug = '')
	{
		$slug OR redirect($this->nama_modul);
		 $this->db->where('bahasa','ind');
		 $file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		  unset($_SESSION['f_category']);
		  unset($_SESSION['f_keywords']);
		  unset($_SESSION['date_from']);
		  unset($_SESSION['date_end']);
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
	 // initialize pagination
		// Get category data
		$category = $this->event_categories_m->where('module_name',$this->nama_modul)->get_by($slug) OR redirect($this->nama_modul);

		// Count total blog posts and work out how many pages exist
		$pagination = create_pagination_blog($this->nama_modul.'/category/'.$slug, $this->event_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
		)), 20, 4);
		

		// Get the current page of blog posts
		$blog = $this->event_m->limit($pagination['limit'])->get_many_by(array(
			'category'=> $slug,
			'status' => 'live' 
		));

		// Set meta description based on post titles
		$meta = $this->_posts_metadata($blog);
		 $categoy_lain = array();
		if($category->navigation_group_id){
			 if(isset($_SESSION['bahasa'])){
		//	$this->db->where('bahasa', $_SESSION['bahasa']);
		}
			$this->db->where('id <>',$category->id);
			$this->db->where('navigation_group_id',$category->navigation_group_id);
			$categoy_lain = $this->db->get('blog_categories')->result();
			//print_r($categoy_lain);
		}
		 
		$category_event = $this->db->where('bahasa',$_SESSION['bahasa'])->where('module_name',$this->nama_modul)->get('blog_categories')->result();

		
		// Build the page
		$this->template->title($this->module_details['name'], $category->title )
			->set_metadata('description', $category->title.'. '.$meta['description'] )
			->set_metadata('keywords', $category->title )
			->set_breadcrumb( lang('blog_blog_title'), 'blog')
			->set_breadcrumb( $category->title )
			->set('categoy_lain', $categoy_lain)
			->set('blog', $blog)
			->set('category_event',$category_event)
			->set('category', $category)
			->set('pagination', $pagination)
			->build('index', $this->data );
	}
	
	public function category_download($slug = '')
	{
		$slug OR redirect($this->nama_modul);
		 $this->db->where('bahasa','ind');
	 
		
		  unset($_SESSION['f_category']);
		  unset($_SESSION['f_keywords']);
		  unset($_SESSION['date_from']);
		  unset($_SESSION['date_end']);
		
		 
	 // initialize pagination
		// Get category data
		$category = $this->event_categories_m->where('module_name',$this->nama_modul)->get_by($slug) OR redirect($this->nama_modul);

		// Count total blog posts and work out how many pages exist
	  

		// Get the current page of blog posts
		$this->data->blog = $this->event_m->get_many_by(array(
			'category'=> $slug,
			'status' => 'live' 
		)); 
		// Build the page
		$this->load    
			->view('download', $this->data );
	}
	
	public function api_category($slug = '')
	{
		$slug OR redirect($this->nama_modul);
		 $this->db->where('bahasa','ind');
		 $file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		  unset($_SESSION['f_category']);
		  unset($_SESSION['f_keywords']);
		  unset($_SESSION['date_from']);
		  unset($_SESSION['date_end']);
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
	 // initialize pagination
		// Get category data
		$category = $this->event_categories_m->where('module_name',$this->nama_modul)->get_by($slug) OR redirect($this->nama_modul);

		// Count total blog posts and work out how many pages exist
		$countpage=$this->event_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
		));
		$jmlpage=ceil($countpage/20);
		$pagination = create_pagination_blog($this->nama_modul.'/category/'.$slug, $countpage, 20, 4);
		 
		// Get the current page of blog posts
		$blog = $this->event_m->limit($pagination['limit'])->get_many_by(array(
			'category'=> $slug,
			'status' => 'live' 
		));
		header("Content-Type: application/json");
			$blogs['data']=$blog;
			$blogs['page']['total_page']=$jmlpage;
			$blogs['page']['per_page']=20;
          echo json_encode($blogs);
		 
	}

	public function archive($year = NULL, $month = '01')
	{
		$year OR $year = date('Y');
		$month_date = new DateTime($year.'-'.$month.'-01');
		$this->data->pagination = create_pagination('blog/archive/'.$year.'/'.$month, $this->event_m->count_by(array('year'=>$year,'month'=>$month)), NULL, 5);
		$this->data->blog = $this->event_m->limit($this->data->pagination['limit'])->get_many_by(array('year'=> $year,'month'=> $month));
		$this->data->month_year = format_date($month_date->format('U'), lang('blog_archive_date_format'));

		// Set meta description based on post titles
		$meta = $this->_posts_metadata($this->data->blog);

		$this->template->title( $this->data->month_year, $this->lang->line('blog_archive_title'), $this->lang->line('blog_blog_title'))
			->set_metadata('description', $this->data->month_year.'. '.$meta['description'])
			->set_metadata('keywords', $this->data->month_year.', '.$meta['keywords'])
			->set_breadcrumb($this->lang->line('blog_blog_title'), 'blog')
			->set_breadcrumb($this->lang->line('blog_archive_title').': '.format_date($month_date->format('U'), lang('blog_archive_date_format')))
			->build('archive', $this->data);
	}

	// Public: View an post
	public function view($slug = '')
	{
		 $this->db->where('bahasa','ind');
		$file_folders = $this->event_categories_m->get_folders();
		$folders_tree = array();
		
		 
		
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			$this->data->folders_tree[$folder->id] = $indent . $folder->title;
		}
		$this->db->where('slug', urldecode ($slug));
		 
		if ( ! $slug or ! $post = $this->db->get('blog')->row())
		{
			redirect('blog');
		}else{
			$_SESSION['bahasa']=$post->bahasa;
		}


		if ($post->status != 'live' && ! $this->ion_auth->is_admin())
		{
			 redirect('blog');
		}

		$post->author = $this->ion_auth->get_user($post->author_id);

		// IF this post uses a category, grab it
		if ($post->category_id && ($category = $this->event_categories_m->get($post->category_id)))
		{
			$post->category = $category;
		}

		// Set some defaults
		else
		{
			@$post->category->id		= 0;
			$post->category->slug	= '';
			$post->category->title	= '';
		}

		$this->session->set_flashdata(array('referrer' => $this->uri->uri_string));
 

		if ($post->category->id > 0)
		{
			$this->template->set_breadcrumb($post->category->title, $this->nama_modul.'/category/'.$post->category->slug);
		}
		
		if(isset($_SESSION['bahasa'])){
			$this->db->where('bahasa', $_SESSION['bahasa']);
		}
		$this->db->where('category_id',$post->category_id);
		$this->db->where('id <>',$post->id);
		$this->db->where('nama_modul',$this->nama_modul);
		$this->db->where('YEAR(date_from) >=',date('Y'));
		$this->db->where('MONTH(date_from) >=',date('m'));
		$this->db->where('DAY(date_from) >=',date('D'));
		$this->db->or_where('YEAR(date_end) >=',date('Y'));
		$this->db->where('MONTH(date_end) >=',date('m'));
		$this->db->where('DAY(date_end) >=',date('D'));  
		$this->db->where('category_id',$post->category_id);
		$this->db->where('nama_modul',$this->nama_modul);
		$this->db->where('id <>',$post->id);
		$this->db->where('bahasa', $_SESSION['bahasa']);
		$this->db->limit(5);
		$this->db->order_by('RAND()');
		$incategory = $this->db->get('blog')->result();
		 
		 if(isset($_SESSION['bahasa'])){
			$this->db->where('bahasa', $_SESSION['bahasa']);
		}
 
		$this->db->where('nama_modul',$this->nama_modul);
		$this->db->where('pilihan_editor','1');
		$this->db->where('YEAR(date_from) >=',date('Y'));
		$this->db->where('MONTH(date_from) >=',date('m'));
		$this->db->where('DAY(date_from) >=',date('D'));
 
		$this->db->where('bahasa', $_SESSION['bahasa']);
		$this->db->limit(5); 
		$inrecomend = $this->db->get('blog')->result(); 

		@$category_eventarr = $this->db->where('navigation_group_id',$post->category->navigation_group_id)->where('bahasa',$_SESSION['bahasa'])->where('module_name',$this->nama_modul)->get('blog_categories')->result();
		$category_event = array();
		foreach($category_eventarr as $dat => $val){
			$category_event[$val->id]=$val->title;
		}
		$images=strip_image($post->body);
		$this->template
		
		->title($post->title)
			->set_breadcrumb($post->title)
			->set_metadata('news_keywords',$post->category->title.', '.$post->title) 
			->set_metadata('robots', 'index, follow')
			->set_metadata('googlebot', 'NOODP, all')
			->set_metadata('googlebot-news', 'index, follow')
			->set_metadata('googlebot-image', 'index, follow')
			->set_metadata('fb:app_id', '376955466100726','property') 
			->set_metadata('og:type', 'article','property')
			->set_metadata('article:published_time', date('Y-m-d H:i:s', $post->created_on),'property')
			->set_metadata('og:url', base_url().'news/'.date('Y/m', $post->created_on).'/'.$post->slug,'property')
			->set_metadata('og:title', $post->title,'property') 
			->set_metadata('og:image', 'http://jakarta-tourism.go.id'.$images,'property')
			->set_metadata('twitter:image:src', 'http://jakarta-tourism.go.id'.$images)
			
			->set_metadata('og:image:type','image/jpeg','property')
			->set_metadata('og:image:width', '641','property')
			->set_metadata('og:image:height', '452','property')
			->set_metadata('og:description', substr($post->body,0,200).'...','property')
			->set('article', $post)
			->set('incategory', $incategory)
			->set('event_category', $category_event)
			->set('inrecomend', $inrecomend)
			->build('view', $this->data);
	}
	
	public function document($slug = '')
	{
		  $slug = $this->uri->segment(5);
	 
		if ( ! $slug or ! $post = $this->event_m->get_by('slug', $slug))
		{
			redirect('blog');
		}

		if ($post->status != 'live' && ! $this->ion_auth->is_admin())
		{
			redirect('blog');
		}

		$post->author = $this->ion_auth->get_user($post->author_id);

		// IF this post uses a category, grab it
		if ($post->category_id && ($category = $this->event_categories_m->get($post->category_id)))
		{
			$post->category = $category;
		}

		// Set some defaults
		else
		{
			$post->category->id		= 0;
			$post->category->slug	= '';
			$post->category->title	= '';
		}

		$this->session->set_flashdata(array('referrer' => $this->uri->uri_string));

		$this->template->title($post->title, lang('blog_blog_title'))
			->set_metadata('description', $post->intro)
			->set_metadata('keywords', $post->category->title.' '.$post->title)
			->set_breadcrumb(lang('blog_blog_title'), 'blog');

		if ($post->category->id > 0)
		{
			$this->template->set_breadcrumb($post->category->title, 'blog/category/'.$post->category->slug);
		}

		$this->template
			->set_breadcrumb($post->title)
			->set('post', $post)
			->build('view', $this->data);
	}

	// Private methods not used for display
	private function _posts_metadata(&$posts = array())
	{
		$keywords = array();
		$description = array();

		// Loop through posts and use titles for meta description
		if(($posts))
		{
			foreach($posts as &$post)
			{
				if($post->category_title)
				{
					$keywords[$post->category_id] = $post->category_title .', '. $post->category_slug;
				}
				$description[] = $post->title;
			}
		}

		return array(
			'keywords' => implode(', ', $keywords),
			'description' => implode(', ', $description)
		);
	}
	
	public function search_api()
	{
		$_SESSION['bahasa'] = 'ind';
		//set the base/default where clause
		$base_where = array('show_future' => TRUE, 'status' => 'all');

		//add post values to base_where if f_module is posted
		if(($this->uri->segment('5')=='search')){
			
			 unset($_SESSION['f_category']);
		  unset($_SESSION['f_keywords']);
		  unset($_SESSION['date_from']);
		  unset($_SESSION['date_end']);
		  
			
			$_SESSION['f_category'] = $this->input->get('f_category');
			$_SESSION['f_keywords'] = $this->input->get('f_keywords');
			$_SESSION['date_from'] = str_replace('-','/',$this->uri->segment('3'));
			$_SESSION['date_end'] = str_replace('-','/',$this->uri->segment('4'));
		}
		 
		@$base_where = $_SESSION['f_category'] ? $base_where + array('category' => $_SESSION['f_category']) : $base_where; 
		@$base_where = $_SESSION['f_keywords'] ? $base_where + array('keywords' => $_SESSION['f_keywords']) : $base_where;
		@$base_where = $_SESSION['date_from'] ? $base_where + array('date_from' => $_SESSION['date_from']) : $base_where;
		@$base_where = $_SESSION['date_end'] ? $base_where + array('date_end' => $_SESSION['date_end']) : $base_where;

		// Create pagination links
		$total_rows = $this->event_m->count_search($base_where);
		$pagination = create_pagination_endless($this->nama_modul.'/search_api/', $total_rows,10,6);

		// Using this data, get the relevant results
		$blog = $this->event_m->limit($pagination['limit'])->search($base_where);
$a=0;
$data=array();
if(($blog)){
	$blogs['selesai']=0;
		foreach ($blog as $post)
		{
			$data[$a]['title']=$post->title;
			$data[$a]['date_from']=date_format( date_create($post->date_from),'d-m-Y');
			$data[$a]['image']='http://jakarta-tourism.go.id'.trim_image($post->body);
			$data[$a]['body']= (text_only($post->body));
			$data[$a]['phone']=$post->phone;
			$data[$a]['email']=$post->email;
			$data[$a]['website']=$post->website;
			$data[$a]['alamat']=$post->alamat;
			$data[$a]['from']=date_format( date_create($post->date_from),'d-m-Y');
			$data[$a]['end']=date_format( date_create($post->date_end),'d-m-Y');
			//$post->author = $this->ion_auth->get_user($post->author_id);
			++$a;
		}
}else{
	$blogs['selesai']=1;
}

		//do we need to unset the layout because the request is ajax?
		 $bahasaArr = $this->event_m->get_enum_values('default_blog','bahasa');
		 
		 

		 header("Content-Type: application/json");
			$blogs['data']=$data;
			$blogs['total']=$total_rows;
			$blogs['page']['total_page']=$jmlpage;
			$blogs['page']['per_page']=20;
          echo json_encode($blogs);
	}

	function today(){
		header("Content-Type: application/json");
		
		if($id=$this->input->get('id')){
			$this->db->where('id < ',$id);
		}
		$this->db->where('nama_modul','event');
		$this->db->where('bahasa',$this->input->get('bahasa'));
		$this->db->where("DATE_FORMAT(date_from,'%d-%m-%Y') <",date('d-m-Y')); 
		$this->db->where("DATE_FORMAT(date_end,'%d-%m-%Y')",date('d-m-Y')); 
		$this->db->order_by('date_from','ASC');
		$this->db->limit('20');
		$event = $this->db->get('blog')->result_array();
		$result['result']=$event;
		echo json_encode($result);
	}

	function thismonth(){
		header("Content-Type: application/json");
		
		if($id=$this->input->get('id')){
			$this->db->where('id < ',$id);
		}
		$this->db->where('nama_modul','event');
		$this->db->where('bahasa',$this->input->get('bahasa')); 
		$this->db->where("DATE_FORMAT(date_from,'%m-%Y')",date('m-Y')); 
		$this->db->order_by('date_from','ASC');
		$this->db->limit('20');
		$event = $this->db->get('blog')->result_array();
		$result['result']=$event;
				echo json_encode($result);
	}

	function comingsoon(){
		header("Content-Type: application/json");
		
		if($id=$this->input->get('id')){
			$this->db->where('id < ',$id);
		}
		$this->db->where('nama_modul','event');
		$this->db->where('bahasa',$this->input->get('bahasa')); 
		$this->db->where("DATE_FORMAT(date_from,'%m-%Y') >",date('m-Y')); 
		$this->db->order_by('date_from','ASC');
		$this->db->limit('20');
		$event = $this->db->get('blog')->result_array();
		$result['result']=$event;
				echo json_encode($result);
	}

	function eventbyid(){
		header("Content-Type: application/json");
		
		if($id=$this->input->get('id')){
			$this->db->where('id',$id);
		} 
		$this->db->limit('1');
		$event = $this->db->get('blog')->result_array();
		$result['result']=$event;
				echo json_encode($result);
	}
	
	public function getevent(){
		header("Content-Type: application/json");
		 
		$this->db->where('status','live');
		$this->db->where('bahasa',$this->input->get('bhs'));
		$this->db->where('nama_modul','event'); 
		$this->db->where("MONTH(date_from)",$this->input->post('monthx'));
		$this->db->where("YEAR(date_from)",$this->input->post('yearx')); 
		$this->db->or_where('YEAR(date_end)',$this->input->post('yearx'));
		$this->db->where('MONTH(date_end) ',$this->input->post('monthx'));
		
		$this->db->where('status','live');
		$this->db->where('bahasa',$this->input->get('bhs'));
		$this->db->where('nama_modul','event');  
		$this->db->order_by('date_from','ASC');
		$today = $this->db->get('default_blog')->result();
		$hasil['kalender']=array();
		$html ='';
		if(($today)){
		foreach($today as $dat=> $val){

			 $tgl = date('m-d-Y',strtotime($val->date_from));
			 $tgl_end = date('mY',strtotime($val->date_end));
			 
			 if($tgl_end==date('mY')){
				$hasil['kalender'][$tgl]='<span style="font-size:11px;color:#ff5733">'.$val->title.'</span>';
				$tgl = date('m-d-Y',strtotime($val->date_end));
			 }

			 $hasil['kalender'][$tgl]='<span style="font-size:11px;color:#ff5733">'.$val->title.'</span>';
		}

$n=0;
		foreach($today as $dat=> $valnews){
			++$n;
			if($n<= 4){
		 
			$img = url_img($valnews->body); 
			$html .='<a href="javascript:void(0)" onclick="modalpop(\'<img src='.$img.'><a href='.base_url().'event/'.date('Y/m',strtotime($valnews->date_from)).'/'.$valnews->slug.'>View event</a>\')" data-lightbox="gallery-item">';
			$html .='<div class="event-item">';
			$html .='<div class="event-date" style="width: auto;height: auto;">';
			$html .='<div class="event-day">'.date('d',strtotime($valnews->date_from)).'</div>';
			$html .='<div class="event-month">'.date('M',strtotime($valnews->date_from)).'</div>';
			$html .='<div class="event-year">'.date('Y',strtotime($valnews->date_from)).'</div>';
			$html .='</div>';
			$html .='<div class="event-info">';
			$html .='<h5 class="event-link">'.$valnews->title.'</h5>';
			$html .='<div class="event-info-item" style="font-size:15px"><i class="icon-calendar3"></i>';
			$html .='Start : <span class="badge badge-success">'.date('d-m-Y',strtotime($valnews->date_from)).'</span> | End : <span class="badge badge-danger">'.date('d-m-Y',strtotime($valnews->date_end)).'</span>';
		 
			$html .='</div>';
			$html .='</div>';
												
			$html .='</div>';
			$html .='</a>';
			}
	 }
	 $html .='<center><a href="'.base_url().'event" class="button button-3d button-xlarge button-rounded button-purple">See more events</a></center>';
	}
	 $hasil['result']=$html;
		echo json_encode($hasil);
	}

	public function geteventdata(){
		header("Content-Type: application/json");
		 
		$this->db->where('status','live');
		$this->db->where('bahasa',$this->input->get('bhs'));
		$this->db->where('nama_modul','event'); 
		$this->db->where("DAY(date_from)",$this->input->post('datex'));
		$this->db->where("MONTH(date_from)",$this->input->post('monthx'));
		$this->db->where("YEAR(date_from)",$this->input->post('yearx')); 
		$this->db->or_where('YEAR(date_end)',$this->input->post('yearx'));
		$this->db->where('MONTH(date_end) ',$this->input->post('monthx'));
		$this->db->where("DAY(date_end)",$this->input->post('datex'));
		
		$this->db->where('status','live');
		$this->db->where('bahasa',$this->input->get('bhs'));
		$this->db->where('nama_modul','event');  
		$this->db->order_by('date_from','ASC');
		$today = $this->db->get('default_blog')->result();
		$hasil['kalender']=array();
		$html ='';
		if(($today)){
		 

$n=0;
		foreach($today as $dat=> $valnews){
			++$n;
			if($n<= 4){
			$img = trim_image($valnews->body); 
		
			$html .='<a href="javascript:void(0)" onclick="modalpop(\'<img src='.$img.'><a href='.base_url().'event/'.date('Y/m',strtotime($valnews->date_from)).'/'.$valnews->slug.'>View event</a>\')" data-lightbox="gallery-item">';
			$html .='<div class="event-item">';
			$html .='<div class="event-date" style="width: auto;height: auto;">';
			$html .='<div class="event-day">'.date('d',strtotime($valnews->date_from)).'</div>';
			$html .='<div class="event-month">'.date('M',strtotime($valnews->date_from)).'</div>';
			$html .='<div class="event-year">'.date('Y',strtotime($valnews->date_from)).'</div>';
			$html .='</div>';
			$html .='<div class="event-info">';
			$html .='<h5 class="event-link">'.$valnews->title.'</h5>';
			$html .='<div class="event-info-item" style="font-size:15px"><i class="icon-calendar3"></i>';
			$html .='Start : <span class="badge badge-success">'.date('d-m-Y',strtotime($valnews->date_from)).'</span> | End : <span class="badge badge-danger">'.date('d-m-Y',strtotime($valnews->date_end)).'</span>';
			$html .='</div>';
			$html .='</div>';
												
			$html .='</div>';
			$html .='</a>';
			}
	 }
	 $html .='<center><a href="'.base_url().'event" class="button button-3d button-xlarge button-rounded button-purple">See more events</a></center>';
	}
	 $hasil['result']=$html;
		echo json_encode($hasil);
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
$pdf->Cell(0, 0, 'EVENT', 0, 0, 'C');
$pdf->Ln(); 
$pdf->Cell(0, 0, 'Jakarta-Tourism.go.id', 0, 0, 'C');
 

$pdf->Write(0, ' ', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln();
$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------
$this->db->where('status','live');
$this->db->where('bahasa',$this->input->get('bhs'));
$this->db->where('nama_modul','event');  
$this->db->where("MONTH(date_from)",$this->input->get('monthx'));
$this->db->where("YEAR(date_from)",$this->input->get('yearx')); 
$this->db->or_where('YEAR(date_end)',$this->input->get('yearx'));
$this->db->where('MONTH(date_end) ',$this->input->get('monthx')); 

$this->db->where('status','live');
$this->db->where('bahasa',$this->input->get('bhs'));
$this->db->where('nama_modul','event');  
$this->db->order_by('date_from','ASC');
$res = $this->db->get('blog')->result(); 
$tbl = 'Month : '.$this->input->get('monthx').', Year: '.$this->input->get('yearx').'<p>
<table cellspacing="0" cellpadding="1" border="0">
<tr>
        <td style="text-align:center;width:50px">No.</td>
		<td style="width:90%">Event</td> 
		</tr>
		';
		$io=0;
		
		foreach($res as $valp){
			++$io;
			$img = trim_image($valp->body); 
			 
			
			$tbl.= '
			<tr>
					<td style="text-align:center;width:50px">'.$io.'</td>
					<td style="margin:10px"><img src="http://jakarta-tourism.go.id/'.$img.'"><br>'.$valp->title.'<br>  '.$valp->body.date('d-m-Y', strtotime($valp->date_from)).' Until : '.date('d-m-Y', strtotime($valp->date_end)).'</td>  
					</tr>
					';
		}
		//$tbl .= $this->gentbl($dataarr['today']);
	

$tbl.='</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

 
$pdf->Output('event_'.$this->input->get('monthx').'_'.$this->input->get('yearx').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
	 }



	 function rekap($type=""){
		if(($this->input->get('tgl'))){
			$hariini = $this->input->get('tgl');
		}else{
			$hariini = date('Y/m/d');
		}
		$this->db->where_in('id',array('7','8','9','10','11')); 
		
		$this->db->order_by('id','ASC');
		$group = $this->db->get('default_groups')->result();


		//cari hari ini
		  $this->db->select(' default_groups.name, IFNULL(SUM(default_wisatawan.wisman),0) AS totalman, IFNULL(SUM(default_wisatawan.wisnus),0) AS totalnus');
		  $this->db->join('default_wisatawan','default_groups.id = default_wisatawan.group_id');
			$this->db->where('tgl',$hariini);
			$this->db->where('default_wisatawan.tampilkan','1');
			//$this->db->where('default_wisatawan.tipe',$this->input->get('tipe'));
			$this->db->group_by('default_groups.name');
			$wisatawan = $this->db->get('default_groups')->result_array(); 
			
$this->db->select(' default_groups.name, (SUM(default_wisatawan.wisman)) AS totalman, IFNULL(SUM(default_wisatawan.wisnus),0) AS totalnus');
		  $this->db->join('default_wisatawan','default_groups.id = default_wisatawan.group_id');
			$this->db->where('tgl >= ',date('Y/m/').'1');
			$this->db->where('tgl <= ',$hariini);
			$this->db->where('default_wisatawan.tampilkan','1'); 
			//$this->db->where('default_wisatawan.tipe',$this->input->get('tipe'));
			$this->db->group_by('default_groups.name');
			$month = $this->db->get('default_groups')->result_array();

			$this->db->select(' default_groups.name, (SUM(default_wisatawan.wisman)) AS totalman, IFNULL(SUM(default_wisatawan.wisnus),0) AS totalnus');
		  $this->db->join('default_wisatawan','default_groups.id = default_wisatawan.group_id');
			$this->db->where('tgl >= ',date('Y/').'01/01');
			$this->db->where('tgl <= ',$hariini);
			$this->db->where('default_wisatawan.tampilkan','1'); 
			//$this->db->where('default_wisatawan.tipe',$this->input->get('tipe'));
			$this->db->group_by('default_groups.name');
			$year = $this->db->get('default_groups')->result_array();


			if(!empty($wisatawan)){
				foreach($wisatawan as $wis){
					$data[$wis['name']]['wisman'] = $wis['totalman'];
					$data[$wis['name']]['wisnus'] = $wis['totalnus'];
				} 

				foreach($group as $dat){
					if(!empty($data[$dat->name]['wisman'])){
						$res = $data[$dat->name]['wisman'];
					}else{
						$res = 0;
					}

					if(!empty($data[$dat->name]['wisnus'])){
						$resnus = $data[$dat->name]['wisnus'];
					}else{
						$resnus = 0;
					} 

					$hasil['today'][$dat->name]['wisman'] = $res; 
					$hasil['today'][$dat->name]['wisnus'] = $resnus; 
				}
			} 
//month
if(!empty($month)){
foreach($month as $wis){
	$data[$wis['name']]['wisman'] = $wis['totalman'];
	$data[$wis['name']]['wisnus'] = $wis['totalnus'];
} 

foreach($group as $dat){
	if(!empty($data[$dat->name]['wisman'])){
		$res = $data[$dat->name]['wisman'];
	}else{
		$res = 0;
	}

	if(!empty($data[$dat->name]['wisnus'])){
		$resnus = $data[$dat->name]['wisnus'];
	}else{
		$resnus = 0;
	}


	$hasil['month'][$dat->name]['wisman'] = $res; 
	$hasil['month'][$dat->name]['wisnus'] = $resnus; 
}
} 


//year
if(!empty($year)){
foreach($year as $wis){
	$data[$wis['name']]['wisman'] = $wis['totalman'];
	$data[$wis['name']]['wisnus'] = $wis['totalnus'];
} 

foreach($group as $dat){
	if(!empty($data[$dat->name]['wisman'])){
		$res = $data[$dat->name]['wisman'];
	}else{
		$res = 0;
	}

	if(!empty($data[$dat->name]['wisnus'])){
		$resnus = $data[$dat->name]['wisnus'];
	}else{
		$resnus = 0;
	}


	$hasil['year'][$dat->name]['wisman'] = $res; 
	$hasil['year'][$dat->name]['wisnus'] = $resnus; 
}
} 


		 //print_r($hasil);
		 $hasil['status']='success';

		 if($type=='json'){
			return $hasil;
		 }else{ 
			echo json_encode($hasil);
		 }

	}

	 

	function rekappdf(){  
		if(($this->input->get('tgl'))){
			$tglarr = explode('-',$this->input->get('tgl'));
			$tanggal = $tglarr[2].'-'.$tglarr[1].'-'.$tglarr[0];
		}else{
			$tanggal = date('d-m-Y');
			$tglarr[2] = date('d');
			$tglarr[1] = date('m');
			$tglarr[0] = date('Y');
		}
	
		$dataarr = $this->rekap('json'); 
	
	
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
	$pdf->Cell(0, 0, 'Data Kunjungan Destinasi Wisata di Lingkungan', 0, 0, 'C');
	$pdf->Ln(); 
	$pdf->Cell(0, 0, 'Dinas Pariwisata Dan Kebudayaan Provinsi DKI Jakarta', 0, 0, 'C');
	
	
	$pdf->Write(0, ' ', '', 0, 'C', true, 0, false, false, 0);
	$pdf->Ln();
	$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
	
	$pdf->SetFont('helvetica', '', 8);
	
	// -----------------------
	
	
	$tbl = 'Tanggal : '.$tanggal.'<p>
	<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td rowspan="2" style="text-align:center;width:50px">No.</td>
		<td rowspan="2" style="text-align:center;width:290px">Nama Destinasi Wisata</td>
				<td colspan="2" style="text-align:center;width:200px">Pengunjung</td> 
		<td rowspan="2" style="text-align:center;width:100px">Total</td>
		</tr>
		<tr> 
				<td style="text-align:center">Wisman</td> 
		<td style="text-align:center">Wisnus</td>
		</tr>
		';
		
		$tbl .= $this->gentbl($dataarr['today']);
	
	
	$tbl.='</table>';
	
	$pdf->writeHTML($tbl, true, false, false, false, '');
	
	
	//---------------------------------------------
	$pdf->AddPage();
	
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->Cell(0, 0, 'Data Kunjungan Destinasi Wisata di Lingkungan', 0, 0, 'C');
	$pdf->Ln(); 
	$pdf->Cell(0, 0, 'Dinas Pariwisata Dan Kebudayaan Provinsi DKI Jakarta', 0, 0, 'C');
	
	
	$pdf->Write(0, ' ', '', 0, 'C', true, 0, false, false, 0);
	$pdf->Ln();
	$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
	
	$pdf->SetFont('helvetica', '', 8);
	
	$tblmonth = 'Tanggal : 1-'.$tglarr[1].'-'.$tglarr[0].' s/d '.$tanggal.'<p>
	<table cellspacing="0" cellpadding="1" border="1">
	<tr>
	<td rowspan="2" style="text-align:center;width:50px">No.</td>
	<td rowspan="2" style="text-align:center;width:290px">Nama Destinasi Wisata</td>
	<td colspan="2" style="text-align:center;width:200px">Pengunjung</td> 
	<td rowspan="2" style="text-align:center;width:100px">Total</td>
		</tr>
		<tr> 
				<td style="text-align:center">Wisman</td> 
		<td style="text-align:center">Wisnus</td>
		</tr>
		';
		
		$tblmonth .= $this->gentbl($dataarr['month']);
	
	
	$tblmonth.='</table>';
	
	$pdf->writeHTML($tblmonth, true, false, false, false, '');
	
	
	
	//---------------------------------------------
	$pdf->AddPage();
	
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->Cell(0, 0, 'Data Kunjungan Destinasi Wisata di Lingkungan', 0, 0, 'C');
	$pdf->Ln(); 
	$pdf->Cell(0, 0, 'Dinas Pariwisata Dan Kebudayaan Provinsi DKI Jakarta', 0, 0, 'C');
	
	
	$pdf->Write(0, ' ', '', 0, 'C', true, 0, false, false, 0);
	$pdf->Ln();
	$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
	
	$pdf->SetFont('helvetica', '', 8);
	
	$tblthn = 'Tanggal : 1 Januari s/d '.$tanggal.'<p>
	<table cellspacing="0" cellpadding="1" border="1">
	<tr>
	<td rowspan="2" style="text-align:center;width:50px">No.</td>
	<td rowspan="2" style="text-align:center;width:290px">Nama Destinasi Wisata</td>
	<td colspan="2" style="text-align:center;width:200px">Pengunjung</td> 
	<td rowspan="2" style="text-align:center;width:100px">Total</td>
		</tr>
		<tr> 
				<td style="text-align:center">Wisman</td> 
		<td style="text-align:center">Wisnus</td>
		</tr>
		';
		
		$tblthn .= $this->gentbl($dataarr['year']);
	
	
	$tblthn.='</table>';
	
	$pdf->writeHTML($tblthn, true, false, false, false, '');
	
	
	// -----------------------------------------------------------------------------
	
	// -----------------------------------------------------------------------------
	
	//Close and output PDF document  
	$pdf->lastPage();
	$pdf->Output('example_048s.pdf', 'I');
	
	//============================================================+
	// END OF FILE
	//============================================================+
	 }

	 
 function gentbl($data){
	$i=1;
	$wisman = 0;
	$wisnus = 0;
	$jmlrow2 = 0;
	$tbl='';
foreach($data as $res => $val){
$jmlrow = ($val['wisman']+$val['wisnus']);
$tbl .='<tr>
<td style="text-align:center">'.$i.'.</td>
<td>'.$res.'</td>
<td style="text-align:right">'.$val['wisman'].'</td> 
<td style="text-align:right">'.$val['wisnus'].'</td> 
<td style="text-align:right">'.$jmlrow.'</td>  
</tr>';
++$i;
$wisman += $val['wisman'];
$wisnus += $val['wisnus'];
$jmlrow2 += $jmlrow;
}

$tbl .='<tr>
<td style="text-align:center"></td>
<td><b>TOTAL SELURUHNYA</b></td>
<td style="text-align:right"><b>'.$wisman.'</b></td> 
<td style="text-align:right"><b>'.$wisnus.'</b></td> 
<td style="text-align:right"><b>'.$jmlrow2.'</b></td>  
</tr>';

return $tbl;

 }


}


