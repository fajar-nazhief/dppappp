<div class="container">
<?php 
 if(($article->category->banner)){?>
 <script>
	 
	 $(".head").attr("src","<?php echo trim_banner($article->category->banner) ?>");
	 </script>
 
 <?php }?>

 <div class="title">
		<h2><?php echo $article->title?></h2>
		<small>{pyro:theme:partial name="breadcrumbs"}</small>
	</div>
	<?php if(($article->alamat) || ($article->lat) || ($article->operasional) || ($article->phone)){?>
<div class="row canvas">
  <div class="col-sm-4">
  <object class="icon" type="image/svg+xml" data="assets/images/icon/placeholder.svg"></object>
    <h5>Address</h5>
    <p>
	<?php if(($article->alamat)){?>
				 <?php echo $article->alamat?> 
	<?php }?>
	</p>
	<p> <?php if(($article->lat)){?> 
						<a class="btn btn-block btn-success btn-map" data-lat="<?php echo $article->lat?>, <?php echo $article->lng?>" data-toggle="modal" data-target="#myMapModal" style="color:#fff"><i class="fa fa-map-marker"></i> View on map</a>
					
						 
					                <?php }?></p>
  </div>
  <div class="col-sm-4">
    <object class="icon" type="image/svg+xml" data="assets/images/icon/timer.svg"></object>
    <h5>Open at</h5>
    <p> <?php echo $article->operasional?></p>
  </div>
  <div class="col-sm-4">
    <object class="icon" type="image/svg+xml" data="assets/images/icon/telephone.svg"></object>  
    <h5>Contact</h5>
    <p><?php echo $article->phone?> | <?php echo $article->email?></p>
  </div>
</div>
	<?php }?>


	
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5846e5df0fb84a6d"></script>
<div class="deskripsi">

				<?php  $body = ($article->body);
							 $intro = text_only($article->intro);
							 ?>  
							 <?php  
							 if(strlen($intro) > 400){echo '...';}
							 $images = get_image($article->body);
							 //echo '<pre>';
							
							 ?>
							  <?php echo $body; ?>  

 </div>

 <div class="gallery">
	
 <?php  $jml = count($images[1]);
 if($jml==0){ ?>
 
<div class="gallery-item">
		<a class="thumbnail" href="javascript:void(0)" onClick="openmodal('<?php echo $def = 'http://utara.jakarta.go.id/srv-5/images/berita/'.$article->foto;?>')">
			<img class="gallery-image" src="<?php echo $def = 'http://utara.jakarta.go.id/srv-5/images/berita/'.$article->foto;?>" alt="<?php echo $article->title?>">
			 </a>
		</div>

 <?php }
             for($i=0;$i<$jml;$i++){
             ?>
		<div class="gallery-item">
		<a class="thumbnail" href="javascript:void(0)" onClick="openmodal('<?php  echo empty($images[1][$i])?'/pariwisata/images/no-image-box.png':$images[1][$i];?>')">
			<img class="gallery-image" src="<?php  echo empty($images[1][$i])?'/pariwisata/images/no-image-box.png':$images[1][$i];?>" alt="<?php echo $article->title?>">
			 </a>
		</div>
		<?php  }?>
			 </div>
 <div class="addthis_inline_share_toolbox" style="margin:10px"></div>
     
<?php if(($inrecomend)){?>
<div class="bg-white text-center content-padding">
				<div class="container">
					   
<div class="row" style="padding-top:30px">

<h1 class="section-header">Rekomendasi</h1>
					    <div class="eq-height">
					        <?php
		
			foreach($inrecomend as $datacategory => $resCategory){ ?>
					        <div class="col-sm-4 eq-box-sm">
					
					            <!--Basic Panel-->
					            <!--===================================================-->
					            <div class="panel">
						<img src="<?php echo trim_image($resCategory->body,$resCategory->foto)?>" style="max-height:200px;width:100%">
					                <div class="panel-body">
					                    <div><a href="<?php echo base_url().'news/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>"  class="text-semibold text-danger" style="text-decoration:none"><?php echo $resCategory->title?></a></div>
					<?php //echo $resCategory->intro?>
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
<?php if(($bacajuga)){?>
				            
<div class="padding-md">
				<div class="container">
<div class="fluid">					            
<div class="row" style="padding-top:30px">

<h1 class="section-header">Artikel Terkait</h1>
	<div class="eq-height">
		<?php
		
			foreach($bacajuga as $datacategory => $resCategory){ ?>
			 <div class="col-sm-4 eq-box-sm">
					
			 <!--Basic Panel-->
			<!--===================================================-->
			
			<div class="panel" style="height:300px">
			<div style="border-radius: 8px;background: url('<?php echo trim_image($resCategory->body,$resCategory->foto)?>');background-position: center;background-repeat: no-repeat;background-size: cover;min-height:200px">
						 <a href="<?php echo base_url().'news/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>"><img src="<?php echo base_url()?>images/bgtrans.png" style="width:100%;max-height:200px"></a>
					 
					</div>	
			 <div class="panel-body">
				<div><h4>
				<a href="<?php echo base_url().'news/' .date('Y/m', $resCategory->created_on) .'/'. $resCategory->slug?>"  class="text-semibold text-danger" style="font-size:14px;text-decoration:none"><?php if(strlen($resCategory->title) >'54'){echo substr($resCategory->title,'0','55').'...';}else{echo $resCategory->title;}?></a></h4></div>
			<?php //echo $resCategory->intro?>
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
 
								
								
 	<div class="modal fade" id="image-gallery" data-toggle="mymodalimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-body" >
                <img id="image-gallery-image" class="img-responsive" src="" style="width:100%">
            </div>
           
        </div>
    </div>
</div>							 
 
  
<script>
	function openmodal(img){
		$('#image-gallery').modal('show');
		$('#image-gallery-image').attr("src",img);
	}
</script>
	<script>
	document.getElementById("modulename").innerHTML = '<a href="./news/category/<?php echo  ($article->category->slug)?>"><?php echo  ($article->category->title)?></a>'</script>
 
</div>