 
<?php  if (!empty($berita)): ?>
 
<h3 style="border-bottom:1px solid #B9172C;padding-bottom:10px"> <a href="<?php  echo base_url()?>collection/category/<?php  echo $berita[0]->category_slug?>" style="font: 26px Oswald; color: rgb(113, 148, 41);">Berita <?php  echo $berita[0]->category_title ?></a> &raquo; <?php  echo $berita[0]->keyword ?></h3> 
<table width="100%">
		
<?php  foreach ($berita as $dats=>$article): ?>
<?php   $TGL=date('Y-m-d');//$article->tgl;//tanggalb8($article->tgl)?>
<tr>
		<td valign="top" style="border-bottom:1px solid #dedede;padding:10px 10px;margin:0px 10px">
			<table>
						<tr>
									<td> 
<a href="<?php  echo base_url().'collection/' .date('Y/m/', $article->created_on). $article->slug?>">
						<img align="left" src="<?php   echo strip_image($article->body)?>" width="90"  style="padding-right:5px;padding:2px ;border:1px solid #dedede">
						</a>
									</td>
						</tr>
						
						
			</table>
</td>
		
<td valign="top"  style="border-bottom:1px solid #dedede;padding:10px 10px;margin:0px 10px">
					 <b><?php  echo  anchor('collection/' .date('Y/m/', $article->created_on).  $article->slug, $article->title,'  '); ?></b> 
					
					<span style="font-size: 10px;" class="address">
					 <br>
					 
		 <?php  //echo  $article->tgl; ?>
		 </span>
					<div style="padding-top:5px;padding-bottom:0px">
						<div style="text-align: justify;">
									
						<?php  echo stripslashes($article->intro); ?>
						
						</div>
						<table>
															<tr> 
																		<td valign="middle">
																					<font style="font-size:9px">Dibaca: <?php  echo $article->klik?> Kali</font>
																		</td>
															</tr>
												</table>
					</div>
					 
		</td> 
</tr> 
<?php  endforeach; ?>
</table>
<div style="padding-top:10px">
<?php  echo $pagination['links']; ?>
</div>

<?php  else: ?>
	<p><?php  echo lang('berita_currently_no_articles');?></p>
<?php  endif; ?>