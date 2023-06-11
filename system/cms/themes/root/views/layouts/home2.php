<!DOCTYPE html>
<html lang="en">
{pyro:theme:partial name="metadata"}

<body> 
 

    {pyro:theme:partial name="header"}
	
	<main>
 

<?php 
		   $this->db->where('folder_id','71');
		   $this->db->where('pilihan_editor','1');
			$this->db->limit('5');
			$this->db->order_by('id','DESC');
			$count=0;
			$slider = $this->db->get('files')->result_array(); 
			 
			?>

<div id="rev_slider_54_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="notgeneric1" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
			<div id="rev_slider_54_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
				<ul>
					<!-- SLIDE  -->
					<li data-index="rs-140" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="<?php echo base_url()?>uploads/default/files/<?php echo $slider[0]['filename']?>" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="<?php echo base_url()?>uploads/default/files/<?php echo $slider[0]['filename']?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->
						<?php $des1= explode(',',$slider[0]['description']); ?>
						<!-- LAYER NR. 1 -->
						<div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-140-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['50','46','36','28']" data-lineheight="['46','46','36','28']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"split":"chars","split_direction":"forward","splitdelay":0.05,"speed":2000,"frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 50px; line-height: 46px; font-weight: 700;font-family:Montserrat;"><?php echo  $des1[0]?> </div>

						<!-- LAYER NR. 2 -->
						<div class="tp-caption NotGeneric-SubTitle   tp-resizeme" id="slide-140-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-weight: 400;font-family:Montserrat;"><?php echo  $des1[1]?></div>

					 
					</li>

					
					<!-- SLIDE  -->
					<li data-index="rs-141" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500" data-thumb="<?php echo base_url()?>uploads/default/files/<?php echo $slider[1]['filename']?>" data-rotate="0" data-saveperformance="off" data-title="Chill" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="<?php echo base_url()?>uploads/default/files/<?php echo $slider[1]['filename']?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->
						<?php $des2= explode(',',$slider[1]['description']); ?>
						<!-- LAYER NR. 6 -->
						<div class="tp-caption NotGeneric-Title   tp-resizeme " id="slide-141-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['50','46','36','28']" data-lineheight="['46','46','36','28']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"split":"chars","split_direction":"forward","splitdelay":0.05,"speed":2000,"frame":"0","from":"y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" 
						style="z-index: 5; white-space: nowrap; font-size: 50px; line-height: 46px; font-weight: 700;font-family:Montserrat;"><?php echo $des2[0]?> </div>

						<!-- LAYER NR. 7 -->
						<div class="tp-caption NotGeneric-SubTitle   tp-resizeme " id="slide-141-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" 
						style="z-index: 6; white-space: nowrap; font-weight: 400;font-family:Montserrat;"><?php echo $des2[1]?></div>
 
					</li>
					<!-- SLIDE  -->
					<li data-index="rs-142" data-transition="zoomin" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="<?php echo base_url()?>uploads/default/files/<?php echo $slider[2]['filename']?>" data-rotate="0" data-saveperformance="off" data-title="Enjoy Nature" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="<?php echo base_url()?>uploads/default/files/<?php echo $slider[2]['filename']?>" alt="" data-bgposition="center center" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->
						<?php $des3= explode(',',$slider[2]['description']); ?>
						<!-- LAYER NR. 15 -->
						<div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-142-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['1','0','0','0']" data-fontsize="['50','48','36','28']" data-lineheight="['46','48','36','28']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"split":"chars","split_direction":"forward","splitdelay":0.05,"speed":2000,"frame":"0","from":"y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 50px; line-height: 46px; font-weight: 700;font-family:Montserrat;"><?php echo $des3[0]?> </div>

						<!-- LAYER NR. 16 -->
						<div class="tp-caption NotGeneric-SubTitle   tp-resizeme" id="slide-142-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-weight: 400;font-family:Montserrat;"><?php echo $des3[1]?></div>

						<!-- LAYER NR. 17 -->
						<div class="tp-caption NotGeneric-Icon   tp-resizeme" id="slide-142-layer-8" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-68','-68','-68','-68']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;cursor:default;"><i class="pe-7s-expand1"></i> </div>

					 
					</li>
					<!-- SLIDE  -->
					<li data-index="rs-143" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="<?php echo base_url()?>uploads/default/files/<?php echo $slider[3]['filename']?>" data-rotate="0" data-saveperformance="off" data-title="Iceberg" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="<?php echo base_url()?>uploads/default/files/<?php echo $slider[3]['filename']?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->

						<?php $des4= explode(',',$slider[3]['description']); ?>
						<!-- LAYER NR. 21 -->
						<div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-143-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['50','48','36','28']" data-lineheight="['48','48','36','28']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"split":"chars","split_direction":"forward","splitdelay":0.05,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 50px; line-height: 48px; font-weight: 700;font-family:Montserrat;"><?php echo $des4[0]?></div>

						<!-- LAYER NR. 22 -->
						<div class="tp-caption NotGeneric-SubTitle   tp-resizeme" id="slide-143-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap; font-weight: 400;font-family:Montserrat;"><?php echo $des4[1]?></div>

						<!-- LAYER NR. 23 -->
						<div class="tp-caption NotGeneric-Icon   tp-resizeme" id="slide-143-layer-8" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-68','-68','-68','-68']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; white-space: nowrap;cursor:default;"><i class="pe-7s-anchor"></i> </div>

					 
					</li>

					 
		 
					 
				</ul>
				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
			</div>
		</div>
		<!-- END REVOLUTION SLIDER -->
		 
		<!-- END REVOLUTION SLIDER -->

		<div class="container margin_60">

		 <?php
		  if(isset($_GET['bahasa']) AND $_GET['bahasa']=='eng'){
			$open='Open';
			$_SESSION['bahasa']=$_GET['bahasa'];
			$judul_sistem ='<h2>Cultural <span>Information </span> System</h2>';
			$cb = "<h3><span>+120</span> Cultural Heritage</h3>";
			$situs = 'The Jakarta <span>Museum</span> Site';
			$situs_ket='List of museum sites in DKI Jakarta';
			$agenda = 'Agenda of <span>activities<span>';
			$berita='Culture <span>News</span>';
			$potret='Cultural <span>Potrait</span>';
			$video='Cultural <span>Video</span>';
			$art='Art <span>Gallery</span>';
			$idnews='509';
		}else{
			$judul_sistem ='<h2>Sistem <span>Informasi</span> Budaya</h2>';
			$cb='<h3><span>+120</span> Cagar Budaya</h3>';
			$open='Buka';
			$situs = 'Situs <span>Museum</span> Jakarta';
			$situs_ket='Daftar situs museum di DKI Jakarta ';
			$agenda='Agenda <span>Kegiatan Dinas</span>';
			$berita='<span>Berita</span> Kebudayaan';
			$potret='Potret <span>Budaya </span>';
			$video='Video <span>Budaya </span>';
			$art='Sanggar <span>Seni</span>';
			$idnews='495';
		}
		?>
    	<div class="main_title">
			
			<?php echo $judul_sistem?>
		</div>

		<div class="row">

			<div class="col-lg-4 wow zoomIn" data-wow-delay="0.2s">
				<div class="feature_home">
					<img src="./images/CAGAR BUDAYA.png" style="height:100px">
					<?php echo $cb;?>
					<a href="http://jakarta-tourism.go.id/sim/cagarbudaya" class="btn_1 outline" target="_blank"><?php echo $open?></a>
				</div>
			</div>

			<div class="col-lg-4 wow zoomIn" data-wow-delay="0.4s">
				<div class="feature_home">
					<img src="./images/SANGGAR SENI.png" style="height:100px">
					<h3><?php echo $art?></h3> 
					<a href="http://disparbud.jakarta.go.id/sanggarseni" class="btn_1 outline" target="_blank"><?php echo $open?></a>
				</div>
			</div>

			<div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
				<div class="feature_home">
					<img src="./images/ENSIKLOPEDIA.png" style="height:100px">
					<h3><span>Encyclo</span>pedia</h3> 
					<a href="http://encyclopedia.jakarta-tourism.go.id/" class="btn_1 outline"><?php echo $open?></a>
				</div>
			</div>

		</div>
		<!--End row -->

		<div class="white_bg">
			<div class="container margin_60">
				<div class="main_title">
					<h2><?php echo $situs?></h2>
					<p>
						<?php echo $situs_ket;?>
					</p>
				</div>
				<div class="row add_bottom_45">
					
					<div class="col-lg-4 other_tours">
						<ul>
							<li><a href="#"><i class="icon_set_1_icon-3"></i>Museum M.H Thamrin </a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-30"></i>Museum Tekstil</a>
							</li>
							<li><a href="http://museumkesenian.jakarta-tourism.go.id/"><i class="icon_set_1_icon-44"></i>Museum Seni</a>
							</li>  
						</ul>
					</div>
					<div class="col-lg-4 other_tours">
						<ul>
							<li><a href="#"><i class="icon_set_1_icon-1"></i>Museum Seni Rupa dan Keramik</a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-4"></i>Museum Joang '45</a>
							</li>
							<li><a href="http://museumkebaharian.jakarta-tourism.go.id/"><i class="icon_set_1_icon-30"></i>Museum Bahari</a>
							</li>
						 
						</ul>
					</div>
					<div class="col-lg-4 other_tours">
						<ul>
							<li><a href="http://museumkesejarahan.jakarta-tourism.go.id/"><i class="icon_set_1_icon-1"></i>Museum Sejarah</a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-1"></i>Museum Prasasti</a>
							</li>
					 
						</ul>
					</div>
				</div>
				<!-- End row -->
 
			<!-- End row -->
			
		 

			<hr>

			<div class="main_title">
				<h2><?php echo $agenda?> </h2> 
			</div>

			<div class="row">

				
				<!-- End col -->

				<div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.2s">
				<div class="hotel_container">
				<div id="calendar" style="margin: 0 auto;padding:10px"></div>
					</div>
					<!-- End box -->
				</div>
				<!-- End col -->

				<div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
				<div id="agendaresults" style="margin-top:20px;margin-bottom:30px">
        <?php
				$this->db->set_dbprefix('tbl_');
				$this->db->select("agenda.*,DATE_FORMAT(tgl_agenda,'%e-%c-%Y') as tgl,DATE_FORMAT(tgl_agenda, '%H:%i')as jam,DATE_FORMAT(tgl_agenda,'%d')as tanggal,MONTHNAME(tgl_agenda) as bulan,YEAR(tgl_agenda)as tahun");
				$this->db->order_by('tgl_agenda','DESC');
				$this->db->limit('4');
		 $dcata_agenda = $this->db->get('agenda')->result_array();
		 $this->db->set_dbprefix('default_');
     if($dcata_agenda){
         $htmlx='';

     foreach($dcata_agenda as $val){
      $htmlx .='<div> <b>Tanggal:</b> '.$val['tgl'].'</div>';
      $htmlx .='<div> <b>Jam:</b> '.$val['jam'].'</div>';
      $htmlx .='<div> <b>Tempat:</b> '.$val['tempat'].'</div>';
      $htmlx .='<div> <b>Dihadiri:</b> '.$val['dihadiri'].'</div>';
      $htmlx .='<div> <b>Pendamping:</b> '.$val['pendamping'].'</div>';
      $htmlx .='<div> <b>Acara:</b> '.$val['acara'].'</div>';
       ?>
     <a href="javascript:void(0)" onClick="modalpop('<?php echo $htmlx?>')">
 <div class="event-item">
                     <div class="event-date" style="width: auto;height: auto;">
                    <div class="event-day"><?php echo $val['tanggal']; ?></div>
                    <div class="event-month"><?php echo $val['bulan']; ?></div>
                    <div class="event-year"><?php echo $val['tahun']; ?></div>
                    </div>
                    <div class="event-info">
                    <h6 class="event-link" style="font-size:12px"><?php echo $val['acara']; ?></h6>
                    <div class="event-info-item" style="font-size:11px"><i class="fa fa-map-marker"></i><?php echo $val['tempat']; ?></div>
                    </div>
                   
                    </div>
     </a>

     <?php $htmlx='';}}else{ echo 'No result at the moment';}?>  
       </div>
					<!-- End box -->
				</div>
				<!-- End col -->

				<div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s" style="margin-bottom: 30px;">
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" style="height:400px">
            <?php $this->db->where('folder_id','69');
               $this->db->where('pilihan_editor','1');
          $this->db->limit('3');
          $resimng = $this->db->get('files')->result();
          $count=0;
          foreach($resimng as $val){
            ++$count;
            $activer='';
            if($count=='1'){
              $activer='active';
            }
          ?>
							<div class="carousel-item <?php echo $activer?>">
							<a href="<?php  if($val->description){ echo $val->description;}else{echo 'javascript:void(0)';}; ?>">
								<img class="d-block w-100" src="<?php echo base_url()?>uploads/default/files/<?php echo $val->filename?>" alt="First slide" style="height:400px">
					</a>
              </div>
          <?php }?>
            </div>
          </div>
				</div>
 

			</div>
			<!-- End row -->
			
			<p class="text-center nopadding">
				<a href="./agenda" class="btn_1 medium"><i class="icon-calendar-outlilne"></i>View all Agenda </a>
			</p>
			
		</div>
		<!-- End container -->

		<div class="white_bg">
			<div class="container margin_60">
				<div class="main_title">
					<h2> <?php echo $berita?></h2>
				 
				</div>

				
			<div class="row">

			 
<!-- slider -->
<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
			<div class="MultiCarousel-inner">
			<?php 

	$this->db->where('status','Live');
	$this->db->where('category_id',$idnews);
$this->db->order_by('created_on','DESC');
$this->db->limit('8');
$resnews1= $this->db->get('news')->result();
	foreach($resnews1 as $valnews1){
		$img = url_img($valnews1->body);
	 
		?>

						<div class="item">
						<div class="col" data-wow-delay="0.3s">
              <!-- news  item preview -->
              <span class="news_item_preview">
								<a href="<?php echo base_url().'news/' .date('Y/m', $valnews1->created_on) .'/'. $valnews1->slug?>" data-js="1">
								
                  <div class="card-header" style="background-image:url(<?php  echo $img;?>);height:200px;width:100%">
                  
                    </div>
                  
                  <span>
                  <h3 style="margin-top:10px;font-size:15px"><?php if(strlen($valnews1->title) >'54'){echo substr($valnews1->title,'0','55').'...';}else{echo $valnews1->title;}?></h3>
                  <p>&nbsp;</p>
                  </span></a>
  
            </span>
          </div>
					</div>
	<?php }

	$this->db->set_dbprefix('default_');
	?>
		 
					 
			</div>
			<button class="btn btn-primary leftLst"><</button>
			<button class="btn btn-primary rightLst">></button>
	</div>


</div>
<!-- End row -->
			 
				
			</div>
			<!-- End container -->
		</div>
		<!-- End white_bg -->
 
		 

		<div class="container margin_60">

			<div class="main_title">
				<h2> <?php echo $potret?></h2>
				<p>
			&nbsp;
				</p>
			</div>

			<div class="row">

			 
        <!-- slider -->
        <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
              <div class="MultiCarousel-inner">
              <?php 
          $this->db->set_dbprefix('tbl_');
          $this->db->order_by('gall_cat_id','DESC');
          $this->db->limit(12);
          $respw = $this->db->get('gall_cat')->result();
          foreach($respw as $val){?>
   
                    <div class="item">
                      <a href="./potret_wilayah/view/<?php echo $val->gall_cat_id?>">
                       <img src="<?php echo base_url()?>uploads/potret-wilayah/<?php echo str_replace('.jpg','_thumb.jpg',$val->gall_cat_cover)?>" style="padding-right:10px;height:150px;width:100%"  id="#gogo">
                       <div class="textoverlay">
      <div class="text"><?php echo $val->gall_cat_title?></div>
    </div></a>
                  </div>
          <?php }
  
          $this->db->set_dbprefix('default_');
          ?>
             
                   
              </div>
              <button class="btn btn-primary leftLst"><</button>
              <button class="btn btn-primary rightLst">></button>
          </div>


			</div>
			<!-- End row -->
			<hr>
			<div class="main_title">
				<h2><?php echo $video;?></h2>
				<p>
				&nbsp;
				</p>
			</div>

			<div class="row">

				<div class="col-lg-12" data-wow-delay="0.2s">
				<div class="feature_home">
				<?php 
          $this->db->set_dbprefix('tbl_');
          $this->db->order_by('id','DESC');
          $this->db->limit(4);
          $respw = $this->db->get('video')->result();
          $count=0;
          foreach($respw as $val){
            ++$count;
            if($count=='1'){
						?> 
						<iframe src="<?php echo $val->url?>" id="youtube" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position:inherit;height:400px !important"></iframe> 
         
						<table class="table table_summary" style="text-align:left">
							<tbody>
            <?php }else{?>
             <tr>
							 <td>
								<a href="javascript:void(0)" onClick="$('#youtube').attr('src', '<?php echo $val->url?>');"><?php echo $val->title?></a>
						</td>
						</tr>
          <?php }}
  
          $this->db->set_dbprefix('default_');
					?> 
					</tbody>
					</table>
					<a href="./video" class="btn_1 outline">View more</a>
						</div>
				</div>


			</div>
			<!--End row -->
			  
		</div>
		<!-- End container -->
		<div class="modal fade" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:99999">
      <div class="modal-dialog">
          <div class="modal-content">
              
              <div class="modal-body" >
							<button type="button" class="close" data-dismiss="modal">×</button>
                <a href="#" id="link">
                  <img id="image-gallery-image" class="img-responsive" src="" style="width:100%">
                </a>
              </div>
             
          </div>
      </div>
  </div>		
	</main>
	<!-- End main -->
	
	{pyro:theme:partial name="footer"}
	<script>

		/* Preload */
$(window).load(function () { // makes sure the whole site is loaded
	$('#status').fadeOut(); // will first fade out the loading animation 
	$('body').delay(350).css({
		'overflow': 'visible'
	});
	$(window).scroll();
})
		//multicaraousel
		var itemsMainDiv = ('.MultiCarousel');
      var itemsDiv = ('.MultiCarousel-inner');
      var itemWidth = "";
  
      $('.leftLst, .rightLst').click(function () {
          var condition = $(this).hasClass("leftLst");
          if (condition)
              click(0, this);
          else
              click(1, this)
      });
  
      ResCarouselSize();
  
  
  
  
      $(window).resize(function () {
          ResCarouselSize();
      });
  
      //this function define the size of the items
      function ResCarouselSize() {
          var incno = 0;
          var dataItems = ("data-items");
          var itemClass = ('.item');
          var id = 0;
          var btnParentSb = '';
          var itemsSplit = '';
          var sampwidth = $(itemsMainDiv).width();
          var bodyWidth = $('body').width();
          $(itemsDiv).each(function () {
              id = id + 1;
              var itemNumbers = $(this).find(itemClass).length;
              btnParentSb = $(this).parent().attr(dataItems);
              itemsSplit = btnParentSb.split(',');
              $(this).parent().attr("id", "MultiCarousel" + id);
  
  
              if (bodyWidth >= 1200) {
                  incno = itemsSplit[3];
                  itemWidth = sampwidth / incno;
              }
              else if (bodyWidth >= 992) {
                  incno = itemsSplit[2];
                  itemWidth = sampwidth / incno;
              }
              else if (bodyWidth >= 768) {
                  incno = itemsSplit[1];
                  itemWidth = sampwidth / incno;
              }
              else {
								
                  incno = itemsSplit[0];
                  itemWidth = sampwidth / incno; 
              }
              $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
              $(this).find(itemClass).each(function () {
                  $(this).outerWidth(itemWidth);
              });
  
              $(".leftLst").addClass("over");
              $(".rightLst").removeClass("over"); 
						 
  
          });
      }
  
  
      //this function used to move the items
      function ResCarousel(e, el, s) {
          var leftBtn = ('.leftLst');
          var rightBtn = ('.rightLst');
          var translateXval = '';
          var divStyle = $(el + ' ' + itemsDiv).css('transform');
          var values = divStyle.match(/-?[\d\.]+/g);
          var xds = Math.abs(values[4]);
          if (e == 0) {
              translateXval = parseInt(xds) - parseInt(itemWidth * s);
              $(el + ' ' + rightBtn).removeClass("over");
  
              if (translateXval <= itemWidth / 2) {
                  translateXval = 0;
                  $(el + ' ' + leftBtn).addClass("over");
              }
          }
          else if (e == 1) {
              var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
              translateXval = parseInt(xds) + parseInt(itemWidth * s);
              $(el + ' ' + leftBtn).removeClass("over");
  
              if (translateXval >= itemsCondition - itemWidth / 2) {
                  translateXval = itemsCondition;
                  $(el + ' ' + rightBtn).addClass("over");
              }
          }
          $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
      }
  
      //It is used to get some elements from btn
      function click(ell, ee) {
          var Parent = "#" + $(ee).parent().attr("id");
          var slide = $(Parent).attr("data-slide");
          ResCarousel(ell, Parent, slide);
      }
		//end multicaraosel
		
		var javascript_array = []; 
  
	createAgenda = function(javascript_array) {
			$('#calendar').calendar({
					// view: 'month',
				//	width: 320,
				//	height: 320,
					// startWeek: 0,
					// selectedRang: [new Date(), null],
					data: javascript_array,
					onSelected: function (view, date, data) {
							var dd = date.getDate();
							var mm = date.getMonth() + 1; //January is 0!
							var yyu = date.getFullYear();
							getAgenda(dd + '-' + mm + '-' + yyu);
					},
					viewChange: function (view, yearx, monthx) {

							getAgendaM(monthx,yearx);
					}
			});
	}


	getAgenda = function(date) {
			$('#agendaresults').html('No Result Data');
		 // $('.agendaresults-tanggal').html(date);
			$.ajax({
				 url: './agenda/agendalist',
				 type: 'post',
				 data: {
									 date: date
							 },
					beforeSend:function(){
							$('.agendaresults-loading').append('<i class="agendaresults-loading-i fa fa-spinner fa-spin"></i>');
					},
					success: function (data) {
							$('.agendaresults-loading-i').remove();
							if(data.hasil=='true'){
								var html='';
				var htmlx='';
				$.each(data.data,function(val,index){
					htmlx +='<div> <b>Tanggal:</b> '+index.tgl+'</div>';
					htmlx +='<div> <b>Jam:</b> '+index.jam+'</div>';
					htmlx +='<div> <b>Tempat:</b> '+index.tempat+'</div>';
					htmlx +='<div> <b>Dihadiri:</b> '+index.dihadiri+'</div>';
					htmlx +='<div> <b>Pendamping:</b> '+index.pendamping+'</div>';
					htmlx +='<div> <b>Acara:</b> '+index.acara+'</div>';

					html += '<div class="event-item">';
					html += '<a href="javascript:void(0);" onClick="modalpop(\''+htmlx+'\')">';
					html += '<div class="event-date" style="width: auto;height: auto;">';
					html += '<div class="event-day">'+index.tanggal+'</div>';
					html += '<div class="event-month">'+index.bulan+'</div>';
					html += '<div class="event-year">'+index.tahun+'</div>';
					html += '</div>';
					html += '<div class="event-info">';
					html += '<h6 class="event-link" style="font-size:12px">'+index.acara+'</h6>';
					html += '<div class="event-info-item" style="font-size:11px"><i class="icon-map"></i>'+index.tempat+'</div>';
					html += '</div>';
					html += '</a>';
					html += '</div>';
					htmlx = '';
								})
							}
							$('#agendaresults').html(html);
				 },
				 error: function(xhr, Status, err) {
					$('.agendaresults-loading-i').remove();
					
				 }
			});
	}


	getAgendaM = function(monthx,yearx) {

			$.ajax({
				 url: './agenda/agendalistm',
				 type: 'post',
				 dataType: 'json',
				 data: {
									 monthx: monthx,
									 yearx: yearx
							 },
					beforeSend:function(){
							
					},
					success: function (data) {
							//createAgenda(data);
							
							$('#calendar').calendar('setData', data);
							//$('#agendaresults').html(monthx + '-' + yearx +  JSON.stringify(data));
				 },
				 error: function(xhr, Status, err) {
					 
					 
				 }
			});
	}
	

	createAgenda(javascript_array);
	getAgendaM();

	$("#rev_slider_54_1").show().revolution({delay:7000,
		sliderType: "standard", 
				sliderLayout: "fullwidth",
					autoHeight:"on",
					navigation: {
						keyboardNavigation:"off",
						keyboard_direction: "horizontal",
						mouseScrollNavigation:"off",
													 mouseScrollReverse:"default",
						onHoverStop:"off",
						touch:{
							touchenabled:"on",
							touchOnDesktop:"off",
							swipe_threshold: 75,
							swipe_min_touches: 50,
							swipe_direction: "horizontal",
							drag_block_vertical: false
						}
						,
						arrows: {
							style:"uranus",
							enable:true,
							hide_onmobile:true,
							hide_under:778,
							hide_onleave:true,
							hide_delay:200,
							hide_delay_mobile:1200,
							tmp:'',
							left: {
								h_align:"left",
								v_align:"center",
								h_offset:20,
																	v_offset:0
							},
							right: {
								h_align:"right",
								v_align:"center",
								h_offset:20,
																	v_offset:0
							}
						}
					},
				responsiveLevels: [1240, 1024, 778, 480],
				visibilityLevels: [1240, 1024, 778, 480],
				gridwidth: [1240, 1024, 778, 480],
				gridheight: [700, 550, 860, 480],
					
					
	});

	function openmodallink(img,link){
      $('#imgmodal').modal('show');
      $("#link").attr("href", link);
      $('#image-gallery-image').attr("src",img);
    }
 
		</script>
		<?php 
         $this->db->where('folder_id','70');
         $this->db->where('pilihan_editor','1');
          $this->db->limit('1');
          $this->db->order_by('id','DESC');
          $respop = $this->db->get('files')->row();
          $FF = $respop->filename;
          
            if($respop->filename){?>
  <script>
    openmodallink('<?php echo base_url()?>uploads/default/files/<?php echo $FF?>','<?php echo $respop->description?>');
    </script>
           <?php }


          ?>

</body>

</html>
