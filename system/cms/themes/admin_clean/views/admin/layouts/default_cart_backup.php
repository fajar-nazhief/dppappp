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
	
	<!-- Grab Google CDNs jQuery, fall back if necessary -->
	 
	<script>window.jQuery || document.write('<script src="<?php echo js_path('jquery/jquery.min.js'); ?>">\x3C/script>')</script>
	
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<?php file_partial('metadata'); ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/jquery/jquery.tablesorter/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/flot/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/hg/highcharts.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/hg/modules/exporting.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/admin/showLoading/js/jquery.showLoading.min.js"></script>
	<link media="print, projection, screen" type="text/css" href="<?php echo base_url(); ?>system/cms/themes/admin_theme/js/jquery/jquery.tablesorter/themes/blue/style.css" rel="stylesheet">
	
	<script type="text/javascript">
		
		jQuery.noConflict();
                /**
 * Grid theme for Highcharts JS
 * @author Torstein H�nsi
 */

Highcharts.theme = {
   colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
   chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, 'rgb(255, 255, 255)'],
            [1, 'rgb(240, 240, 255)']
         ]
      },
      borderWidth: 2,
      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
      plotShadow: true,
      plotBorderWidth: 1
   },
   title: {
      style: {
         color: '#000',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      lineColor: '#000',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      lineColor: '#000',
      lineWidth: 1,
      tickWidth: 1,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   },

   navigation: {
      buttonOptions: {
         theme: {
            stroke: '#CCCCCC'
         }
      }
   }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
	</script>
</head>

<body>
	
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <!-- Menu button for smallar screens -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span>Menu</span>
      </a>
      <!-- Site name for smallar screens -->
      <a href="" class="brand hidden-desktop"><?php echo $this->settings->site_name; ?></a>

      <!-- Navigation starts -->
      <div class="nav-collapse collapse">        

        <ul class="nav">  

          <!-- Upload to server link. Class "dropdown-big" creates big dropdown -->
          <li class="dropdown dropdown-big">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  style="color:#fff"><span class="badge badge-important"><i class="icon-cloud-upload"></i></span> Upload to Cloud</a>
            <!-- Dropdown -->
            
          </li>

          <!-- Sync to server link -->
          <li class="dropdown dropdown-big">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  style="color:#fff"><span class="badge badge-success"><i class="icon-refresh"></i></span> Sync with Server</a>
            <!-- Dropdown -->
            
          </li>

        </ul>

        <!-- Search form -->
        

        <!-- Links -->
        <ul class="nav pull-right">
          <li class="dropdown pull-right">            
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="color:#fff">
              <i class="icon-user"></i> <?php echo sprintf(lang('cp_logged_in_welcome'), $user->display_name); ?> <b class="caret"></b>              
            </a>
            
            <!-- Dropdown menu -->
            <ul class="dropdown-menu"> 
	      <li> 
		 <?php if ($this->settings->enable_profiles) echo anchor('edit-profile', '<i class="icon-user"></i>'.lang('cp_edit_profile_label')) ?></li>
               
              <li> <?php echo anchor('admin/logout', '<i class="icon-off"></i>'.lang('cp_logout_label')); ?></li>
            </ul>
          </li>
          
        </ul>
      </div>

    </div>
  </div>
</div>

<!-- Header starts -->
  

<!-- Header starts -->
  <header>
    <div class="container-fluid">
      <div class="row-fluid">

        <!-- Logo section -->
        <div class="span4">
          <!-- Logo. -->
	  <div class="logo">
            <h1><a href="#">myOp<span class="bold">System</span></a></h1>
            <p class="meta">brand monitoring and analyzer</p>
          </div>
          
          <!-- Logo ends -->
        </div>

        <!-- Button section -->
        <div class="span4">

          <!-- Buttons -->
	

        </div>

        <!-- Data section -->

        <div class="span4">
          <div class="header-data">

            <!-- Traffic data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with red background -->
                <i class="icon-signal bred"></i> 
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="#">{memory_usage}</a> <em>memory</em></p>
              </div>
              <div class="clearfix"></div>
            </div>

            <!-- Members data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with blue background -->
                <i class="icon-user bblue"></i> 
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="#">3000</a> <em>users</em></p>
              </div>
              <div class="clearfix"></div>
            </div>

            <!-- revenue data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with green background -->
                <i class="icon-money bgreen"></i> 
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="#">{elapsed_time}</a> <em>Sec.</em></p>
              </div>
              <div class="clearfix"></div>
            </div>                        

          </div>
        </div>

      </div>
    </div>
  </header>


<!-- Header ends -->

<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
  	<div class="sidebar">
      	<div class="sidebar-dropdown"><a href="#">Navigation</a></div>

      	<!--- Sidebar navigation -->
      	<!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
      	<?php file_partial('navigation'); ?>
	 
  	</div>

  	<!-- Sidebar ends -->

  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head" style="height:60px">
	      <h2 class="pull-left"><i class="icon-table"></i> 
	       <?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?>
			 <span style="font-size:11px;color:#9C9C9C">  <?php echo $module_details['description'] ? $module_details['description'] : ''; ?>
			 </span>
			
	      </h2>
	    

        <!-- Breadcrumb -->
        <div class="bread-crumb pull-right">
          <a href="./admin"><i class="icon-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current"> <?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?></a>
        </div>

        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter" style="padding-top:0px">
		<?php template_partial('shortcuts'); ?>
		 
		<div class="container-fluid">
      	  
           

			<?php template_partial('filters'); ?>

			<?php file_partial('notices'); ?>
			
			<?php echo $template['body']; ?>
			</div>
		  </div>

		<!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->	    	
   <div class="clearfix"></div>

</div>
<!-- Content ends -->
 
<!-- Footer starts -->
<footer>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
            <!-- Copyright info -->
            <p class="copy" style="color:#fff">Copyright &copy; 2013 | <a href="<?=base_url()?>" style="color:#fff"><?php echo $this->settings->site_name; ?></a> </p>
      </div>
    </div>
  </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<span style="display: none;" class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 

<!-- JS -->

<?php echo js('jquery_010.js'); ?>
<?php echo js('bootstrap.js'); ?> 

<?php echo js('custom2.js'); ?>
 
  
  
  
</body>
</html>