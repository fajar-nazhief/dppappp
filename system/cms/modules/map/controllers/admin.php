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
			'field'   => 'apikey',
			'label'   => 'Api Key',
			'rules'   => 'trim|htmlspecialchars|required'
			),
		array(
			'field'	=> 'width',
			'label'	=> 'Width',
			'rules' => 'trim|required|numeric|max_length[100]'
		),
		array(
			'field' => 'height',
			'label' => 'height',
			'rules' => 'trim|numeric'
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
		
		$this->load->model('map_m'); 
	}
	
	 
	/**
	 * Show all created news articles
	 * @access public
	 * @return void
	 */
	public function index()
	{ 
		// Using this data, get the relevant results
		$this->data->map=$this->map_m->settingMap(); 
		$this->template
			->title($this->module_details['name'], 'googlemap')
			->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
			->append_metadata( js('news_form.js', 'news') )
			->set('article', $this->data->map)
			->build('admin/form');
	}
	
	 
	/**
	 * Create new article
	 * @access public
	 * @return void
	 */
	 
	
	/**
	 * Edit news article
	 * @access public
	 * @param int $id the ID of the news article to edit
	 * @return void
	 */
	public function edit($id = 0)
	{
		
		 
			    
			    $this->load->library('form_validation');
			    
			    $this->form_validation->set_rules($this->validation_rules); 
			    
			    if ($this->form_validation->run())
			    {
				    
				    $result = $this->map_m->update($id, array(
					    'apikey'			=> $this->input->post('apikey'),
					    'widhtmap'			=> $this->input->post('width'),
					    'heightmap'		=> $this->input->post('height') 
					    ));
				    
				    if ($result)
				    {
					    $this->session->set_flashdata(array('success'=> sprintf($this->lang->line('news_edit_success'), $this->input->post('title'))));
					    
					     
					    // End twitter code
				    }
				    
				    else
				    {
					    $this->session->set_flashdata(array('error'=> $this->lang->line('news_edit_error')));
				    }
				    
				    // Redirect back to the form or main page
				    $this->input->post('btnAction') == 'save_exit'
					    ? redirect('admin/news')
					    : redirect('admin/news/edit/'.$id);
			    }
			    
			    // Go through all the known fields and get the post values
			    foreach(array_keys($this->validation_rules) as $field)
			    {
				    if (isset($_POST[$field])) $article->$field = $this->form_validation->$field;
			    }    	
			    
			    // Load WYSIWYG editor
			    $this->template
				    ->title($this->module_details['name'], sprintf(lang('news_edit_title'), $article->title))
				    ->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
				    ->append_metadata( js('news_form.js', 'news') )
				    ->set('article', $article)
				    ->build('admin/form');
	}	
	
	/**
	* Preview news article
	* @access public
	* @param int $id the ID of the news article to preview
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
				if ($article = $this->news_m->get($id) )
				{
					$this->news_m->delete($id);
					
					// Wipe cache for this model, the content has changed
					$this->cache->delete('news_m');				
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
				$this->session->set_flashdata('success', sprintf($this->lang->line('news_delete_success'), $article_titles[0]));
			}			
			// Deleting multiple pages
			else
			{
				$this->session->set_flashdata('success', sprintf($this->lang->line('news_mass_delete_success'), implode('", "', $article_titles)));
			}
		}		
		// For some reason, none of them were deleted
		else
		{
			$this->session->set_flashdata('notice', lang('news_delete_error'));
		}
		
		redirect('admin/news');
	}
	
	/**
	 * Callback method that checks the slug of an article
	 * @access public
	 * @param string slug The Slug to check
	 * @return bool
	 */
	 
	
}