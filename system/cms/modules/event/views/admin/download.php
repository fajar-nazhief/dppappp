 <?php
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
?>
<table border="1">
	<tr>
	<td>No.</td>
		<td>Judul</td>
		<td>bahasa</td>
		<td>isi</td>
		<td>Tanggal</td>
		<td>Image</td>
	</tr>
<?php
$no=0;
foreach($res as $dat){
	++$no;
	//echo $dat->title.format_date($dat->created_on);;
	echo "<tr><td>".$no.".</td><td>". $dat->title."</td><td>". $dat->bahasa."</td><td>". text_only($dat->body). "</td><td>".format_date($dat->created_on)."</td><td>http://jakarta-tourism.go.id".strip_image($dat->body)."</td></tr>";
}
 ?>
</table>