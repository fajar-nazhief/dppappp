<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Comments controller (frontend)
 *
 * @author 		Phil Sturgeon, Yorick Peterse - PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Comments module
 * @category 	Modules
 */
class Kliping extends Public_Controller {

	/**
	 * An array containing the validation rules
	 * @access private
	 * @var array
	 */
	 

	/**
	 * Constructor method
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::Public_Controller();
		$this->db->set_dbprefix('default_');
		$this->db->set_dbprefix('tbl_');
		// Load the required classes
		//print_r($this->session);
		$this->theme = $this->settings->default_theme;
		 
	}

	/**
	 * Create a new comment
	 * @access public
	 * @param string $module The module (what module?)
	 * @param int $id The ID (what ID?)
	 * @return void
	 */
	 function klipinglist(){ 
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$res['hasil']='false';
		if($this->input->post('date')){
			$this->db->select("kliping.*,DATE_FORMAT(date,'%d-%m-%Y') as tgl,DATE_FORMAT(date, '%H:%i')as jam,DATE_FORMAT(date,'%d')as tanggal,MONTHNAME(date) as bulan,YEAR(date)as tahun");
			$this->db->where("DATE_FORMAT(date,'%e-%c-%Y')",$this->input->post('date'));
			$this->db->order_by('date','ASC');
			$this->db->limit('3');
			$res['data'] = $this->db->get('kliping')->result_array();
			$res['hasil']='true'; 	
		} 
			
		
		echo json_encode($res);	
	 }

	 function klipinglistm(){ 
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		 
		$month = $this->input->post('monthx');
		$year = $this->input->post('yearx'); 
		if(!$month){
			 $month = date('n');
			$year = date('Y'); 
		}
			$this->db->select("DATE_FORMAT(date,'%Y/%m/%d')as date,title as value");
			$this->db->where("DATE_FORMAT(date,'%c')",$month);
			$this->db->where("DATE_FORMAT(date,'%Y')",$year);
			$this->db->order_by('date','ASC'); 
			$res= $this->db->get('kliping')->result_array();
		 	
		 
			
		
		echo json_encode($res);	
	 }

	 function index($id){  
		
		$this->db->set_dbprefix('tbl_');
		
	 
		  $month = date('n');
		   $year = date('Y'); 
	   
		   $this->db->select("kliping.*,DATE_FORMAT(date,'%d-%m-%Y') as tgl,DATE_FORMAT(date, '%H:%i')as jam,DATE_FORMAT(date,'%d')as tanggal,MONTHNAME(date) as bulan,YEAR(date)as tahun");
		   $this->db->where("DATE_FORMAT(date,'%c')",$month);
		   $this->db->where("DATE_FORMAT(date,'%Y')",$year);
		   $this->db->order_by('date','ASC'); 
		   $res= $this->db->get('kliping')->result_array();

		$this->db->set_dbprefix('default_');

		$this->template->title('Kliping', 'Kliping media' )		
			->set_metadata('description', '' )
			->set_metadata('keywords', '' ) 
			->set('data',$res)		
			->build( 'view' );
   }

   function search($id){  
		
	$this->db->set_dbprefix('tbl_');
	
 
	  $month = date('n');
	   $year = date('Y'); 
   
	   if($this->input->post('q')){
		$this->db->select("kliping.*,DATE_FORMAT(date,'%d-%m-%Y') as tgl,DATE_FORMAT(date, '%H:%i')as jam,DATE_FORMAT(date,'%d')as tanggal,MONTHNAME(date) as bulan,YEAR(date)as tahun");
		$this->db->like("title",$this->input->post('q'));
		 $this->db->limit('10');
		$this->db->order_by('date','ASC'); 
		$res= $this->db->get('kliping')->result_array();
		
		$this->db->set_dbprefix('default_');
	   }

	$this->template->title('Kliping', 'Kliping media' )		
		->set_metadata('description', '' )
		->set_metadata('keywords', '' ) 
		->set('data',$res)		
		->build( 'view' );
}
   
   public function chrtmedia_get(){
		$headers = $_GET;
		 
 
						//cek
						  $this->db->select('count(kliping.*)as jml,kliping_media.media_name as media');
					 
							$this->db->join('kliping_media','kliping_media.id = kliping.media_id');
							$this->db->group_by('kliping_media.media_name');
						$res = $this->db->get('kliping')->result();
						//cek
						//trans_kasir_detail
						if(!is_null($res)){
						 $html='Laporan,Jumlah '."\r\n";
							foreach($res as $dat => $val){
								$html.= $val->media.','.$val->jml." \r\n";
							}
						}
						echo $html;
				  
			return;  
	}

}