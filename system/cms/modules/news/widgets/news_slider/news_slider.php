 <?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		Category Menu Widget
 * @author			Stephen Cozart
 * 
 * Show a list of news categories.
 */

class Widget_News_slider extends Widgets
{
	public $title = 'News Slider';
	public $description = 'Show a list of news in slider form.';
	public $author = 'Doni Maulana';
	public $website = 'http://github.com/clip/';
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
		),
		array(
			'field'   => 'start_limits',
			'label'   => 'Limit Start at',
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
			'field'   => 'newstype',
			'label'   => 'Type News',
			'rules'   => 'required'
		),array(
			'field'   => 'width',
			'label'   => 'Width',
			'rules'   => 'trim'
		),array(
			'field'   => 'height',
			'label'   => 'Height',
			'rules'   => 'trim'
		),array(
			'field'   => 'warna',
			'label'   => 'warna',
			'rules'   => 'trim'
		),array(
			'field'   => 'bgheader',
			'label'   => 'bgheader',
			'rules'   => 'trim'
		)
	);
	
	public function form()
	{
		$this->load->model('news/news_categories_m');

		$categories = $this->news_categories_m->get_all();
		$groups = array();
		$newstype=array('News','Pilihan','Headline');
		$styles = array('JQ rotate','Standard Horizontal','Standard Vertical','JQ rotate news','JQ red slider','JQ news tricker','Standard Vertical with Next Article','Style Profile','Video Style','List Image And Title Vertical','1 article and image horizontal','Berita Style 1','Berita style 2','Berita Tab','kirim chripstory','berita style 3','Berita List Kanan','chirp vertical');
		$groups['0'] = '-- SEMUA KATEGORI --';
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
		if(($options['start_limits'])){$slimit=$options['start_limits'];}else{$slimit=0;}
		if(($options['limits'])){$limit=$options['limits'];}else{$limit=4;}
		$params=array('catid'=>$catid,'limit'=>array($limit,$slimit),'news_type' => ($options['newstype'])?$options['newstype']:"");
		$categories = $this->news_m->where('news.section_id','0')->get_all($params);
		
		return array('categories' => $categories);
	}
	
}