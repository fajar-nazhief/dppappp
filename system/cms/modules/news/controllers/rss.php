<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends Public_Controller
{
	function __construct()
	{
		parent::Public_Controller();	
		$this->load->model('news_m');
		$this->load->helper('xml');
		$this->load->helper('date');
		$this->lang->load('news');
	}
	
	function json_berita()
	{
		header('Content-Type: application/json');
		
		$this->db->select("news.slug,news.created_on,CONCAT('http://utara.jakarta.go.id/srv-5/news/',FROM_UNIXTIME(created_on, '%Y'),'/',FROM_UNIXTIME(created_on, '%m'),'/',slug) AS 'url',news.title as judul,FROM_UNIXTIME(default_news.created_on) as tgl,news.body as content,CONCAT('http://utara.jakarta.go.id/srv-5/images/berita/',news.foto) as img,news.slug as slug");
 
		$this->db->where('status', 'live');
		$this->db->order_by('id','DESC');
		$this->db->limit('100');
		$blog = $this->db->get('news')->result();
	 
 
		$result['result']=$blog;
		
		echo json_encode($result);
	}

	function json_agenda()
	{
		header('Content-Type: application/json');
		$this->db->set_dbprefix('tbl_'); 
 
		$this->db->order_by('tgl_agenda','DESC');
		$this->db->limit('100');
		$blog = $this->db->get('agenda')->result_array();

		$result['data']=$blog;
		
		echo json_encode($result);
		$this->db->set_dbprefix('default_');
	}

	function json_beritafoto()
	{
		header('Content-Type: application/json');
		$this->db->set_dbprefix('tbl_'); 
  
		$this->db->order_by('created_on','DESC');
		$this->db->limit('100');
		$blog = $this->db->get('tbl_gall_cat')->result_array();

		$result['data']=$blog;
		
		echo json_encode($result);
		$this->db->set_dbprefix('default_');
	}

}
?>
