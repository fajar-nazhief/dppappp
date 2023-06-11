<!DOCTYPE html>
<html lang="en">
<head>

 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo lang('cp_admin_title').' - '.$template['title'];?></title>
	<base href="<?php echo base_url(); ?>" />
<?php file_partial('metadata'); ?>
  
 
</head>
 
<body>
	<div id="cover"></div>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                 <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                         
                        <div class="brand-title">
                            <span class="brand-text"></span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->


                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-view-list"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->



                        

                    </ul>
                    <ul class="nav navbar-top-links pull-right">

                        <!--Language selector-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                      
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End language selector-->



                        <!--User dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <!--<img class="img-circle img-user media-object" src="img/profile-photos/1.png" alt="Profile Picture">-->
                                    <i class="demo-pli-male ic-user"></i>
                                </span>
                                <div class="username hidden-xs"><?php echo $user->display_name?></div>
                            </a>


                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">

                                


                                <!-- User dropdown menu -->
                                 

                                <!-- Dropdown footer -->
                                <div class="pad-all text-right">
                                    <a href="<?php echo base_url()?>admin/logout" class="btn btn-primary">
                                        <i class="demo-pli-unlock"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End user dropdown-->

                        <li>
                            <a href="#" class="aside-toggle navbar-aside-icon">
                                <i class="pci-ver-dots"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="breadcrumbgue">
																		<ul class="breadcrumbgue">
																				<li><i class="ion-home"></i><a href=""> Home</a> / </li>
																				<li class="active"><?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?></li>	 
																		</ul>
																	</div>
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
																<div class="main-header clearfix">
																	<div id="page-title">
                    <h1 class="page-header text-overflow"><?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?></h1>
<?php echo $module_details['description'] ? $module_details['description'] : ''; ?>
                    <!--Searchbox-->
                    <div class="searchbox" style="width:50%;pull-right">
                        <div class="input-group pull-right">
                             <?php template_partial('filters'); ?>
                        </div>
                    </div>
                </div>
																	
                

                    <!--Searchbox-->
                    
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                
                 
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->

<div class="grey-container shortcut-wrapper">

	   <?php template_partial('shortcuts'); ?> 
			
	 
			</div><!-- /grey-container --> 
        

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					 <?php file_partial('notices'); ?>
				<?php echo $template['body']; ?>
					
					
                </div>
                <!--===================================================-->
                <!--End page content-->


            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
            <!--ASIDE-->
            <!--===================================================-->
            <aside id="aside-container">
                <div id="aside">
                    <div class="nano">
                        <div class="nano-content">
                            
                            <!--Nav tabs-->
                            <!--================================-->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#demo-asd-tab-1" data-toggle="tab">
                                        <i class="demo-pli-speech-bubble-7"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-2" data-toggle="tab">
                                        <i class="demo-pli-information icon-fw"></i> Report
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-3" data-toggle="tab">
                                        <i class="demo-pli-wrench icon-fw"></i> Settings
                                    </a>
                                </li>
                            </ul>
                            <!--================================-->
                            <!--End nav tabs-->



                            <!-- Tabs Content -->
                            <!--================================-->
                         
                </div>
            </aside>
            <!--===================================================-->
            <!--END ASIDE-->

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap">
                                        <div class="pad-btm text-center">
                                           
																																												
																																							 
																																								<img src="fav.png" alt="User Avatar" class="img-lg"> 
                                      
																																					 
																																								
																																								<?php
																																								
																																								
																																								
																	 
						$namaTravel = $this->settings->site_name;
				 
					
					$title = explode(' ',$namaTravel); 
					if(!empty($title[1])){
					?>
					
					<div class="list-inline mar-all"  style="margin-bottom:0px">
						 <span class="label label-success pull-right"><?php echo $this->user->group?></span>
							<span class=""><h4 class="bounceIn animation-delay4" style="margin-top:0px;color:#fff;">  <?php echo $namaTravel?></h4></span>
						
					</div>
					 
					 <?php }else{?>
					 <ul class="list-inline"  style="margin-bottom:0px">
							<li class="">&nbsp;</li>
						</ul>
					 <h4 class="bounceIn animation-delay4" style="margin-top:0px;color:#fff;"><?php echo $title[0]?></h4>
					 <?php }?>
                     </div>
                                         
                                    </div>
                                    
                                </div>


                                <!--Shortcut buttons-->
                                <!--================================-->
                                
                                <!--================================-->
                                <!--End shortcut buttons-->

<?php file_partial('navigation'); ?> 
                                


                                <!--Widget-->
                                <!--================================-->
                                <div class="mainnav-widget">

                                    <!-- Show the button on collapsed navigation -->
                                    <div class="show-small">
                                        <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                            <i class="demo-pli-monitor-2"></i>
                                        </a>
                                    </div>

                                    <!-- Hide the content on collapsed navigation -->
                                    <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                         
                                    </div>
                                </div>
                                <!--================================-->
                                <!--End widget-->

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->



    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


    
        
    <!--===================================================-->
    <!-- END SETTINGS -->

<script>  setTimeout(function(){
                $('#cover').fadeOut(500);
                },500);
                $('#datetimepicker').datetimepicker({
                    
                    format:'YYYY/MM/DD HH:mm'         
                });

               
												</script>
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.5/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Feb 2017 11:39:37 GMT -->
</html>

