<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_m extends My_Model {

    function Banner_m() {
        parent::My_Model();
    }

	function getBanners($params = array()) {
		
		// Limit the results based on 1 number or 2 (2nd is offset)
		if($this->uri->segment(3) == 'search'){
		    $where_condition=$this->uri->segment(4); 
		    $query =$this->db->query("
					SELECT a.* ,b.title as catTitle,c.title as titleClient FROM `banner` as a,banner_categories as b ,banner_client as c where a.title like '%".$where_condition."%'  and a.category_id=b.id and a.client_id = c.id
					UNION
					SELECT a.* ,b.title as catTitle,c.title as titleClient FROM `banner` as a,banner_categories as b ,banner_client as c where b.title like '%".$where_condition."%'  and a.category_id=b.id and a.client_id = c.id
					UNION
					SELECT a.* ,b.title as catTitle,c.title as titleClient FROM `banner` as a,banner_categories as b ,banner_client as c where a.link_file like '%".$where_condition."%'  and a.category_id=b.id and a.client_id = c.id
					LIMIT ".$params['limit'][1].",".$params['limit'][0]);
		    //return $query->result();
		}else{
			if(isset($params['limit']) && is_int($params['limit'])) $this->db->limit($params['limit']);
			elseif(isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
			$this->db->select('banner.category_id as pollid,banner.simpan,banner.urutan,banner.createdby,banner.link_file,banner.link_url,banner.id,banner.slug,banner.title,banner.title_en,banner_categories.title as catTitle,banner_client.title as titleClient');
				
			$this->db->join('banner_categories', 'banner.category_id = banner_categories.id', 'left');
				$this->db->join('banner_client', ' banner.client_id=banner_client.id', 'left');
		
			$this->db->order_by('banner.urutan', 'asc');
			if(!empty($params['simpan'])){
			    $this->db->where('simpan', $params['simpan']);
			}
				
				if(!empty($params['category_id_not'])){
				    $this->db->where_not_in('banner.category_id',$params['category_id_not']);
				    //$this->db->where('category_id <>',$params['category_id_not']);
				}
				
				if(!empty($params['category_id'])){
				    $this->db->where('category_id ',$params['category_id']);
				}
				
			$query = $this->db->get('banner');
		}
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
   
	function getBanner($id = 0) {
        
    	if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);
		
	    $query = $this->db->get('banner');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    
    function countBanner($params = array())
    {
		if($this->uri->segment(3) == 'search'){
		    $where_condition=$this->uri->segment(4); 
		    $query =$this->db->query("
					SELECT a.* ,b.title as catTitle,c.title as titleClient FROM `banner` as a,banner_categories as b ,banner_client as c where a.title like '%".$where_condition."%'  and a.category_id=b.id and a.client_id = c.id
					UNION
					SELECT a.* ,b.title as catTitle,c.title as titleClient FROM `banner` as a,banner_categories as b ,banner_client as c where b.title like '%".$where_condition."%'  and a.category_id=b.id and a.client_id = c.id
					UNION
					SELECT a.* ,b.title as catTitle,c.title as titleClient FROM `banner` as a,banner_categories as b ,banner_client as c where a.link_file like '%".$where_condition."%'  and a.category_id=b.id and a.client_id = c.id
					");
		    //return $query->result();
		    return  $query->num_rows();
		}else{
		    return $this->db->count_all_results('banner');
		}
		
    }
    
    function newBanner($input = array()) {

    	$this->db->insert('banner', $input );
        
        return $input['title'];
    }
    
    function updateBanner($input = array(), $id = 0) {
        if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);    
		$this->db->update('banner', $input);
            
		return TRUE;
    }

	function updateBanner_en($input, $id = 0) {
        if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);    
		$this->db->update('banner', array(
            'title_en'	=> $input['title_en'],
			'updateby'	=> $input['user'],
			'dateupdates'=> date('Y/m/d H:i:s')
		));
            
		return TRUE;
    }
    
    function deleteBanner($id = 0) {
		if(is_numeric($id))  $this->db->where('id', $id);
    	else  				 $this->db->where('slug', $id);

        $this->db->delete('banner');
        return $this->db->affected_rows();
    }
    
    function checkTitle($title = '') {
        $this->db->select('COUNT(title) AS total');
        $query = $this->db->getwhere('banner', array('slug'=>url_title($title)));
        $row = $query->row();
        if ($row->total == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

?>
