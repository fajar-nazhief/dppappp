 
<?php  if (($news)): ?>
 
<?php  foreach ($news as $article): ?>

		<div class="main_toplist_box new_biz " style="padding-top:20px;padding-bottom:20px">
					 <legend><b><?php  echo  anchor('news/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title); ?></b></legend>
					
					<span style="font-size: 10px;" class="address">
					<?php  if($article->category_slug): ?>
			 
					<?php  echo lang('news_category_label');?>: <?php  echo anchor('news/category/'.$article->category_slug, $article->category_title);?>
			 
					<?php  endif; ?>, <?php  echo lang('news_posted_label');?>: 
						<?php  $date = date_create($article->datecreated);?>
		 <?php  echo (($article->datecreated<>'0000-00-00 00:00:00')?date_format($date, 'M d, Y'):date('M d, Y', $article->created_on)); ?> 
		</span>
					<div style="padding-top:5px;padding-bottom:10px">
						<div style="text-align: justify;">
						<img align="left" src="<?php   echo strip_image($article->body)?>" width="60" height="42" style="padding:10px"><?php  echo stripslashes($article->intro); ?>
						</div>
					</div>
					 
		</div>
		<br>
<?php  endforeach; ?> 
<?php  echo $pagination['links']; ?>

<?php  else: ?>
	<p>Tidak tidak ditemukan!</p>
<?php  endif; ?>