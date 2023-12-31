<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_Admin_gue extends Theme {

    public $name			= 'PyroCMS Admin Theme';
    public $author			= 'PyroCMS Dev Team';
    public $author_website	= 'http://pyrocms.com/';
    public $website			= 'http://pyrocms.com/';
    public $description		= 'Default PyroCMS v1.0 Admin Theme - Vertical navigation, CSS3 styling.';
    public $version			= '1.0';
	public $type			= 'admin';
	public $options 		= array('recent_comments' => 	array('title' 		=> 'Recent Comments',
																'description'   => 'Would you like to display recent comments on the dashboard?',
																'default'       => 'no',
																'type'          => 'radio',
																'options'       => 'yes=Yes|no=No',
																'is_required'   => TRUE),
									'news_feed' => 			array('title' => 'News Feed',
																'description'   => 'Would you like to display the news feed on the dashboard?',
																'default'       => 'yes',
																'type'          => 'radio',
																'options'       => 'yes=Yes|no=No',
																'is_required'   => TRUE),
									'quick_links' => 		array('title' => 'Quick Links',
																'description'   => 'Would you like to display quick links on the dashboard?',
																'default'       => 'yes',
																'type'          => 'radio',
																'options'       => 'yes=Yes|no=No',
																'is_required'   => TRUE),
									'analytics_graph' => 	array('title' => 'Analytics Graph',
																'description'   => 'Would you like to display the graph on the dashboard?',
																'default'       => 'yes',
																'type'          => 'radio',
																'options'       => 'yes=Yes|no=No',
																'is_required'   => TRUE),
								   );
	
	/**
	 * Run() is triggered when the theme is loaded for use
	 *
	 * This should contain the main logic for the theme.
	 *
	 * @access	public
	 * @return	void
	 */
	public function run()
	{
		self::generate_menu();

		// only load these items on the dashboard
		if ($this->module == '')
		{
			// don't bother fetching the data if it's turned off in the theme
			//if ($this->theme_options->analytics_graph == 'yes')		self::get_analytics();
			//if ($this->theme_options->news_feed == 'yes')			self::get_rss_feed();
			//if ($this->theme_options->recent_comments == 'yes')		self::get_recent_comments();
		}
	}
	
	private function generate_menu()
	{
		// Get a list of all modules available to this user/group
		if ($this->user)
		{
			$modules = $this->module_m->get_all(array(
				'is_backend' => TRUE,
				'group' => $this->user->group,
				'lang' => CURRENT_LANGUAGE
			));

			$grouped_modules = array();

			$grouped_menu[] = 'content';

			foreach ($modules as $module)
			{
				if ($module['menu'] != 'content' && $module['menu'] != 'design' && $module['menu'] != 'users' && $module['menu'] != 'utilities' && $module['menu'] != '0')
				{
					$grouped_menu[] = $module['menu'];
				}
			}

			array_push($grouped_menu, 'design', 'users', 'utilities');

			$grouped_menu = array_unique($grouped_menu);

			foreach ($modules as $module)
			{
				$grouped_modules[$module['menu']][$module['name']] = $module;
			}

			// pass them on as template variables
			$this->template->menu_items = $grouped_menu;
			$this->template->modules = $grouped_modules;
		}
	}
	
	public function get_analytics()
	{
		$data = array();
		
		 
	}
	
	public function get_rss_feed()
	{
		 
	}
	
	public function get_recent_comments()
	{
	 
	}
}

/* End of file theme.php */