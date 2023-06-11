<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class collection_m extends MY_Model
{
    
    protected $_table = 'default_collection'; 
	
	function collection_m()
	{
		//parent::MY_Model();
		//$this->db->dbprefix('');
		//$this->db->dbprefix('collection'); 
		 //$this->db = $this->load->database('shared', TRUE);
		 //$this->db->dbprefix('collection'); 
	}
	
    function get_all($params=array())
    { 
	 
	// Is a status set?
    	if ( ! empty($params['status']) )
    	{
    		// If it's all, then show whatever the status
    		if ($params['status'] != 'all')
    		{
	    		// Otherwise, show only the specific status
			$this->db->where('created_on <=', now());
    			$this->db->where('status', $params['status']);
    		}
    	}
    	
    	// Nothing mentioned, show live only (general frontend stuff)
    	else
    	{
	       
    		$this->db->where('status', 'live');
		$this->db->where('created_on <=', now());
	       
    	}
	
	if(!empty($params['catid'])){
	    $this->db->where('collection.category_id',$params['catid']);
	}
	
	if(!empty($params['collection_type'])){
	    if($params['collection_type'] =='1'){
		$this->db->where('collection.pilihan_editor','1');
	    }
	    if($params['collection_type'] =='2'){
		$this->db->where('collection.headline','1');
	    }
	    
	}
	
	if(!empty($params['pilihan_editor'])){
	    $this->db->where('collection.pilihan_editor',$params['pilihan_editor']);
	}
	//print_r($params['limit']);
	if (isset($params['limit']) && is_array($params['limit'])) $this->db->limit(intval($params['limit'][0]), intval($params['limit'][1]));
	 
       	elseif (isset($params['limit'])) $this->db->limit(intval($params['limit']));
	
    	$this->db->select('collection.*, collection_categories.navigation_group_id,collection_categories.title AS category_title, collection_categories.slug AS category_slug');
       	$this->db->join('collection_categories', 'collection.category_id = collection_categories.id', 'left');
    	$this->db->where('collection.status','live');
    	$this->db->order_by('collection.id', 'DESC');
         
        return $this->db->get('collection')->result();
	 
	
    }
    
    function klik($id=""){
	$this->db->set('klik', 'klik+1', FALSE)
			 ->where('id', $id)
			 ->update('collection');
    }
    
    function get_all_widget($params=array())
    { 
	
	// Is a status set?
    	if ( ! empty($params['status']) )
    	{
    		// If it's all, then show whatever the status
    		if ($params['status'] != 'all')
    		{
	    		// Otherwise, show only the specific status
    			$this->db->where('collection.status', $params['status']);
    		}
    	}
    	
    	// Nothing mentioned, show live only (general frontend stuff)
    	else
    	{
    		$this->db->where('collection.status', 'live');
		$this->db->where('collection.created_on <=', now());
    	}
	
	if(!empty($params['catid'])){
	    $this->db->where('collection.category_id',$params['catid']);
	}
	
	if(!empty($params['pilihan_editor'])){
	    $this->db->where('collection.pilihan_editor',$params['pilihan_editor']);
	}
	
	if (isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif (isset($params['limit'])) $this->db->limit($params['limit']);
	
    	$this->db->select('collection.*'); 
    	$this->db->where('status','live');
    	$this->db->order_by('collection.id', 'DESC'); 
        return $this->db->get('collection')->result();
	 
	
    }
    
    function get_all_max($params=array())
    { 
	 
	
	if (isset($params['limit']) && is_array($params['limit'])) $this->db->limit($params['limit'][0], $params['limit'][1]);
       	elseif (isset($params['limit'])) $this->db->limit($params['limit']);
	// Is a status set?
    	if ( ! empty($params['status']) )
    	{
    		// If it's all, then show whatever the status
    		if ($params['status'] != 'all')
    		{
	    		// Otherwise, show only the specific status
    			$this->db->where('collection.status', $params['status']);
    		}
    	}
    	
    	// Nothing mentioned, show live only (general frontend stuff)
    	else
    	{
    		$this->db->where('collection.status', 'live');
		$this->db->where('collection.created_on <=', now());
    	}
    	 
    	$this->db->order_by('collection.klik', 'DESC');
        
        return $this->db->get('collection')->result();
	 
	
    }
    
    function count_data($params=array()){
		if($this->uri->segment(3)=='search' OR $this->uri->segment(2)=='search'){
	    if($this->uri->segment(2)=='search'){
		$where_condition=$this->uri->segment(3); 
	    }else{
		$where_condition=$this->uri->segment(4); 
	    }
		    $query =$this->db->query("
					SELECT a.*,b.title as category_title FROM default_collection as a,default_collection_categories as b where a.intro like '%".$where_condition."%'  and a.category_id=b.id
					UNION
					SELECT a.*,b.title as category_title FROM default_collection as a,default_collection_categories as b where a.body like '%".$where_condition."%'  and a.category_id=b.id
					UNION
					SELECT a.*,b.title as category_title FROM default_collection as a,default_collection_categories as b where b.title like '%".$where_condition."%'  and a.category_id=b.id
					");
		    return  $query->num_rows();
		} else{
		    return $this->db->count_all_results('collection');
		}
		
	}
  
    function get($id)
    {
      $this->db->select("*, MONTH(FROM_UNIXTIME(created_on)) as created_on_month, DAY(FROM_UNIXTIME(created_on)) as created_on_day, YEAR(FROM_UNIXTIME(created_on)) as created_on_year,  MINUTE(FROM_UNIXTIME(created_on)) as created_on_minute,  HOUR(FROM_UNIXTIME(created_on)) as created_on_hour");
	if((int)$id){
	     $this->db->where(array('id'=>$id));
	}else{
	    $this->db->where(array('slug'=>$id));
	}
   
           
        return $this->db->get('collection')->row();
    }
	
	
	
	function get_many_by($params = array())
    {
    	$this->load->helper('date');
        
    	if ( ! empty($params['category']))
    	{
	    	if (is_numeric($params['category']))  $this->db->where('collection_categories.id', $params['category']);
	    	else  				 				 $this->db->where(array( 'collection_categories.slug =' => $params['category']) );
    	}
    	
    	if ( ! empty($params['month']))
    	{
    		$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
    	}
	
	if ( ! empty($params['not_id']))
    	{
    		$this->db->where('collection.id <>', $params['not_id']);
    	}
	
	if ( ! empty($params['order_by_id']))
    	{
    		$this->db->order_by('collection.id', $params['order_by_id']);
    	}
	
	if ( ! empty($params['order_by_comment']))
    	{
    		$this->db->order_by('collection.total_comment', $params['order_by_comment']);
    	}
	
	if ( ! empty($params['order_by_klik']))
    	{
    		$this->db->order_by('collection.klik', $params['order_by_klik']);
    	}
    	
    	if ( ! empty($params['year']))
    	{
    		$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
    	}
	
	if ( ! empty($params['penulis']))
    	{
    		$this->db->where('intro_en', $params['penulis']);
    	}
	
	if ( ! empty($params['keyword']))
    	{
    		$this->db->like('collection.keyword', $params['keyword']);
		$key_src=str_replace(array('-',','),'-',$params['keyword']);
		$key=explode('-',$key_src);
			foreach($key as $datakey){
				//echo $datakey;
				$this->db->or_like('collection.keyword',$datakey);
			}
    	}
    	
    	// Is a status set?
    	
    	
    	// By default, dont show future articles
    	 
       	
       	// Limit the results based on 1 number or 2 (2nd is offset)
       	if (isset($params['limit']) && is_array($params['limit'])) $this->db->limit(intval($params['limit'][0]), intval($params['limit'][1]));
       	elseif (isset($params['limit'])) $this->db->limit(intval($params['limit']));
    	 
    	return $this->get_all();
    }
    
     

	function count_by($params = array())
    {
    	$this->db->join('collection_categories', 'collection.category_id = collection_categories.id', 'left');
    	
    	if ( ! empty($params['category']))
    	{
	    	if (is_numeric($params['category']))  $this->db->where('collection_categories.id', $params['category']);
	    	else  				 				 $this->db->where('collection_categories.slug', $params['category']);
    	}
    	
    	if ( ! empty($params['month']))
    	{
    		$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
    	}
    	
    	if ( ! empty($params['year']))
    	{
    		$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
    	}
	
	if ( ! empty($params['penulis']))
    	{
    		$this->db->where('intro_en', $params['penulis']);
    	}
    	
    	// Is a status set?
    	if ( ! empty($params['status']) )
    	{
    		// If it's all, then show whatever the status
    		if ($params['status'] != 'all')
    		{
	    		// Otherwise, show only the specific status
    			$this->db->where('status', $params['status']);
    		}
    	}
    	
    	// Nothing mentioned, show live only (general frontend stuff)
    	else
    	{
    		$this->db->where('status', 'live');
		$this->db->where('created_on <=', now());
    	}
	
	if ( ! empty($params['keyword']))
    	{
    		$this->db->like('collection.keyword', $params['keyword']);
		$key_src=str_replace(array('-',','),'-',$params['keyword']);
		$key=explode('-',$key_src);
			foreach($key as $datakey){
				//echo $datakey;
				$this->db->or_like('collection.keyword',$datakey);
			}
    	}
       	        
		return $this->db->count_all_results('collection');
    }

    function insert($input = array())
    {
    	if (isset($input['created_on_day']) && isset($input['created_on_month']) && isset($input['created_on_year']) )
    	{
    		$input['created_on'] = gmmktime(@$input['created_on_hour'], @$input['created_on_minute'], 0, $input['created_on_month'], $input['created_on_day'], $input['created_on_year']);

			unset($input['created_on_hour'], $input['created_on_minute'], $input['created_on_month'], $input['created_on_day'], $input['created_on_year']);
    	}
    	
    	// Otherwise, use now
    	else
    	{
    		$this->load->helper('date');
    		$input['created_on'] = now();
    	}

    	return parent::insert($input);
    }
    
    function update($id, $input)
    {
    	$this->load->helper('date');
            
    	$input['updated_on'] = now();

    	 

    	return parent::update($id, $input);
    }
    
    function publish($id = 0)
    {
    	return parent::update($id, array('status' => 'live'));
    }


    // -- Archive ---------------------------------------------
    
    function get_archive_months()
    {
    	$this->load->helper('date');
    	
    	$this->db->select('UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(t1.created_on), "%Y-%m-02")) AS `date`', FALSE);
    	$this->db->distinct();
		$this->db->select('(SELECT count(id) FROM collection t2 
							WHERE MONTH(FROM_UNIXTIME(t1.created_on)) = MONTH(FROM_UNIXTIME(t2.created_on)) 
								AND YEAR(FROM_UNIXTIME(t1.created_on)) = YEAR(FROM_UNIXTIME(t2.created_on)) 
								AND status = "live"
								AND created_on <= '.now().'
						   ) as article_count');
		
		$this->db->where('status', 'live');
    	$this->db->where('created_on <=', now());
		$this->db->having('article_count >', 0);
		$this->db->order_by('t1.created_on DESC');
		$query = $this->db->get('collection t1');

		return $query->result();
    }
    
    function get_id(){
		 
		$id='';
		if($this->uri->segment('1') == 'collection' AND $this->uri->segment('2') == 'category'){
			$slug=$this->uri->segment('3');
			$article = $this->db->where('show','1')->where('slug',$slug)->get('collection_categories')->row();
			if(!empty($article))
			{
				$id=$article->id;
			}
			
		}if($this->uri->segment('1') == 'collection' AND $this->uri->segment('2') <> 'category'){
			$slug=$this->uri->segment('4');
			$article = $this->collection_m->join('collection_categories','collection.category_id = collection_categories.id')->where('collection_categories.show','1')->get_by('collection.slug', $slug);
			
			if(!empty($article))
			{
				 
				 $id=$article->category_id;
			}
		}else{
			$slug='';
		}
		
		//print_r($article);
		 if(empty($id)){
				$slug=$this->uri->segment('1');
				$cid=$this->db->order_by('position','DESC')->where('show','1')->where('module_name',$slug)->get('collection_categories')->row();
				if(!empty($cid)){
					//jika modul
					$id=$cid->id;
				}else{
					$slug=$this->uri->segment('1');
			                $article = $this->db->where('show','1')->where('slug',$slug)->get('collection_categories')->row();
					if(!empty($article))
					{
						$id=$article->id;
					}
				}
				
			}
			
			$this->db->where('created_on <=', now());
			return $id;
	 }

    // DIRTY frontend functions. Move to views
    function get_collection_fragment($params = array())
    {
    	$this->load->helper('date');
    	
    	$this->db->where('status', 'live');
    	$this->db->where('created_on <=', now());
       	
       	$string = '';
        $this->db->order_by('created_on', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get('collection');
        if ($query->num_rows() > 0) {
        		$this->load->helper('text');
            foreach ($query->result() as $blogs) {
                $string .= '<p>' . anchor('collection/' . date('Y/m') . '/'. $blogs->slug, $blogs->title) . '<br />' . strip_tags($blogs->intro). '</p>';
            }
        }
        return $string ;
    }

    function check_slug($slug = '')
    {
		return parent::count_by('slug', $slug) == 0;
    }
    
    /**
     * Searches collection articles based on supplied data array
     * @param $data array
     * @return array
     */
    
    function get_many_by_arsip($params = array())
    {
    	$this->load->helper('date');
        
    	if ( ! empty($params['category']))
    	{
	    	if (is_numeric($params['category']))  $this->db->where('collection_categories.id', $params['category']);
	    	else  				 				 $this->db->where(array( 'collection_categories.slug =' => $params['category']) );
    	}
	
	if ( ! empty($params['day']))
    	{
    		$this->db->where('DAY(FROM_UNIXTIME(created_on))', $params['day']);
    	}
    	
    	if ( ! empty($params['month']))
    	{
    		$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
    	}
	
	if ( ! empty($params['not_id']))
    	{
    		$this->db->where('collection.id <>', $params['not_id']);
    	}
	
	if ( ! empty($params['order_by_id']))
    	{
    		$this->db->order_by('collection.id', $params['order_by_id']);
    	}
	
	if ( ! empty($params['order_by_comment']))
    	{
    		$this->db->order_by('collection.total_comment', $params['order_by_comment']);
    	}
	
	if ( ! empty($params['order_by_klik']))
    	{
    		$this->db->order_by('collection.klik', $params['order_by_klik']);
    	}
    	
    	if ( ! empty($params['year']))
    	{
    		$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
    	}
	
	if ( ! empty($params['penulis']))
    	{
    		$this->db->where('intro_en', $params['penulis']);
    	}
	
	if ( ! empty($params['keyword']))
    	{
    		$this->db->like('collection.keyword', $params['keyword']);
		$key_src=str_replace(array('-',','),'-',$params['keyword']);
		$key=explode('-',$key_src);
			foreach($key as $datakey){
				//echo $datakey;
				$this->db->or_like('collection.keyword',$datakey);
			}
    	}
    	
    	// Is a status set?
    	
    	
    	// By default, dont show future articles
    	 
       	
       	// Limit the results based on 1 number or 2 (2nd is offset)
       	if (isset($params['limit']) && is_array($params['limit'])) $this->db->limit(intval($params['limit'][0]), intval($params['limit'][1]));
       	elseif (isset($params['limit'])) $this->db->limit(intval($params['limit']));
    	 
    	return $this->db->get('collection')->result();
    }
    
    function count_by_arsip($params = array())
    {
    	$this->db->join('collection_categories', 'collection.category_id = collection_categories.id', 'left');
    	
    	if ( ! empty($params['category']))
    	{
	    	if (is_numeric($params['category']))  $this->db->where('collection_categories.id', $params['category']);
	    	else  				 				 $this->db->where('collection_categories.slug', $params['category']);
    	}
	
	if ( ! empty($params['day']))
    	{
    		$this->db->where('DAY(FROM_UNIXTIME(created_on))', $params['day']);
    	}
    	
    	if ( ! empty($params['month']))
    	{
    		$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
    	}
    	
    	if ( ! empty($params['year']))
    	{
    		$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
    	}
	
	if ( ! empty($params['penulis']))
    	{
    		$this->db->where('intro_en', $params['penulis']);
    	}
    	
    	// Is a status set?
    	if ( ! empty($params['status']) )
    	{
    		// If it's all, then show whatever the status
    		if ($params['status'] != 'all')
    		{
	    		// Otherwise, show only the specific status
    			$this->db->where('status', $params['status']);
    		}
    	}
    	
    	// Nothing mentioned, show live only (general frontend stuff)
    	else
    	{
    		$this->db->where('status', 'live');
		//$this->db->where('created_on <=', now());
    	}
	
	if ( ! empty($params['keyword']))
    	{
    		$this->db->like('collection.keyword', $params['keyword']);
		$key_src=str_replace(array('-',','),'-',$params['keyword']);
		$key=explode('-',$key_src);
			foreach($key as $datakey){
				//echo $datakey;
				$this->db->or_like('collection.keyword',$datakey);
			}
    	}
       	        
		return $this->db->count_all_results('collection');
    }
    
    public function search($params=array())
    {
	  
	    if($this->uri->segment(2)=='search'){
		$where_condition=str_replace('%20','%',$this->uri->segment(3)); 
	    }else{
		$where_condition=str_replace('%20','%',$this->uri->segment(4)); 
	    }
	    
		    $query =$this->db->query("
					SELECT default_a.*,default_b.title as category_title,default_b.slug as category_slug FROM default_collection as default_a,default_collection_categories as default_b where default_a.intro like '%".$where_condition."%'  and default_a.category_id=default_b.id
					UNION
					SELECT default_a.*,default_b.title as category_title,default_b.slug as category_slug FROM default_collection as default_a,default_collection_categories as default_b where default_a.body like '%".$where_condition."%'  and default_a.category_id=default_b.id
					UNION
					SELECT default_a.*,default_b.title as category_title,default_b.slug as category_slug FROM default_collection as default_a,default_collection_categories as default_b where default_b.title like '%".$where_condition."%'  and default_a.category_id=default_b.id
					LIMIT ".$params['limit'][1].",".$params['limit'][0]);
		    return $query->result();
	 
	 
		 
    }
}

