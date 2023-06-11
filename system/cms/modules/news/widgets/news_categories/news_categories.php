 <?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		Category Menu Widget
 * @author			Stephen Cozart
 * 
 * Show a list of news categories.
 */

class Widget_News_categories extends Widgets
{
	public $title = 'News Categories';
	public $description = 'Show a list of news categories.';
	public $author = 'Stephen Cozart';
	public $website = 'http://github.com/clip/';
	public $version = '1.0';
	public $fields = array(
		 
		array(
			'field'   => 'group',
			'label'   => 'Parent Category',
			'rules'   => 'required'
		),
		array(
			'field'   => 'styles',
			'label'   => 'Type Tampilan',
			'rules'   => 'required'
		)
	);
	
	public function form($options)
	{
		$this->load->model('news/news_categories_m');

		$categories = $this->news_categories_m->get_all();
		$groups = array(); 
		$styles = array('Menu Samping','Menu Atas+Child','Berita 1','Popular category');
		$groups['0']='-- Pilih Semua Category --';
		foreach($categories as $group)
		{
			$groups[$group->id] = $group->title;
		}
		 
		 return array(
			'groups' => $groups ,
			'styles' => $styles
		);
	}
	
	public function run($options)
	{
		$this->load->model('news/news_categories_m');
		 
		$catid=$options['group'];
		if($catid <> '0'){
			$this->db->where('navigation_group_id',$catid);
		}
		//$categories = $this->db->where('show','1')->select('count(default_news.id) as total,news_categories.title as title,news_categories.slug as slug')->join('news_categories','news_categories.id = news.category_id')->group_by('news.category_id')->order_by('news_categories.title','ASC')->get('news')->result();
		$categories = $this->db->where('show','1')->order_by('position','ASC')->get('news_categories')->result();
		return array('categories' => $categories);
	}
	
}