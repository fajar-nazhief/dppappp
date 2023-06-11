<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Comments controller (frontend)
 *
 * @author 		Phil Sturgeon, Yorick Peterse - PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Comments module
 * @category 	Modules
 */
class Agenda extends Public_Controller {

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
	 
	}

	/**
	 * Create a new comment
	 * @access public
	 * @param string $module The module (what module?)
	 * @param int $id The ID (what ID?)
	 * @return void
	 */
	 function agendalist(){ 
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$res['hasil']='false';
		if($this->input->post('date')){
			$this->db->select("agenda.*,DATE_FORMAT(tgl_agenda,'%e-%c-%Y') as tgl,DATE_FORMAT(tgl_agenda, '%H:%i')as jam,DATE_FORMAT(tgl_agenda,'%d')as tanggal,MONTHNAME(tgl_agenda) as bulan,YEAR(tgl_agenda)as tahun");
			$this->db->where("DATE_FORMAT(tgl_agenda,'%e-%c-%Y')",$this->input->post('date'));
			$this->db->order_by('tgl_agenda','ASC');
			$this->db->limit('3');
			$res['data'] = $this->db->get('agenda')->result_array();
			$res['hasil']='true'; 	
		} 
			
		
		echo json_encode($res);	
	 }

	 function agendalistm(){ 
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		 
		$month = $this->input->post('monthx');
		$year = $this->input->post('yearx'); 
		if(!$month){
			 $month = date('n');
			$year = date('Y'); 
		}
			$this->db->select("DATE_FORMAT(tgl_agenda,'%Y/%c/%d')as date,acara as value");
			$this->db->where("DATE_FORMAT(tgl_agenda,'%c')",$month);
			$this->db->where("DATE_FORMAT(tgl_agenda,'%Y')",$year);
			$this->db->order_by('tgl_agenda','ASC'); 
			$res= $this->db->get('agenda')->result_array();
		 	
		 
			
		
		echo json_encode($res);	
	 }

	 function index($id=""){ 
		
		
		$this->db->set_dbprefix('tbl_');
		
	 
		   $month = date('n');
		   $year = date('Y'); 
	   
		   $this->db->select("agenda.*,DATE_FORMAT(tgl_agenda,'%e-%c-%Y') as tgl,DATE_FORMAT(tgl_agenda, '%H:%i')as jam,DATE_FORMAT(tgl_agenda,'%d')as tanggal,MONTHNAME(tgl_agenda) as bulan,YEAR(tgl_agenda)as tahun");
		   $this->db->where("DATE_FORMAT(tgl_agenda,'%c')",$month);
		   $this->db->where("DATE_FORMAT(tgl_agenda,'%Y')",$year);
		   $this->db->order_by('tgl_agenda','ASC'); 
		   $res= $this->db->get('agenda')->result_array();

		$this->db->set_dbprefix('default_');

		$this->template->title('Agenda', 'Agenda kegiatan' )		
			->set_metadata('description', '' ) 
			->set_metadata('keywords', '' ) 
			->append_metadata(js('agenda.js', 'agenda'))
			->set('data',$res)		
			->build( 'view' );
	 }

}