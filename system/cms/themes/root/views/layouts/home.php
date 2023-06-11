<!DOCTYPE html>
<html lang="en">
 
{pyro:theme:partial name="metadata"}
 
 

<body style="overflow: visible;" cz-shortcut-listen="true">
 

    <!-- Mobile menu overlay mask -->

    <!-- Header================================================== -->
	<?php
	if(($this->input->get('bahasa'))){
		$_SESSION['bahasa'] = $this->input->get('bahasa');
		 
	  }
	   
		if((!($_SESSION['bahasa']))){ 
		  $bhs = 'ind';
		  $_SESSION['bahasa']='ind';
		  $berita = 'Berita Terbaru';
		  $pengumuman = 'Pengumuman Terbaru';
		  $idberita = 495;
		  $idpengumuman = 497;
		  $menu=498;
		}else{
		  $bhs = $_SESSION['bahasa'];
		  if($bhs=='eng'){
			$berita = 'Latest News';
			$pengumuman = 'Latest announcement';
			$idberita = 494;
			$idpengumuman = 496;
			$menu=499;
		  }else{
			$berita = 'Berita Terbaru';
			$pengumuman = 'Pengumuman Terbaru';
			$idberita = 495;
			$idpengumuman = 497;
			$menu=498;
		  }
		}


	 
	?>

	{pyro:theme:partial name="header"}
	
	<main>
	<div class="white_bg">

<?php 


		   $this->db->where('folder_id','71');
		   $this->db->where('pilihan_editor','1');
			$this->db->limit('5');
			$this->db->order_by('id','DESC');
			$count=0;
			$slider = $this->db->get('files')->result_array(); 
			
			?>
 <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                 <div class="owl-slide cover" style="background-image: url(./uploads/default/files/<?php echo $slider[0]['filename'];?>);">
                    <div class="opacity-mask d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-12 static">
                                    <div class="slide-text text-center white">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover" style="background-image: url(./uploads/default/files/<?php echo $slider[1]['filename'];?>);">
                    <div class="opacity-mask d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-right white">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
                <div class="owl-slide cover" style="background-image: url(./uploads/default/files/<?php echo $slider[2]['filename'];?>);">
                    <div class="opacity-mask d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-lg-6 static">
                                    <div class="slide-text white">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->
		<!-- END REVOLUTION SLIDER -->
		
		<div class="row feature_home_2">
		{pyro:widgets:area slug="home-application"}
                     
                </div>
			 
<div class="container">
				<div class="row">
				
                    <div class="col-md-6">
					<h4 class="judul"><?php echo $berita?> </h4>
					
					<?php 
				$this->db->select('news_categories.title as kategori,news_categories.title as cat_slug,news.*');
				$this->db->where('news.status','live');
				$this->db->where('news.category_id',$idberita);
				$this->db->join('news_categories','news_categories.id=news.category_id');
				$this->db->order_by('news.id','DESC');
				$this->db->limit('3');
				$res = $this->db->get('news')->result();
				foreach($res as $val){
					$img = url_img($val->body);
					  $intro=text_only(htmltotext($val->body));
				?><div class="row" style="margin-top:30px">
				<div class="col-md-3" >
				<a href="<?php echo base_url().'news/' .date('Y/m', $val->created_on) .'/'. $val->slug?>">
				 
				<div class="d-md-none" >
<img src="<?php echo $img?>"  alt="<?php echo $val->title?>" class="img-artikel-xs" style="width:100%;border-radius:30px">
</div>
<div class="d-none d-xl-block" >
<img src="<?php echo $img?>"  alt="<?php echo $val->title?>" class="img-artikel" style="width:130px">
</div>
				 
				</a>
							</div>
							<div class="col-md-9">
								<a href="<?php echo base_url()?>news/category/<?php echo $val->cat_slug?>"><?php echo $val->kategori?></a><br>
									<small><i class="icon-calendar"></i> <?php echo date('d-m-Y', $val->created_on)?></small>
								<a href="<?php echo base_url().'news/' .date('Y/m', $val->created_on) .'/'. $val->slug?>"><h6 style="font-family:gilroy"><?php echo $val->title?></h6></a>
							<p style="font-size:16px;color:#555"><?php echo substr($intro,0,150)?>...</p>
				</div>
				</div>
				<?php }?>
				
                    </div>
                    <div class="col-md-6">
					<h4 class="judul"><?php echo $pengumuman?></h4>
					
					<?php 
				$this->db->select('news_categories.title as kategori,news_categories.title as cat_slug,news.*');
				$this->db->where('news.status','live');
				$this->db->where('news.category_id',$idpengumuman);
				$this->db->join('news_categories','news_categories.id=news.category_id');
				$this->db->order_by('news.id','DESC');
				$this->db->limit('3');
				$res = $this->db->get('news')->result();
				foreach($res as $val){
					$img = url_img($val->body);
					  $intro=text_only(htmltotext($val->body));
				?><div class="row" style="margin-top:30px">
				<div class="col-md-3">
				<a href="<?php echo base_url().'news/' .date('Y/m', $val->created_on) .'/'. $val->slug?>">
				<div class="d-md-none" >
<img src="<?php echo $img?>"  alt="<?php echo $val->title?>" class="img-artikel-xs" style="width:100%;border-radius:30px">
</div>
<div class="d-none d-xl-block" >
<img src="<?php echo $img?>"  alt="<?php echo $val->title?>" class="img-artikel" style="width:130px">
</div>
				</a>
							</div>
							<div class="col-md-9">
								<a href="<?php echo base_url()?>news/category/<?php echo $val->cat_slug?>"><?php echo $val->kategori?></a><br>
								<small><i class="icon-calendar"></i> <?php echo date('d-m-Y', $val->created_on)?></small>
								<a href="<?php echo base_url().'news/' .date('Y/m', $val->created_on) .'/'. $val->slug?>"><h6 style="font-family:gilroy"><?php echo $val->title?></h6></a>
							<p style="font-size:16px;color:#555"><?php echo substr($intro,0,150)?>...</p>
				</div>
				</div>
				<?php }?>
					  </div> 
                </div> 


<div class="row feature_home_2 white_bg" style=" margin:45px 0 0px 0;">
                  
                </div>
</div>
</div>
<?php
 $this->db->where('folder_id','76');
		   $this->db->where('pilihan_editor','1'); 
			$bgfooter = $this->db->get('files')->row(); 
?>
<section class="promo_full ">
			<div class="footer_full" style="background:url('<?php echo base_url().'uploads/default/files/'.$bgfooter->filename?>') no-repeat center center;height: auto;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;">

			<div class="container">
					<div class="row" style="margin-bottom:30px">
							 
							
						</div> 
					<div class="row">
							<div class="col-md-1">
									<img src="./assets/images/logo.png" class="logos" alt="" style="height:80px">
							</div>
							<div class="col-md-7">
							 <span class="gilroyblackd" style="color:#fff"><span style="font-family:Gilroybold">DINAS PEMBERDAYAAN, PERLINDUNGAN ANAK DAN PENGENDALIAN PENDUDUK <br>PROVINSI DKI JAKARTA</span></span>
							<p style="color:#fff;margin-top:30px">Jl. Jenderal A. Yani Kav 64<br>
							Cempaka Putih, Jakarta Pusat<br>
							DKI Jakarta, 10510<br>(021) 4246470<br>dppapp@jakarta.go.id</p>
							<div class="row">
							<div class="col-md-4">
							<div id="social_footer">
											<ul>
												
													
											{pyro:widgets:area slug="sosmed-icon-footer"} 
													
													
											</ul>
											 
									</div>
							</div>
					</div>
							</div>
							<div class="col-md-4">
									 
							</div>
							 
					</div><!-- End row -->
					<div class="row">
							<div class="col-md-12">
									 
							</div>
					</div><!-- End row -->
			</div><!-- End container -->
			</div>
		</section>
		<div class="row feature_home_2" style="margin:45px 0 45px 0;">
							 <div class="container  text-center">
							 dppapp.jakarta.go.id - <span style="font-size:13px">Portal Resmi DINAS PEMBERDAYAAN, PERLINDUNGAN ANAK DAN PENGENDALIAN PENDUDUK Provinsi DKI Jakarta </span><br> <b><span style="font-family:Gilroybold"> &copy; <?php echo date('Y')?> DINAS PEMBERDAYAAN, PERLINDUNGAN ANAK DAN PENGENDALIAN PENDUDUK PROVINSI DKI JAKARTA </span></b>
</div>
					</div><!-- End row -->
	</main>
	<!-- End main -->
	 

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		<form action="<?php echo base_url()?>news/search/" role="search" id="searchform" method="post">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon_set_1_icon-78"></i>
			</button>
		</form>
	</div><!-- End Search Menu -->
	
	<!-- Sign In Popup -->
	 
	<!-- /Sign In Popup -->

    <!-- Common scripts -->
	{pyro:theme:js file="common_scripts_min.js"}
	{pyro:theme:js file="functions.js"} 
	{pyro:theme:js file="pop_up.min.js"}
	{pyro:theme:js file="pop_up_func.js"}

     	<script>
	 
  function openmodallink(img,link){
	 new $.popup({                
                    title       : '',
                    content         : '<a href="'+link+'"><img src="'+img+'" alt="" class="pop_img" style="width:310px"></a>', 
					html: true,
					autoclose   : false,
					closeOverlay:true,
					closeEsc: false,
					buttons     : false,
                    timeout     : 10000 
                });
  }

	  </script>
	  <?php 
	   $this->db->where('folder_id','70');
	   $this->db->where('pilihan_editor','1');
		$this->db->limit('1');
		$this->db->order_by('id','DESC');
		$respop = $this->db->get('files')->row();
		$FF = $respop->filename;
		
		  if($respop->filename=='tutupdulu'){?>
<script>
  openmodallink('<?php echo base_url()?>uploads/default/files/<?php echo $FF?>','<?php echo $respop->description?>');
  </script>
		 <?php }


		?>
	 
	 <script>
		function modalpop(isi){
		$('#mymodal').modal('show');
		$('#isi').html(isi);
	}
		 $('.start_date').dateDropper();
		 $('.end_date').dateDropper();
		 
</script> 

</body>

</html>