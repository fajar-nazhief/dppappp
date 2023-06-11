<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_categories_m extends My_Model {

    function Banner_categories_m() {
        parent::My_Model();
    }

	function getCategories($params = array()) {
		
		// Limit the results based on 1 number or 2 (2nd is offset)
       	if(isset($params['limit']) && is_int($params['limit'])) $this->db->limit($params['limit']);
    	elseif(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
    	 
        $this->db->order_by('title', 'asc');
		if(@$_POST['search']){
			$this->db->like('title', @$_POST['search']);
		}elseif($this->uri->segment(5)){

		$this->db->like('title', $this->uri->segment(5));
		}
        $query = $this->db->get('banner_categories');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    function getPollCat( ) {
		 
        $this->db->where('simpan_polling', '0'); 
        $query = $this->db->get('banner_categories');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    
	function listSection($id = 0)
	{
		$query = $this->db->get('banner_categories');
	    return $query->result();
	}

	function getCategory($id = 0) {
        
    	if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);
		
		$query = $this->db->get('banner_categories');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

	function getCategoryBySection($id = 0) {
        
        $this->db->where('section_id', $id); 
		
		$query = $this->db->get('banner_categories');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
             return $query->result();
        }
    }
    
    function countCategories($params = array())
    {
		if(@$_POST['search']){
			$this->db->like('title', @$_POST['search']);
		}elseif($this->uri->segment(5)){

		$this->db->like('title', $this->uri->segment(5));
		}
		return $this->db->count_all_results('banner_categories');
    }
    
    function newCategory($input = array()) {

    	$this->db->insert('banner_categories', array(
        	'slug'=>url_title(strtolower($input['title'])),
        	'title'=>$input['title'],
		'simpan_polling'=>$input['txtSimpan'],
		'polling_name'=>$input['polling_name'],
		'header_polling'=>$input['header_polling'],
			'createdby'=> $input['user'],
			'datecreated'=>date('Y/m/d H:i:s')
        ));
        
        return $input['title'];
    }
    
    function updateCategory($input, $id = 0) {
        if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);    
		$this->db->update('banner_categories', array(
            'title'	=> $input['title'],
	    'polling_name'=>$input['polling_name'],
	    'header_polling'=>$input['header_polling'],
	    'simpan_polling'=>$input['txtSimpan'],
	    'updateby'=> $input['user'],
	    'dateupdates'=>date('Y/m/d H:i:s'),
            'slug'	=> url_title(strtolower($input['title']))
		));
            
		return TRUE;
    }

	function updateCategory_en($input, $id = 0) {
        if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);    
		$this->db->update('banner_categories', array(
            'title_en'	=> $input['title_en'],
	    'polling_name'=>$input['polling_name'],
	    'header_polling'=>$input['header_polling'],
			'updateby'	=> $input['user'],
			'dateupdates'=> date('Y/m/d H:i:s')
		));
            
		return TRUE;
    }
    
    function deleteCategory($id = 0) {
		if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);

        $this->db->delete('banner_categories');
        return $this->db->affected_rows();
    }
    
    function checkTitle($title = '') {
        $this->db->select('COUNT(title) AS total');
        $query = $this->db->getwhere('banner_categories', array('slug'=>url_title($title)));
        $row = $query->row();
        if ($row->total == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

?>
