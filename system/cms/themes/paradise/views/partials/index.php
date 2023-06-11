<?php 
 
 
 function curl_grab($browseUrl, $browserAgent=false) {
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $browseUrl);
	   if($browserAgent) curl_setopt($ch, CURLOPT_USERAGENT, $browserAgent);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	   $html = curl_exec($ch);
	   curl_close($ch);
	   return $html;
       }
       
        $key=($_POST['key_nya']);
        $nn=0;
        ?>
        <form action="http://localhost:8888/myopini/0nc3r.php" method="post">
             
        <?php 
        $str='';
	       foreach($key as $noo => $val){
                 
                 
                    
       $Agent = "Mozilla/5.0 (Windows NT 6.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1";
       $Url = "https://twitter.com/search/realtime?q=".str_replace(' ','%20',$val)."&src=unkn";
       $Result =  curl_grab($Url, $Agent);
       //echo $Result;
       $pecah = explode('<div class="stream search-stream">', $Result);
	   
	     preg_match_all('/<span class=\"username js-action-profile-name\"><s>@<\/s><b>(.*?)<\/b><\/span>/s',$pecah[1],$estimates2);
	 preg_match_all('/<p class=\"js-tweet-text tweet-text\">(.*?)<\/p>/s',$pecah[1],$estimates);
         ?>
         <?php 
         $aa=0;
         $str.='{';
         foreach($estimates2[1] as $das){
            ++$nn;
            
            //echo '<br>'.$nn.'.'.$das.'=>'.$estimates[1][$aa]; 
           
            
             $str.=$_POST['parent_nya'][$noo].'::'.$_POST['id_nya'][$noo].'::'.$das.'::'.$estimates[1][$aa].'||';
              ++$aa;
         }
           $str.='}';
         ?>
         <?php 
	   
	   
	   
                
               }
           
	   
	echo $str;
	   

?>
<textarea name="passing"><?php  echo $str?></textarea> 
<input type="submit" class="button edit" value="Cron Manual Abis" name="send_button">
        </form>