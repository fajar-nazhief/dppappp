<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Event extends Module {

	public $version = '2.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Event',
				'ar' => 'المدوّنة',
				'el' => 'Ιστολόγιο',
				'pt' => 'Event',
				'he' => 'בלוג',
				'lt' => 'Blogas',
				'ru' => 'Блог'
			),
			'description' => array(
				'en' => 'Post Event entries.',
				'nl' => 'Post nieuwsartikelen en blog op uw site.', #update translation
				'es' => 'Escribe entradas para los artículos y blog (web log).', #update translation
				'fr' => 'Envoyez de nouveaux posts et messages de blog.', #update translation
				'de' => 'Veröffentliche neue Artikel und Blog-Einträge', #update translation
				'pl' => 'Postuj nowe artykuły oraz wpisy w blogu', #update translation
				'pt' => 'Escrever publicações de blog',
				'zh' => '發表新聞訊息、部落格文章。', #update translation
				'it' => 'Pubblica notizie e post per il blog.', #update translation
				'ru' => 'Управление записями блога.',
				'ar' => 'أنشر المقالات على مدوّنتك.',
				'cs' => 'Publikujte nové články a příspěvky na blog.', #update translation
				'sl' => 'Objavite blog prispevke',
				'fi' => 'Kirjoita uutisartikkeleita tai blogi artikkeleita.', #update translation
				'el' => 'Δημιουργήστε άρθρα και εγγραφές στο ιστολόγιο σας.',
				'he' => 'ניהול בלוג',
				'lt' => 'Rašykite naujienas bei blog\'o įrašus.'
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
		 

		if($this->db->query($blog_categories) && $this->db->query($blog))
		{
			return TRUE;
		}
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
