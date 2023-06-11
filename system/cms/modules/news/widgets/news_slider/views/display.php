<?php   if($options['styles']=='0'){?> 
	 <?php  if(is_array($categories)){ $i=0;?>
		 <div class="widget Label slider label feed no-title fix-height none-icon" id="Label1">
							<div class="widget-content feed-widget-content widget-content-Label1" id="widget-content-Label1"> 
			<?php 
			 //print_r($categories);
			foreach($categories as $article_widget){ ++$i;
			$intro[$i]=htmltotext($article_widget->intro);
			$title[$i]=$article_widget->title;
			$slug[$i]=$article_widget->slug;
			$keyword[$i]=str_replace(',','-',$article_widget->keyword);
			$caption[$i]=$article_widget->katakunci;
			$img = strip_image($article_widget->body);
				 ?>
				<div class="item slider-item slider-item-<?php echo $i?>">
									<div class="slider-item-inner">
										<a class="thumbnail item-thumbnail" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="height: 400px">
											<img width="1000" height="600" src="#" class="attachment-full size-full" alt="<?php echo $article_widget->title?>" title="<?php echo $article_widget->title?>" sizes="(max-width: 1000px) 100vw, 1000px" data-s="<?php echo $img?>" data-ss="<?php echo $img?> 1000w" />
											
										</a>
										<div class="slider-item-content">
											<div class="bg item-labels">
												<a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
											</div>
											<div class="meta-items">
												<a class="meta-item meta-item-author" href="#" target="_blank"><i class="fa fa-pencil-square-o"></i> <span><?php echo $article_widget->title_en?></span></a><a class="meta-item meta-item-comment-number" href="#"><i class="fa fa-comment-o"></i> <span><?php echo $article_widget->klik?></span></a> <a class="meta-item meta-item-date" href="#"><i class="fa fa-clock-o"></i> <span><?php echo date('M d , Y', $article_widget->created_on)?></span></a>
											</div>
											<h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php echo $article_widget->title?>"><?php echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
										</div>
									</div>
								</div>
				  
						
						 
		
		<?php   }?>
		</div>
							<div class="clear"></div><span class="hide widget-data" data-type="slider"><span class="data-item data-speed">5000</span><span class="data-item data-show_dots">on</span><span class="data-item data-show_nav">on</span></span>
						</div>
						<div class="clear"></div><span class="hide widget-data" data-type="slider"><span class="data-item data-speed">5000</span><span class="data-item data-show_dots">on</span><span class="data-item data-show_nav">on</span></span>
						<div class="clear"></div>
						
		<?php }?>
		
		 
	  
 

<!--<div id="buttons" style="padding-bottom:10px">
	<a href="#" id="btn-prev"><i class="icon-backward"></i></a>  
	<a href="#" id="btn-next"><i class="icon-forward"></i></a>  
</div>-->
 
	 
	 
  
 
      <?php   }
      if($options['styles']=='1'){?> 
 <div class="widget Label sticky label feed has-title fix-height none-icon" id="Label2">
	<div class="feed-widget-header">
		<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="#"><?php  echo $options['judul']?></a> </h2>
		<div class="clear"></div>
	</div>
	<div class="widget-content feed-widget-content widget-content-Label2" id="widget-content-Label2">
    
				 <?php  if(is_array($categories)){ $i=0; 
				   foreach($categories as $article_widget){
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
											<h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="text-shadow:none;"')?></h2>
										</div>
									</div>
									<div class="item-sub bg">
										<div class="item-snippet">
											 <?php echo $article_widget->intro?>
										</div>
										<div class="meta-items">
											<a class="meta-item meta-item-author" href="#" target="_blank"><i class="fa fa-pencil-square-o"></i> <span><?php echo $article_widget->title_en?></span></a><a class="meta-item meta-item-comment-number" href="#"><i class="fa fa-comment-o"></i> <span><?php echo $article_widget->klik?></span></a><a class="meta-item meta-item-date" href="#"><i class="fa fa-clock-o"></i> <span><?php echo date('M d , Y', $article_widget->created_on)?></span></a>
										</div>
									</div>
				   </div>
				    <?php
					
				    }else{
					
				    
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
											 <h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
										</div>
									</div>
				 </div>
					
	   				 
				   <?php  }
				    ++$i;
				   }}?>
				   <div class="clear"></div>
	</div>
	 <div class="clear"></div>
	  <div class="clear"></div>
 </div>
      <?php   }
      
       if($options['styles']=='2'){?>
      <div class="widget Label complex label feed has-title fix-height none-icon" id="Label3">
	<div class="feed-widget-header">
		<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="#"><?php  echo $options['judul']?></a> </h2>
		<div class="feed-widget-viewall">
									<a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><span>INDEX</span>
		<i class="fa fa-chevron-right"></i></a>
								</div>
		<div class="clear"></div>
	</div>
	<div class="widget-content feed-widget-content widget-content-Label2" id="widget-content-Label2">
    
				 <?php  if(is_array($categories)){ $i=0; 
				   foreach($categories as $article_widget){
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
											<h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
										</div>
									</div>
									<div class="item-sub">
										<div class="item-snippet">
											 <?php echo $article_widget->intro?>
										</div>
										<div class="meta-items">
											<a class="meta-item meta-item-author" href="#" target="_blank"><i class="fa fa-pencil-square-o"></i> <span><?php echo $article_widget->title_en?></span></a><a class="meta-item meta-item-comment-number" href="#"><i class="fa fa-comment-o"></i> <span><?php echo $article_widget->klik?></span></a><a class="meta-item meta-item-date" href="#"><i class="fa fa-clock-o"></i> <span><?php echo date('M d , Y', $article_widget->created_on)?></span></a>
										</div>
									</div>
				   </div>
				    <?php
					
				    }else{
					
				    
				 ?>
				 <div class="shad item item-<?php echo $i?> than-0">
									<div class="item-main"> 
										 
										<div class="item-content">
											<div class="bg item-labels">
												 <a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a> &raquo; 
												 											 <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,'')?>
											 
											</div>

<h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
										</div>
									</div>
				 </div>
					
	   				 
				   <?php  }
				    ++$i;
				   }}?>
				   <div class="clear"></div>
	</div>
	 <div class="clear"></div>
	  <div class="clear"></div>
 </div>
      <?php   }?>
      <?php   if($options['styles']==3){?>
       <div class="widget Label carousel label feed has-title fix-height none-icon" id="Label4">
							<div class="feed-widget-header">
		<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="#"><?php  echo $options['judul']?></a> </h2>
		<div class="feed-widget-viewall">
									<a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><span>INDEX</span>
		<i class="fa fa-chevron-right"></i></a>
								</div>
		<div class="clear"></div>
	</div>
							<div class="widget-content feed-widget-content widget-content-Label4" id="widget-content-Label4">
			<?php
			$i=0;
			foreach($categories as $article_widget){
				 
				   $img= strip_image($article_widget->body);?>
				    
				   <div class="item carousel-item carousel-item-<?php echo $i?>">
									<div class="carousel-item-inner">
										<a class="thumbnail item-thumbnail" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="height: 215px"><img alt="<?php  echo $article_widget->title?>" class="attachment-full size-full" data-s="<?php echo $img;?>" data-ss="<?php echo $img;?> " height="600" sizes="(max-width: 792px) 100vw, 792px" src="<?php echo $img;?>" title="<?php  echo $article_widget->title?>" width="792"></a>
										<div class="carousel-item-content">
											<h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
										</div>
									</div>
								</div>
				   
				   <?php ++$i; }?>
				 
		</div>
							
	</div>
      <?php   }?>
 
 <?php   if($options['styles']==4){?>
  <div class="widget Label three label feed has-title fix-height none-icon" id="Label5">
	<div class="feed-widget-header">
		<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="#"><?php  echo $options['judul']?></a> </h2>
		<div class="feed-widget-viewall">
									<a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><span>INDEX</span>
		<i class="fa fa-chevron-right"></i></a>
								</div>
		<div class="clear"></div>
	</div>
	<div class="widget-content feed-widget-content widget-content-Label5" id="widget-content-Label5">
		<?php
			$i=0;
			$hit=0;
			foreach($categories as $article_widget){
				++$hit;
				$class="";
				if($hit == 1){
					 $class=" item-two item-three item-four";
				}
				
				if($hit == 3){
					$hit=0;
				} 
				  
				   $img= strip_image($article_widget->body);?>
				    <div class="shad item item-<?php echo $i; echo $class?> than-0">
									 <div class="item-main">
										<a class="thumbnail item-thumbnail" href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="height: 180px"><span class="item-thumbnail-resize-landscape"><img alt="<?php  echo $article_widget->title?>" class="attachment-full size-full special optimized"  src="<?php echo $img?>" title="<?php  echo $article_widget->title?>" width="1200" height="800"></span></a>
										<div class="item-content gradident">
											<div class="bg item-labels">
												 <a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
													
											</div>
											<h2 class="item-title"><a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->title?></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
										</div>
									</div>
									  
				    </div>
				    
				 
				   
				   <?php
				   if($i==2){
					echo '<div class="clear"></div>';
				   }
				   
				   ++$i; }?> 
		
	</div>
  </div>
  
 <?php   }?>
 
 
 <?php   if($options['styles']==5){?>
 
 
 <?php   }?>
 
 <?php   if($options['styles']=='6'){?>
     <?php   $W= '285'; if($options['width'] <>''){ $W=$options['width'];}  ?>
      <div id="featured" class="widget" style="width:<?php  echo $W?>px">
	<h2 class="title" style="width:<?php  echo $W?>px;background:#<?php  echo @$options['warna']?>"><a href="<?php  echo base_url()?>news/category/<?php  echo @$categories[0]->category_slug?>"><?php  echo $options['judul']?></a></h2>
	<div style="margin:0px">
      <div class="section-intro clearfix" id="home-blog" style="padding-bottom:10px">
                 
                    <ul>
			<?php  if(is_array($categories)){
			 
			$img=array();
			$i=0;
			foreach($categories as $article_widget){
				++$i;
				if($i == '1'){
			 ?>
			  <li style="padding:5px 0px;height:auto">
				 <?php  echo anchor('/news/category/'.str_replace(',','-',$article_widget->category_slug),$article_widget->category_title,' class="label label-info"')?> | <span style="color:#FF810A"><b><?php  echo anchor('/news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="color:#FF810A"')?></b></span>
			     <span style="font-size:9px;color:#C1C1C1"> | <?php  echo date('M d, Y ', $article_widget->created_on)?></span>
						<span class="comm_bubble">
						
						<a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" ><?php  echo $article_widget->klik?></a>
						</span><br><br>
                        <table width="100%">
			 <tr>
			  <td style="width:20px;padding-right:5px">
			    <a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>">
			    <img  src="<?php  echo strip_image($article_widget->body);?>" alt="<?php  echo $article_widget->title?>" style="margin-bottom:0px;width:315px;height:170px;float:left;margin-bottom:12px" ></a>
			     
						
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:15px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="font-weight:bold;font-size:20px">
			  <?php  echo $article_widget->title?>
			   </a><br>
			 
			  </td>
			 </tr>
			 
			 <tr>
				<td colspan="2">
					
				</td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
			 <?php   }else{?>
                      <li style="border-top:1px dotted #C2C2C2;padding:5px 0px;height:auto">
                        <table>
			 <tr>
			  
			  <td>
				   
						<span style="color:#316560"><?php  echo anchor('/news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="color:#C1C1C1"')?></span><br>
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:15px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'news/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="font-weight:bold;font-size:15px">
			  <?php  echo $article_widget->title?>
			
			   </a>
			  </td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
		      <?php   }?>
		      <?php   }}?>
		       
                    </ul> 
                  
              </div>
        </div> 
              </div>
       
      <?php   }?>
 <?php   if($options['styles']=='7'){?> 
 <?php  if(is_array($categories)){?>
  
<h2><?php  echo $options['judul']?></h2>
 
<div class="right_articles">
	<table style="border:none">
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<tr>
				<td class="boxImg">
					<img src="<?php  echo strip_image($article_widget->body);?>" width="80px" style="border:1px solid #dedede;padding:2px"  alt="<?php  echo $article_widget->title?>" >
				</td>
				<td class="boxProfile" style="padding:10px 0px">
					 <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->intro?></a>
					 
				</td>
			</tr>
			<?php   }?>
			<tr> 
			</tr>
	</table>	
      <?php   }?>
	</div> 
			 
 <?php   }?>
 
 <?php   if($options['styles']=='8'){?> 
 <?php  if(is_array($categories)){?>
 
<div class="boxOuter">
<div class="boxInner"><h2><?php  echo strtoupper($options['judul'])?></h2></div>
<div class="boxContent">
	<table style="border:none">
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
				++$i;
			if($i==1){?>
			<tr>
				<td class="boxImg" colspan="2" style="text-align:center;border:none;border-bottom:1px solid #dedede">
					<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>">
					<img src="<?php  echo strip_image($article_widget->body);?>" width="250px" style="border:1px solid #dedede;padding:2px"  alt="<?php  echo $article_widget->title?>">
					</a>
				</td>
				 
			</tr>
			
			<?php   }else{ ?>
			<tr>
				<td class="boxImg">
					<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><img src="<?php  echo strip_image($article_widget->body);?>" width="80px" style="border:1px solid #dedede;padding:2px"  alt="<?php  echo $article_widget->title?>" >
					</a>
				</td>
				<td class="boxProfile">
					 <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->intro?></a>
					 
				</td>
			</tr>
			<?php   }}?>
			 
	</table>	
      <?php   }?>
	
</div>
</div>
<div style="padding-bottom:10px">&nbsp;</div>
			 
 <?php   }?>
 
 
<?php   if($options['styles']=='9'){?>
<?php  if(is_array($categories)){?>
<div style="background:#fff;padding:0px; display:block;position:relative;">
 <h2><?php  echo strtoupper($options['judul'])?></h2> 
<div style="padding:5px;;display:block">
	<table style="border:none">
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<tr>
				<td style="width:50px;border:none;border-bottom:1px solid #dedede;padding:10px 0px">
					<img src="<?php  echo strip_image($article_widget->body);?>" width="55px" style="border:1px solid #dedede;padding:2px"  alt="<?php  echo $article_widget->title?>">
				</td>
				<td style="width:100%;border:none;border-bottom:1px solid #dedede;padding:10px 0px">
					 <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a>
					 
				</td>
			</tr>
			<?php   }?>
	</table>	
      <?php   }?>
	
</div>
</div>
<div style="padding-bottom:10px">&nbsp;</div>
      <?php   }//print_r($options)?>
 <?php   if($options['styles']=='10'){?>
 <?php  if(is_array($categories)){?>
 <h2><?php  echo $options['judul']?></h2>
 <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #dedede;padding:7px">
  <?php   foreach($categories as $article_widget){ ?>
  <tr>
   <td align="center">
    <img src="<?php  echo strip_image($article_widget->body);?>" width="200px" height="120px" style="border:1px solid #dedede;padding:2px"  alt="<?php  echo $article_widget->title?>">
   </td>
  </tr>
  <tr>
   <td>
    <table width="100%">
     <tr>
      <td>
        <b > <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a></b>
      </td>
     </tr>
     <tr>
      <td>
       <?php  echo htmltotext($article_widget->intro)?>
      </td>
     </tr>
    </table>
   </td>
  </tr>
  <?php   }?>
 </table>
 <?php   }?>
 <?php   }?>
 
  
 <?php   if($options['styles']=='11'){?>
     <?php   $W= '640'; if($options['width'] <>''){ $W=$options['width'];}  ?>
      <div id="featured" class="widget" style="width:<?php  echo $W?>px">
	<h2 class="title" style="width:<?php  echo $W?>px;background:#<?php  echo @$options['warna']?>"><a href="<?php  echo base_url()?>news/category/<?php  echo @$categories[0]->category_slug?>"><?php  echo $options['judul']?></a></h2>
	<div style="margin:0px">
		
      <div class="section-intro clearfix" id="home-blog" style="padding-bottom:10px">
	
	 <?php  if(is_array($categories)){ $i=0;?>
		 
			<?php 
			 $jml=count($categories);
			 $i=0;
			foreach($categories as $article_widget){ ++$i;
			$intro[$i]=htmltotext($article_widget->intro);
			$body[$i]=$article_widget->body;
			$title[$i]=$article_widget->title;
			$klik[$i]=$article_widget->klik;
			$slug[$i]=$article_widget->slug;
			$cslug[$i]=$article_widget->category_slug;
			$ctitle[$i]=$article_widget->category_title;
			$date[$i]=date('Y/m',$article_widget->created_on);
			$dates[$i]=$article_widget->created_on;
			$keyword[$i]=str_replace(',','-',$article_widget->keyword);
			$caption[$i]=$article_widget->katakunci;
			 
				 ?>
				 
						
						 
		
		<?php   }}?>
                 
                       <table width="100%">
			 <tr>
			  <td style="width:330px;padding-right:5px">
				<?php  echo anchor('/news/category/'.str_replace(',','-',$slug[1]),$ctitle[1],'class="label label-important"')?>  <span style="color:#c1c1c1"> | <?php  echo anchor('/news/keyword/'.$keyword[1],'#'.$keyword[1],' style="color:#719429"')?></span>
			     <span style="font-size:9px"> | <?php  echo date('M d, Y ', $dates[1])?></span>
						<span class="comm_bubble">
						
						<a href="<?php  echo base_url().'news/'.$date[1] .'/'.$slug[1]?>" ><?php  echo $klik[1]?></a>
						</span><br>
			    <a href="<?php  echo base_url().'news/'.$date[1] .'/'.$slug[1]?>"><img  src="<?php  echo strip_image($body[1]);?>" alt="<?php  echo $title[1]?>" style="margin-bottom:0px;width:115px;height:90px;float:left;margin-right:12px;margin-top:10px"  alt="<?php  echo $title[1]?>"></a>
			     
						
						<?php   if($caption[1]){?>
						 <div style="color:green;font-size:15px;font-weight:bold"><?php  echo $caption[1]?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'news/'.$date[1] .'/'.$slug[1]?>" style="font-weight:bold;font-size:20px">
			  <?php  echo $title[1]?>
			   </a><br>
			 			  <?php  echo $intro[1]?>
			  </td>
			 
				<td style="padding-right:0px">
					<ul style="width:100%">
					<?php   for($as=2;$as <= $jml;$as++){?>
					<li style="border-bottom:1px dotted #C2C2C2;padding:5px 0px;height:auto">
						 
						
						<?php   if($caption[$as]){?>
						 <div style="color:green;font-size:15px;font-weight:bold"><?php  echo $caption[$as]?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'news/'.$date[$as] .'/'.$slug[$as]?>" style="font-weight:bold;font-size:15px">
			  <?php  echo $title[$as]?>
			   </a>
					</li>
					<?php   }?>
					</ul>
				</td>
			 </tr>
			 <tr>
				<td colspan="2" style="padding-right:0px;">
					<div style="letter-spacing: 2px;color:#649C00"><b>BERITA <?php  echo $article_widget->category_title?> INI BANYAK DIBACA</b></div>
					 

						<?php 
						$tgls=strtotime ( '-2 day' , strtotime(date('Y-m-d')) ) ;
						//echo date('d-m-Y',$tgls);
					$pop=$this->db->where('created_on > ',$tgls)->where('category_id',$article_widget->category_id)->order_by('klik','DESC')->limit(6)->get('news')->result();
					//print_r($pop);
					 
					foreach($pop as $datpop=>$valklik){
						 
						 
						?>
					<div style="border-bottom:1px dotted #dedede;padding:5px">
						<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$valklik->created_on)?>/<?php  echo $valklik->slug?>" style="color:#2B67A2"><?php echo $valklik->title;?></a>
						<span style="float:right"><a href="<?php  echo base_url()?>news/keyword/<?php  echo $valklik->keyword?>"><b>#<?php  echo $valklik->keyword?></b></a></span>
					</div>
					<?php   }
					
					?>
					 
					</td>
			 </tr>
			 </table>
                  
              </div>
    
        </div> 
              </div>
       
      <?php   }?>
 
 <?php   if($options['styles']=='12'){?>
 <div class="widget Label three label feed has-title fix-height none-icon" id="Label5">
							<div class="feed-widget-header">
								<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><?php echo $options['judul']?></a></h2>
								<div class="feed-widget-viewall">
									 
									<a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><span>INDEX</span> <i class="fa fa-chevron-right"></i></a>
								</div>
								<div class="clear"></div>
								
								<?php  if(is_array($categories)){ $i=0;?>
<?php
$class[1] = 'shad item item-0 item-two item-three item-four';
$class[2] = 'shad item item-1 than-0';
$class[3] = 'shad item item-2 item-two than-0 than-1';
$class[4] = 'shad item item-3 item-three than-0 than-1 than-2';
$class[5] = 'shad item item-4 item-two item-four than-0 than-1 than-2 than-3';
$class[6] = 'shad item item-5 than-0 than-1 than-2 than-3 than-4'; 

foreach($categories as $article_widget){ ++$i;
 $img= strip_image($article_widget->body);

?>
				 <div class="<?php echo $class[$i]?>">
									<div class="item-main">
				<a class="thumbnail item-thumbnail" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" style="height: 180px">
				<img alt="<?php echo $article_widget->title?>" class="attachment-full size-full" data-s="<?php echo $img?>" data-ss="<?php echo $img?>" height="533" sizes="(max-width: 800px) 100vw, 800px" src="<?php echo $img?>" title="<?php echo $article_widget->title?>" width="800"></a>
				
										<div class="item-content gradident">
											<div class="bg item-labels">
												 	<a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
													
											</div>
											
											
											<h2 class="item-title"><a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php echo $article_widget->title?>"><?php echo $article_widget->title?></a>
											
											</h2>
										</div>
									</div>
									<div class="item-sub">
										 <div class="item-snippet"><?php echo $article_widget->intro?></div>
										<div class="meta-items">
											<?php if($article_widget->keyword){?>
											  <span><?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="text-shadow:none;font:12px Oswald;"')?></span>
											  <?php }?><a class="meta-item meta-item-date" href="#">
												<i class="fa fa-clock-o"></i> <span><?php  echo date('M d,Y',$article_widget->created_on)?></span>
											  </a>
										</div>
									</div>
								</div>			
				 
				<?php   }?>
				 
 <?php   }?>
							</div>
 </div>
  <div class="clear"></div>
						<div class="clear"></div>
 <?php   }?>
 
 
 
 <?php   if($options['styles']=='13'){?>
 <div class="widget Label three label feed has-title fix-height none-icon" id="Label5">
							<div class="feed-widget-header">
								<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><?php echo $options['judul']?></a></h2>
								<div class="feed-widget-viewall">
									 
									<a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><span>INDEX</span> <i class="fa fa-chevron-right"></i></a>
								</div>
								<div class="clear"></div>
								
								<?php  if(is_array($categories)){ $i=0;?>
<?php
$class[1] = 'shad item item-0 item-two item-three item-four';
$class[2] = 'shad item item-1 than-0';
$class[3] = 'shad item item-2 item-two than-0 than-1';
$class[4] = 'shad item item-3 item-three than-0 than-1 than-2';
$class[5] = 'shad item item-4 item-two item-four than-0 than-1 than-2 than-3';
$class[6] = 'shad item item-5 than-0 than-1 than-2 than-3 than-4'; 

foreach($categories as $article_widget){ ++$i;
 $img= strip_image($article_widget->body);

?>
				 <div class="<?php echo $class[$i]?>">
									<div class="item-main">
				<a class="thumbnail item-thumbnail" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" style="height: 180px"><img alt="<?php echo $article_widget->title?>" class="attachment-full size-full" data-s="<?php echo $img?>" data-ss="<?php echo $img?>" height="533" sizes="(max-width: 800px) 100vw, 800px" src="<?php echo $img?>" title="<?php echo $article_widget->title?>" width="800"></a>
										 
									</div>
									 
								</div>			
				 
				<?php   }?>
				 
 <?php   }?>
							</div>
 </div>
  <div class="clear"></div>
						<div class="clear"></div>
 <?php   }?>
 

 				
<?php   if($options['styles']=='14'){?>
 <div class="widget Label blogging label feed has-title fix-height none-icon" id="Label7">
							<div class="feed-widget-header">
								<h2 class="widget-title feed-widget-title" style="border-bottom: 2px solid #000000; margin-bottom: 10px;"><a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><?php echo $options['judul']?></a></h2>
								<div class="feed-widget-viewall">
									 
									<a href="<?php echo base_url().'news/category/'.$categories[0]->category_slug?>"><span>INDEX</span> <i class="fa fa-chevron-right"></i></a>
								</div>
								<div class="clear"></div>

								<?php  if(is_array($categories)){ $i=0;?>
								<div class="widget-content feed-widget-content widget-content-Label7" id="widget-content-Label7">
<?php
$class[1] = 'shad item item-0 item-two item-three item-four';
$class[2] = 'shad item item-1 than-0';
$class[3] = 'shad item item-2 item-two than-0 than-1';
$class[4] = 'shad item item-3 item-three than-0 than-1 than-2';
$class[5] = 'shad item item-4 item-two item-four than-0 than-1 than-2 than-3';
$class[6] = 'shad item item-5 than-0 than-1 than-2 than-3 than-4'; 

foreach($categories as $article_widget){ ++$i;
 $img= strip_image($article_widget->body);

?>
				<div class="<?php echo $class[$i]?>"> 
				<a class="thumbnail item-thumbnail" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" style="height: 180px"><img alt="<?php echo $article_widget->title?>" class="attachment-full size-full" data-s="<?php echo $img?>" data-ss="<?php echo $img?>" height="533" sizes="(max-width: 800px) 100vw, 800px" src="<?php echo $img?>" title="<?php echo $article_widget->title?>" width="800"></a>
				<div class="item-content">
										<div class="bg item-labels">
											<a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
										</div>
										<h2 class="item-title"><a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php echo $article_widget->title?>"><?php echo $article_widget->title?></a></h2>
										<div class="meta-items">
											 <span><?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="text-shadow:none;font:12px Oswald;"')?></span>
											 <a class="meta-item meta-item-date" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><i class="fa fa-clock-o"></i> <span><?php  echo date('M d,Y',$article_widget->created_on)?></span></a>
										</div>
										<div class="item-sub">
											<div class="item-snippet">
												<?php echo $article_widget->intro?>
											</div>
											
										</div>
										<div class="clear"></div>
									</div>
									<div class="clear"></div>				 
								 
				</div>	 
								 		
				 
				<?php   }?>
								</div>
				 
 <?php   }?>
							</div>
 </div>
  <div class="clear"></div>
						<div class="clear"></div>
 <?php   }?>
 
 
 <?php 
 //berita style 3
 if($options['styles']=='15'){?>
  
			
<div class="widget Label list label feed has-title fix-height" id="Label11">
						<div class="feed-widget-header">
							<h2 class="widget-title feed-widget-title"><span><i class="fa fa-clock-o"></i> <?php echo $options['judul']?></span></h2>
							<div class="clear"></div>
						</div>
				 <div class="widget-content feed-widget-content widget-content-Label11" id="widget-content-Label11">		
 <?php  if(is_array($categories)){ ?>

<?php
$i=0;
foreach($categories as $article_widget){
	++$i;
	if($i==1){
		$calss='shad item item-0 item-two item-three item-four';
	}else{
		$calss='shad item item-1 than-0';
	}
	?>
<div class="<?php echo $calss?>">
								<div class="tr">
									<div class="td item-index">
										<?php echo $i?>.
									</div>
									<div class="td">
										<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><h2 class="item-title"><a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></span></a>  <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
									</div>
									<div class="td item-readmore">
										<a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div>
							<div class="clear"></div>
				 
				<?php   }?>

 <?php   }?>
  
	</div>
</div>			 
 <?php   }?>
  
 
 <?php 
 //berita style 3
 if($options['styles']=='16'){
	
	?>
  
			
<div class="widget Label blogging label feed has-title fix-height none-icon" id="Label12">
						<div class="feed-widget-header">
							<h2 class="widget-title feed-widget-title"><a href="index3dc5.html?p=*"><?php echo $options['judul']?></a></h2>
							<div class="clear"></div>
						</div>
				<div class="widget-content feed-widget-content widget-content-Label12" id="widget-content-Label12">		
 <?php  if(is_array($categories)){ ?>

<?php
$i=0;
foreach($categories as $article_widget){
	$img= strip_image($article_widget->body);
	++$i;
	if($i==1){
		$calss='shad item item-0 item-two item-three item-four';
	}else{
		$calss='shad item item-1 than-0';
	}
	?>
<div class="<?php echo $calss?>">
<a class="thumbnail item-thumbnail" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" style="height: 50px">
	<img alt="<?php   echo $article_widget->title?>" class="attachment-full size-full" data-s="<?php echo $img?>" data-ss="<?php echo $img?>" height="600" sizes="(max-width: 1000px) 100vw, 1000px" src="<?php echo $img?>" title="<?php   echo $article_widget->title?>" width="1000">
</a>
<div class="item-content">
									<h2 class="item-title"><a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php   echo $article_widget->title?>"><?php   echo $article_widget->title?></a> <?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="color:red;text-shadow:none;"')?></h2>
									<div class="item-sub"></div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
								
								 
							</div>
							<div class="clear"></div>
				 
				<?php   }?>

 <?php   }?>
  
	</div>
</div>			 
 <?php   }?>
      
      
      			
 <?php 
 //berita style 3
 if($options['styles']=='17'){
	
	?>
  
			
<div class="widget Label one label feed has-title fix-height none-icon" id="Label16">
						<div class="feed-widget-header">
							<h2 class="widget-title feed-widget-title"><a href="index3dc5.html?p=*"><?php echo $options['judul']?></a></h2>
							<div class="clear"></div>
						</div>
				<div class="widget-content feed-widget-content widget-content-Label16" id="widget-content-Label16">	
 <?php  if(is_array($categories)){ ?>

<?php
$i=0;
foreach($categories as $article_widget){
	$img= strip_image($article_widget->body);
	++$i;
	if($i==1){
		$calss='shad item item-0 item-two item-three item-four';
	}else{
		$calss='shad item item-1 than-0';
	}
	?>
<div class="<?php echo $calss?>">
 <div class="item-main">
									<a class="thumbnail item-thumbnail" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" style="height: 200px"><img alt="<?php   echo $article_widget->title?>" class="attachment-full size-full" data-s="<?php echo $img?>" data-ss="<?php echo $img?>" height="600" sizes="(max-width: 1000px) 100vw, 1000px" src="<?php echo $img?>" title="<?php   echo $article_widget->title?> hiding" width="1000"></a>
									<div class="item-content gradident">
										<div class="bg item-labels">
											<a href="<?php echo base_url().'news/category/'.$article_widget->category_slug?>"><?php echo $article_widget->category_title?></a>
										</div>
										<h2 class="item-title"><a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php   echo $article_widget->title?>"><?php   echo $article_widget->title?></a>
										<?php  echo anchor('news/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' class="meta-item meta-item-author" style="text-shadow:none;font:12px Oswald;"')?>
										</h2>
									</div>
								</div>
								<div class="item-sub">
									<div class="item-snippet">
										<?php   echo $article_widget->intro?> 
									</div>
									
								</div>
								<div class="clear"></div>
</div>
				<?php   }?>

 <?php   }?>
  
	</div>
</div>			 
 <?php   }?>
 
