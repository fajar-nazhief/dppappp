<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Poll_m extends My_Model {

    function Poll_m() {
        parent::My_Model();
    }

    function getIP($ip = 0) {
        
	 	$this->db->where('IP', $ip);
		$query = $this->db->get('default_log_polling');
		if ($query->num_rows() == 0) {
		    return FALSE;
		} else {
		    return $query->row();
		}
	}
	
    function insert_poll($input){
	$this->db->insert('default_log_polling', array(
        	'idpolling'=>$input['pollid'],
        	'qid'=>$input['vote'],
		'IP'=>$_SERVER['REMOTE_ADDR'] 
        ));
	$_SESSION['ipaddress']=$_SERVER['REMOTE_ADDR'] ;
	return $input['pollid'];
    }
    
    function insert_poll_admin($input){
	$this->db->insert('default_log_polling', array(
        	'idpolling'=>$input['pollid'],
        	'qid'=>$input['vote'],
		'IP'=>'1' 
        )); 
	return $input['pollid'];
    }
    
    
    
    function countPoll($id=""){
	$this->db->where('category_id',$id);
	$this->db->where('simpan',0);
	return $this->db->count_all_results('banner');
    }
    
    function countAllPoll($id=""){
	$this->db->where('idpolling',$id);
	
	return $this->db->count_all_results('log_polling');
    }
    
    function sumpoll($id=""){
	$this->db->select_sum('vote');
	$this->db->where('idpolling',$id);
	return $this->db->get('default_log_polling')->row();
    }
}

?>
