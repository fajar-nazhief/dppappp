<?php
$max_id=null;
$resultAll=array();
do{
	$results=tweetSearch("golkar","*****",true,$max_id);
	$resultAll+=$results->results;
	$max_id=$results->since_id;
	print "get ".count($resultAll)." items. ".end($results->results)->created_at." {$max_id}\n";
}while(1<count($results->results) );
foreach($resultAll as $result){
	print $result->created_at." ".mb_substr($result->text,0,70,"ASCII")."\n";
}
print "total ".count($resultAll)." items.\n";
function tweetSearch($keyword,$oauthToken,$isRecent=true,$max_id=null){
	$options = array(
	    'http'=>array(
	        'method' => "GET"
	         
	    )
	);
	$prams=array();
	$prams["src"]="typd";
	$prams["type"]=$isRecent?"recent":"relevance";
	$prams["include_available_features"]="1";
	$prams["include_entities"]="1";
	if($max_id!==null){
		$prams["max_id"]=$max_id;
	}
	$prams["count"]="100";
	$prams["q"]=$keyword;
	$context = stream_context_create($options);
	$retry=5;
	do{
		$result = @file_get_contents("https://twitter.com/i/search/timeline?".http_build_query($prams), false, $context);
		if($result!=""){
			break;
		}
	}while($retry--);
	$result=json_decode($result);
	$resultItems=explode('<li class="js-stream-item',$result->items_html);
	$results=(object)null;
	$results->results=array();
	$results->since_id="";
	foreach($resultItems as $resultItem){
		$add=(object)null;
		$add->user=(object)null;
		if(!preg_match('{data-item-id="(\d+)"}',$resultItem,$match)){continue;}
		$add->id_str=$match[1];
		if(!preg_match('{<p class="js-tweet-text">(.+?)</p>}s',$resultItem,$match)){continue;}
		$add->text=$match[1];
		$add->text=preg_replace_callback('{<a .*?</a>}',function($p){
			$html=$p[0];$return=$html;
			if(preg_match('{data-expanded-url="(.+?)"}',$html,$match)){
				$return=html_entity_decode($match[1]);
			}else if(preg_match('{>(pic\.twitter\.com/\w+)</a>}',$html,$match)){
				$return="http://{$match[1]}";
			}
			return $return;
		},$add->text);
		$add->text=strip_tags($add->text);
		if(!preg_match('{data-time="(\d+)"}s',$resultItem,$match)){continue;}
		$add->created_at=date("c",$match[1]);
		if(!preg_match('{data-screen-name="(.*?)"}s',$resultItem,$match)){continue;}
		$add->user->screen_name=$match[1];
		if(!preg_match('{data-name="(.*?)"}s',$resultItem,$match)){continue;}
		$add->user->name=$match[1];
		if(!preg_match('{data-user-id="(.*?)"}s',$resultItem,$match)){continue;}
		$add->user->id_str=$match[1];
		$results->results[$add->id_str]=$add;
		$results->since_id=$add->id_str;
	}
	return $results;
}
?>