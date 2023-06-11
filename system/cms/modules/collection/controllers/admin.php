<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Categories
 * @category  	Module
 */
class Admin extends Admin_Controller
{
	/**
	 * Array that contains the validation rules
	 * @access protected
	 * @var array
	 */
	protected $validation_rules = array(
		array(
			'field'   => 'title',
			'label'   => 'lang:collection_title_label',
			'rules'   => 'trim|htmlspecialchars|required|max_length[100]'
			),
		array(
			'field'	=> 'slug',
			'label'	=> 'lang:collection_slug_label',
			'rules' => 'trim|required|alpha_dot_dash|max_length[100]'
		),
		array(
			'field' => 'category_id',
			'label' => 'lang:collection_category_label',
			'rules' => 'trim|numeric'
		),
		array(
			'field' => 'intro',
			'label' => 'lang:collection_intro_label',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'body',
			'label' => 'Body',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'status',
			'label' => 'lang:collection_status_label',
			'rules' => 'trim|alpha'
		),
		array(
			'field' => 'created_on',
			'label' => 'lang:collection_date_label',
			'rules' => 'trim|required'
		),
		array(
		  'field' => 'created_on_hour',
		  'label' => 'lang:collection_created_hour',
		  'rules' => 'trim|numeric|required'
		),
		array(
			'field' => 'created_on_minute',
			'label' => 'lang:collection_created_minute',
			'rules' => 'trim|numeric|required'
		),
		array(
			'field' => 'navigation_group_id',
			'label' => 'Group Navigasi',
			'rules' => 'trim'
		)
		,
		array(
			'field' => 'katakunci',
			'label' => 'Keyword',
			'rules' => 'trim'
		),
		array(
			'field' => 'keyword',
			'label' => 'Keyword',
			'rules' => 'trim'
		)
	);

	/** 
	 * The constructor
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::Admin_Controller();
		
		$this->load->model('collection_m');
		$this->load->model('collection_categories_m');
		$this->lang->load('collection'); 
		$this->lang->load('categories');
		
		// Date ranges for select boxes
		$this->data->hours = array_combine($hours = range(0, 23), $hours);
		$this->data->minutes = array_combine($minutes = range(0, 59), $minutes);
		
		$this->data->categories = array(0 => '');
		if ($categories = $this->collection_categories_m->get_all())
		{
			foreach($categories as $category)
			{
				$this->data->categories[$category->id] = $category->title;
			}
		}
		$this->template
			->append_metadata( css('blog.css', 'blog') ) 
				->set_partial('shortcuts', 'admin/partials/shortcuts');
	}
	
	function pilih($id=""){
			$this->db->set('pilihan_editor', '1', FALSE)
			 ->where('id', $id)
			 ->update('collection');
			 redirect('admin/collection');
	}
	
	function headline($id=""){
			$this->db->set('headline', '1', FALSE)
			 ->where('id', $id)
			 ->update('collection');
			 redirect('admin/collection');
	}
	
	function selesai($id=""){
			$this->db->set('pilihan_editor', '0', FALSE)
			 ->where('id', $id)
			 ->update('collection');
			 redirect('admin/collection');
	}
	
	function headline_selesai($id=""){
			$this->db->set('headline', '0', FALSE)
			 ->where('id', $id)
			 ->update('collection');
			 redirect('admin/collection');
	}
	/**
	 * Show all created collection articles
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// Create pagination links
		$total_rows = $this->collection_m->count_by(array('show_future'=>TRUE, 'status' => 'all'));
		$pagination = create_pagination('admin/collection/index', $total_rows);
		 
		// Using this data, get the relevant results
		$collection = $this->collection_m->limit($pagination['limit'])->get_many_by(array(
			'show_future' => TRUE,
			'status' => 'all'
		));
		
		if(!empty($_POST['search'])){
			redirect('admin/collection/search/'.$_POST['search']);
		}
		
		$this->template
			->title($this->module_details['name'])
			->set('pagination', $pagination)
			->set('collection', $collection)
			->build('admin/index', $this->data);
	}
	
	public function search()
	{
		// Create pagination links
		$total_rows = $this->collection_m->count_data(array());
		$pagination = create_pagination('admin/collection/search/'.$this->uri->segment(4), $total_rows,20,5);
		 
		// Using this data, get the relevant results
		$collection = $this->collection_m->search(array(
			'show_future' => TRUE,
			'limit'=>$pagination['limit'],
			'status' => 'all'
		));
		 
		$this->template
			->title($this->module_details['name'])
			->set('pagination', $pagination)
			->set('collection', $collection)
			->build('admin/index', $this->data);
	}
	/**
	 * Create new article
	 * @access public
	 * @return void
	 */
	public function create()
	{
		$this->load->library('form_validation');
		
		//append the check slug callback function to rules array
		$this->validation_rules[1]['rules'] .= '|callback__check_slug';
		$this->form_validation->set_rules($this->validation_rules);
		
		if ($this->input->post('created_on'))
		{
			  $created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), $this->input->post('created_on_hour'), $this->input->post('created_on_minute')));
		}
 
		
		if ($this->form_validation->run())
		{
			
      $date = $this->input->post('date');
      
      $date =  explode('/', $date);
    
      $id = $this->collection_m->insert(array(
				'title'			=> $this->input->post('title'),
				'slug'			=> $this->input->post('slug'),
				'category_id'		=> $this->input->post('category_id'),
				'intro'			=> $this->input->post('intro'),
				'body'			=> $this->input->post('body'),
				'status'		=> $this->input->post('status'),
				'lat'			=> $this->input->post('txtLat'),
				'lng'		=> $this->input->post('txtLang'),
				'created_on'		=> $created_on,
				'created_on_hour'	=> $this->input->post('created_on_hour'),
				'created_on_minute'	=> $this->input->post('created_on_minute'),
				'navigation_group_id' => $this->input->post('navigation_group_id'),
				'katakunci'		=> $this->input->post('katakunci'),
				'keyword'		=> $this->input->post('keyword')
			));
    	
			if($id)
			{
				$this->pyrocache->delete_all('collection_m');
				$this->session->set_flashdata('success', sprintf($this->lang->line('collection_article_add_success'), $this->input->post('title')));
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('collection_article_add_error'));
			}

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/collection') : redirect('admin/collection/edit/'.$id);
		}

		else
		{
			// Go through all the known fields and get the post values
			foreach($this->validation_rules as $key => $field)
			{
				$article->$field['field'] = set_value($field['field']);
			}
		}
		 
		$this->template
			->title($this->module_details['name'], lang('collection_create_title'))
			->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
			->append_metadata( js('collection_form.js', 'collection') )
			->set('article', $article)
			->build('admin/form');
	}
	
	/**
	 * Edit collection article
	 * @access public
	 * @param int $id the ID of the collection article to edit
	 * @return void
	 */
	public function edit($id = 0)
	{//echo $_POST['coba'];exit;
		 
    $date = $this->input->post('date');
    
    $date =  explode('/', $date);
  
    $id OR redirect('admin/collection');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules($this->validation_rules);
			
		$article = $this->collection_m->get($id);
		// If we have a useful date, use it
		if ($this->input->post('created_on'))
		{
			  $created_on = strtotime(sprintf('%s %s:%s', $this->input->post('created_on'), $this->input->post('created_on_hour'), $this->input->post('created_on_minute')));
		}

		else
		{
			$created_on = $article->created_on;
		}
		
		if ($this->form_validation->run())
		{ 
			
			$result = $this->collection_m->update($id, array(
				'title'			=> $this->input->post('title'),
				'slug'			=> $this->input->post('slug'),
				'category_id'		=> $this->input->post('category_id'),
				'intro'			=> $this->input->post('intro'),
				'body'			=> $_POST['body'],
				'status'		=> $this->input->post('status'), 
				'lat'			=> $this->input->post('txtLat'),
				'lng'		=> $this->input->post('txtLang'),
				'created_on'	=> $created_on,
				'navigation_group_id' => $this->input->post('navigation_group_id'),
				'created_on_hour'	=> $this->input->post('created_on_hour'),
				'created_on_minute'	=> $this->input->post('created_on_minute'),
				'katakunci'		=> $this->input->post('katakunci'),
				'keyword'		=> $this->input->post('keyword')
				));
			
			if ($result)
			{
				$this->session->set_flashdata(array('success'=> sprintf($this->lang->line('collection_edit_success'), $this->input->post('title'))));
				
				// The twitter module is here, and enabled!
				if ($this->settings->item('twitter_collection') == 1 && ($article->status != 'live' && $this->input->post('status') == 'live'))
				{
					$url = shorten_url('collection/'.$date[2].'/'.str_pad($date[0], 2, '0', STR_PAD_LEFT).'/'.url_title($this->input->post('title')));
					$this->load->model('twitter/twitter_m');
					if ( ! $this->twitter_m->update(sprintf($this->lang->line('collection_twitter_posted'), $this->input->post('title'), $url)))
					{
						$this->session->set_flashdata('error', lang('collection_twitter_error') . ": " . $this->twitter->last_error['error']);
					}
				}
				// End twitter code
			}
			
			else
			{
				$this->session->set_flashdata(array('error'=> $this->lang->line('collection_edit_error')));
			}
			
			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit'
				? redirect('admin/collection')
				: redirect('admin/collection/edit/'.$id);
		}
		
		// Go through all the known fields and get the post values
		foreach(array_keys($this->validation_rules) as $field)
		{
			if (isset($_POST[$field])) $article->$field = $this->form_validation->$field;
		}    	
		 
		// Load WYSIWYG editor
		$this->template
				->title($this->module_details['name'], sprintf(lang('blog_edit_title'), $article->title))
				->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
				->append_metadata(js('blog_form.js', 'blog'))
			 
			->set('article', $article)
			->build('admin/form');
	}	
	
	/**
	* Preview collection article
	* @access public
	* @param int $id the ID of the collection article to preview
	* @return void
	*/
	public function preview($id = 0)
	{
		$article = $this->collection_m->get($id);

		$this->template
			->set_layout('modal', 'admin')
			->set('article', $article)
			->build('admin/preview');
	}
	
	/**
	 * Helper method to determine what to do with selected items from form post
	 * @access public
	 * @return void
	 */
	public function action()
	{
		switch($this->input->post('btnAction'))
		{
			case 'publish':
				$this->publish();
			break;
			case 'delete':
				$this->delete();
			break;
			default:
				redirect('admin/collection');
			break;
		}
	}
	
	/**
	 * Publish collection article
	 * @access public
	 * @param int $id the ID of the collection article to make public
	 * @return void
	 */
	public function publish($id = 0)
	{
		// Publish one
		$ids = ($id) ? array($id) : $this->input->post('action_to');
		
		if ( ! empty($ids))
		{
			// Go through the array of slugs to publish
			$article_titles = array();
			foreach ($ids as $id)
			{
				// Get the current page so we can grab the id too
				if ($article = $this->collection_m->get($id) )
				{
					$this->collection_m->publish($id);
					
					// Wipe cache for this model, the content has changed
					$this->cache->delete('collection_m');				
					$article_titles[] = $article->title;
				}
			}
		}
	
		// Some articles have been published
		if ( ! empty($article_titles))
		{
			// Only publishing one article
			if ( count($article_titles) == 1 )
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('collection_publish_success'), $article_titles[0]));
			}			
			// Publishing multiple articles
			else
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('collection_mass_publish_success'), implode('", "', $article_titles)));
			}
		}		
		// For some reason, none of them were published
		else
		{
			$this->session->set_flashdata('notice', $this->lang->line('collection_publish_error'));
		}
		
		redirect('admin/collection');
	}
	
	/**
	 * Delete collection article
	 * @access public
	 * @param int $id the ID of the collection article to delete
	 * @return void
	 */
	public function delete($id = 0)
	{
		// Delete one
		$ids = ($id) ? array($id) : $this->input->post('action_to');
		
		// Go through the array of slugs to delete
		if ( ! empty($ids))
		{
			$article_titles = array();
			foreach ($ids as $id)
			{
				// Get the current page so we can grab the id too
				if ($article = $this->collection_m->get($id) )
				{
					$this->collection_m->delete($id);
					
					// Wipe cache for this model, the content has changed
					$this->pyrocache->delete('collection_m');				
					$article_titles[] = $article->title;
				}
			}
		}
		
		// Some pages have been deleted
		if ( ! empty($article_titles))
		{
			// Only deleting one page
			if ( count($article_titles) == 1 )
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('collection_delete_success'), $article_titles[0]));
			}			
			// Deleting multiple pages
			else
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('collection_mass_delete_success'), implode('", "', $article_titles)));
			}
		}		
		// For some reason, none of them were deleted
		else
		{
			$this->session->set_flashdata('notice', lang('collection_delete_error'));
		}
		
		redirect('admin/collection');
	}
	
	/**
	 * Callback method that checks the slug of an article
	 * @access public
	 * @param string slug The Slug to check
	 * @return bool
	 */
	public function _check_slug($slug = '')
	{
		if ( ! $this->collection_m->check_slug($slug))
		{
			$this->form_validation->set_message('_check_slug', lang('collection_already_exist_error'));
			return FALSE;
		}
		
		return TRUE;
	}
	
	/**
	 * method to fetch filtered results for collection list
	 * @access public
	 * @return void
	 */
	public function ajax_filter()
	{
		$category = $this->input->post('f_category');
		$status = $this->input->post('f_status');
		$keywords = $this->input->post('f_keywords');
	
		$post_data = array();
	
		if ($status == 'live' OR $status == 'draft')
		{
			$post_data['status'] = $status;
		}
	
		if ($category != 0)
		{
			$post_data['category_id'] = $category;
		}
	
		//keywords, lets explode them out if they exist
		if ($keywords)
		{
			$post_data['keywords'] = $keywords;
		}
		$results = $this->collection_m->search($post_data);
	
		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('collection', $results)
			->build('admin/index');
	}
	
}