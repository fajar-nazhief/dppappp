<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event_m extends MY_Model {

	protected $_table = 'blog';
	
	function get_hastag()
	{
		$this->db->where('nama_modul','news');
		$this->db->order_by('ahastag', 'asc');
        $result = $this->db->get('blog');
       
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) 
			{
               $string_tag = $row->ahastag;
			   $db_sel  = explode(",", $string_tag);
			   	foreach ($db_sel as $line) 
				{
					$dd[$line]=$line;
				}
               				
			}	
        }
		$result_tag = array_unique($dd);
		
        return $result_tag;
		
	}

	function get_all()
	{
		$this->db->select('blog.*,profiles.first_name, blog_categories.banner as banner,blog_categories.title AS category_title, blog_categories.slug AS category_slug');
		$this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');
		$this->db->join('profiles', 'blog.author_id = profiles.user_id', 'left');
		$this->db->order_by('date_from', 'DESC');
		$this->db->where('nama_modul',$this->nama_modul);
		
		if(isset($_SESSION['bahasa'])){
			$this->db->where('blog.bahasa', $_SESSION['bahasa']);
		} 
		return $this->db->get('blog')->result();
	}
	
	function get_all_admin()
	{
		$this->db->select('blog.*, blog_categories.banner as banner,blog_categories.title AS category_title, blog_categories.slug AS category_slug');
		$this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');

		$this->db->order_by('id', 'DESC');
		$this->db->where('nama_modul',$this->nama_modul);
		
		if(isset($_SESSION['bahasa'])){
			$this->db->where('blog.bahasa', $_SESSION['bahasa']);
		} 
		return $this->db->get('blog')->result();
	}
	
	function get_all_module()
	{
		$this->db->select('blog.*, blog_categories.banner as banner,blog_categories.title AS category_title, blog_categories.slug AS category_slug');
		$this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');

		$this->db->order_by('created_on', 'DESC'); 
		return $this->db->get('blog')->result();
	}
	 
	 function get_enum_values( $table, $field )
{
    $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
    $enum = explode("','", $matches[1]);
	
    return array_combine($enum, $enum);
}

function get_by($id)
	{
		$this->db->where(array('slug' => $id));
		 
		return $this->db->get('blog')->row();
	}

	function get($id)
	{
		$this->db->where(array('id' => $id));
		if(isset($_SESSION['bahasa'])){
			$this->db->where('bahasa', $_SESSION['bahasa']);
		}
		return $this->db->get('blog')->row();
	}

	function get_many_by($params = array())
	{
		$this->load->helper('date');

		if (isset($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where('blog_categories.id', $params['category']);
			else
				$this->db->where('blog_categories.slug', $params['category']);
		}

		if (isset($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (isset($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (isset($params['status']))
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
			$this->db->where('created_on <=', now());
		}

		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$this->db->limit($params['limit']);
		 
		return $this->get_all();
	}
	
	function get_many_by_admin($params = array())
	{
		$this->load->helper('date');

		if (isset($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where('blog_categories.id', $params['category']);
			else
				$this->db->where('blog_categories.slug', $params['category']);
		}

		if (isset($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (isset($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (isset($params['status']))
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
			$this->db->where('created_on <=', now());
		}

		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$this->db->limit($params['limit']);
		 
		return $this->get_all_admin();
	}

	function count_by($params = array())
	{
		$this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');

		if (isset($params['category']))
		{
			if (is_numeric($params['category']))
				$this->db->where('blog_categories.id', $params['category']);
			else
				$this->db->where('blog_categories.slug', $params['category']);
		}

		if (isset($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME(created_on))', $params['month']);
		}

		if (isset($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME(created_on))', $params['year']);
		}

		// Is a status set?
		if (isset($params['status']))
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
		$this->db->where('nama_modul',$this->nama_modul);
		if(isset($_SESSION['bahasa'])){
			$this->db->where('blog.bahasa', $_SESSION['bahasa']);
		}
		return $this->db->count_all_results('blog');
	}
	
	function count_search($data = array())
	{
		  if (isset($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where('blog.category_id', $data['category']);
			}
			 
		}
		
		if(isset($data['bahasa'])){
			$this->db->where('blog.bahasa', $data['bahasa']);
		}

		if (($data['status']))
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
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if (($matches[0]))
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

				//$this->db->or_like('blog.body', $phrase);
				//$this->db->or_like('blog.intro', $phrase);
				$counter++;
			}
		}
		
		if(isset($data['date_from']) and !($data['date_end'])){
			   $start_arr = explode('/',$data['date_from']);
			 $start = $start_arr[2].'-'.$start_arr[0].'-'.$start_arr[1];
			  
			  
		   $this->db->where("date_from = '".$start."' "); 
		}
		
		if(isset($data['date_from']) and ($data['date_end'])){
			 $start_arr = explode('/',$data['date_from']);
			 $start = $start_arr[2].'-'.$start_arr[0].'-'.$start_arr[1];
			 
			 $end_arr = explode('/',$data['date_end']);
			 $end = $end_arr[2].'-'.$end_arr[0].'-'.$end_arr[1];
			  
		   $this->db->where("date_from >= '".$start."' ");
		   $this->db->where("date_end  <=   '".$end."'");
		}
		
		$this->db->where('nama_modul',$this->nama_modul);
		if(isset($_SESSION['bahasa'])){
			$this->db->where('blog.bahasa', $_SESSION['bahasa']);
		}
		return $this->db->count_all_results('blog');
	}
	
	function count_search_all($data = array())
	{
		  if (($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where('blog.category_id', $data['category']);
			}
			 
		}

		if (($data['status']))
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
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if (($matches[0]))
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

				//$this->db->or_like('blog.body', $phrase);
				//$this->db->or_like('blog.intro', $phrase);
				$counter++;
			}
		}
		 
		if(isset($_SESSION['bahasa'])){
			$this->db->where('bahasa', $_SESSION['bahasa']);
		}
		 
		return $this->db->count_all_results('blog');
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
		$this->db->from('blog t1');
		$this->db->distinct();
		$this->db->select('(SELECT count(id) FROM ' . $this->db->dbprefix('blog') . ' t2
							WHERE MONTH(FROM_UNIXTIME(t1.created_on)) = MONTH(FROM_UNIXTIME(t2.created_on))
								AND YEAR(FROM_UNIXTIME(t1.created_on)) = YEAR(FROM_UNIXTIME(t2.created_on))
								AND status = "live"
								AND created_on <= ' . now() . '
						   ) as post_count');

		$this->db->where('status', 'live');
		$this->db->where('created_on <=', now());
		$this->db->having('post_count >', 0);
		$this->db->order_by('t1.created_on DESC');
		$this->db->where('nama_modul',$this->nama_modul);
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
		$query = $this->db->get('blog');
		if ($query->num_rows() > 0)
		{
			$this->load->helper('text');
			foreach ($query->result() as $blog)
			{
				$string .= '<p>' . anchor('blog/' . date('Y/m') . '/' . $blog->slug, $blog->title) . '<br />' . strip_tags($blog->intro) . '</p>';
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
		 if (isset($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where('blog.category_id', $data['category']);
			}
			 
		}
		
		if(isset($data['bahasa'])){
			$this->db->where('blog.bahasa', $data['bahasa']);
		}

		if (($data['status']))
		{
			// If it's all, then show whatever the status
			if ($data['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('status', $data['status']);
			}
		}
		 
		// echo '>>>'.$data['date_from'].'=>'.strtotime(date('Y-m-d').' 00:00:00');
		if(isset($data['date_from']) and !($data['date_end'])){
			  $start_arr = explode('/',$data['date_from']);
			 $start = $start_arr[2].'-'.$start_arr[0].'-'.$start_arr[1];
			  
			  
		   $this->db->where("date_from = '".$start."' "); 
		}
		
		if(isset($data['date_from']) and ($data['date_end'])){
			
			 $start_arr = explode('/',$data['date_from']);
			 $start = $start_arr[2].'-'.$start_arr[0].'-'.$start_arr[1];
			 
			 $end_arr = explode('/',$data['date_end']);
			 $end = $end_arr[2].'-'.$end_arr[0].'-'.$end_arr[1];
			  
		   $this->db->where("date_from >= '".$start."' ");
		   $this->db->where("date_from  <=   '".$end."'");
		}

		if (array_key_exists('keywords', $data))
		{
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if (($matches[0]))
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

				//$this->db->or_like('blog.body', $phrase);
				//$this->db->or_like('blog.intro', $phrase);
				$counter++;
			}
		}
		
		return $this->get_all();
	}
	
	public function search_all($data = array())
	{
		 if (($data['category']))
		{
			if (is_numeric($data['category'])){
				$this->db->where('blog.category_id', $data['category']);
			}
			 
		}

		if (($data['status']))
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
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if (($matches[0]))
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

				//$this->db->or_like('blog.body', $phrase);
				//$this->db->or_like('blog.intro', $phrase);
				$counter++;
			}
		}
		
		if(isset($_SESSION['bahasa'])){
			$this->db->where('blog.bahasa', $_SESSION['bahasa']);
		}
		
		return $this->get_all_module();
	}

}