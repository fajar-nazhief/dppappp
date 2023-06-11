
 

<main> 

	<div class="collapse" id="collapseMap">
		
			<div id="map" class="map"><div class="container-fluid">
	<div class="row">

<div class="col-lg-12"  style="height:450px">
<?php echo $posts['entries'][0]['map_frame']?>
</div>
</div>
</div></div>
		</div>
		<!-- End Map -->
	<div class="container margin_60">
		
		<div class="row">

			<div class="col-lg-9">
			<div class="box_style_1">
						<div class="post nopadding"> 
							
							
						 
				<div class="post_info clearfix">
								<div class="post-left">
									<ul>
										<li><i class="icon-calendar-empty"></i>On <span><?php echo date('d M Y',$article->created_on)?></span>
										</li>
										 
									</ul>
								</div>
								<div class="post-right"><i class="icon-eye"></i><a href="#"><?php echo $article->klik?> </a></div>
							</div>

				<h2><?php echo $article->title?></h2>
				<p>
					<?php echo $article->body?>
				</p> 
			 
			 </div>
			 </div>
			</div>
			<!-- End col-md-8-->
			<aside class="col-lg-3 add_bottom_30">
					<p class="d-none d-xl-block d-lg-block d-xl-none">
						<a class="btn_map collapsed" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
					</p>
				 

				</aside>
		 

		</div>
		<!-- End row-->
		
	</div>
	<!-- End container -->
	
</main>

  <script>
	  var html='<li><a href="<?php echo base_url()?>event">Home</a>';
	 		 html +='<li><a href="<?php echo base_url()?>event/category/<?php echo $article->category->slug?>"><?php echo $article->category->title?></a>';
	  $('#breadcrumbs_event').html(html);
	  </script>
					
				 