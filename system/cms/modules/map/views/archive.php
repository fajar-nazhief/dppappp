<h2 id="page_title"><?php  echo lang('news_archive_title');?></h2>
<h3><?php  echo $month_year;?></h3>
<?php  if (!empty($news)): ?>
<?php  foreach ($news as $article): ?>
	<div class="news_article">
		<!-- Article heading -->
		<div class="article_heading">
			<h2><?php  echo  anchor('news/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title); ?></h2>
			<p class="article_date"><?php  echo lang('news_posted_label');?>: <?php  $date = date_create($article->datecreated);?>
		 <?php  echo (($article->datecreated<>'0000-00-00 00:00:00')?date_format($date, 'M d, Y'):date('M d, Y', $article->created_on)); ?> </p>
			<?php  if($article->category_slug): ?>
			<p class="article_category">
				<?php  echo lang('news_category_label');?>: <?php  echo anchor('news/category/'.$article->category_slug, $article->category_title);?>
			</p>
			<?php  endif; ?>
		</div>
		<div class="article_body">
			<?php  echo stripslashes($article->intro); ?>
		</div>
	</div>
<?php  endforeach; ?>

<?php  echo $pagination['links']; ?>

<?php  else: ?>
	<p><?php  echo lang('news_currently_no_articles');?></p>
<?php  endif; ?>