<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Polling extends Public_Controller
{
	public $limit = 5; // TODO: PS - Make me a settings option

	public function __construct()
	{
		parent::Public_Controller();
		$this->load->model('poll_m');
		$this->load->model('banner_categories_m');
	 
	}

	// blog/page/x also routes here
	public function poll()
	{
		
		if(empty($_POST['vote'])){
			
			redirect('polling/error_poll');
		}else{
			if(!empty($_SESSION['ipaddress'])){
				redirect('polling/error_duplicate');
			}else{
			
				//cek ip ke database apakah sudah pernah ikut polling
				$ipaddress = $_SERVER['REMOTE_ADDR'];
				if($this->poll_m->getIP($ipaddress)){
					redirect('polling/error_duplicate');
				}else{
					if($this->poll_m->insert_poll($_POST)){
						redirect('polling/sukses_poll');
					}
					
					//$this->data->msg = 'berhasil';
					
				}
			}
		}
		
		 $this->template->build('index', $this->data);
		 
	}
	
	public function error_poll(){
			$this->data->error_msq = 'Anda Belum Memilih!';
			$this->template->build('error', $this->data);
	}
	
	public function error_duplicate(){
			$this->data->error_msq = 'Anda Sudah Pernah Melakukan Vote';
			$this->template->build('error', $this->data);
	}

	public function sukses_poll(){
			$this->data->error_msq = 'Vote Anda Telah Tersimpan';
			$this->template->build('error', $this->data);
	}
	
	public function poll_result(){
		
		 $this->data->pollkat = $dataK = $this->banner_categories_m->getPollCat(); 
		 $pollidg=$dataK->id;
		 $query=$this->db->query('select count(*) as vote,qid,title,b.link_file from default_log_polling as a,default_banner as b where a.qid = b.id and a.idpolling='.$pollidg.' and b.simpan=0 group by a.qid order by b.urutan ASC');
		 $this->data->total=$this->poll_m->countAllPoll($pollidg);
		if ($query->num_rows() > 0) {
			$this->data->datas= $query->result();
		    } else {
			return FALSE;
		    }
		    //echo $pollidg;
		   $sumpoll= $this->poll_m->sumpoll($pollidg);
		   $this->data->rt=$sumpoll->vote;
		    
		 //echo $this->data->rt->qid;
		$this->template->build('result', $this->data);
		
	}
}