<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regulasi extends Public_Controller
{
	public $limit = 12; // TODO: PS - Make me a settings option
	
	function __construct()
	{
		parent::Public_Controller();		
		 
	}
	
	// news/page/x also routes here
	function index()
	{
		$this->db->set_dbprefix('tbl_');
		 
		$cat = $this->uri->segment('3');
		if(empty($cat)){
			redirect('');
		}
		$this->data->pagination = create_pagination('regulasi/index/',$this->db->where('category_id',$cat)->count_all_results('regulasi'), 20, 4);
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles
		$this->db->select('regulasi.*,regulasi_category.category_name');
		$this->db->join('regulasi_category','regulasi_category.id = regulasi.category_id');
		$this->db->where('regulasi.category_id',$cat);
		$this->db->limit($this->data->pagination['limit'][0], $this->data->pagination['limit'][1]);
		$this->db->order_by('regulasi.id','DESC');
		$post = $this->db->get('regulasi')->result();
		 

		$this->db->set_dbprefix('default_');
		$this->template
			->title('Instruksi walikota')  
			->set('news', $post)
			->build('index',$this->data);
		 
		 
	}

	function search(){
		if(empty($this->uri->segment(4))){
			$paging=0;
		}else{
			$paging=$this->uri->segment(4);
		}
		redirect('regulasi/category/'.$this->uri->segment(3).'/'.$paging.'/'.$this->input->post('q'));
	}

	 

	function category(){
		if($this->uri->segment(5)){
			$this->db->like("CONCAT(' ', default_regulasi.title,default_regulasi.tentang)",$this->uri->segment(5));
		}
			@$this->data->pagination = create_pagination('regulasi/category/'.$this->uri->segment(3),$this->db->count_all_results('regulasi'), 20, 4);
		
		
		//print_r( $this->data->pagination['limit']);
		// Get the current page of news articles 
		

		$this->db->select('regulasi.*,regulasi_categories.title as judul_kategori');
		$this->db->join('regulasi_categories','regulasi.category_id = regulasi_categories.id');
		$this->db->like('regulasi_categories.slug',$this->uri->segment(3));
		if($this->uri->segment(5)){
			$this->db->like("CONCAT(' ', default_regulasi.title,default_regulasi.tentang)",$this->uri->segment(5));
		}
		$this->db->limit($this->data->pagination['limit'][0], $this->data->pagination['limit'][1]);
		$this->db->order_by('regulasi.id','DESC');
		$res = $this->db->get('regulasi')->result();
	 
		$this->template
			->title('instruksi walikota | Regulasi')  
			->set('news', $res)
			->build('index',$this->data);
		 
	}
	 
	
	 
}