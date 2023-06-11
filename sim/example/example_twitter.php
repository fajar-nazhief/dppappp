<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 
// get DOM from URL or file
$html = file_get_html('https://twitter.com/search?q=golkar&src=typd');

// find all link
//foreach($html->find('a') as $e) 
  //  echo $e->href . '<br>';

// find all image
//foreach($html->find('img') as $e)
  //  echo $e->src . '<br>';

// find all image with full tag
//foreach($html->find('img') as $e)
  //  echo $e->outertext . '<br>';

//foreach($html->find('h2') as $e)
  // echo $e->innertext . '<br>';

//foreach($html->find('h1') as $e)
  // echo $e->innertext . '<br>';
   
// find all div tags with id=gbar 
//foreach($html->find('div.stream') as $e)
  // echo $e->innertext . '<br>';

// find all span tags with class=gb1

 function list_data($query="",$iter="",$next="",$datas=array()){
    $query_data=htmlentities(urlencode($query));
   // echo '<br> https://twitter.com/i/search/timeline?q='.$query.'&src=typd&include_available_features=1&include_entities=1&last_note_ts=0&oldest_unread_id=0&scroll_cursor='.$next;
    if(empty($next)){
       $query_url='https://twitter.com/i/search/timeline?q='.$query_data.'&src=typd&include_available_features=1&include_entities=1&last_note_ts=0&oldest_unread_id=0';
    }else{
        $query_url='https://twitter.com/i/search/timeline?q='.$query_data.'&src=typd&include_available_features=1&include_entities=1&last_note_ts=0&oldest_unread_id=0&scroll_cursor='.$next;
    }
    echo '<br>'.$query_url;
    $data=json_decode(file_get_contents($query_url));
    $result=explode('<li class="js-stream-item',$data->items_html);
    $next= $data->scroll_cursor;
    $i=0;
    ++$iter;
    foreach($result as $key => $val){
        ++$i;
        $datas[$iter][$i]['image_profile']=get_data('src',$val);
        $datas[$iter][$i]['idstr']=get_data('data-item-id',$val);
        $datas[$iter][$i]['username']=get_data('data-name',$val);
        $datas[$iter][$i]['screen_name']=get_data('data-screen-name',$val);
        $datas[$iter][$i]['status']=status($val);
    }
     
    if(!empty($next)){
        if($iter <= 5){
        return list_data($query,$iter,$next,$datas);
        }
        
    }
    
    return $datas;
    
    
 }
 
 function get_data($idname="",$from_source=""){
    preg_match('{'.$idname.'="(.+?)"}',$from_source,$match);
    return $match[1];
 }
 
 function status($resultItem){
    preg_match('{<p class="js-tweet-text tweet-text">(.+?)</p>}s',$resultItem,$matchs);
    return($matchs[0]);
 }
 
 function replace_unicode_escape_sequence($match) {
                return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }
        
        function unicode_decode($str) {
                return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $str);
        }
        echo '<pre>';
    print_r(list_data('benar',0,"",""));
 exit;
  echo $data->croll_cursor;
echo'<pre>';print_r($data);
//$html=file_get_html('https://twitter.com/i/search/timeline?q=golkar&src=typd&include_available_features=1&include_entities=1&last_note_ts=0&oldest_unread_id=0&scroll_cursor=TWEET-406732048498294784-406745769136238592');


// find all td tags with attribite align=center
//foreach($html->find('td[align=center]') as $e)
  //  echo $e->innertext . '<br>';
    
// extract text from table
//echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

// extract text from HTML
//echo $html->plaintext;
?>