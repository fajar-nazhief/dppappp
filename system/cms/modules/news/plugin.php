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
		$this->load->model('news/news_m');
		if (!$slug or !$article = $this->news_m->get_by('slug', $slug))
		{
			return '';
		}else{
			 
			 
			$key=explode(',',$article->keyword);
			 
			$key=explode(',',$article->keyword);
			$words='';
			foreach($key as $datakey){
				//echo $datakey;
				$words.="OR keyword LIKE '%".$datakey."%' AND created_on <= '".now()."' AND `default_news`.`id` <> '".$article->id."'";
				//$this->db->or_like('keyword',$datakey);
				//$this->db->where('CONCAT(berita.date," ",SUBSTRING(berita.tgl,-5),":","00") <= ',date('Y-m-d H:i:s'));
				
			}
			
			$qq="SELECT * FROM (default_news) WHERE `default_news`.`id` <> '".$article->id."' AND `status` = 'live' AND created_on < '".now()."' AND keyword LIKE '%".$article->keyword."%'  ".$words." ORDER BY default_news.id DESC LIMIT 5";
			$query =$this->db->query($qq);
		        $news=$query->result();
			
			if(($news)){
			$display='<div class="widget">
					<h3 class="title"> Kategori Berita  </h3>
					<div class="padder"> 
					 
					<div style="">

			<ul style="margin-bottom:7px">';
			foreach($news as $data => $val){
				$display.='<li style="border-bottom:1px solid #dedede;padding:10px 10px;height:auto">
                        <table>
			<tr>
			<td>
                         <a href="'.base_url().'news/'.date('Y/m', $val->created_on) .'/'.$val->slug.'"><img   src="'.strip_image($val->body).'" alt="'.$val->title.'" width="35px"></a>
			 </td>
			 <td>
                        <a href="'.base_url().'news/'.date('Y/m', $val->created_on) .'/'.$val->slug.'"><b>'.$val->title.'</b></a>
			 </td>
			 </tr>
			 </table>
                         
			 
                      </li>';
			}
			$display.='</ul></div></div></div>';
			return $display;
			}
		}
	}
	
	function galeri_terkait(){
		$this->load->model('news/news_m');
		$category_id = $this->news_m->get_where('news_categories',array('id'=>$this->attribute('group')))->row();
		 
		if(($category_id)){
		$folder_slug=$category_id->folder_id;
		
		$folder=$this->news_m->get_where('file_folders',array('slug'=>$folder_slug,'parent_id' => 1))->row();
		if(($folder)){
		$folder_id=$folder->id;
		$files=$this->news_m->select('files.id as id,galleries.slug,gallery_images.id as fid')->join('galleries','galleries.folder_id = files.folder_id')->join('gallery_images','gallery_images.file_id = files.id')->get_where('files',array('files.folder_id'=>$folder_id,'files.youtube'=>'0'))->result();
		$galeri='<div class="widget">
					<h3 class="title"> Galeri Terkait </h3>
					<div class="padder"> 
					 
					<div style="">
					 ';
		if(($files)){
			 
			$galeri.='<div style="padding:5px 0px;text-align:left;">';
			 
			foreach($files as $data => $val){
				
			$galeri.='<a href="'.base_url().'galleries/'.$val->slug.'/'.$val->fid.'"><img class="" src="'.base_url().'files/thumb/'.$val->id.'" width="65px" style="border:1px solid #dedede;padding:2px 0px;margin:5px 5px">';
			
			}
			 
			$galeri.='</div>';
			 
		}else{
			$galeri .='Belum Ada Galeri Terkait';
		}
		
		return $galeri.='</div></div></div>';
		}
		}
	}
	
	function galeri_artikel(){ 
		 
		$files=$this->news_m->select('files.id as id ,galleries.slug,gallery_images.id as fid')->join('galleries','galleries.folder_id = files.folder_id')->join('gallery_images','gallery_images.file_id = files.id')->get_where('files',array('files.news_id'=>$this->attribute('news_id'),'files.youtube'=>'0'))->result();
		$galeri='';
		if(($files)){
			$vid='Foto Untuk Artikel Ini';
			if($this->uri->segment('1') == 'news' && $this->uri->segment('2') == 'category'){
				$vid='Foto Terbaru';
			} 
			$galeri.='<div class="widget">
					<h3 class="title">'.$vid.' </h3>
					<div class="padder"> 
					 
					<div style="">';
			$galeri.='<div style="padding:10px 0px;text-align:left;">';
			foreach($files as $data => $val){
				
			$galeri.='<a href="'.base_url().'galleries/'.$val->slug.'/'.$val->fid.'"><img class="" src="'.base_url().'files/thumb/'.$val->id.'" width="50px" style="border:1px solid #dedede;padding:2px 0px;margin:5px 5px;">';
			
			}
			$galeri.='</div></div></div></div>';
			return $galeri;
		} 
		
		
		 
	}
	 
	
	function twitterland_profile(){
		
		if(($_SESSION['twittero'])){
			$nama=$_SESSION['twittero']->screen_name;
			
			$chrp= $this->db
			->select('count(id) as jml,createdby')
			->where('createdby', $nama) 
			->get('news')
			->row();
			 
		}
		
		if(($nama)){
		
		$data=json_decode(@file_get_contents('https://api.twitter.com/1/users/show.json?screen_name='.$nama.'&include_entities=true'),true);
		
		if(($data)){
			//echo $data['screen_name'];
			
			$res='<style>.avatar {
				border-radius: 5px 5px 5px 5px;
				height: 48px;
				width: 48px;
			    }				</style>';
			$res.='<div class="widget">
					<h3 class="title"> Twittlander </h3>
					<div class="padder">  
					<div style="">';
			$res.='<table><tr>';
			$res.='<td><img class="avatar" src="'.$data['profile_image_url'].'"></td>';
			$res.='<td><b><a href="'.base_url().'file/'.$data['screen_name'].'">'.$data['name'].'</a></b> @'.$data['screen_name'].' 
				<br><span class="address" style="font-size: 10px;"><a href="'.base_url().'file/'.$data['screen_name'].'">'.base_url().'file/'.$data['screen_name'].'</a></span>
			</td>
			</tr>';
			$res.='<table style="margin-top:10px;width:100%">
			<tr>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			<a href="'.base_url().'file/'.$data['screen_name'].'">FILES</a><br>
			<b><a href="'.base_url().'file/'.$data['screen_name'].'">'.$chrp->jml.'</a></b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			TWEETS<br>
			<b>'.$data['statuses_count'].'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			FOLLOWING<br>
			<b>'.$data['friends_count'].'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede">
			FOLLOWER<br>
			<b>'.$data['followers_count'].'</b>
			</td>
			</tr>
			</table>';
			$res.='</table></div></div></div>';
			return $res;
		}
		}
		 
	 }
	 
	 function twitterland_profile_vertical(){
		 
		if($this->uri->segment('2') == 'category' AND $this->uri->segment('1') <> 'news'){
			$nama=$_SESSION['namablog'];
		}
		if($this->uri->segment('2') == 'page' AND $this->uri->segment('1') <> 'news'){
			$nama=$_SESSION['namablog'];
		}
		if($this->uri->segment('2') == 'penulis' AND $this->uri->segment('1') == 'news'){
			$nama=$_SESSION['namablog'];
		}
		
		 
		
		if(($nama)){
		
		$data=json_decode(@file_get_contents('https://api.twitter.com/1/users/show.json?screen_name='.$nama.'&include_entities=true'),true);
		
		if(($data['screen_name'])){
			$chrp= $this->db
			->select('count(id) as jml,createdby')
			->where('intro_en', $nama) 
			->get('news')
			->row();
			//echo $data['screen_name'];
			
			$res='<style>.avatar {
				border-radius: 5px 5px 5px 5px;
				height: 48px;
				width: 48px;
			    }				</style>';
			$res.='<div class="widget" id="featured">
					<h3 class="title">Twittlander &raquo; <a href="'.base_url().'twittlander/page/'.$data['screen_name'].'">'.$data['name'].' </a> <span style="float:right"><a href="https://twitter.com/intent/user?screen_name='.$data['screen_name'].'"><button class="btn btn-success" type="button">Follow</button></a> <a href="https://twitter.com/intent/tweet?text=%40'.$data['screen_name'].'"><button class="btn btn-info" type="button">Colek</button> </a></span> </h3>
					<div>
					 <!-- NEWS CONTENT -->
						<div class="tab_container">
							<div style="padding:20px"> 
				<div class="news_article">';
			$res.='<table><tr>';
			$res.='<td><img class="avatar" src="'.$data['profile_image_url'].'"></td>';
			$res.='<td><a href="'.base_url().'twittlander/page/'.$data['screen_name'].'"><b>'.$data['name'].'</b></a> @'.$data['screen_name'].'
			<div style="font-size:12px">'.$data['description'].'</div>
			<table style="margin-top:10px;width:100%">
			<tr>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			<a href="'.base_url().'twittlander/page/'.$data['screen_name'].'">FILES<br></a>
			<b>'.$chrp->jml.'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			TWEETS<br>
			<b>'.$data['statuses_count'].'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			FOLLOWING<br>
			<b>'.$data['friends_count'].'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede">
			FOLLOWER<br>
			<b>'.$data['followers_count'].'</b>
			</td>
			</tr>
			</table>
			</td>
			</tr>';
			$res.='</table></div></div></div></div></div>';
			return $res;
		}
		}
		 
	 }
	 
	 function twitterland_profile_vertical_blog(){
		$dipsoting=" Twittlander";
		if(($_SESSION['namablog'])){
		if($this->uri->segment('2') == 'category_blog'){
			$nama=$_SESSION['namablog'];
		}
		if($this->uri->segment('2') == 'blog'){
			$nama=$_SESSION['namablog'];
		}
		if($this->uri->segment('1') == 'file'){
			$nama=$_SESSION['namablog'];
		}
		if($this->uri->segment('1') == 'news' and $this->uri->segment('2') <> 'penulis'){
			$nama=$_SESSION['namablog'];
			$dipsoting=" Di posting oleh ";
		}
		 
		
		if(($nama)){
		
		$data=json_decode(@file_get_contents('https://api.twitter.com/1/users/show.json?screen_name='.$nama.'&include_entities=true'),true);
		
		if(($data['screen_name'])){
			$chrp= $this->db
			->select('count(id) as jml,createdby')
			->where('createdby', $nama)
			->or_where('intro_en',$nama)
			->get('news')
			->row();
			//echo $data['screen_name'];
			
			$res='<style>.avatar {
				border-radius: 5px 5px 5px 5px;
				height: 48px;
				width: 48px;
			    }				</style>';
			$res.='<div class="widget" id="featured">
					<h3 class="title">'.$dipsoting.' &raquo; <a href="'.base_url().'file/'.$data['screen_name'].'">'.$data['name'].' </a> <span style="float:right;padding-top:5px;height:20px"> <a href="https://twitter.com/intent/user?screen_name='.$data['screen_name'].'"  class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="large">Follow</a> <a href="https://twitter.com/intent/tweet?text=%40'.$data['screen_name'].'" class="twitter-share-button" data-related="twittlandcom" data-lang="en" data-size="large" data-count="none">Tweet</a></span> </h3>
					<div>
					 <!-- NEWS CONTENT -->
						<div class="tab_container">
							<div style="padding:20px"> 
				<div class="news_article">';
			$res.='<table><tr>';
			$res.='<td><img class="avatar" src="'.$data['profile_image_url'].'"></td>';
			$res.='<td><a href="'.base_url().'file/'.$data['screen_name'].'"><b>'.$data['name'].'</b></a> @'.$data['screen_name'].'
			<div style="font-size:12px">'.$data['description'].'</div>
			<table style="margin-top:10px;width:100%">
			<tr>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			<a href="'.base_url().'file/'.$data['screen_name'].'">FILES<br></a>
			<b>'.$chrp->jml.'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			TWEETS<br>
			<b>'.$data['statuses_count'].'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede;border-right:1px solid #dedede">
			FOLLOWING<br>
			<b>'.$data['friends_count'].'</b>
			</td>
			<td style="text-align:center;padding:5px;border-top:1px solid #dedede">
			FOLLOWER<br>
			<b>'.$data['followers_count'].'</b>
			</td>
			</tr>
			</table>
			</td>
			</tr>';
			$res.='</table></div></div></div></div></div>';
			return $res;
		}
		}
		}
		 
	 }
	 
	 function video_artikel(){ 
		 
		$files=$this->news_m->select('files.id as id ,files.youtube,galleries.slug,gallery_images.id as fid')->join('galleries','galleries.folder_id = files.folder_id')->join('gallery_images','gallery_images.file_id = files.id')->get_where('files',array('files.news_id'=>$this->attribute('news_id'),'files.youtube <>'=>'0'))->result();
		$galeri='';
		$vid='';
		if($this->uri->segment('1') == 'news' && $this->uri->segment('2') == 'category'){
			$vid='';
		} 
		if(($files)){
			//$galeri.='<h3> '.$vid.'</h3>';
			$galeri.='<div class="widget">
					<h3 class="title"> Artikel Terkait </h3>
					<div class="padder"> 
					 
					<div style="text-align:center;padding-top:10px">';
			$count=0;
			foreach($files as $data => $val){
				++$count;
				if($count == '1'){
					$galeri.='<iframe width="250" height="200" src="http://www.youtube.com/embed/'.$val->youtube.'" frameborder="0" allowfullscreen></iframe>';
				}
				
			//$galeri.='<a href="'.base_url().'galleries/'.$val->slug.'/'.$val->fid.'" ><img class="" src="'.base_url().'files/thumb/'.$val->id.'" width="50px" style="border:1px solid #dedede;padding:2px 0px;margin:5px 5px;">';
			
			}
			$galeri.='</div></div></div>';
			return $galeri;
		} 
		
		
		 
	}
	
	function getID(){
		$id='';
		if($this->uri->segment('1') == 'news' AND $this->uri->segment('2') == 'category'){
			$slug=$this->uri->segment('3');
			$article = $this->db->where('show','1')->where('slug',$slug)->get('news_categories')->row();
			if(($article))
			{
				$id=$article->id;
			}
			
		}if($this->uri->segment('1') == 'news' AND $this->uri->segment('2') <> 'category'){
			$slug=$this->uri->segment('4');
			$article = $this->news_m->get_by('slug', $slug);
			
			if(($article))
			{
				 
				$id=$article->category_id;
			}
		}else{
			$slug='';
		}
		
		//print_r($article);
		 if((empty($id)) AND $this->uri->segment('1')<>''){
				$slug=$this->uri->segment('1');
				$cid=$this->db->order_by('position','DESC')->where('show','1')->where('module_name',$slug)->get('news_categories')->row();
				if(($cid)){
					//jika modul
					$id=$cid->id;
				}else{
					$slug=$this->uri->segment('1');
			                $article = $this->db->where('show','1')->where('slug',$slug)->get('news_categories')->row();
					if(($article))
					{
						$id=$article->id;
					}
				}
				
			}
			
			
			return $id;
	 }
	 
	function menu_level(){
	        $id=$this->getID();
		 
		$level=intval($this->attribute('level'));
		 
		
		
		switch($level)
		{
			case '2':
				return $this->menu_level2($id,$level);
			break;
			case 'side':
				 
				return $this->menu_level_samping($id,$level);
				//$this->delete();
			break;
			case '4' :
				return $this->menu_level3($id,$level-1);
			break;
			case '5' :
				return $this->menu_level4($id,$level-1);
			break;
			 
		}
	        
		
	 }
	 
	 function menu_level3($id="",$level=""){
		 $id=intval($id);
		 $lvl=menu_level($id);
		 
		if($lvl == 3){
		 
		$idparent=$this->db->where('id',intval($id))->get('news_categories')->row();
		if(($idparent)){
		$idM=$idparent->navigation_group_id;
		$ids=$id;
		 
		} 
		}
		if($lvl >= 4)
		{
			
		$idparent=$this->db->where('id',intval($id))->get('news_categories')->row();
		if(($idparent)){
		 $ids=$idparent=$idparent->navigation_group_id; 
		 $DM=$this->db->where('id',intval($idparent))->get('news_categories')->row();
		 $idM=$DM->navigation_group_id;
		 
		}
			
		}
	        
		$datamenu='';
		
		if(($idM)){
			 
		 
		$datamenu=getmenu($idM,$level,$ids);
		}
		 
		 
		 
		
		if(($datamenu)){
			
			$menu='          <div id="content" style="border-bottom:1px solid #dddddd;height:37px;margin-bottom:10px"> <ul class="nav nav-tabs" id="myTab">';
			$i=0;
			foreach($datamenu as $dat => $val){
				$active='';
				
				if($ids == $val['ids']){
					$active='active';
				}
				if(($val['uri'])){
					// echo $this->del_link;
					$url=str_replace($this->del_link,base_url(),$val['uri']);
				}else{
					$url=base_url().'news/category/'.$val['slug'];
				}
				
				if($i == 4){
						$menu.='<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"> <b>Lainnya</b> </a>
							<ul class="dropdown-menu">';
					}
				if($i <= 3){
					$menu.='<li class="'.$active.'"><a href="'.$url.'"><b>'.$val['title'].'</b></a></li>';
					
					
				}else{
					$menu.=' <li><a data-toggle="tab" href="#" onclick="window.location.href=\''.$url.'\'">'.$val['title'].'</a></li>';
				}
				++$i;
				
			}
			if($i >= 4){
			 $menu.=' 
				</ul>
			      </li>';
			}
			 $menu.='</ul></div><div class="clear"></div>';
			 
			 return $menu;
		}
     
   
		
	 }
	 
	 function menu_level3_ASLI($id="",$level=""){
		 $id=intval($id);
		 $lvl=menu_level($id);
		if($lvl == 4){
		$idparent=$this->db->where('id',intval($id))->get('news_categories')->row();
		if(($idparent)){
		$idM=$idparent->navigation_group_id;
		$ids=$id;
		 
		}
		}
		if($lvl == 3){
		 
		$idM=$id;
		$ids=''; 
		}
		if($lvl > 4)
		{
			
		$idparent=$this->db->where('id',intval($id))->get('news_categories')->row();
		if(($idparent)){
		 $ids=$idparent=$idparent->navigation_group_id; 
		 $DM=$this->db->where('id',intval($idparent))->get('news_categories')->row();
		 $idM=$DM->navigation_group_id;
		 
		}
			
		}
	        
		$datamenu='';
		
		if(($idM)){
			 
		 
		$datamenu=getmenu($idM,($level+1),$ids);
		}
		 
		 
		 
		
		if(($datamenu)){
			
			$menu='          <div id="content" style="border-bottom:1px solid #dddddd;height:37px;margin-bottom:10px"> <ul class="nav nav-tabs" id="myTab">';
			$i=0;
			foreach($datamenu as $dat => $val){
				$active='';
				
				if($ids == $val['ids']){
					$active='active';
				}
				if(($val['uri'])){
					$url=$val['uri'];
				}else{
					$url=base_url().'news/category/'.$val['slug'];
				}
				
				if($i <= 3){
					$menu.='<li class="'.$active.'"><a href="'.$url.'"><b>'.$val['title'].'</b></a></li>';
					if($i == 3){
						$menu.='<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"> <b>Lainnya</b> </a>
							<ul class="dropdown-menu">';
					}
					
				}else{
					$menu.=' <li><a data-toggle="tab" href="#" onclick="window.location.href=\''.$url.'\'">'.$val['title'].'</a></li>';
				}
				++$i;
				
			}
			if($i >= 3){
			 $menu.=' 
				</ul>
			      </li>';
			}
			 $menu.='</ul></div>';
			 
			 return $menu;
		}
     
   
		
	 }
	 
	  function menu_level4($id="",$level=""){
		 $id=intval($id);
		 $lvl=menu_level($id);
		if($lvl == 4){
		$idparent=$this->db->where('id',intval($id))->get('news_categories')->row();
		if(($idparent)){
		$idM=$idparent->navigation_group_id;
		$ids=$id;
		 
		}
		}
		if($lvl == 3){
		 
		$idM=$id;
		$ids=''; 
		}
		if($lvl > 4)
		{
			
		$idparent=$this->db->where('id',intval($id))->get('news_categories')->row();
		if(($idparent)){
		 $ids=$idparent=$idparent->navigation_group_id; 
		 $DM=$this->db->where('id',intval($idparent))->get('news_categories')->row();
		 $idM=$DM->navigation_group_id;
		 
		}
			
		}
	        
		$datamenu=''; 
		if(($idM)){
			 
		 
		$datamenu=getmenu($idM,($level),$ids);
		}
		 
		 //print_r($datamenu);
		if(($datamenu)){
			$i=0;
			$ul='';
			$menu='           <div class="btn-toolbar"> ';
			foreach($datamenu as $dat => $val){
				$active='';
				$id='class="btn btn-info"';
				if($ids == $val['ids']){
					$active='class="active"';
					$id='class="btn"';
				}
				if(($val['uri'])){
					$url=str_replace($this->del_link,base_url(),$val['uri']);
					//$url=$val['uri'];
				}else{
					$url=base_url().'news/category/'.$val['slug'];
				}
				if($i < 4){
				$menu.=' <div class="btn-group"><a  '.$id.' href="'.$url.'" style="font-size:11px">'.$val['title'].'</a></div> ';
				}
				if($i == 4){
				$menu.=' <div class="btn-group"><a  class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" style="font-size:11px">Lainnya</a> ';
				$menu.='<ul class="dropdown-menu"><li>'.' <a  href="'.$url.'" style="font-size:11px">'.$val['title'].'</a> '.'</li>';
				$ul='</ul></div>';
				}
				
				if($i>=5){
					$menu.=' <li><a href="'.$url.'" style="font-size:11px">'.$val['title'].'</a> </li>';
				}
				++$i;
			}
			 $menu.=$ul;
			 $menu.=' </div>';
			 
			 return $menu;
		}
     
   
		
	 }
	 
	 function menu_level4_ASLI($id="",$level=""){
		$lvl=menu_level($id);
		if($lvl == 5){
			$idparent=$this->db->where('id',$id)->get('news_categories')->row();
			if(($idparent)){
			$ids=$id; 
			$idparent=$idparent->navigation_group_id; 
			 
			}
		}
		if($lvl == 4){
			$idparent=$this->db->where('id',$id)->get('news_categories')->row();
			if(($idparent)){
			$idparent=$idparent->id; 
			 $ids=''; 
			}
		}
		  if(($idparent)){
	         
			$datamenu=getmenu($idparent,($level+1),$ids);
		  }
		 
		 
		if(($datamenu)){
			
			$menu='           <div id="content"><ul  class="nav nav-pills">';
			foreach($datamenu as $dat => $val){
				$active='';
				$id='id="menu4"';
				if($ids == $val['ids']){
					$active='class="active"';
					$id='';
				}
				if(($val['uri'])){
					$url=$val['uri'];
				}else{
					$url=base_url().'news/category/'.$val['slug'];
				}
				$menu.='<li '.$active.'><a '.$id.' href="'.$url.'"><b>'.$val['title'].'</b></a></li>';
			}
			 
			 $menu.='</ul></div>';
			 
			 return $menu;
		}
     
   
		
	 }
	 
	
	function menu_level_samping($id="",$lvl=""){  
		$id=$this->getID();
	        $buyutid=getbuyut($id,1);
		$datamenu=getmenu($buyutid,2,$id);
		$menu='<div>';
		$i=0;//print_r($datamenu);
		if(($datamenu)){
			foreach($datamenu as $dat => $val){
				$url=$val['slug'];
				
				if(($val['uri'])){
					//$url=base_url().uri_string($val['uri']);
					//$url=$val['uri'];
					$url=str_replace($this->del_link,base_url(),$val['uri']);
				}else{
				$url=base_url().'news/category/'.$val['slug'];
				}
				
				++$i;
				$SUBMENU=$this->submenu($dat,$i,$id);
			$menu.=' 
				<span style="padding-right:10px">';
				if($SUBMENU){
					$menu.='<a   style="color:#555555;text-shadow: 0 1px 0 #fff;" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$i.'">
						<b>'.$val['title'].'</b>
						</a>
						 ';
				}else{
					$menu.='<a    style="color:#555555;text-shadow: 0 1px 0 #fff;" data-parent="#accordion2" href="'.$url.'">
						<b>'.$val['title'].'</b>
						</a>
						 ';
				}
			
			$menu.=$SUBMENU;//$this->submenu($dat,$i);
			
			$menu.='</span>';
				 //$menu.='<b><a href="'.base_url().'news/category/'.$url.'">'.$val['slug'].'</a></b> &nbsp;';
				
			}	
		}
		$menu.='</div>';
		
		return $menu;
	 }
	 
	 function submenu($id="",$i="",$ids=""){
		$buyutid=getbuyut($ids,2);
		$this->load->model('news/news_categories_m');
		$categories = $this->db->where('navigation_group_id',$id)->where('show','1')->order_by('position','ASC')->get('news_categories')->result();
		if(($categories)){
			
			$in='';
			if($id == $buyutid){
					$in=' in';
				}
				$menu='<div id="collapse'.$i.'" class="accordion-body collapse'.$in.'">
				<div class="accordion-inner">
				 ';
			foreach($categories as $data => $val){
				if(($val->uri)){ 
					//$url=$val->uri;
					//$url=$url;
					$url=str_replace($this->del_link,base_url(),$val->uri);
				}else{
					$url=base_url().'news/category/'.$val->slug;
				}
				
				
				
				$menu.=' 
				 <div style="border-bottom:1px solid #dedede;padding:5px 0px 5px">&nbsp;<i class="fam-bullet-blue"></i> <a href="'.$url.'" style="color:#000">'.$val->title.'</a></div>
				';
				
			}
			$menu.='</div>
			</div>';
			return $menu;
		}
	 }
	 
	 
	 function menu_level2($id="",$lvl=""){  
		
	        $buyutid=getbuyut($id);
		$datamenu=getmenu($buyutid,$lvl,$id);
		$menu='';
		if(($datamenu)){
			foreach($datamenu as $dat => $val){
				$url=$val['slug'];
				if(($val['uri'])){
				$url=$val['uri'];
				}
				 $menu.='<b><a href="'.base_url().'news/category/'.$url.'">'.$val['slug'].'</a></b> &nbsp;';
				
			}	
		}
		
		return $menu;
	 }
}

/* End of file plugin.php */