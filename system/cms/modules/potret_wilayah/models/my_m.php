<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_m extends MY_Model {

	protected $_table = 'tbl_gallery';
	

	function get_all()
	{   
		$this->db->select('gallery'.'.*, '.'gall_cat.gall_cat_title AS category_title');
		$this->db->join('gall_cat', 'gallery'.'.gall_cat_id = '.'gall_cat.gall_cat_id', 'left');

		$this->db->order_by('created_on', 'DESC');

		return $this->db->get('gallery')->result();
	}

	function get($id)
	{
		$this->db->where(array('id' => $id));
		return $this->db->get('gallery')->row();
	}

	function get_many_by($params = array())
	{
		$this->load->helper('date');

		if (!empty($params['category']))
		{
			 
				$this->db->where('gallery'.'.gall_cat_id', $params['category']);
			 
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		 

		// By default, dont show future posts
		if (!isset($params['show_future']) || (isset($params['show_future']) && $params['show_future'] == FALSE))
		{
			$this->db->where('created_ons <=', now());
		}

		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$this->db->limit($params['limit']);

		return $this->get_all();
	}

	function count_by($params = array())
	{
		 

		if (!empty($params['category']))
		{ 
				$this->db->where('gallery'.'.gall_cat_id', $params['category']);
			 
		}
 

		return $this->db->count_all_results('gallery');
	}
	
	function count_search($data = array())
	{
		  if (!empty($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where('gallery'.'.category_id', $data['category']);
			}
			 
		}

		if (!empty($data['status']))
		{
			// If it's all, then show whatever the status
			if ($data['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('status', $data['status']);
			}
		}
		
		if (array_key_exists('keywords', $data))
		{
			$this->db->like('gallery'.'.json_data', $data['keywords']);
		}

		 
		return $this->db->count_all_results('gallery');
	}

	function update($id, $input)
	{
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
		$this->db->select('UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(t1.created_on), "%Y-%m-02")) AS `date`', FALSE);
		$this->db->from('gallery'.' t1');
		$this->db->distinct();
		$this->db->select('(SELECT count(id) FROM ' . $this->db->dbprefix('gallery') . ' t2
							WHERE MONTH(FROM_UNIXTIME(t1.created_on)) = MONTH(FROM_UNIXTIME(t2.created_on))
								AND YEAR(FROM_UNIXTIME(t1.created_on)) = YEAR(FROM_UNIXTIME(t2.created_on))
								AND status = "live"
								AND created_on <= ' . now() . '
						   ) as post_count');

		$this->db->where('status', 'live');
		$this->db->where('created_on <=', now());
		$this->db->having('post_count >', 0);
		$this->db->order_by('t1.created_on DESC');
		$query = $this->db->get();

		return $query->result();
	}

	// DIRTY frontend functions. Move to views
	function get_blog_fragment($params = array())
	{
		$this->load->helper('date');

		$this->db->where('status', 'live');
		$this->db->where('created_on <=', now());

		$string = '';
		$this->db->order_by('created_on', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get('gallery');
		if ($query->num_rows() > 0)
		{
			$this->load->helper('text');
			foreach ($query->result() as $blog)
			{
				$string .= '<p>' . anchor('gallery'.'/' . date('Y/m') . '/' . $blog->slug, $blog->title) . '<br />' . strip_tags($blog->intro) . '</p>';
			}
		}
		return $string;
	}

	function check_exists($field, $value = '', $id = 0)
	{
		if (is_array($field))
		{
			$params = $field;
			$id = $value;
		}
		else
		{
			$params[$field] = $value;
		}
		$params['id !='] = (int) $id;

		return parent::count_by($params) == 0;
	}

	/**
	 * Searches blog posts based on supplied data array
	 * @param $data array
	 * @return array
	 */
	public function search($data = array())
	{
		 if (!empty($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where('gallery'.'.category_id', $data['category']);
			}
			 
		}

		if (!empty($data['status']))
		{
			// If it's all, then show whatever the status
			if ($data['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('status', $data['status']);
			}
		}

		 
		if (array_key_exists('keywords', $data))
		{
			$this->db->like('gallery'.'.json_data', $data['keywords']);
		}
		return $this->get_all();
	}

}