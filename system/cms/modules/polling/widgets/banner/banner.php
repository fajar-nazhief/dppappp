<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		RSS Feed Widget
 * @author			Phil Sturgeon - PyroCMS Development Team
 * 
 * Show RSS feeds in your site
 */

class Widget_Banner extends Widgets
{
	public $title = 'Aplikasi Polling';
	public $description = 'Menampilkan Polling';
	public $author = 'Doni Maulana';
	public $website = 'http://www.12tiga.com/';
	public $version = '1.0';
	public $fields = array(
		 
		array(
			'field'   => 'txtCat',
			'label'   => 'Category',
			'rules'   => 'required'
		),array(
			'field'   => 'txtStyle',
			'label'   => 'Style',
			'rules'   => 'required'
		) ,array(
			'field'   => 'txtLimit',
			'label'   => 'Limit',
			'rules'   => 'required'
		) ,array(
			'field'   => 'txtRotator',
			'label'   => 'Rotator',
			'rules'   => 'required'
		) ,array(
			'field'   => 'txtWidth',
			'label'   => 'Width',
			'rules'   => 'trim'
		) ,array(
			'field'   => 'txtHeight',
			'label'   => 'Height',
			'rules'   => 'trim'
		) 
	);
	
	public function form()
	{
		$this->load->model('polling/banner_categories_m');

		$dataCat = $this->banner_categories_m->order_by('title')->get_all();
		 
		$cat = array();
		if(!empty($dataCat)){
			foreach($dataCat as $data)
			{
				$cat[$data->id] = $data->title;
			}
		}
		
		 $style=array('vertical'=>'Vertical','horizontal' => 'Horizontal');
		 $rotator=array('yes'=>'Yes','no' => 'No');

		 return array(
			'category' => $cat,
			'style' => $style,
			'rotator' => $rotator
		);
	}
	
	public function run($options)
	{
		 $this->load->model('polling/banner_m');
		 
		 $params=array('limit' => array('0'=>$options['txtLimit'],'1'=>'0'),'category_id'=>$options['txtCat'],'simpan'=>'no');
		return array(
			'res' => $this->banner_m->getBanners($params) ,
			'category' => $options['txtCat']
			);
		 
	}
	
}