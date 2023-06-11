<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 include('db.php');

$rss=get_web_page('http://www.merdeka.com/feed/'); 
    $rrss=$rss['content'];
    $htmlrss = str_get_html($rrss);
    $feed = simplexml_load_string($htmlrss);
     
    //$insert='INSERT INTO default_news VALUES '; 
foreach($feed->channel->item as $ul => $res) {
     //echo '<pre>';
     //print_r($res);
        $url=$res->link ;
        $date=strtotime($res->pubdate) ;
	$date1=date("d-m-Y",$date);
	$date2=strtotime(date('d-m-Y H:i:s',strtotime($date1 . "-1 days")));
        $slug=toAscii($res->title);
        
        $kateg=explode('/',$url);
       
        $databerita=get_channel($url);
	
        $objRS = mysql_query ("select slug from default_news where  created_on > ".$date2." and slug = '".$slug."' ");
        $RESULT= mysql_fetch_row($objRS);
        
        if(empty($RESULT[0])){
            $insert="INSERT INTO default_news VALUES (NULL,'".str_replace(array("'",'"'),'',$res->title)."','merdeka.com','$slug',459,'0','".$databerita['image']."','".substr($databerita['body'],0,200)."...','$url','<img src=\"".$databerita['image']."\">".$databerita['body']."','NULL',".$date.",'','','','','','','live','','','','','','','','','0','','','','','','".$kateg[3]."'),";
            $QUERY_GET_DATA_DUMP=substr($insert, 0, -1);
            //mysql_query($QUERY_GET_DATA_DUMP);
        }
      //  
}
 


 

function get_channel($url=""){
$r=get_web_page($url);

 $rr=$r['content'];
 
 

   $html_chld = str_get_html($rr);
       
       foreach($html_chld->find('div#mdk-body-news-detimg') as $ul) {
     
        $img = strip_image($ul->innertext) ;
        
        $IMAGE=($img[2][0]);
}

foreach($html_chld->find('h1') as $ul) {
     
        $JUDUL=$ul->innertext . '<br>';
}

foreach($html_chld->find('div#mdk-body-newsarea') as $ul) {
     
        $BODY= $ul->innertext . '<br>';
}

 $data['image']=$IMAGE;
 $data['title']=$JUDUL;
 $data['body']=$BODY;
 
return $data; 
}
 
function toAscii($str) {
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
	return $clean;
}

function detik($content=""){
	//$content = preg_replace('{<div class="leftarticle"> (.+?)</div>}s', " ", $content);
        //$content = preg_replace('{<div class="articleshare2"> (.+?)</div>}s', " ", $content);
         //$content = preg_replace('{<div id="bacajugabox" class="box_artikel2 box_artikel3">(.+?)</div>}s', " ", $content);
          //$content = preg_replace('{<div class="baca_juga2 f12">(.+?)</div>}s', " ", $content);
            $img=strip_image($content);
            $content = preg_replace('{<iframe width="630" height="100" frameborder="0" style="overflow:hidden;" class="frame_iklan_baris" src="http://adsbox.detik.com/iklanbaris/kanalbox/IB_bottom_article.php"></iframe>}s', " ", $content);
            $content = preg_replace('{<ul class="list_fotovideo">(.+?)</ul>}s', " ", $content);
            $content = preg_replace('{<div[^>]+\>(.+?)</div>}s', " ", $content);
            $content = preg_replace('{<a[^>]+\>(.+?)</a>}s', " ", $content);
         
        
        
        return '<img '.$img.'>'.$content;
}


function strip_image($content=""){
	
	$contenttograbimagefrom = $content;
	$firstImage = "";
	$output = preg_match_all('/(?<!_)src=([\'"])?(.*?)\\1/', $contenttograbimagefrom, $ContentImages);
     // echo'<pre>'; print_r($ContentImages);
	return $firstImage = @$ContentImages; // To grab the first image
	//$image_array = @getimagesize(SERVER_DIR.$firstImage);
	 
}

function html2text($content=""){
	$content = preg_replace("/<img[^>]+\>/i", " ", $content); 
return $content;
}

function list_url($post_content=""){
    preg_match_all('/<a\s[^>]*href=([\"\']??)([^\" >]*?)\\1[^>]*>(.*)<\/a>/siU', $post_content, $matches);
}

function get_web_page( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

// find all span tags with class=gb1
//foreach($html->find('span.gb1') as $e)
  //  echo $e->outertext . '<br>';

// find all td tags with attribite align=center
//foreach($html->find('td[align=center]') as $e)
  //  echo $e->innertext . '<br>';
    
// extract text from table
//echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

// extract text from HTML
//echo $html->plaintext;
?>