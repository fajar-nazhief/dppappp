<br>
	<span class='st_sharethis_hcount' displayText='ShareThis'></span>
<span class='st_facebook_hcount' displayText='Facebook'></span>
<span class='st_twitter_hcount' displayText='Tweet'></span>  
	<div style="border-bottom:0px;padding-bottom:20px;margin-bottom:20px">
	<div style="font-size:16px">Hasil Polling
<?php   echo $pollkat->polling_name;?>
</div>
	</div> 
		<div class="hr"></div>
<?php 
echo '<table width="90%" style="border:0px"><tr>';
		foreach($datas as $dat => $val){
			echo '<td width="80px" style="border:0px"><br><img src="'.base_url().'uploads/Banner/'.$val->link_file.'"  width="90px" height="84px"></td>
			<td    style="padding-left:10px;border:0px">&nbsp;<font size="1" face="Verdana" color="#000000"><b>'.$val->title.'</b></font><br> ';
			$width2=($val->vote *1)/50 ; /// change here the multiplicaiton factor //////////
			 $cta=($val->vote/$rt)*100;
			 $ct=sprintf ("%01.2f", $cta); // number formating
			 $per=$ct*100;
			echo "   &nbsp;<img src='".base_url()."uploads/default/graph.jpg' height=10 width=$width2><br><font size='1' face='Verdana' color='#000000'> Jumlah Vote:$val->vote | Persentase: ($ct %)</font>
			</td>
			</tr>";
			
			echo "<tr>
			<td colspan=\"2\" style=\"border:0px;border-bottom:1px solid #dedede\">&nbsp;</td></tr>";
			//echo $noticia['sel'],$noticia[no]."<br>";
		 
		}
		echo '</tr></table>';

?>
	Total Vote: <?php  echo $total?>
		     