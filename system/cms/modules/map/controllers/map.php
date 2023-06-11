<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Map extends Public_Controller
{
	 
	function __construct()
	{
		parent::Public_Controller();		
		$this->load->model('map_m'); 
	}
	
	// news/page/x also routes here
	function index()
	{
		$this->load->model('news/news_categories_m');
		$this->load->model('news/news_m');
			$this->data->id=$this->uri->segment(3);
			$this->data->map=$cari=$this->map_m->get($this->data->id); 
			if(!empty($cari->lat) <> '' AND !empty($cari->lng) <>''){
			// IF this article uses a category, grab it
			if($cari->category_id > 0)
			{
			
			$this->data->category = $this->news_categories_m->get($cari->category_id);
			}
			
			$this->data->qfile=$this->db->where('news_id',(int)$this->data->id)->limit(6)->get('files')->result();
			$slug=$this->data->category->slug;
			$this->data->pagination = create_pagination('map/index/'.$this->data->id, $this->news_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
				)), 10, 4);
				
				// Get the current page of news articles
				$this->data->news = $this->news_m->limit($this->data->pagination['limit'])->get_many_by(array(
					'category'=>$slug,
					'status' => 'live'
				));
			
				
			$this->template->title($cari->title)		
			->set_metadata('description', $cari->intro)
			->set_metadata('keywords', $cari->intro) 
			->build('index',$this->data);
			}else{
				echo 'Error2c : <a href="'.base_url().'">Kami tidak menemukan adanya koordinat silahkan Kembali Ke Halaman Utama atau masukkan koordinat terlebih dahulu!</a>';	
			}
	}
	
	function xmlData($id=""){
			$cari=$this->map_m->get($id); 
	       
		        $this->data->xml = '<markers> ';
			$this->data->xml .= '<marker ';
			$this->data->xml .= 'name="' . $this->parseToXML($cari->title) . '" ';
			$this->data->xml .= 'address="'.strip_image($cari->body).'" ';
			$this->data->xml .= 'intro="'.$this->parseToXML($cari->intro).'" ';
			$this->data->xml .= 'lat="' . $cari->lat . '" ';
			$this->data->xml .= 'lng="' . $cari->lng . '" ';
			$this->data->xml .= 'type="resturant" ';
			$this->data->xml .= '/>';
		        $this->data->xml .= '</markers>';

		 
		$this->load->view('xmldata',$this->data);
	}
	
	function xmlDataArray($id=""){
		$this->load->model('news/news_categories_m');
		$this->load->model('news/news_m');
			$this->data->id=$this->uri->segment(3);
			$this->data->map=$cari=$this->map_m->get($this->data->id);
			 
			
			if(!empty($cari->lat) <> '' AND !empty($cari->lng) <>''){
			// IF this article uses a category, grab it
			if($cari->category_id > 0)
			{
			
			$this->data->category = $this->news_categories_m->get($cari->category_id);
			}
			
			$slug=$this->data->category->slug;
			$this->data->pagination = create_pagination('map/index/'.$this->data->id, $this->news_m->count_by(array(
			'category'=>$slug,
			'status' => 'live'
				)), 10, 4);
				
				// Get the current page of news articles
				$this->data->news = $this->news_m->limit($this->data->pagination['limit'])->get_many_by(array(
					'category'=>$slug,
					'status' => 'live'
				));
				 
			//$cari=$this->map_m->get($id);
			$this->data->xml = '<markers> ';
				foreach($this->data->news as $data => $val){
				  
					 if($val->lat){
					 $this->data->xml .= '<marker ';
					 $this->data->xml .= 'name="' . $this->parseToXML($val->title) . '" ';
					 $this->data->xml .= 'address="'.strip_image($val->body).'" ';
					 $this->data->xml .= 'intro="'.$this->parseToXML($val->intro).'" ';
					 $this->data->xml .= 'lat="' . $val->lat . '" ';
					 $this->data->xml .= 'lng="' . $val->lng . '" ';
					 $this->data->xml .= 'type="resturant" ';
					 $this->data->xml .= '/>';
					 }
				       
				}
		   $this->data->xml .= '</markers>';
		$this->load->view('xmldata',$this->data);
			}
			 
			
	}
	
	function parseToXML($htmlStr) 
	{ 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
	} 
	
	 
}