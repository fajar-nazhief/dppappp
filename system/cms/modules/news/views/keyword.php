 
 <div class="index-content widget archive-page-content">
	<div class="archive-page-header">
		
						<h1 class="archive-page-title">Category: <strong><?php echo ($berita[0]->keyword);?></strong></h1>
			</div>
 </div>
<div class="widget Label sticky label feed has-title fix-height none-icon" id="Label2">
	 
	<div class="widget-content feed-widget-content widget-content-Label2" id="widget-content-Label2">
    
				 <?php  if(is_array($berita)){ $i=0;
					$jml =  count($berita);
				   foreach($berita as $article_widget){
					
				   $img= strip_image($article_widget->body);
				    if($i==0){?>
					
				   <div class="shad item item-<?php echo $i?> item-two item-three item-four">
									<div class="item-main">
											<a class="thumbnail item-thumbnail" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"  style="background: url('<?php  echo $img;?>');background-position: center;background-repeat: no-repeat;background-size: cover;min-height:200px">
											<span class="item-thumbnail-resize-portrait">
												 
											</span>
											</a>
											<div class="item-content gradident">
											<div class="bg item-labels">
												 	<a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
													
											</div>
											 <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="text-shadow:none;font:15px Oswald;color:#fff;"')?>
											<h3 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="text-shadow:none;"')?></h3>
										</div>
									</div>
									<div class="item-sub bg">
										<div class="item-snippet">
											 <?php echo  $article_widget->intro?>
										</div>
										<div class="meta-items">
											<a class="meta-item meta-item-author" href="#" target="_blank"><i class="fa fa-pencil-square-o"></i> <span><?php echo $article_widget->title_en?></span></a><a class="meta-item meta-item-comment-number" href="#"><i class="fa fa-comment-o"></i> <span><?php echo $article_widget->klik?></span></a><a class="meta-item meta-item-date" href="#"><i class="fa fa-clock-o"></i> <span><?php echo date('M d , Y', $article_widget->created_on)?></span></a>
										</div>
									</div>
				   </div>
				    <?php
					
				    }else if($i<>0 and $i <=3){
					
				    
				 ?>
				 <div class="shad item item-<?php echo $i?> than-0">
									<div class="item-main"> 
										<a class="thumbnail item-thumbnail" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>">
											<span class="item-thumbnail-resize-portrait">
												<img alt="<?php  echo $article_widget->title?>" class="attachment-full size-full special optimized" src="<?php echo $img?>" title="<?php  echo $article_widget->title?>" style="bottom: auto; top: -30px;" width="800" height="533">
										</span>
										</a>
										<div class="item-content gradident">
											<div class="bg item-labels">
												 <a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
											</div>
											 <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="text-shadow:none;font:15px Oswald;color:#fff;"')?>
											 <h3 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h3>
										</div>
									</div>
				 </div>
					
	   				 
				   <?php  } 
				    ++$i;
				   }}?>
				   <div class="clear"></div>
	</div> 
 </div>
<div class="post-meta-wrapper">
							&nbsp;
						 </div>
<div class="widget Label blogging label feed no-title fix-height none-icon " id="magone-archive-blog-rolls" style="padding-top:20px">
	<div class="widget-content feed-widget-content widget-content-magone-archive-blog-rolls" id="widget-content-magone-archive-blog-rolls">

<?php
$i=0;
foreach($berita as $article_widget){
	$img= strip_image($article_widget->body);
	++$i;
	if($i==4){
		$calss='shad item item-0 item-two item-three item-four';
	}else{
		$calss='shad item item-1 than-0';
	}
	
	if($i >=4){
	 ?>
	 
<div class="<?php echo $calss ?>">
<a style="height: 165px" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" class="thumbnail item-thumbnail">
	<span class="item-thumbnail-resize-portrait">
		<img src="<?php echo $img?>"
			 class="attachment-full size-full special optimized"
			 alt="<?php  echo $article_widget->title?>"
			 title="<?php  echo $article_widget->title?>" sizes="(max-width: 800px) 100vw, 800px"
			 data-s="<?php echo $img?>"
			 data-ss="<?php echo $img?>" style="bottom: auto; top: -19px;" width="800" height="533"></span></a>
<div class="item-content">
	<div class="bg item-labels"><a href="<?php echo base_url().'news/keyword/'.str_replace(',','-',$article_widget->keyword)?>"><?php echo $article_widget->keyword?></a><span>
	</span> 
	</div><h3 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a></h3><div class="meta-items">
	<a href="<?php  echo $article_widget->title?>" target="_blank" class="meta-item meta-item-author"><i class="fa fa-pencil-square-o"></i> <span>Admin</span></a>
	<a class="meta-item meta-item-date" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"><i class="fa fa-clock-o"></i>
	<span><?php echo date('M d,Y', $article_widget->created_on)?></span></a></div><div class="item-sub">
	<div class="item-snippet"><?php  echo $article_widget->intro?></div>
	<div class="item-readmore-wrapper"><a class="item-readmore" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>">Read More</a></div></div><div class="clear"></div></div><div class="clear"></div></div>
<?php }}?>
	</div>
</div>

  <?php  echo $pagination['links']; ?>