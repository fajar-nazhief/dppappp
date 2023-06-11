 
<?php  if (!empty($collection)): ?>
<ul id="stream-list">
<?php  foreach ($collection as $article): ?>

		<li class="main_toplist_box new_biz ">
					<fieldset><legend><b><?php  echo  anchor('collection/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title); ?></b></legend>
					
					<span style="font-size: 10px;" class="address">
					<?php  if($article->category_slug): ?>
			 
					<?php  echo lang('collection_category_label');?>: <?php  echo anchor('collection/category/'.$article->category_slug, $article->category_title);?>
			 
					<?php  endif; ?>, <?php  echo lang('collection_posted_label');?>: 
						<?php  $date = date_create($article->datecreated);?>
		 <?php  echo (($article->datecreated<>'0000-00-00 00:00:00')?date_format($date, 'M d, Y'):date('M d, Y', $article->created_on)); ?> 
		</span>
					<div style="padding-top:5px;padding-bottom:10px">
						<div style="text-align: justify;">
						<img align="left" src="<?php   echo strip_image($article->body)?>" width="60" height="42"><?php  echo stripslashes($article->intro); ?>
						</div>
					</div>
					</fieldset>
		</li> 
<?php  endforeach; ?>
</ul>
<?php  echo $pagination['links']; ?>

<?php  else: ?>
	<p><?php  echo lang('collection_currently_no_articles');?></p>
<?php  endif; ?>