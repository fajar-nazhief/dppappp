<div class="news_article" style="padding-left:10px;padding-top:10px ">
	<!-- Article heading -->
	
	<div class="article_heading" style="border-bottom:2px dotted #dedede;padding-bottom:10px">
		  <?php //=strtoupper($article->category->title)?> 
		<div style="padding:0px">
		<h3 style="font-size:14px"><?php  echo $article->title; ?></h3>
		</div>
		
		<span style="font-size: 10px;" class="address">
			<?php  $date = date_create($article->datecreated);?>
		 <?php  echo lang('news_posted_label');?>: <?php  echo (($article->datecreated<>'0000-00-00 00:00:00')?date_format($date, 'M d, Y'):date('M d, Y', $article->created_on)); ?> 
		<?php  if($article->category->slug): ?>
		 
			<?php  echo lang('news_category_label');?>: <?php  echo anchor('news/category/'.$article->category->slug, $article->category->title);?>
		 
		<?php  endif; ?>
		</span>  
		
		 
	</div>
	<div style='float:right; margin-top:-10px; text-align:center;'>
			 
			 <span style="margin-top:-30px">
				<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e131b227deb8fa6"></script>
<!-- AddThis Button END --> 
  </span>   
</div>
	<div style="  width:100%;height:5px;padding-bottom:0px">&nbsp;</div>
	<div id="home-detail" class="clearfix">
      <div id="content">
        <div class="cp_tile " style="width:620px"><br>
		<?php 
		$find = array("&lt;", "&gt;");
		$replace   = array("<", ">");
		echo str_replace($find,$replace,stripslashes($article->body)); ?>
		<?php //php echo $article->body; ?>
	</div></div></div>
	<div style="padding:10px;">
		<div class="more-link"> <a href="<?php  echo base_url()?>news/category/<?php  echo $article->category->slug?>">Artikel Lainnya</a> </div>
	</div>
	<br><p>
	<div class="clearfix" id="home-two-column-detail">
          <div class="col-1">
            
            <div class="cp_tile ">
			
      <style>
      .imageB{
	border: 1px solid #D9D9D9;
	clear: left;
	float: left;
	margin: 0px 5px 0;
	width: 95px; height: 65px;
	padding:3px;
      }
      </style>
	<?php 
	echo display_comments($article->id);
	?>
	    </div>
	  </div>
	   <div class="col-2">
            
            <div class="cp_tile ">
		 <style>
      .imageB{
	border: 1px solid #D9D9D9;
	clear: left;
	float: left;
	margin: 0px 5px 0;
	width: 95px; height: 65px;
	padding:3px;
      }
      </style>
      <div class="section-intro clearfix" id="home-blog">
                <div class="view-content">
                  <div class="item-list"> 
                    <h2 class="title">    Artikel Terkait  </h2>
                    <ul class="entry-list">
			<?php 
			$categories=$news;
			if($categories){
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
                      <li style="border-bottom:1px solid #dedede;">
                        
                        <h3><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"><img   class="imageB" src="<?php  echo strip_image($article_widget->body);?>" alt="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a></h3>
                         <p ><?php  echo $article_widget->intro?></p>
			 <div class="event_landing_info_container">
                         <span class="event_landing_info_time" style="font-size:10px"><?php  echo date('d/m/Y', $article_widget->created_on)?> </span>
                        <div class="event_landing_info_place"><a   href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="text-decoration:none">Bacalah</a></div>
			 </div>
                      </li>
		      <?php   }?>
		      <li>
			<div class="more-link"> <a href="<?php  echo base_url().'news/category/'.$article_widget->category_slug?>">Artikel Lainnya</a> </div>
		      </li>
		      <?php   }else{?>
		      <li>
			Belum Ada Artikel Terkait
		      </li>
		      <?php   }?>
                    </ul> 
                  </div> 
                </div> 
              </div>
	    </div>
	   </div>
	</div>
</div> 
<style>
 
</style>


