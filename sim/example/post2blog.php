<?php
 
/*
* read more on :
* https://developers.google.com/blogger/docs/3.0/getting_started
*
*/
 
$key["server"] = "YOUR_BLOGGER_API_KEY";
$blogId = "1117012217325311232";
$url = "https://www.googleapis.com/blogger/v3/blogs/$blogId/posts?key=$key[server]";
 
try{
$ch = curl_init($url);
 
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch);
curl_close($ch);
$posts = json_decode($resp, true);
// do whatever you want with this data responses
}catch(Exception $ex){
echo $ex->getMessage();
}
 
?>