<div class="container margin_60">

			<div class="row">
				<aside class="col-lg-3">
         <?php 
          // $this->db->set_dbprefix("");
       
					 
					 ?>

					<div class="box_style_cat">
						<ul id="cat_nav">
            <li><a href="<?php echo base_url()?>video" id="active"><i class="<?php echo $val->fa_icon?>"></i>All </a>
							</li>
							<?php foreach($res as $dat=> $val){?>
							<li><a href="<?php echo base_url()?>video/category/<?php echo $val->category_id?>" id="active"><i class="<?php echo $val->fa_icon?>"></i><?php echo $val->title?> ( <?php echo $val->jml?> )</a>
							</li>
							<?php }?>
							 
						</ul>
					</div>

					 
					 
				</aside>
				<!--End aside -->
				<div class="col-lg-9">

					<div >
				 
<div class="row">

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

                <iframe width="100%" height="180" src="<?php echo $post->url?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position:inherit"></iframe>

								</div>

								<div class="transfer_title">

									<h3><strong><?php echo $post->title?></strong></h3> 

									 

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
					</div>
					<!--/tools -->
				 

 

                <script>
     $('#judul').html('Galeri Video');
     </script>