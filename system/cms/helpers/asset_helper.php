<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package		CodeIgniter
* @author		Rick Ellis
* @copyright	Copyright (c) 2006, pMachine, Inc.
* @license		http://www.codeignitor.com/user_guide/license.html
* @link			http://www.codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* Code Igniter Asset Helpers
*
* @package		CodeIgniter
* @subpackage	Helpers
* @category		Helpers
* @author       Philip Sturgeon < email@philsturgeon.co.uk >
*/

// ------------------------------------------------------------------------
function trim_image($str="",$foto=''){
	preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
	if(!empty($foto)){
		$def = $foto;
	}else{
		$def = base_url().'images/no-image-box.png';
	}
   return empty($image["src"])?$def:$image["src"];
	
   
}

function trim_banner($str=""){
	preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
	
   return empty($image["src"])?base_url().'images/bg-header-5.jpg':$image["src"];
	
   
}


function get_image($string=""){
	$matches = array(); 
preg_match_all('/<img[^>]*?\s+src\s*=\s*"([^"]+)"[^>]*?>/i', $string, $matches);
return $matches;
}

function get_file($string=""){
	$matches = array(); 
preg_match_all('/<a[^>]*?\s+href\s*=\s*"([^"]+)"[^>]*?>/i', $string, $matches);
return $matches;
}

function text_only($str=""){
	$content = preg_replace("/<img[^>]+\>/i", " ", $str); 
return  $content;
}

function css($asset_name, $module_name = NULL, $attributes = array())
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css($asset_name, $module_name, $attributes);
}

function firstname($id){
	$CI =& get_instance();
	$CI->db->set_dbprefix('default_');
	$res = $CI->db->where('user_id',$id)->get('profiles')->row();
	return $res->first_name;
}

function theme_css($asset, $attributes = array())
{
	return css($asset, '_theme_', $attributes);
}

function css_url($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css_url($asset_name, $module_name);
}

function css_path($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css_path($asset_name, $module_name);
}

// ------------------------------------------------------------------------


function image($asset_name, $module_name = NULL, $attributes = array())
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->image($asset_name, $module_name, $attributes);
}

function theme_image($asset, $attributes = array())
{
	return image($asset, '_theme_', $attributes);
}

function image_url($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->image_url($asset_name, $module_name);
}

function image_path($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->image_path($asset_name, $module_name);
}

// ------------------------------------------------------------------------


function js($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js($asset_name, $module_name);
}

function theme_js($asset)
{
	return js($asset, '_theme_');
}

function js_url($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js_url($asset_name, $module_name);
}

function js_path($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js_path($asset_name, $module_name);
}

function html2text($content=""){
	$content = preg_replace("/<img[^>]+\>/i", " ", $content); 
	
return ($content);
}

function strip_html_tags( $text )
{
	// PHP's strip_tags() function will remove tags, but it
	// doesn't remove scripts, styles, and other unwanted
	// invisible text between tags.  Also, as a prelude to
	// tokenizing the text, we need to insure that when
	// block-level tags (such as <p> or <div>) are removed,
	// neighboring words aren't joined.
	$text = preg_replace(
		array(
			// Remove invisible content
			'@<head[^>]*?>.*?</head>@siu',
			'@<style[^>]*?>.*?</style>@siu',
			'@<script[^>]*?.*?</script>@siu',
			'@<div[^>]*?.*?</div>@siu',
			'@<embed[^>]*?.*?</embed>@siu',
			'@<applet[^>]*?.*?</applet>@siu',
			'@<span[^>]*?.*?</span>@siu',
			'@<noscript[^>]*?.*?</noscript>@siu',
			'@<noembed[^>]*?.*?</noembed>@siu',

			// Add line breaks before & after blocks
			'@<((hr))@iu',
			'@</?((address)|(blockquote)|(center)|(del))@iu',
			'@</?((div)|(h[1-9])|(ins)|(isindex)|(pre))@iu',
			'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
			'@</?((table)|(th)|(td)|(caption))@iu',
			'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
			'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
			'@</?((frameset)|(frame)|(iframe))@iu',
		),
		array(
			' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
			"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
			"\n\$0", "\n\$0",
		),
		$text );
	 
	//$text = strip_tags($text, '<br>');
	// Remove all remaining tags and comments and return.
	return ( $text );
}

function cekImg($gravatar=""){
	 $firstImage = $_SERVER['DOCUMENT_ROOT'].'/pollings/uploads/Banner/'.$gravatar; // To grab the first image
	//$image_array = @getimagesize(SERVER_DIR.$firstImage);
	 
	
	if (file_exists($firstImage)) { 
		
		return base_url().'/uploads/Banner/'.$gravatar;
	 
	}else{
		return base_url().'/uploads/default/noimage.png';
	}
}

function strip_image($content=""){
	
	$contenttograbimagefrom = $content;
	$firstImage = "";
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
	//return $firstImage = @$ContentImages[1] [0]; // To grab the first image
        return $firstImage = ((@$ContentImages[1][0]=="")?base_url()."images/index.jpg":@$ContentImages[1][0]);
	//$image_array = @getimagesize(SERVER_DIR.$firstImage);
	 
}

function htmltotext($document){
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
);
$text = preg_replace($search, '', $document);
return $text;
} 

function strip_html($document=""){
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
);
$text = preg_replace($search, '', $document);
return $text;
}



function getID(){
	
	$CI =& get_instance();
	$CI->load->model('news/news_categories_m');
	$CI->load->model('news/news_m');
	 $CI->db = $CI->load->database('shared', TRUE);
		$id='';
		if($CI->uri->segment('1') == 'news' AND $CI->uri->segment('2') == 'category'){
			$slug=$CI->uri->segment('3');
			$article = $CI->db->where('show','1')->where('slug',$slug)->get('news_categories')->row();
			if(!empty($article))
			{
				$id=$article->id;
			}
			
		}if($CI->uri->segment('1') == 'news' AND $CI->uri->segment('2') <> 'category'){
			$slug=$CI->uri->segment('4');
			$article = $CI->news_m->get_by('slug', $slug);
			
			if(!empty($article))
			{
				 
				$id=$article->category_id;
			}
		}else{
			$slug='';
		}
		
		//print_r($article);
		 if(empty($id)){
				$slug=$CI->uri->segment('1');
				$cid=$CI->db->order_by('position','DESC')->where('show','1')->where('module_name',$slug)->get('news_categories')->row();
				if(!empty($cid)){
					//jika modul
					$id=$cid->id;
				}else{
					$slug=$CI->uri->segment('1');
			                $article = $CI->db->where('show','1')->where('slug',$slug)->get('news_categories')->row();
					if(!empty($article))
					{
						$id=$article->id;
					}
				}
				
			}
			
			
			return $id;
		$CI->db = $CI->load->database('live', TRUE);
	 }
	 
function getbuyut($id="",$level=""){
	$CI =& get_instance();
	$CI->load->model('news/news_categories_m');
	 $file_folders = $CI->news_categories_m->get_folders();
		$folders_tree = array();
		//echo '<pre>';
		//print_r($file_folders);
		$parent='';
		$buyut=array();
		foreach($file_folders as $folder)
		{
			if($folder->depth == $level){
				 $parent=$folder->id;
			}
			 
			 
				$buyut[$folder->id]=$parent;
			 
			
			//echo '<br>'.$folder->depth.'-->'.$folder->title.'=>'.$folder->id.' root:'.$folder->root_id;
			// $indent = repeater('&raquo; ', $folder->depth-1);
			//$folders_tree[$folder->id] = $indent . $folder->title;
		}
		 
		if(!empty($buyut[$id])){
			return $buyut[$id];
		}
		
}

function menu_level($id="",$level="",$ids=""){
	// echo $buyutid=getbuyut($id,4);
		 $CI =& get_instance();
		$CI->load->model('news/news_categories_m');
		$file_folders = $CI->news_categories_m->get_folders();
		$folders_tree = array(); 
		$parent='';
		$buyut=array();
		foreach($file_folders as $folder)
		{ 
				 $buyut[$folder->id]=$folder->depth;
		}
		 // $indent = repeater('&raquo; ', $folder->depth-1);
			if(!empty($buyut[$id])){
			return $buyut[$id];
			} 
}

function getmenu($id="",$level="",$ids=""){
	$CI =& get_instance();
	$CI->load->model('news/news_categories_m');
	$file_folders = $CI->news_categories_m->get_folders();
		$folders_tree = array();
		//echo '<pre>';
		//print_r($file_folders);
		$parent='';
		$buyut=array();
		foreach($file_folders as $folder)
		{
			if($folder->depth == ($level-1)){
				$parent=$folder->id;
			}
			//echo $parent;
			if($id == $parent and $folder->depth == $level){
				if($folder->show <> '0'){
				$buyut[$folder->id]['title']=$folder->title;//$buyut[$folder->id]=$parent;
				$buyut[$folder->id]['slug']=$folder->slug;
				$buyut[$folder->id]['uri']=$folder->uri;
				$buyut[$folder->id]['level']=$folder->depth;
				$buyut[$folder->id]['ids']=$folder->id;
				}
			}
			
			
		}
		
		return $buyut;
}

function bulan($bln=""){
		 
		switch ($bln) {
		case 1:
		    return 'Januari';
		    break;
		case 2:
		    return 'Februari';
		    break;
		case 3:
		    return 'Maret';
		    break;
		case 4:
		    return 'April';
		    break;
		case 5:
		    return 'Mei';
		    break;
		case 6:
		    return 'Juni';
		    break;
		case 7:
		    return 'Juli';
		    break;
		case 8:
		    return 'Agustus';
		    break;
		case 9:
		    return 'September';
		    break;
		case 10:
		    return 'Oktober';
		    break;
		case 11:
		    return 'November';
		    break;
		case 12:
		    return 'Desember';
		    break;
	    }
	}

	function bln(){
		$bulan=array(
				 '01' => 'January',
				 '02' => 'Februari',
				 '03' => 'Maret',
				 '04' => 'April',
				 '05' => 'Mei',
				 '06' => 'Juni',
				 '07' => 'July',
				 '08' => 'Agustus',
				 '09' => 'September',
				 '10' => 'Oktober',
				 '11' => 'November',
				 '12' => 'Desember' 
	
				 
				 );
		return $bulan;
	}
	
	function tgl(){
		
		for($i=1;$i<=31;$i++){
			$frm=str_pad($i,2,'0',STR_PAD_LEFT);
			$tgl[$frm]=$frm;
		}
		return $tgl;
	}
	
	function thn($awal="",$akhir=""){
		if($awal==''){
			$awal='2000';
		}
		
		if($akhir==''){
			$akhir=date('Y');
		}
		
		for($i=$awal;$i<=$akhir;$i++){
			$year[$i]=$i;
		}
		
		return $year;
	}
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
 
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
}

function hitunghari($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
 
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

   return $diff->days;
}

function timeAgo($time=""){
  $periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "yang lalu";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "";
   }

   return $difference.' '.$periods[$j].' '.$tense;
}

function days_in_month($bln="",$thn=""){
	return cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
}

function dmy($originalDate){ 
			return  $newDate = date("d-m-Y", strtotime($originalDate));
}

function cekAvatar($gravatar=""){
	if($gravatar){
	$FPATH=$_SERVER['DOCUMENT_ROOT'].'/web/uploads/komunitas_avatar/';
	$avatar=$FPATH.$gravatar;
			if (file_exists($avatar)) {
				 $avatar=base_url().'uploads/komunitas_avatar/'.$gravatar;
			    } else {
				$avatar=base_url().'uploads/komunitas_avatar/no_image.jpg';
			    }
	}else{
		$avatar=base_url().'uploads/komunitas_avatar/no_image.jpg';
	}
	 
	return $avatar;
}


function generate_form($forminput="",$dbdata=array(),$data=array()){
	 foreach($forminput as $frm_key => $frm_val){?> 
	<div class="form-group">
		<label class="col-lg-2 control-label"><?php echo $frm_val['label']?></label>
		<div class="col-lg-10">
			<?php if($frm_val['type'] == 'text' ){?>
		<?php echo form_input($frm_val['field'], @$dbdata->$frm_val['field'], 'maxlength="10" id="'.$frm_val['id'].'" class="text width-20 form-control"'); ?>
		<?php }?>
		<?php if($frm_val['type'] == 'texteditor' ){?>
		<?php echo form_textarea(array('id' => $frm_val['field'], 'name' => $frm_val['field'], 'value' => @$dbdata->$frm_val['field'], 'rows' => 5, 'class' => 'wysiwyg-advanced form-control')); ?>	
		<?php }?>
		<?php if($frm_val['type'] == 'datepicker' ){?>
		<?php echo form_input($frm_val['field'], date('Y-m-d'), 'maxlength="10" id="'.$frm_val['id'].'" class="text width-20 form-control"'); ?>	
		<?php }?>
		<?php if($frm_val['type'] == 'dropdown' ){
			
			 
			
			?>
		<?php echo form_dropdown('tdup_sumber', $data[$frm_val['field']], @$dbdata->$frm_val['field'],' class="form-control" id="'.$frm_val['id'].'"') ?>	
		<?php }?>
		</div> 
	</div>
	<?php } 
}

	function repairSerializeString($value)
{

    $regex = '/s:([0-9]+):"(.*?)"/';

    return preg_replace_callback(
        $regex, function($match) {
            return "s:".mb_strlen($match[2]).":\"".$match[2]."\""; 
        },
        $value
    );
				}

function data_enum($table , $field){
	$obj =& get_instance();
	$query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
	 $row = $obj->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;  
	 $regex = "/'(.*?)'/";
			preg_match_all( $regex , $row, $enum_array );
			$enum_fields = $enum_array[1];
			foreach ($enum_fields as $key=>$value)
			{
				$enums[$value] = $value; 
			}
			return $enums;
}

function cek(){
	echo 'asdasd';exit;
}

function bahasa(){
	if((!isset($_SESSION['bahasa']))){ 
		 
		$_SESSION['bahasa']='ind'; 
		}
}
function url_img($body){
	$img=trim_image($body);
	$img_arr=explode('/',$img);
	 
	if($img_arr[1]=='2017'){
	$img='http://jakarta-tourism.go.id'.$img;
	} 
	return $img;
}

function only_img($body){
	$img=($body);
	$img_arr=explode('/',$img);
	 
	if($img_arr[1]=='2017'){
	$img='http://jakarta-tourism.go.id'.$img;
	} 
	return $img;
}
function upload_data($folder=""){
	$obj =& get_instance();
	 $path = '../srv-5/'.$folder.'/' ;
	 
	$obj->load->library('upload', array(
			'upload_path'	=> $path,
			'allowed_types'	=> 'bmp|gif|jpeg|jpg|jpe|png|pdf|doc|xls|xlsx|pdf'
		));

	if($_FILES['userfile']['name'][0]){
			 
		$filecount=count($_FILES['userfile']['name']);
		
		
	   for($i=0; $i<$filecount; $i++){
		   $_FILES['mediaelement']['name']=$_FILES['userfile']['name'][$i];
		   $_FILES['mediaelement']['type']=$_FILES['userfile']['type'][$i];
		   $_FILES['mediaelement']['tmp_name']=$_FILES['userfile']['tmp_name'][$i];
		   $_FILES['mediaelement']['error']=$_FILES['userfile']['error'][$i];
		   $_FILES['mediaelement']['size']=$_FILES['userfile']['size'][$i];

		
		   $imageuploaderres[]=$obj->upload->do_upload('mediaelement');
		   $file = $obj->upload->data(); 
		   $ff[$i]['name']=$file['file_name']; 
	   }
	   return $ff;
	}

	return false;
}