<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * News Plugin
 *
 * Create lists of articles
 *
 * @package		PyroCMS
 * @author		PyroCMS Dev Team
 * @copyright	Copyright (c) 2008 - 2010, PyroCMS
 *
 */
class Plugin_News extends Plugin
{
	/**
	 * News List
	 *
	 * Creates a list of news posts
	 *
	 * Usage:
	 * {pyro:news:posts limit="5"}
	 *	<h2>{pyro:title}</h2>
	 *	{pyro:body}
	 * {/pyro:news:posts}
	 *
	 * @param	array
	 * @return	array
	 */
	function posts($data = array())
	{
		$limit = $this->attribute('limit', 10);
		$category = $this->attribute('category');

		if ($category)
		{
			if (is_numeric($category))
			{
				$this->db->where('c.id', $category);
			}
			
			else
			{
				$this->db->where('c.slug', $category);
			}
		}
		
		return $this->db
			->where('status', 'live')
			->where('created_on <=', now())
			->limit($limit)
			->get('news')
			->result_array();
	}
	
	function artikel_terkait(){
		$slug=$this->uri->segment(4);
		if (!$slug or !$article = $this->news_m->get_by('slug', $slug))
		{
			return '';
		}else{
			if($article->category_id > 0)
				{
					$article->category = $this->news_categories_m->get( $article->category_id );
				}
		
			$news = $this->news_m->limit(5)->get_many_by(array(
				'category'=>$article->category->slug,
				'status' => 'live',
				'not_id' => $article->id
			));
			$display='<h3> Artikel Terkait </h3><ul style="margin-bottom:7px">';
			foreach($news as $data => $val){
				$display.='<li style="border-bottom:1px solid #dedede;padding:10px 10px;height:80px">
                        
                         <a href="'.base_url().'news/'.date('Y/m', $val->created_on) .'/'.$val->slug.'"><img   class="imageB" src="'.strip_image($val->body).'" alt="'.$val->title.'">'.$val->title.'</a> 
                         <p >'.$val->intro.'</p>
			 
                      </li>';
			}
			$display.='</ul>';
			return $display;
		}
	}
}

/* End of file plugin.php */