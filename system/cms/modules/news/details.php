<?php  defined('BASEPATH') or exit('No direct script access allowed');

class Module_News extends Module {

	public $version = '2.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Berita',
				'ar' => 'المدوّنة',
				'el' => 'Ιστολόγιο',
				'pt' => 'News',
				'he' => 'בלוג',
				'lt' => 'Newsas',
				'ru' => 'Блог'
			),
			'description' => array(
				'en' => 'Post News entries.',
				'nl' => 'Post nieuwsartikelen en News op uw site.', #update translation
				'es' => 'Escribe entradas para los artículos y News (web log).', #update translation
				'fr' => 'Envoyez de nouveaux posts et messages de News.', #update translation
				'de' => 'Veröffentliche neue Artikel und News-Einträge', #update translation
				'pl' => 'Postuj nowe artykuły oraz wpisy w Newsu', #update translation
				'pt' => 'Escrever publicações de News',
				'zh' => '發表新聞訊息、部落格文章。', #update translation
				'it' => 'Pubblica notizie e post per il News.', #update translation
				'ru' => 'Управление записями блога.',
				'ar' => 'أنشر المقالات على مدوّنتك.',
				'cs' => 'Publikujte nové články a příspěvky na News.', #update translation
				'sl' => 'Objavite News prispevke',
				'fi' => 'Kirjoita uutisartikkeleita tai Newsi artikkeleita.', #update translation
				'el' => 'Δημιουργήστε άρθρα και εγγραφές στο ιστολόγιο σας.',
				'he' => 'ניהול בלוג',
				'lt' => 'Rašykite naujienas bei News\'o įrašus.'
			),
			'frontend'	=> TRUE,
			'backend'	=> TRUE,
			'skip_xss'	=> TRUE,
			'menu'		=> 'Publikasi',

			'roles' => array(
				'put_live', 'edit_live', 'delete_live'
			)
		);
	}

	public function install()
	{
		 return TRUE;
	}

	public function uninstall()
	{
		//it's a core module, lets keep it around
		return FALSE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		/**
		 * Either return a string containing help info
		 * return "Some help info";
		 *
		 * Or add a language/help_lang.php file and
		 * return TRUE;
		 *
		 * help_lang.php contents
		 * $lang['help_body'] = "Some help info";
		*/
		return TRUE;
	}
}

/* End of file details.php */
