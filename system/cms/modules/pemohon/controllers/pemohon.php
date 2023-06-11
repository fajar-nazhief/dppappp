<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class pemohon extends Public_Controller
{
	public $limit = 12; // TODO: PS - Make me a settings option
	protected $validation_rules = array( 
		array( 
			'field' => 'title', 
			'label' => 'lang:blog_title_label', 
			'rules' => 'trim|htmlspecialchars' 
		) ,
		array(

			'field' => 'category_id', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim|numeric'

		), array(

			'field' => 'rincian_informasi', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'cara_memperoleh', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'mendapatkan_salinan', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'alamat', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'email', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'no_telepon', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'pekerjaan', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), array(

			'field' => 'cara_mendapatkan', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		),  array(

			'field' => 'tujuan', 
			'label' => 'lang:blog_category_label', 
			'rules' => 'trim'

		), 

	);
	
	function __construct()
	{
		parent::Public_Controller();		
		 
	}
	
	// news/page/x also routes here
	function index()
	{ 
		$this->template
			->title('Permohonan Informasi Publik Dinas Kebudayaan DKI Jakarta')   
			->build('index');
		 
		 
	}

	function send()
	{ 
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->validation_rules);
		if ($this->form_validation->run())

		{
			

			$post_data = array(

				'title'				=> $this->input->post('title'),

				'slug'				=> url_title($this->input->post('title')),

				'category_id'		=> $this->input->post('category_id'),

				'status'			=> 'waiting',

				'created_on'		=> now(),

				'createdby'			=> '1',

				'json_data' 		=> serialize($_POST),
				'email'		=> $this->input->post('email'),
				'rincian'		=> $this->input->post('rincian_informasi'),
				'tujuan'		=> $this->input->post('tujuan'),
				'cara_peroleh'		=> $this->input->post('cara_memperoleh'),
				'salinan'		=> $this->input->post('mendapatkan_salinan'),
				'cara_dapat_salinan'		=> $this->input->post('cara_mendapatkan'),
				'no_telp'		=> $this->input->post('no_telepon'),
				'alamat'		=> $this->input->post('alamat'), 

			);

			 

			   $this->db->insert('pemohon', $post_data);

				$id = $this->db->insert_id();



			if ($id)

			{

				$this->pyrocache->delete_all('my_m');
				
				$this->session->set_flashdata('success', 'Selamat,Permohonan anda segera kami proses!');
				redirect('pemohon');

			}

			else

			{

				$this->session->set_flashdata('error', 'Oops,Terjadi kesalahan data!');

			}

		}else{
			$this->session->set_flashdata('error', 'Oops,Terjadi kesalahan data!');
		}

		$this->template
			->title('Permohonan Informasi Publik Dinas Kebudayaan DKI Jakarta')   
			->build('index');
		 
		 
	}

	public function status_permohonan(){ 
		$this->load->model('my_m');

		$this->load->model('categories_m');

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

		$pagination = create_pagination_endless('admin/pemohon/index', $total_rows,20,4);



		// Using this data, get the relevant results

		$blog = $this->my_m->limit($pagination['limit'])->get_many_by($base_where);



		foreach ($blog as &$post)

		{

			$post->author = $this->ion_auth->get_user($post->createdby);

		}



		//do we need to unset the layout because the request is ajax?
 

		$this->template
			->title('Status permohonan - Permohonan Informasi Publik Dinas Kebudayaan DKI Jakarta')   
			->build('status',$this->data);
	}
	 
	
	 
}