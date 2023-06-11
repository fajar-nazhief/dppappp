  

    <!-- Bootstrap core CSS -->
    <link href="system/cms/themes/admin_endless/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link href="system/cms/themes/admin_endless/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Pace -->
	<link href="system/cms/themes/admin_endless/css/pace.css" rel="stylesheet">
	
	<!-- Color box -->
	<link href="system/cms/themes/admin_endless/css/colorbox/colorbox.css" rel="stylesheet">
	
	<!-- Morris -->
	<link href="system/cms/themes/admin_endless/css/morris.css" rel="stylesheet"/>	
	

	
	 
	<!-- Endless -->
	<link href="system/cms/themes/admin_endless/css/endless.min.css" rel="stylesheet">
	<link href="system/cms/themes/admin_endless/css/endless-skin.css" rel="stylesheet">
	<link href="system/cms/themes/admin_endless/css/endless.css" rel="stylesheet">
	<link href="system/cms/themes/admin_endless/css/chosen/chosen.min.css" rel="stylesheet">
	<!-- Grab Google CDNs jQuery, fall back if necessary -->
	<script src="system/cms/themes/admin_theme/js/jquery/jquery.min.js"></script> 
	<script type="text/javascript" src="system/cms/themes/admin_theme/js/jquery/jquery-ui.min.js"></script> 
	<script type="text/javascript" src="system/cms/themes/admin_theme/js/admin/functions.js"></script>
	<link href="system/cms/themes/admin_theme/css/jquery/jquery-ui.css" rel="stylesheet">
	
 

<script type="text/javascript">
	var APPPATH_URI			= "<?php echo APPPATH_URI; ?>",
		SITE_URL			= "<?php echo rtrim(site_url(), '/') . '/'; ?>",
		BASE_URL			= "<?php echo BASE_URL; ?>",
		BASE_URI			= "<?php echo BASE_URI; ?>",
		UPLOAD_PATH			= "<?php echo UPLOAD_PATH; ?>",
		DEFAULT_TITLE		= "<?php echo $this->settings->site_name; ?>",
		DIALOG_MESSAGE		= "<?php echo lang('dialog.delete_message'); ?>";

	pyro.admin_theme_url 	= "<?php echo BASE_URL . $this->admin_theme->path; ?>";
	pyro.apppath_uri		= "<?php echo APPPATH_URI; ?>";
	pyro.base_uri			= "<?php echo BASE_URI; ?>";

	jQuery.noConflict();
</script>

<?php echo $template['metadata']; ?>
