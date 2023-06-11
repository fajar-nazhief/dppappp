<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @package 		PyroCMS
 * @subpackage 		RSS Feed Widget
 * @author			Phil Sturgeon - PyroCMS Development Team
 * 
 * Show RSS feeds in your site
 */

class Widget_Banner_rotator extends Widgets
{
	public $title = 'Banner rotator for front page';
	public $description = 'Menampilkan Banner rotator';
	public $author = 'Doni Maulana';
	public $website = 'http://www.i2tiga.com/';
	public $version = '1.0';
	
	public function run($options)
	{
		$this->load->model('banner/banner_m');
		$params=array( 'category_id' => '2' ); 
		return array(
			'res' => $this->banner_m->getBanners($params) 
		);
	}
	
}