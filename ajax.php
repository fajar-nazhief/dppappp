<?php

mysql_connect('localhost', 'adminbj', 'a7y8uvuqa') or die();
mysql_select_db('donimaulana_bj');

$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();


$q="SELECT default_news.*, default_news_categories.navigation_group_id, default_news_categories.title AS category_title, default_news_categories.slug AS category_slug FROM (default_news) LEFT JOIN default_news_categories ON default_news.category_id = default_news_categories.id WHERE  `default_news_categories`.`slug` = '".$_POST['slug']."' AND `status` = 'live' AND `created_on` <= ".$_POST['date']." ORDER BY default_news.id DESC LIMIT ".$offset.", ".$postnumbers;

$run = mysql_query($q);

?>
<table>
	
<?
while($row = mysql_fetch_array($run)) {
	
	$content = substr(strip_tags($row['post_content']), 0, 500);
	
	echo '<tr style="border-bottom:1px solid #dedede"><td style="padding:20px"><a href="news/' .date('Y/m', $row['created_on']) .'/'.$row['slug'].'"> <img src="'.strip_image($row['body']).'" style="180px;width:200px;margin-right:20px"></a>
	</td><td style="padding:20px"><h1 style="border-bottom:none"><a href="news/' .date('Y/m', $row['created_on']) .'/'.$row['slug'].'">'.$row['title'].'</a></h1>';
	echo '</td></tr>';

}
echo '</table>';
function strip_image($content=""){
	
	$contenttograbimagefrom = $content;
	$firstImage = "";
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $contenttograbimagefrom, $ContentImages);
	return $firstImage = @$ContentImages[1] [0]; // To grab the first image
	//$image_array = @getimagesize(SERVER_DIR.$firstImage);
	 
}
?>