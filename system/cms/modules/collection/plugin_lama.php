<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * collection Plugin
 *
 * Create lists of articles
 *
 * @package		PyroCMS
 * @author		PyroCMS Dev Team
 * @copyright	Copyright (c) 2008 - 2010, PyroCMS
 *
 */
class Plugin_collection extends Plugin
{
	/**
	 * collection List
	 *
	 * Creates a list of collection posts
	 *
	 * Usage:
	 * {pyro:collection:posts limit="5"}
	 *	<h2>{pyro:title}</h2>
	 *	{pyro:body}
	 * {/pyro:collection:posts}
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
			->get('collection')
			->result_array();
	}
	
	function artikel_terkait(){
		$slug=$this->uri->segment(4);
		if (!$slug or !$article = $this->collection_m->get_by('slug', $slug))
		{
			return '';
		}else{
			if($article->category_id > 0)
				{
					$article->category = $this->collection_categories_m->get( $article->category_id );
				}
		
			$collection = $this->collection_m->limit(5)->get_many_by(array(
				'category'=>$article->category->slug,
				'status' => 'live',
				'not_id' => $article->id
			));
			$display='<h3> Artikel Terkait </h3><ul style="margin-bottom:7px">';
			foreach($collection as $data => $val){
				$display.='<li style="border-bottom:1px solid #dedede;padding:10px 10px;height:80px">
                        
                         <a href="'.base_url().'collection/'.date('Y/m', $val->created_on) .'/'.$val->slug.'"><img   class="imageB" src="'.strip_image($val->body).'" alt="'.$val->title.'">'.$val->title.'</a> 
                         <p >'.$val->intro.'</p>
			 
                      </li>';
			}
			$display.='</ul>';
			return $display;
		}
	}
}

/* End of file plugin.php */