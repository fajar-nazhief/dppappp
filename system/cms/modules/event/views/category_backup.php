<script>document.getElementById("modulename").innerHTML = "<?php echo  ($blog[0]->category_title)?>"</script>

                        <?php if(($blog[0]->banner)){?>
 <style>
	#header {
    background-image: url("<?php echo trim_banner($blog[0]->banner) ?>");
    background-position: right top;
    background-repeat: no-repeat;
    background-size: cover;
    height: 350px;
    margin: 0 auto;
    position: relative;
}

 </style>
 
 <?php }?>
<div class="bg-white padding-md" id="feature">
	<div class="container">
					<div class="panel">
					                    <div class="panel-body  pad-all">
												<div class="row mar-all">
												<div class="col-sm-9 ">
													<form class="form-inline" action="event/search" method="post">
					         <!--   <div class="form-group">
					                <label for="demo-inline-inputmail" class="sr-only">Category</label>
					                <?php echo form_dropdown('f_category',array('0'=>'--All--')+$folders_tree,@$_SESSION['f_category'],' class="form-control"')?>
					            </div> -->
					            <div class="form-group">
					                <label for="demo-inline-inputpass" class="sr-only">Keywords</label>
					                <input name="f_keywords" placeholder="Keywords" id="demo-inline-inputpass" class="form-control" type="text" value="<?php echo @$_SESSION['f_keywords']?>">
					            </div>
					           <div class="form-group" id="demo-dp-txtinput">
					                                <input name="date_from" class="form-control" value="<?php echo @$_SESSION['date_from']?>" type="text">
					                            </div>
					           To 
					           <div class="form-group" id="demo-dp-txtinput">
					                                <input name="date_end" class="form-control" value="<?php echo @$_SESSION['date_end']?>" type="text">
					                            </div>
					            <button class="btn btn-primary" type="submit" name="search" value="Submit">Submit</button>
					        </form>
												</div>
													<div class="col-sm-3 hidden-lg hidden-md mar-all">
													 
													<button class="btn btn-info" onClick="window.print();"><i class="fa fa-print"></i> Print</button>
													<a href="<?php echo base_url()?>event/create"  class="btn btn-danger btn-icon"><i class="demo-psi-pen-5 icon-lg"></i> Send Us Your Event</a>
													   <a href="<?php echo str_replace(array('/category'),array('/category_download/'),$this->uri->uri_string())?>" alt="Download Xls." class="btn btn-success btn-icon"><i class="fa fa-download  icon-lg"></i> </a>
													
					                    </div>
												<div class="col-sm-3 hidden-sm hidden-xs">
													 
													<button class="btn btn-info" onClick="window.print();"><i class="fa fa-print"></i> Print</button>
													<a href="<?php echo base_url()?>event/create"  class="btn btn-danger btn-icon"><i class="demo-psi-pen-5 icon-lg"></i> Send Us Your Event</a>
													  <a href="<?php echo str_replace(array('/category'),array('/category_download/'),$this->uri->uri_string())?>" alt="Download Xls." class="btn btn-success btn-icon"><i class="fa fa-download  icon-lg"></i> </a>
													
					                    </div>
												</div>
											 </div>
					               </div>
					</div>
				<div class="container">
					<div class="pad-ver mar-btm pull-right">
<?php if (($blog)): ?>

<div class="row">
<div class="eq-height">
<?php
$hit=0; 
foreach ($blog as $post):
++$hit;
$body = strip_tags(text_only($post->body), '<p><a><br />');
if($hit <= 3){?>
	<div class="col-sm-4 eq-box-sm">
				<!--Panel with Footer-->
				<!--===================================================-->
				
				<div class="panel detail fadeInUp animated-element no-border">
					 <div style="border-radius: 8px;background: url('<?php echo trim_image($post->body)?>');background-position: center;background-repeat: no-repeat;background-size: cover;min-height:200px">
						 <a href="<?php echo base_url().'news/' .date('Y/m', $post->created_on) .'/'. $post->slug?>"><img src="<?php echo base_url()?>images/bgtrans.png" style="width:100%;max-height:200px"></a>
					</div>
					<?php if(($post->date_from >= now()) AND (now() <= $post->date_end)){?>
					 <div class="post-review" style="background-color: #9e673c; background: linear-gradient(to bottom, #9e673c 0%,#da9858 100%);">
                <div class="post-review-score" style="font-size:12px">Today<span></span>
                </div>
            </div>
		<?php }?>			
					<div class="panel-body">
					 
<div class="post-content-container">

				<div class="post-categories-container"><div class="post-categories"><a href="<?php echo base_url()?>event/category/<?php echo  ($post->category_slug)?>"><?php echo  ($post->category_title)?></a></div></div>
				
					<h2><a href="<?php echo base_url().'event/' .date('Y/m', $post->created_on) .'/'. $post->slug?>" class="post-title asikfont"><?php echo $post->title?>&nbsp;<span class="post-read-later tooltipstered" data-type="add" data-id="53"><i class="fa fa-bookmark-o"></i></span>					</a></h2>				

									<div class="post-content">
						<p><?php echo substr($body,0,200);
							 if(strlen($body) > 200){echo '...';}?></p>
					</div>
				
				<div class="post-meta">
					
    <div class="post-meta">
					
     <div class="post-meta-content text-info">
                    <span class="post-auhor-date">
                               
	            <span>
                <span href="#" class="post-author text-info"><b>Event Date</b></span></span>,
                                    <span href="#" class="post-date text-info">
                                                <?php echo date_format( date_create($post->date_from),'d-m-Y')?>                   </span>
                            </span>
        
                
                
                            <span href="#" class="post-comments text-info">
                <i class="icon icon-bubble"></i>
                <b>Until  </b>         </span>
        
                            <span class="post-readtime">
                <i class="icon icon-clock"></i>
                 <?php echo date_format( date_create($post->date_end),'d-m-Y')?> 
                 </span>
        
                 
                                            
                        </div>

				</div>

				</div>
			</div>
				 
					</div>
					 
				</div><!--===================================================-->
				<!--End Panel with Footer-->
			</div>
<?php }else{
echo '</div></div><div class="row"><div class="eq-height">';
$hit=0;
}
?> 
 
	 
<?php endforeach; ?>

<p>&nbsp;</p>


<?php else: ?>
	<p><?php echo lang('blog_currently_no_posts');?></p>
<?php endif; ?>
					</div>
				</div>
</div>
	 </div></div>
	 
	<div class=" pad-all bg-white">
		<div class="container"><?php echo $pagination['links']; ?></div>
		
	</div> 