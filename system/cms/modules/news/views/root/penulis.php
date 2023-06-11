

 	<div class="archiveposts" style="margin:0px;width:100%;margin-bottom:20px">
			 

			<div class="rounded">

				
					

<?php  if (($news)): ?>
 
<?php  foreach ($news as $article): ?>
<div style="border-bottom:1px solid #dedede;padding:10px">

                		<div class="thumb">
						<a href="<?php  echo base_url().'news/' .date('Y/m', $article->created_on) .'/'. $article->slug?>">
						<img align="left" src="<?php   echo strip_image($article->body)?>" width="95px" height="95px"  style="padding-right:5px;padding:2px ;border:1px solid #dedede">
						</a>
				</div>
			
        <div class="post-content">

			<h5><?php  echo  anchor('news/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title,'  '); ?></h5>
			<span class="comm_bubble">
				<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article->created_on)?>/<?php  echo $article->slug?>" class=" " title="<?php   echo $article->title?>"><?php   echo $article->total_comment?></a>
			, <font style="font-size:9px">Dibaca: <?php  echo $article->klik?> Kali</font>
			</span>
 			<span class="meta">
				<?php  echo date('M d, Y, H:i:s',$article->created_on)?> 
			</span>
 		
			<div class="entry">
				<p><?php  echo stripslashes($article->intro); ?> </p>
				
				 	</div><!-- /.entry -->
		 
			<div class="clear"></div>
		</div><!-- /.post-content -->
 
	</div><!-- /#post-24 --> 
 
	<div class="clear"></div> 
<?php  endforeach; ?> 

<div class="navigation">
		<span class="page-numbers current">
		<?php  echo $pagination['links']; ?>
		&nbsp;
		</span> 
<a class="page-numbers" href="#">&nbsp;</a> 

</div> 			
	 		
	
		 


<?php  else: ?>
	<p><?php  echo lang('news_currently_no_articles');?></p>
<?php  endif; ?>
</div> <!-- /rounded -->
		</div> <!-- /archive -->
		 