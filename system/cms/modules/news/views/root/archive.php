 
<div class="navbar" style="margin:10px">
              <div class="navbar-inner">
                <?php   echo form_open('news/search',array('class'=>'navbar-form '));?>
 <?php 
  if($this->uri->segment('3')){$thns=$this->uri->segment('3');}else{$thns=date('Y');}
  if($this->uri->segment('4')){$blns=$this->uri->segment('4');}else{$blns=date('m');}
  if($this->uri->segment('5')){$tgls=$this->uri->segment('5');}else{$tgls=date('d');}
   
 ?>
 <table>
	<tr>
		<td>
<?php   echo form_dropdown('tgl', $tgldat,$tgls,' class="span1"');?>&nbsp;
</td>
		<td>
<?php   echo form_dropdown('bln', $blnx,$blns,' class="span2"');?>&nbsp;
</td><td>
<?php   echo form_dropdown('thn', $thnx,$thns,' class="span1"');?>&nbsp;
</td><td>
<button class="btn" type="submit">Cari Berita</button>
</td>
		</tr>
	</table>
<?php   echo form_close()?>
              </div>
            </div>
<?php  if (($berita)): ?>
<?php  foreach ($berita as $article): ?>
	<div class="news_article" style="border:1px dotted #dedede;margin:10px;padding:10px">
		<!-- Article heading -->
		<div class="article_heading">
			<div style="font-size:15px;font-weight:bold;color:#0D4A86"><?php  echo  anchor('news/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title); ?></div>
			<p class="article_date"><?php  echo lang('news_posted_label');?>: <?php  $date = date_create($article->datecreated);?>
		 <?php  echo (($article->datecreated<>'0000-00-00 00:00:00')?date_format($date, 'M d, Y'):date('M d, Y', $article->created_on)); ?> </p>
			 
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