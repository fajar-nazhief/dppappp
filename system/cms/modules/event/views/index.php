<div class="container margin_60">

			<div class="row">
				<aside class="col-lg-3">
				 <?php 
				 	 $this->db->where('module_name','event');
					 $this->db->where('bahasa','ind');
					 $this->db->order_by('no_urut','ASC');
					 $res = $this->db->get('blog_categories')->result();
					 
					 ?>

					<div class="box_style_cat">
						<ul id="cat_nav">
							<?php foreach($res as $dat=> $val){?>
							<li><a href="<?php echo base_url()?>event/category/<?php echo $val->slug?>" id="active"><i class="<?php echo $val->fa_icon?>"></i><?php echo $val->title?> </a>
							</li>
							<?php }?>
							 
						</ul>
					</div>

					 
					 
				</aside>
				<!--End aside -->
				<div class="col-lg-9">

					<div id="tools">
						<form name="aksi" action="<?php echo base_url()?>event/start_end" method="post">
						<div class="row">
							<div class="col-md-3 col-sm-4 col-4">
								<div class="styled-select-filters">
								<input class="form-control start_date" value="<?php echo @$_SESSION['start']?>" name="start" type="text" data-format="Y-m-d" data-dd-format="Y-m-d" data-lang="en" data-large-mode="true" data-large-default="true" data-min-year="2020" data-max-year="2025" data-disabled-days="11/17/2017,12/17/2017">
								</div>
							</div>
							<div class="col-md-3 col-sm-4 col-4">
								<div class="styled-select-filters">
								<input class="form-control end_date"  value="<?php echo @$_SESSION['end']?>" name="end" type="text" data-lang="en" data-format="Y-m-d" data-large-mode="true" data-large-default="true" data-min-year="2020" data-max-year="2025" data-disabled-days="11/17/2017,12/17/2017">
								
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-2">
							<input type="submit" class="btn_1 add_bottom_30" value="Search" style="margin-bottom:5px">
							</div>
							<div class="col-md-4 col-sm-4 d-none d-sm-block text-right">
								<a href="<?php echo base_url()?>event" class="bt_filters" alt="reset search"><i class="icon-home-6"></i></a> 
							</div>

						</div>
							</form>
					</div>
					<!--/tools -->
					<?php if (($blog)){ ?>
						<?php
					$hit=0; 
					foreach ($blog as $post){
					++$hit;
					$img=only_img(trim_image($post->body));
					$body = strip_tags(text_only($post->body), '<p><a><br />');
					?>
					<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.<?php echo $hit?>s">
						<div class="row">
							<div class="col-lg-4 col-md-4">
							<?php if($post->rekomendasi=='1'){?>
	<div class="ribbon_3"><span>Recommend</span></div>
<?php }?>
								<div class="wishlist">
									<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
								</div>
								<div class="img_list">
									<a href="<?php echo base_url().'event/' .date('Y/m', $post->created_on) .'/'. $post->slug?>"><img src="<?php echo $img?>" alt="Image">
										 
									</a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="tour_list_desc">
								 
									<h3><strong><?php echo $post->title?></strong></h3>
									<p> <?php echo $post->intro?></p>
									<ul class="add_info">
										<li>
											<div class="tooltip_styled tooltip-effect-4">
												<span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
												<div class="tooltip-content">
													<h4>Schedule</h4>
													<?php echo $post->operasional?>
												</div>
											</div>
										</li>
										<li>
											<div class="tooltip_styled tooltip-effect-4">
												<span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>
												<div class="tooltip-content">
													<h4>Address</h4> <?php echo $post->alamat?>
													<br>
												</div>
											</div>
										</li>
										<li>
											<div class="tooltip_styled tooltip-effect-4">
												<span class="tooltip-item"><i class="icon_set_1_icon-97"></i></span>
												<div class="tooltip-content">
													<h4>Languages</h4> <?php echo $post->bahasa_event?>
												</div>
											</div>
										</li>
										<li>
											<div class="tooltip_styled tooltip-effect-4">
												<span class="tooltip-item"><i class="icon_set_1_icon-27"></i></span>
												<div class="tooltip-content">
													<h4>Parking</h4> 
													<?php echo $post->parkir?>
												</div>
											</div>
										</li>
										<li>
											<div class="tooltip_styled tooltip-effect-4">
												<span class="tooltip-item"><i class="icon_set_1_icon-25"></i></span>
												<div class="tooltip-content">
													<h4>Transport</h4>
													
													<?php echo $post->transportasi?>
													<br>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-lg-2 col-md-2">
								<div class="price_list">
									<div> 
										<p><a href="<?php echo base_url().'event/' .date('Y/m', $post->created_on) .'/'. $post->slug?>" class="btn_1">Details</a>
										</p>
									</div>

								</div>
							</div>
						</div>
					</div>
					<!--End strip -->
					<?php }}?>

					<hr>

					<?php echo $pagination['links']; ?> 
					<!-- end pagination-->

				</div>
				<!-- End col lg-9 -->
			</div>
			<!-- End row -->
		</div>
	