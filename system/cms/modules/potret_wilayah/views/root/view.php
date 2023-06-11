




 
 <div class="main_title">
        <h2><?php $chunk = explode(' ',$news[0]->judul);
        if(count($chunk) > 1){
          $i=0;
          foreach($chunk as $valchunk){
if($i==1){
  echo ' <span>'.$valchunk.'</span> ';
}else{
  echo ' '.$valchunk.' ';
}
++$i;
          }
        }
        ?></h2>
			 <p>&nbsp;</p>
      </div>
      <hr>
       
<div class="row magnific-gallery">
<?php 
    
    if (!empty($news)){ ?>
      <?php
$hit=0; 
foreach ($news as $post){
++$hit;
$body = strip_tags(text_only($post->body), '<p><a><br />');
?>
  <div class="col-md-4 wow zoomIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
  
							<div class="transfer_container">
                <?php if($post->pilihan_editor){?>
                <div class="ribbon_3 popular"><span>Popular</span>
                
                </div>
                <?php }?>
								<div class="img_container">
									<a href="<?php echo base_url().'uploads/potret-wilayah/'.$post->img_thumb?>" data-effect="mfp-zoom-in">
										<img src="<?php echo base_url().'uploads/potret-wilayah/'.$post->img_thumb?>" class="img-fluid" alt="Image" width="800" height="533">
									 
									</a>
								</div>
								<div class="transfer_title">
									<a href="<?php echo base_url().'uploads/potret-wilayah/'.$post->img_thumb?>"><h3><strong><?php echo $post->title_caption?></strong></h3></a>
									 
									<!-- end rating -->
									 
									<!-- End wish list-->
								</div>
							</div>
							<!-- End box tour -->
            </div>
            <?php }}?>
 
             

                </div>
                <hr>
            <nav aria-label="Page navigation">
<?php echo $pagination['links']; ?>
                </nav>
                </div>



