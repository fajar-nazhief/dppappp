

 

<!-- End section -->


<div class=" d-none d-xl-block" style="padding-top:200px">&nbsp;</div>
<main class="white_bg">
 

	<div id="position" style="padding:0px;background:#fff">

		<div class="container">

			<ul class="headercrumb">

				<li><a href="<?php echo base_url()?>">Home</a>

				</li> 

				<li>
				   
				    <a href="<?php echo base_url()?>news/category/<?php echo $article->category->slug?>"><?php echo $article->category->title?></a></li>

			</ul>

		</div>

	</div> 
	<!-- End position -->
	<div class="container margin_60 ">
			<div class="row">
				<?php 
				  $parent = $article->category->navigation_group_id;
				if($article->category->left_menu=='1'){
				if(($parent <> '498') && ($parent <> '499') ){
					$this->db->where('navigation_group_id',$parent);
					$this->db->where('show','1');
					$this->db->order_by('position','ASC');
					$resnav = $this->db->get('news_categories')->result();
				
				?>
				<aside class="col-lg-3 add_bottom_30">

				 

					<div class="widget  d-none d-xl-block" id="navnews"> 
						<ul>
							<?php  
							
							foreach($resnav as $valnav){
								$bg = '#E5E5E5';
								$color = '#000';
								if($article->category->id == $valnav->id){
									$bg='#F8971D';
									$color = '#fff';
								}
								if($valnav->uri){
									$url=$valnav->uri;
								}else{
									$url=base_url().'news/category/'.$valnav->slug;
								}
							 ?>
							<li style="background:<?php echo $bg?>;">
							
							<?php $cekchild=$this->db->where('navigation_group_id',$valnav->id)->get('news_categories')->row();
							if($cekchild){
							  	if($valnav->uri){
									$url=$valnav->uri;
								}else{
									$url='javascript:void(0)';
								}
							?> 
								<a href="<?php echo $url?>"  style="color:<?php echo $color?> !important;"><?php echo $valnav->title?></a>
                               
							<?php }else{?>
								<a href="<?php echo $url?>" style="color:<?php echo $color?> !important"><?php echo $valnav->title?></a>

							<?php }?>
							
							</li>
							
							<?php }}?>
							 
						</ul>
					</div>
					<!-- End widget -->
 
					 
				</aside>
				<div class="col-lg-9" style="padding-left:30px;font-size:14px">
				 	<small><i class="icon-calendar"></i> <?php echo date('d-m-Y', $article->created_on)?></small>
				 	<h2 style="margin-top: 0px;"><?php echo $article->title?></h2>
				<?php echo $article->body?>
					
				</div>
				<?php }else{?>
				<!-- End aside -->

				<div class="col-lg-12" style=font-size:14px">
				 	<small><i class="icon-calendar"></i> <?php echo date('d-m-Y', $article->created_on)?></small>
				 		<h2 style="margin-top: 0px;"><?php echo $article->title?></h2>
				<?php echo $article->body?>
					
				</div>
				<?php }?>
				<!-- End col-md-9-->
			</div>
			<!-- End row-->
		</div>
	<!-- End Position -->

  
	<!-- End container -->

	

</main>



  

					

				