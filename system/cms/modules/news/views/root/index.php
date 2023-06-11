
<script>
  $('#judul').html('<?php echo $categories[0]->category_title?>');
  </script>
<div class="row">
<?php 
    
    if (($news)){ ?>
      <?php
$hit=0; 
foreach ($news as $post){
++$hit;
$body = strip_tags(text_only($post->body), '<p><a><br />');
?>
  <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
							<div class="transfer_container">
                <?php if($post->pilihan_editor){?>
                <div class="ribbon_3 popular"><span>Popular</span>
                
                </div>
                <?php }?>
								<div class="img_container">
									<a href="<?php echo base_url().'news/' .date('Y/m', $post->created_on) .'/'. $post->slug?>">
										<img src="<?php echo trim_image($post->body,$post->foto)?>" class="img-fluid" alt="Image" width="800" height="533">
									 
									</a>
								</div>
								<div class="transfer_title">
									<a href="<?php echo base_url().'news/' .date('Y/m', $post->created_on) .'/'. $post->slug?>"><h3><strong><?php echo $post->title?></strong></h3></a>
									 
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