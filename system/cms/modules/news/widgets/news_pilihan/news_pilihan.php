 <?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		Category Menu Widget
 * @author			Stephen Cozart
 * 
 * Show a list of news categories.
 */

class Widget_News_pilihan extends Widgets
{
	public $title = 'News pilihan';
	public $description = 'Show a list of editors pick news.';
	public $author = 'Doni Maulana';
	public $website = 'http://12tiga.com';
	public $version = '1.0';
	public $fields = array(
		 
		array(
			'field'   => 'group',
			'label'   => 'Category',
			'rules'   => 'required'
		),
		array(
			'field'   => 'limits',
			'label'   => 'Limit',
			'rules'   => 'required'
		)
		,
		array(
			'field'   => 'styles',
			'label'   => 'Style',
			'rules'   => 'required'
		),array(
			'field'   => 'judul',
			'label'   => 'Judul',
			'rules'   => 'required'
		),array(
			'field'   => 'show',
			'label'   => 'show',
			'rules'   => 'trim'
		),array(
			'field'   => 'newstype',
			'label'   => 'Type News',
			'rules'   => 'required'
		)
	);
	
	public function form()
	{
		$this->load->model('news/news_categories_m');

		$categories = $this->news_categories_m->get_all();
		$groups = array();
		$newstype=array('news','pilihan','Terpopuler');
		$styles = array('Normal','slider');
		$groups['0']='-- Pilih Semua Category --';
		foreach($categories as $group)
		{
			$groups[$group->id] = $group->title;
		}
		 
		 return array(
			'groups' => $groups ,
			'styles' => $styles,
			'newstype' => $newstype
		);
	}

	public function run($options)
	{
		$this->load->model('news/news_m');
		$catid=$options['group']; 
		if(($options['limits'])){$limit=$options['limits'];}else{$limit=4;}
		
		if($options['newstype']=='1'){
			
			$params=array('catid'=>$catid,'limit'=>$limit,'pilihan_editor' => ($options['newstype'])?$options['newstype']:"");
		}else{
			$params=array('catid'=>$catid,'limit'=>$limit,'pilihan_editor' => ($options['newstype'])?$options['newstype']:"");
		
		}
		 
		if($options['newstype'] == '2'){
			$categories = $this->news_m->get_all_max($params);
		}else{
			$categories = $this->news_m->get_all($params);
		}
		
		
		return array('categories' => $categories);
	}
	
}