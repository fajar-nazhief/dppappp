 <?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		Category Menu Widget
 * @author			Stephen Cozart
 * 
 * Show a list of news categories.
 */

class Widget_Vertical_category extends Widgets
{
	public $title = 'News Vertical Category';
	public $description = 'Show a list of news  based on its category ID in vertical way';
	public $author = 'Doni Maulana';
	public $website = 'http://www.12tiga.com';
	public $version = '1.0';
	public $fields = array(
		 
		array(
			'field'   => 'group',
			'label'   => 'Category',
			'rules'   => 'required'
		),
		array(
			'field'   => 'style',
			'label'   => 'Style',
			'rules'   => 'required'
		),
		array(
			'field'   => 'limit',
			'label'   => 'Limit',
			'rules'   => 'required'
		)
	);
	
	public function form()
	{
		$this->load->model('news/news_categories_m');
		$params=array('order'=>'title');
		$categories = $this->news_categories_m->get_all($params);
		$groups = array();
		foreach($categories as $group)
		{
			$groups[$group->id] = $group->title;
		}
 
		 return array(
			'groups' => $groups 
		);
	}

	public function run($options)
	{  
		$this->load->model('news/news_m');
		$catid=$options['group']; 
		if(($options['limit'])){
			$limit=$options['limit'];
		}else{
			$limit='5';
		}
		
		$params=array('catid'=>$catid,'limit'=>$limit);
		$news = $this->news_m->get_all($params);
		
		return array('news' => $news,'style'=>$options);
	}
	
}