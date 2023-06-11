<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_client_m extends My_Model {

    function Banner_client_m() {
        parent::My_Model();
    }

	function getClients($params = array()) {
		
		// Limit the results based on 1 number or 2 (2nd is offset)
       	if(isset($params['limit']) && is_int($params['limit'])) $this->db->limit($params['limit']);
    	elseif(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
    	
        $this->db->order_by('title', 'asc');
		if(@$_POST['search']){
			$this->db->like('title', @$_POST['search']);
		}elseif($this->uri->segment(5)){

		$this->db->like('title', $this->uri->segment(5));
		}
        $query = $this->db->get('banner_client');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
	function listSection($id = 0)
	{
		$query = $this->db->get('banner_client');
	    return $query->result();
	}

	function getClient($id = 0) {
        
    	if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);
		
		$query = $this->db->getwhere('banner_client');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    
    function countClients($params = array())
    {
		if(@$_POST['search']){
			$this->db->like('title', @$_POST['search']);
		}elseif($this->uri->segment(5)){

		$this->db->like('title', $this->uri->segment(5));
		}
		return $this->db->count_all_results('banner_client');
    }
    
    function newClient($input = array()) {

    	$this->db->insert('banner_client', array(
        	'slug'=>url_title(strtolower($input['title'])),
        	'title'=>$input['title'],
			'description'=>$input['description'],
			'createdby'=> $input['user'],
			'datecreated'=>date('Y/m/d H:i:s')
        ));
        
        return $input['title'];
    }
    
    function updateClient($input, $id = 0) {
        if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);    
		$this->db->update('banner_client', array(
            'title'	=> $input['title'],
			'description'=>$input['description'],
            'slug'	=> url_title(strtolower($input['title']))
		));
            
		return TRUE;
    }

	function updateClient_en($input, $id = 0) {
        if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);    
		$this->db->update('banner_client', array(
            'title_en'	=> $input['title_en'],
			'description_en'=>$input['description'],
			'updateby'	=> $input['user'],
			'dateupdates'=> date('Y/m/d H:i:s')
		));
            
		return TRUE;
    }
    
    function deleteClient($id = 0) {
		if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);

        $this->db->delete('banner_client');
        return $this->db->affected_rows();
    }
    
    function checkTitle($title = '') {
        $this->db->select('COUNT(title) AS total');
        $query = $this->db->getwhere('banner_client', array('slug'=>url_title($title)));
        $row = $query->row();
        if ($row->total == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

?>
