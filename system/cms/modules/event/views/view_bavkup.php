 <script>document.getElementById("modulename").innerHTML = "<?php echo  ($post->category->title)?>"</script>
 <?php if(($post->category->banner)){?>
 <style>
	#header {
    background-image: url("<?php echo trim_banner($post->category->banner) ?>");
    background-position: right top;
    background-repeat: no-repeat;
    background-size: cover;
    height: 350px;
    margin: 0 auto;
    position: relative;
}

 </style>
 
 <?php }?>


 
    
     
  
<div class="bg-light padding-md" id="feature">
				<div class="container">
					<div class="panel">
					                    <div class="panel-body  pad-all">
												<div class="row mar-all">
												<div class="col-sm-9 ">
													<form class="form-inline" action="event/search" method="post">
					           <!-- <div class="form-group">
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
													<a href="<?php echo base_url()?>event/create"  class="btn btn-danger btn-icon" style="color:#fff"><i class="demo-psi-pen-5 icon-lg"></i> Send Us Your Event</a>
													  
					                    </div>
												<div class="col-sm-3 hidden-sm hidden-xs">
													 
													<button class="btn btn-info" onClick="window.print();"><i class="fa fa-print"></i> Print</button>
													<a href="<?php echo base_url()?>event/create"  class="btn btn-danger btn-icon" style="color:#fff"><i class="demo-psi-pen-5 icon-lg"></i> Send Us Your Event</a>
													  
					                    </div>
												</div>
											 </div>
					               </div>
					<?php  $images = get_image($post->body);
					$jml = count($images[1]);
					if($jml > 1){
					?>
					<div class="row">
					    <div class="eq-height">
					        <div class="col-sm-4  eq-box-sm">
					
					            <!--Basic Panel-->
					            <!--===================================================-->
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="text-2x text-mint  asikfont pad-all">
							 <?php echo text_only($post->title); ?>
						      </div>
						      <img src="images/pembatas.png" style="height:20px;width:100%">
						      <div class="text-left pad-all">
							
							 <?php echo text_only($post->intro);
							
							 //echo '<pre>';
							
							 ?>
							  
						      </div>
					                </div>
					            </div>
					            <!--===================================================-->
					            <!--End Basic Panel-->
					
					        </div>
					        <div class="col-sm-4 col-lg-10 eq-box-sm fadeInUp animated-element">
					
					           <div class="panel bord-no" style="background: none;">
					
					            <!--Carousel-->
					            <!--===================================================-->
					            <div id="demo-carousel" class="carousel slide mar-no" data-ride="carousel">
					
					                <!--Indicators-->
					                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					                <ol class="carousel-indicators out">
											<?php for($i=0;$i<$jml;++$i){
												$active='';
												if($i==0){ $active='active';}
												?>
					                    <li class="text-danger <?php echo $active?>" data-slide-to="0" data-target="#demo-carousel"></li>
					                    <?php }?>
					                </ol>
					                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					
					                <div class="carousel-inner text-center" style="max-height:380px">
					<?php for($i=0;$i<$jml;++$i){
												$active='';
												if($i==0){ $active='active';}
												?>
					                    
					                    <!--Item 3-->
					                    <div class="item <?php echo $active?> pad-no">
					                       <img src="<?php  echo !($images[1][$i])?'/pariwisata/images/no-image-box.png':$images[1][$i];?>" style="width:100%;height:100%">
					                    </div>
											  <?php }?>
					                </div>
					
					                <!--carousel-control-->
					                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					                <a class="carousel-control text-warning left" data-slide="prev" href="#demo-carousel"><i class="demo-pli-arrow-left icon-2x"></i></a>
					                <a class="carousel-control text-warning right" data-slide="next" href="#demo-carousel"><i class="demo-pli-arrow-right icon-2x"></i></a>
					                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					
					            </div>
					            <!--===================================================-->
					            <!--End Carousel-->
					
					
					        </div>
					        </div>
					        
					    </div>
					</div>

<?php }?>
										
<div class="fixed-fluid">
					            <div class="fixed-lg-300 pull-lg-right">
						<?php if(($post->alamat) || ($post->lat) || ($post->operasional) || ($post->phone)){
							
							$arr_from = explode('-',str_replace('00:00:00','',$post->date_from));
							
							$start = $arr_from[2].'-'.$arr_from[1].'-'.$arr_from[0];
							
							$arr_end = explode('-',str_replace('00:00:00','',$post->date_end));
							$stop = $arr_end[2].'-'.$arr_end[1].'-'.$arr_end[0];
			
			?>
						
					                <div class="panel">
					                     
					                    <div class="panel-body">
						<ul class="list-group bg-trans text-sm">
					 <li class="list-group-item list-item-sm bord-btm">
											<i class="fa fa-calendar  icon-lg icon-fw text-success "></i><?php echo $start?>   
											</li>
											<li class="list-group-item list-item-sm bord-btm">
											<i class="fa fa-calendar  icon-lg icon-fw text-danger"></i><?php echo $stop?>
											</li>
					                <!-- Profile Details -->
					                <?php if(($post->alamat)){?>
					                <li class="list-group-item list-item-sm bord-btm">
					             	<strong class="text-main">Address</strong><br>
					              <address>   
				 <?php echo $post->alamat?>
									  </address>
					                </li>
					                <?php }?>
					                <?php if(($post->lat)){?>
					                <li class="list-group-item list-item-sm bord-btm">
						<a class="btn btn-block btn-success btn-map" data-lat="<?php echo $post->lat?>, <?php echo $post->lng?>" data-toggle="modal" data-target="#myMapModal" style="color:#fff"><i class="fa fa-map-marker"></i> View on map</a>
						<hr>
						 
					                </li>
										
					                <?php }?>
					                <li class="list-group-item list-item-sm">
					                     <?php echo $post->operasional?>
					                </li>
										 
					                <?php if(($post->phone)){?>
					                <li class="list-group-item list-item-sm">
					                     <i class="fa fa-phone icon-lg icon-fw"></i><?php echo $post->phone?>
					                </li>
					                <?php }?>
					            </ul>
						
					                    </div>
					                </div>
					
					                <?php }?>
             <?php  $jml = count($images[1]); for($i=0;$i<$jml;$i++){?>
						<div class="panel">
							<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Gallery" data-caption="<?php echo $post->title?>" data-image="<?php  echo !($images[1][$i])?'/pariwisata/images/no-image-box.png':$images[1][$i];?>" data-target="#image-gallery">
						 <img src="<?php  echo !($images[1][$i])?'/pariwisata/images/no-image-box.png':$images[1][$i];?>" style="width:100%;height:100%">
							</a>
						</div>
						<?php }?>
						  
						</div>
					            <div class="fluid fadeInUp animated-element">
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5846e5df0fb84a6d"></script>
				<div class="addthis_inline_share_toolbox"></div> 
					<img alt="0" src="<?php echo trim_image($post->body); ?> " width="100%">
					
					                <div class="panel">
					                    <div class="panel-body">
					
					                         <article class="post">
                              <div class="post_content ">
                                   
                              <?php echo text_only($post->body); ?>     
							 
                         </article> 
					
					                    </div>
					                </div>
					              
					            </div>
					            
					            
					            <!--start -->
	</div>
				</div>
				</div>		
<?php if(($inrecomend)){?>
<div class="bg-white text-center content-padding">
				<div class="container">
<div class="row">
	<div class="text-2x text-mint  asikfont pad-all text-center">Rekomendasi </div>
					    <div class="eq-height">
					        <?php
		
			foreach($inrecomend as $datacategory => $resCategory){ ?>
					        <div class="col-sm-4 eq-box-sm">
					
					            <!--Basic Panel-->
					            <!--===================================================-->
					            <div class="panel">
					<a href="<?php echo base_url().$this->nama_modul.'/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>">	<img src="<?php echo trim_image($resCategory->body)?>" style="max-height:200px;width:100%"></a>
					                <div class="panel-body">
					                    <div><h4><a href="<?php echo base_url().$this->nama_modul.'/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>"  class="text-semibold text-danger"><?php echo $resCategory->title?></a></h4></div>
					<?php echo $resCategory->intro?>
					                </div>
					            </div>
					            <!--===================================================-->
					            <!--End Basic Panel-->
					
					        </div>
					      <?php } ?>   
					    </div>
</div>
				</div></div>
<?php }?>

<!--Panel heading-->
<?php if(($incategory)){?>			            
<div class="padding-md">
				<div class="container">
<div class="fluid">					            
<div class="row" style="padding-top:30px">
	<div class="text-2x text-mint  asikfont pad-all text-center">Also Check Out</div>
	<div class="eq-height">
		<?php
		
			foreach($incategory as $datacategory => $resCategory){ ?>
			 <div class="col-sm-4 eq-box-sm">
					
			 <!--Basic Panel-->
			<!--===================================================-->
			
			<div class="panel">
				<div style="border-radius: 8px;background: url('<?php echo trim_image($resCategory->body)?>');background-position: center;background-repeat: no-repeat;background-size: cover;min-height:200px">
					 <a href="<?php echo base_url().'event/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>"><img src="<?php echo base_url()?>images/bgtrans.png" style="width:100%;max-height:200px"></a>
						 
					</div>	
			 <div class="panel-body">
				<div><h4><a href="<?php echo base_url().$this->nama_modul.'/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>"  class="text-semibold text-danger"><?php echo $resCategory->title?></a></h4></div>
			 
			</div>
			</div>
			<!--===================================================-->
			<!--End Basic Panel-->

			</div>	
			<?php }
		 
		?>
					       
					       
	</div>
</div>
</div>
</div>
</div>
<?php }?>

					            <!-- end -->
					        </div>
 
								
								
 	<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-body" >
                <img id="image-gallery-image" class="img-responsive" src="" style="width:100%">
            </div>
           
        </div>
    </div>
</div>							 
 
  
