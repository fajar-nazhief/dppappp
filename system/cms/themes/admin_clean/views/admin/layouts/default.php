<!DOCTYPE html>
<html lang="en">
<head>

 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo lang('cp_admin_title').' - '.$template['title'];?></title>
	<base href="<?php echo base_url(); ?>" />
<?php file_partial('metadata'); ?>
<link href="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />


<link href="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">

<link href="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">

<link href="<?php echo base_url()?>system/cms/themes/admin_clean/css/animate.css" rel="stylesheet">

<link href="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom CSS --> 
    
    <link href="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  
<script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/js/waves.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- jQuery peity -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/peity/jquery.peity.init.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/js/custom.min.js"></script> 
    <!--Style Switcher -->
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/moment/moment.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/js/functions.js"></script>
    
    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/bower_components/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo base_url()?>assets/code/highcharts.js"></script>
    <script src="<?php echo base_url()?>assets/code/modules/data.js"></script>
<script src="<?php echo base_url()?>assets/code/modules/exporting.js"></script> 
<script>
 function chartcolumn(a,b,c,d){
  Highcharts.chart(a, {
      chart: {
          type: 'column'
      },
      data: {
          // enablePolling: true,
          csvURL: b
      },
      plotOptions: {
          bar: {
              colorByPoint: true
          },
          series: {
            zones: [{
              color: '#4CAF50',
              value: 0
          }, {
              color: '#8BC34A',
              value: 10
          }, {
              color: '#CDDC39',
              value: 20
          }, {
              color: '#CDDC39',
              value: 30
          }, {
              color: '#FFEB3B',
              value: 40
          }, {
              color: '#FFEB3B',
              value: 50
          }, {
              color: '#FFC107',
              value: 60
          }, {
              color: '#FF9800',
              value: 70
          }, {
              color: '#FF5722',
              value: 80
          }, {
              color: '#F44336',
              value: 90
          }, {
              color: '#F44336',
              value: Number.MAX_VALUE
          }],
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.0f}'
              }
          }
      },
      title: {
          text: c
      },
      yAxis: {
          title: {
              text: d
          }
      }
  });
}
</script>
</head>
 
<body>
    
 <!-- Preloader -->
 <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="index.html"><b><img src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/images/eliteadmin-logo.png" alt="home" /></b><span class="hidden-xs"><strong>Villa</strong>2000</span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                    <?php template_partial('filters'); ?> 
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-envelope"></i>
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-note"></i>
          <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/images/users/d1.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $user->display_name?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i>  My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i>  Account Setting</a></li>
                            <li><a href="login.html"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="<?php echo base_url()?>system/cms/themes/admin_clean/plugins/images/users/d1.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?php echo $user->display_name?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li> 
                    <?php file_partial('navigation'); ?> 
                    
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-header text-overflow"><?php echo $module_details['name'] ?$module_details['name'] : lang('cp_admin_home_title'); ?></h4> 
                 </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                        <li><?php template_partial('shortcuts'); ?> </li>	 
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--row -->

                <?php file_partial('notices'); ?>
				<?php echo $template['body']; ?>
                 
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Elite Admin brought to you by OmDon Tech.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->


    
        
    <!--===================================================-->
    <!-- END SETTINGS -->
    
    <?php echo $template['metadata']; ?>
     
</body>
 
</html>

