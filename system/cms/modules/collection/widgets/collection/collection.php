 <?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		Category Menu Widget
 * @author			Stephen Cozart
 * 
 * Show a list of collection categories.
 */

class Widget_collection extends Widgets
{
	public $title = 'Collection';
	public $description = 'Koleksi widget untuk modul collection';
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
			'field'   => 'collectiontype',
			'label'   => 'Type collection',
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
		)
	);
	
	public function form()
	{
		$this->load->model('collection/collection_categories_m');

		$categories = $this->collection_categories_m->get_all();
		$groups = array();
		$collectiontype=array('collection','Pilihan','Headline');
		$styles = array('JQ rotate','Standard Horizontal','Standard Vertical','JQ rotate collection','JQ red slider','JQ collection tricker','Standard Vertical with Next Article','Style Profile','Video Style','List Image And Title Vertical','1 article and image horizontal','Berita Style 1','Berita style 2','Berita Tab','kirim chripstory','berita style 3','Berita List Kanan','chirp vertical');
		$groups['0'] = '-- SEMUA KATEGORI --';
		foreach($categories as $group)
		{
			$groups[$group->id] = $group->title;
		}
		 
		 return array(
			'groups' => $groups ,
			'styles' => $styles,
			'collectiontype' => $collectiontype
		);
	}

	public function run($options)
	{
		$this->load->model('collection/collection_m');
		$catid=$options['group'];
		if(!empty($options['start_limits'])){$slimit=$options['start_limits'];}else{$slimit=0;}
		if(!empty($options['limits'])){$limit=$options['limits'];}else{$limit=4;}
		$params=array('catid'=>$catid,'limit'=>array($limit,$slimit),'collection_type' => !empty($options['collectiontype'])?$options['collectiontype']:"");
		$categories = $this->collection_m->get_all($params);
		
		return array('categories' => $categories);
	}
	
}