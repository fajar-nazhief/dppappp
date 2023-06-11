<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<title><?php echo lang('cp_admin_title').' - '.$template['title'];?></title>
	
	<base href="<?php echo base_url(); ?>" />
	
	<!-- Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"> 
	<?php file_partial('metadata'); ?>
</head>

<body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>
	
	 
	<div id="wrapper" class="preload">
		<div id="top-nav" class="fixed skin-5">
			<a href="#" class="brand" style="background: #f65d35 none repeat scroll 0 0 !important;">
				<span>CMS</span>
				<span class="text-toggle"> </span>
			</a><!-- /brand -->					
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<i class="nav-icon fa fa-arrows-alt"></i>
			</button>
			<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle" style="color:#000">
				<i class="nav-icon fa fa-arrows-alt"></i> 
			</button>
			<?php file_partial('header'); ?> 
		</div><!-- /top-nav-->
		
		<aside class="fixed skin-6">
			<div class="sidebar-inner scrollable-sidebar">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->	
				<div class="user-block clearfix">
					<?php
					
				 
					if(@$_SESSION['logo']){?>
					<img src="<?php echo base_url().'uploads/travel/'.$_SESSION['travel_id'].'/'.$_SESSION['logo']?>" alt="User Avatar" style="border-radius:0px !important;margin-right:10px">
					<?php }else{?>
					<img src="<?php echo base_url()?>fav.png" alt="User Avatar" style="border-radius:0px !important;margin-right:10px">
					<?php }?>
					<?php
					if(@$_SESSION['nama_travel']){
						$namaTravel = $_SESSION['nama_travel'];
					}else{
						$namaTravel = $this->settings->site_name;
					}
					
					$title = explode(' ',$namaTravel); //print_r($title[0]);
					if(!empty($title[1])){
					?>
					<ul class="list-inline"  style="margin-bottom:0px">
							<li class=""><a href="<?php echo base_url()?>"><?php echo $title['0']?></a></li>
						</ul>
					 <h4 class="bounceIn animation-delay4" style="margin-top:0px;color:#fff;"><?php echo $title[1]?></h4>
					 <?php }else{?>
					 <ul class="list-inline"  style="margin-bottom:0px">
							<li class=""><a href="<?php echo base_url()?>">Aplikasi</a></li>
						</ul>
					 <h4 class="bounceIn animation-delay4" style="margin-top:0px;color:#fff;"><?php echo $title[0]?></h4>
					 <?php }?>
				</div><!-- /user-block -->
				 
				<?php file_partial('navigation'); ?> 
			</div><!-- /sidebar-inner -->
		</aside>

		<div id="main-container">
			<div id="breadcrumb">
				<ul class="breadcrumb">
					 <li><i class="fa fa-home"></i><a href="index-2.html"> Home</a></li>
					 <li class="active"><?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?></li>	 
				</ul>
			</div><!-- /breadcrumb-->
			<div class="main-header clearfix">
				<div class="page-title">
					<h3 class="no-margin"><?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?></h3>
					<span><?php echo $module_details['description'] ? $module_details['description'] : ''; ?></span>
				</div><!-- /page-title -->
				
				
			     <?php template_partial('filters'); ?>
			    
			</div><!-- /main-header -->
			
			<div class="grey-container shortcut-wrapper">
				<?php template_partial('shortcuts'); ?> 
			</div><!-- /grey-container --> 
			<div class="padding-md">
				<?php file_partial('notices'); ?>
				<?php echo $template['body']; ?>
				  
			</div><!-- /.padding-md -->
		</div><!-- /main-container -->
		<!-- Footer
		================================================== -->
		<footer>
			<div class="row">
				<div class="col-sm-6">
					<span class="footer-brand">
						<strong class="text-danger"> CMS</strong> MERDEKA
					</span>
					<p class="no-margin">
						&copy; 2016 <strong> Merdeka.in</strong> CMS . ALL Rights Reserved. 
					</p>
				</div><!-- /.col -->
			</div><!-- /.row-->
		</footer>
		
		
		<!--Modal-->
		 
  			 
	</div><!-- /wrapper -->

	<a href="#" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="<?php echo base_url()?>admin/logout">Logout</a>
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="PopConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to Delete?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="" id="linkdelete">Yes</a>
			<a class="btn btn-danger PopConfirm_close">Cancel</a>
		</div>
	</div>
	 

 <!--Modal-->
		<div class="modal fade" id="theModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>View Data</h4>
      				</div>
				    <div class="modal-body">
				        <p id="isinya">Please wait while Loading...</p>
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

 
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	
	
	<!-- Jquery -->
	<script src="system/cms/themes/admin_endless/js/jquery-1.10.2.min.js"></script>
	
	<!-- Bootstrap -->
    <script src="system/cms/themes/admin_endless/bootstrap/js/bootstrap.min.js"></script>
    
	<!-- Chosen -->
	<script src='system/cms/themes/admin_endless/js/chosen.jquery.min.js'></script>	

	<!-- Mask-input -->
	<script src='system/cms/themes/admin_endless/js/jquery.maskedinput.min.js'></script>	

	<!-- Datepicker -->
	<script src='system/cms/themes/admin_endless/js/bootstrap-datepicker.min.js'></script>	

	<!-- Timepicker -->
	<script src='system/cms/themes/admin_endless/js/bootstrap-timepicker.min.js'></script>	
	
	<!-- Slider -->
	<script src='system/cms/themes/admin_endless/js/bootstrap-slider.min.js'></script>	
	
	<!-- Tag input -->
	<script src='system/cms/themes/admin_endless/js/jquery.tagsinput.min.js'></script>	

	<!-- WYSIHTML5 -->
	<script src='system/cms/themes/admin_endless/js/wysihtml5-0.3.0.min.js'></script>	
	<script src='system/cms/themes/admin_endless/js/uncompressed/bootstrap-wysihtml5.js'></script>	

	<!-- Dropzone -->
	<script src='system/cms/themes/admin_endless/js/dropzone.min.js'></script>	
	
	<!-- Modernizr -->
	<script src='system/cms/themes/admin_endless/js/modernizr.min.js'></script>
	
	<!-- Pace -->
	<script src='system/cms/themes/admin_endless/js/pace.min.js'></script>
	
	<!-- Popup Overlay -->
	<script src='system/cms/themes/admin_endless/js/jquery.popupoverlay.min.js'></script>
	
	<!-- Slimscroll -->
	<script src='system/cms/themes/admin_endless/js/jquery.slimscroll.min.js'></script>
	
	<!-- Cookie -->
	<script src='system/cms/themes/admin_endless/js/jquery.cookie.min.js'></script>

	<!-- Endless -->
	<script src="system/cms/themes/admin_endless/js/endless/endless_form.js"></script>
	<script src="system/cms/themes/admin_endless/js/endless/endless.js"></script>
	<!-- Endless --> 
	 <script>
	 
		 $('#theModal').on('hidden.bs.modal', function () {
 $(this).find('iframe').attr('src', '');

})
		 
		 
 
	 </script>
	  
</body>
</html>