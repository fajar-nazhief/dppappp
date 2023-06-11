 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="article_heading" style="border-bottom:1px solid red;margin-bottom:10px">
	   <span style="font-size: 10px;" class="address">
		    <?php  if($article->category->slug): ?>
		 
			<span class="label label-info"> <?php  echo anchor('collection/category/'.$article->category->slug, $article->category->title);?></span>
			&nbsp; <a href="<?php  echo base_url()?>collection/keyword/<?php  echo str_replace(',','-',$article->keyword)?>" style="color:#DE1D11;font-size:12px"><b>#<?php  echo $article->keyword?></b></a>
		 
		<?php  endif; ?>
		</span> 
		  <?php   if($article->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article->katakunci?></div> 
								<?php   }?>
		<div style="padding-top:5px">
		    
		<h3 style="font-size:20px;margin:0px;padding:0px"><?php  echo $article->title; ?></h3>
		</div>
		
		<span style="font-size: 10px;" class="address">
		    Dibaca: <?php  echo $article->klik?> kali
		 
		 
			<?php  $date = date_create($article->datecreated);?>
		 <?php  echo lang('collection_posted_label');?>: <?php  echo (($article->datecreated<>'0000-00-00 00:00:00')?date_format($date, 'M d, Y'):date('M d, Y', $article->created_on)); ?> 
		
		</span>  
		
	 
					   </div> 
	
	<div id="home-detail" class="clearfix">
		<div >
		  <div class="cp_tile " >
		     	   <!-- AddThis Button BEGIN -->
		 <div>
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
		 
			  <?php  echo str_replace('&lt;','<',stripslashes($article->body)); ?>
			 
		 
		  </div>
		
		  
	
  <?php   if(!empty($keyword)){?> 
		  <div width="100%"> 
					
					<div style="">

			<ul style="margin-bottom:7px;border-top:1px solid #091891;list-style-type:none">
                        <li style="margin:0">
			      <h3 class="title" style="width:635px;margin:0px;padding:0px">Berita Terkait</h3>
			</li>
		    <?php   foreach($keyword as $val => $dat){
		     if($nid <> $dat->id){
		     ?>
		   <li style="border-bottom:1px dotted #dedede;padding:10px 10px;height:auto;width:615px">
		    <a href="<?php  echo base_url().'collection/'.date('Y/m', $dat->created_on) .'/'.$dat->slug?>"><?php  echo $dat->title?></a>
		    </li>
		  <?php   }}?>
			</ul>
					</div>
					</div>
		  <?php   }?>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-506bfde60fe58cf4"></script>
<!-- AddThis Button END -->
		</div>
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
     
	    </div>
	   </div>
	</div>
</div>  


