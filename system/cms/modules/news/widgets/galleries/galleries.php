 <?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		Category Menu Widget
 * @author			Stephen Cozart
 * 
 * Show a list of news categories.
 */

class Widget_Galleries extends Widgets
{
	public $title = 'Galleries pilihan';
	public $description = 'Menampilkan Foto Gallery';
	public $author = 'Doni Maulana';
	public $website = 'http://suara-jakarta.com';
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
		),array(
			'field'   => 'width',
			'label'   => 'Width',
			'rules'   => 'trim'
		),array(
			'field'   => 'height',
			'label'   => 'Height',
			'rules'   => 'trim'
		)
	);
	
	public function form()
	{
		$this->load->model('galleries/galleries_m');

		$categories = $this->db->get('galleries')->result();
		$groups = array();
		$newstype=array('Normal','Pilihan','Terpopuler','Video');
		$styles = array('Pilihan Editor','slider');
		$groups['0']='-- Pilih Semua Category --';
		foreach($categories as $group)
		{
			$groups[$group->folder_id] = $group->title;
		}
		 
		 return array(
			'groups' => $groups ,
			'styles' => $styles,
			'newstype' => $newstype
		);
	}

	public function run($options)
	{
		 
		 $this->load->model('galleries/gallery_images_m');
		$catid=$options['group']; 
		if(($options['limits'])){$limit=$options['limits'];}else{$limit=4;}
		 
		($catid)?$category=array('files.folder_id'=>$catid):$category=array();
		if($options['newstype'] == '1'){
			$categories = $this->db->select('files.description,files.filename,galleries.slug,galleries.id as gid,files.id as id,gallery_images.id as fid')->join('galleries','galleries.folder_id = files.folder_id')->join('gallery_images','gallery_images.file_id = files.id')->limit($limit)->order_by('files.id','DESC')->get_where('files',$category+array('files.youtube'=>'0'))->result();
		}
		
		if($options['newstype'] == '3'){
			$categories = $this->db->select('files.description,files.filename,galleries.slug,galleries.id as gid,files.id as id,gallery_images.id as fid')->join('galleries','galleries.folder_id = files.folder_id')->join('gallery_images','gallery_images.file_id = files.id')->limit($limit)->order_by('files.id','DESC')->get_where('files',$category+array('files.youtube <> '=>'0'))->result();
		}else{
			$categories = $this->db->select('files.description,files.filename,galleries.slug,galleries.id as gid,files.id as id,gallery_images.id as fid')->join('galleries','galleries.folder_id = files.folder_id')->join('gallery_images','gallery_images.file_id = files.id')->limit($limit)->order_by('files.id','DESC')->get_where('files',$category+array('files.youtube'=>'0'))->result();
		}
		
		
		return array('categories' => $categories);
	}
	
}