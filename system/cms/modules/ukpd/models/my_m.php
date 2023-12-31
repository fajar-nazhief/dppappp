<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_m extends MY_Model {

	protected $_table = 'ukpd';

	function get_all()
	{   
		 
		 
		$this->db->order_by('id', 'DESC');

		return $this->db->get($this->MNAME)->result();
	}

	function get($id)
	{
		$this->db->where(array('id' => $id));
		return $this->db->get($this->MNAME)->row();
	}

	function get_many_by($params = array())
	{
		$this->load->helper('date');

		if (!empty($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where($this->MNAME.'_categories.id', $params['category']);
			else
				$this->db->where($this->MNAME.'_categories.slug', $params['category']);
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (!empty($params['status']))
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
		//$this->db->join($this->MNAME.'_categories', $this->MNAME.'.category_id = '.$this->MNAME.'_categories.id', 'left');

		if (!empty($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where($this->MNAME.'_categories.id', $params['category']);
			else
				$this->db->where($this->MNAME.'_categories.slug', $params['category']);
		}

		if (!empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (!empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (!empty($params['status']))
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
		}

		return $this->db->count_all_results($this->MNAME);
	}
	
	function count_search($data = array())
	{
		  if (!empty($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where($this->MNAME.'.category_id', $data['category']);
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
			$this->db->like($this->MNAME.'.json_data', $data['keywords']);
		}

	 
		return $this->db->count_all_results($this->MNAME);
	}

	function update($id, $input)
	{ 

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
		$this->db->from($this->MNAME.' t1');
		$this->db->distinct();
		$this->db->select('(SELECT count(id) FROM ' . $this->db->dbprefix($this->MNAME) . ' t2
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
		$query = $this->db->get($this->MNAME);
		if ($query->num_rows() > 0)
		{
			$this->load->helper('text');
			foreach ($query->result() as $blog)
			{
				$string .= '<p>' . anchor($this->MNAME.'/' . date('Y/m') . '/' . $blog->slug, $blog->title) . '<br />' . strip_tags($blog->intro) . '</p>';
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
				$this->db->where($this->MNAME.'.category_id', $data['category']);
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

		/*if (array_key_exists('keywords', $data))
		{
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if (!empty($matches[0]))
			{
				foreach ($matches[0] as $match)
				{
					$phrases[] = str_replace('%', '', $match);
				}
			}
			else
			{
				$temp_phrases = explode(' ', $data['keywords']);
				foreach ($temp_phrases as $phrase)
				{
					$phrases[] = str_replace('%', '', $phrase);
				}
			}

			$counter = 0;
			 
			
			foreach ($phrases as $phrase)
			{
				if ($counter == 0)
				{
					$this->db->like('CONCAT(default_blog.title, default_blog.intro,default_blog.body)', $phrase);
				}
				else
				{
					$this->db->like('CONCAT(default_blog.title, default_blog.intro,default_blog.body)', $phrase);
				}

				//$this->db->or_like($this->MNAME.'.body', $phrase);
				//$this->db->or_like($this->MNAME.'.intro', $phrase);
				$counter++;
			}
		}
		*/
		if (array_key_exists('keywords', $data))
		{
			$this->db->like($this->MNAME.'.json_data', $data['keywords']);
		}
		return $this->get_all();
	}

}