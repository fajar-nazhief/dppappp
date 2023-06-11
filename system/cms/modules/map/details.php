<?php  defined('BASEPATH') or exit('No direct script access allowed');

class Module_Map extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Google map',
				'nl' => 'Nieuws',
				'es' => 'Artículos',
				'fr' => 'Actualités',
				'de' => 'News',
				'pl' => 'Aktualności',
				'br' => 'Novidades',
				'zh' => '新聞',
				'it' => 'Notizie',
				'ru' => 'Новости',
				'ar' => 'الأخبار'
			),
			'description' => array(
				'en' => 'Post news articles and blog entries.',
				'nl' => 'Post nieuwsartikelen en blogs op uw site.',
				'es' => 'Escribe entradas para los artículos y blogs (web log).',
				'fr' => 'Envoyez de nouveaux articles et messages de blog.',
				'de' => 'Veröffentliche neue Artikel und Blog-Einträge',
				'pl' => 'Postuj nowe artykuły oraz wpisy w blogu',
				'br' => 'Poste novidades',
				'zh' => '發表新聞訊息、部落格文章。',
				'it' => 'Pubblica notizie e post per il blog.',
				'ru' => 'Управление новостными статьями и записями блога.',
				'ar' => 'أنشر مقالات الأخبار والمُدوّنات.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'skip_xss'	=> TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		 
			return FALSE;
		 
	}

	public function uninstall()
	{		
		 return FALSE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return FALSE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.";
	}
}

/* End of file details.php */
