		
					

<?php  if (($news)):
 
?>
  
	<ul>
<?php 
$i=0;
foreach ($news as $article):
++$i;
if($i % 2 == 0){
					$class='style="vertical-align:top;border-bottom:none"';
				    }else{
					$class='class="right_col" style="border-bottom:none"';
				    }
?>
<li <?php  echo $class?>>
  <table style="padding:10px;border:1px dotted #dedede;padding:10px;margin:10px 10px 10px 0px;width:100%">
<tr >
		<td style="padding:10px;width:50px" valign="top">
                		<div class="thumb" style="margin-right:0px">
						<a href="<?php  echo base_url().'news/' .date('Y/m', $article->created_on) .'/'. $article->slug?>">
						<img align="left" src="<?php   echo strip_image($article->body)?>" width="95px" height="95px"  style="padding-right:0px;padding:2px ;border:1px solid #dedede">
						</a>
				</div>
		</td>
		<td>
			
        <div class="post-content" style="padding:10px">
				
				 <?php   if($article->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article->katakunci?></div> 
								<?php   }?>
			<h5 style="line-height:10px;padding:0px"><?php  echo  anchor('news/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title,'  style="line-height:15px"'); ?></h5>
			<span class="meta" style="font-size:10px">
				<?php  echo date('M d, Y, H:i:s',$article->created_on)?>
				<span class="comm_bubble">
				<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article->created_on)?>/<?php  echo $article->slug?>" class=" " title="<?php   echo $article->title?>"><?php  echo $article->klik?> </a>
			 
			</span>
			</span>
			 
 			
 		
			<div class="entry"> &nbsp;
				 	</div><!-- /.entry -->
		 
			<div class="clear"></div>
		</div><!-- /.post-content -->
 	</td>
</tr>
	 
	</table>
  </li>
	
<?php  endforeach; ?> 