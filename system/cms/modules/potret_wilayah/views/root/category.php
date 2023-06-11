





 

<div class="row">

<?php 

    

    if (!empty($news)){ ?>

      <?php

$hit=0; 

foreach ($news as $post){

++$hit; 

?>

  <div class="col-md-3 wow zoomIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

							<div class="transfer_container">

                <?php if($post->pilihan_editor){?>

                <div class="ribbon_3 popular"><span>Popular</span>

                

                </div>

                <?php }?>

								<div class="img_container"> 
                      <a href="./potret_wilayah/view/<?php echo $post->gall_cat_id?>">
                       <img src="./uploads/potret-wilayah/<?php echo $post->gall_cat_cover?>" style="padding-right:10px;height:150px;width:100%"  id="#gogo">
                 </a> 
               
								</div>

								<div class="transfer_title">

									<h3><strong><?php echo $post->gall_cat_title?></strong></h3> 

									 

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





 <script>
     $('#judul').html('Galeri Foto');
     </script>