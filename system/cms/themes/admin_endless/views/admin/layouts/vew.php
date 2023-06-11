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

<body>
	<!-- Overlay Div -->
	 
	
	 
	<div id="wrapper" class="preload">
	 

		<div id="main-container">
			 
			<div class="padding-md">
				<?php file_partial('notices'); ?>
				<?php echo $template['body']; ?>
				  
			</div><!-- /.padding-md -->
		</div><!-- /main-container -->
		<!-- Footer
		================================================== -->
		 
		
		
		<!--Modal-->
		 
  			 
	</div><!-- /wrapper -->
 

 
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
	 
	  
</body>
</html>