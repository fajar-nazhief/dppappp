 <!DOCTYPE html>
<html> 
<head>
	 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
    <meta charset="utf-8">
    <title>Jakarta Tourism</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Jakarta Tourism Event in Jakarta" name="description" />
    <meta content="Jakarta Tourism" name="author" />
    <link rel="shortcut icon" href="logoaja.png">
    <link href="<?php echo base_url()?>theme/home/assets/css/style.css" rel="stylesheet">
				  <link href="<?php echo base_url()?>theme/home/assets/css/pariwisata.css" rel="stylesheet"> 
      
	 <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url()?>theme/home/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url()?>theme/home/css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="<?php echo base_url()?>theme/home/css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo base_url()?>theme/home/css/demo/nifty-demo.min.css" rel="stylesheet">


        
    <!--Switchery [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/switchery/switchery.min.css" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/chosen/chosen.min.css" rel="stylesheet">


    <!--noUiSlider [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/noUiSlider/nouislider.min.css" rel="stylesheet">


    <!--Select2 [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/select2/css/select2.min.css" rel="stylesheet">


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>theme/home/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">





    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?php echo base_url()?>theme/home/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?php echo base_url()?>theme/home/plugins/pace/pace.min.js"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url()?>theme/home/js/jquery-2.2.4.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url()?>theme/home/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url()?>theme/home/js/nifty.min.js"></script>






    <!--=================================================-->
    
    <!--Demo script [ DEMONSTRATION ]--> 

    
    <!--Morris.js [ OPTIONAL ]-->
    <script src="<?php echo base_url()?>theme/home/plugins/morris-js/morris.min.js"></script>
	<script src="<?php echo base_url()?>theme/home/plugins/morris-js/raphael-js/raphael.min.js"></script>
<script src="<?php echo base_url()?>theme/home/plugins/cuaca/jquery.simpleWeather.min.js"></script>

    <!--Sparkline [ OPTIONAL ]-->
    <script src="<?php echo base_url()?>theme/home/plugins/sparkline/jquery.sparkline.min.js"></script>

 
</head>
<body style="background: url('<?php echo base_url()?>theme/home/images/bgevent.jpg');background-size: 100%">
	<div style="position:absolute; top:0%;z-index: 9999 "> 
	   <img src="<?php echo base_url()?>theme/home/images/logoevent.png" style="width: 78%" >
</div>
	<style>
		 .form-control::-moz-placeholder {
    color: #fff;
    opacity: 1;
}

.dropdown-menu {
    background: #F40909;
     
}

.dropdown-menu > li > a {
    color: #fff;
}

.dropdown.open > .btn, .btn-group.open .dropdown-toggle {
    box-shadow: none;
}
	</style>
	<div class="panel" style="margin-top:110px;background: none !important;border:none !important">
					    <div class="panel-heading red col-centered" style="height:80px">
					        <div class="row col-centered align-middle">
								 <div class="col-lg-4">
								 
								 </div>
								 <div class="col-lg-8 align-middle">
									<form class="form-inline" action="<?php echo base_url()?>event/search" method="post">
								 <div class="row" style="margin-top:20px">
									 <div class="col-sm-3">
					                             <div class="btn-group" >
											<style>
												.eventsel{
													 -webkit-appearance: none; 
														-moz-appearance: none;
														 
  
  border: 1px solid #111;
  border-radius: 3px;
  overflow: hidden;
  background: url(<?php echo base_url()?>images/arrow_down.png) 96% / 20% no-repeat #EA272E;
												}
											</style>
										 
											<select name="f_category" class="eventsel" data-style="btn-danger" tabindex="-98" style="border:none !important;color:#fff;height:40px;font-size:20px">
												
												<option value="">CATEGORY</option>
												<?php foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth);
			 
		?>
					                                    <option value="<?php echo $folder->id?>"><?php echo $indent . ($folder->title);?></option>
																	<?php }?> 
					                                </select>
									</div>
					                        </div>
					                       
					                        <div class="col-sm-2">
					                            <div class="form-group">
					                                <input name="f_keywords"  placeholder="SEARCH" class="form-control" type="text" style="width:150px;border:none;background: none;border-bottom:1px dotted #ffff;color:#fff">
					                            </div>
					                        </div>
									     <div class="col-sm-2">
					                            <div class="form-group"> 
					                                <input name="date_from"  placeholder="DATE START" class="form-control" type="text" style="width:150px;border:none;background: none;border-bottom:1px dotted #ffff;color:#fff">
					                            </div>
					                        </div>
									    <div class="col-sm-2">
					                            <div class="form-group">
					                                <input name="date_end"  placeholder="DATE END" class="form-control" type="text" style="width:150px;border:none;background: none;border-bottom:1px dotted #ffff;color:#fff">
					                            </div>
					                        </div>
									    <div class="col-sm-2">
					                            <div class="form-group">
											<button class="btn btn-lg btn-default btn-active-success" style="border-radius: 5px;" name="search" value="true">FIND EVENT</button>
					                                 </div>
					                        </div>
					                    </div>
								 </div>
									</form>
					    </div>
						</div>
							
						
					    <div class="panel-body panel-trans-dark" style="height:650px;border-bottom:15px solid rgba(229, 6, 6, 0.8)">
					
					        <!--Text Alignment-->
					        <!--===================================================-->
					      <div class="row">
					    <div class="col-lg-4">
							 
					            
																	<!-- isi -->
																	<div style="margin-top:150px">
																					<!--Heading-->
																					
																		
																					<!--Widget body-->
 
																						<div class="nano border-white col-centered" style="height:120px;width:300px">
																							<div class="nano-content pad-all">
																								<div class="media">
																	 						
					                                    <div class="media-left">
					                                        <span class="text-2x text-semibold text-main" style="line-height: 0.75;color:#fff;font-size:50px"><?php echo date('d',$today[0]->date_from)?></span>
					                                    </div>
					                                    <div class="media-body">
					                                        <p class="mar-no"><?php echo date('M',$today[0]->date_from)?></p> 
					                                    </div>
					                                </div>
																								<br>
																								<ul class="list-unstyled media-block">
																									<?php foreach($today as $dat => $val){?>
																									<li class="mar-btm">
																									 <blockquote class="bq-sm  mar-no">
																										<?php echo anchor('event/'.date('Y/m',$val->date_from).'/'.$val->slug,$val->title)?>
																									 </blockquote>
																									 
																									</li>
																									 <?php }?>
																									 
																								</ul>
																							</div>
																							
																						</div>
																		
																						<!--Widget footer-->
																						<!-- Calendar -->
																						<div class="col-centered" style="height:200px;width:300px;margin-top:10px">
	<style>
		.brd-calender{
			     
				border: 1px solid #766e6c;
				font-size: 11px;
				padding: 10px;
		}
	</style>																						
<?php
function days_month($month, $year) {
	if($month!=2) {
		if($month==9||$month==4||$month==6||$month==11)
			return 30;
		else
			return 31;
	}
	else
		return $year%4==""&&$year%100!="" ? 29 : 28;
}
 
global $months;
$months = array(0 => 'January', 1 => 'February', 2 => 'March', 3 => 'April', 4 => 'May', 5 => 'June', 6 => 'July', 7 => 'August', 8 => 'September', 9 => 'October', 10 => 'November', 11 => 'December');
$days = array(0 => 'Monday', 1 => 'Tuesday', 2 => 'Wednesday', 3 => 'Thursday', 4 => 'Friday', 5 => 'Saturday', 6 => 'Sunday');
 
function render_calendar($this_year = null,$bulan=0,$adaevent=array()) {
	if($this_year==null)
		$this_year = date('Y');
	$day_of_the_month = date('N', strtotime('1 January '.$this_year));
	
		echo '<table class="calendertable col-centered"> 
			<thead>
				<tr>
				  <th class="arrow"> </th>
				  <th colspan="5" style="font-size:15px;letter-spacing: 10px;padding:5px">
				    '.$GLOBALS['months'][($bulan+1)-2].' 
				  </th>
				  <th class="arrow" </th>
				</tr>
			   </thead>
			<tbody>
			 <tr>
      <th>Mon</th>
      <th>Tue</th>
      <th>Wed</th>
      <th>Thu</th>
      <th>Fri</th>
      <th>Sat</th>
      <th>Sun</th>
    </tr>
				<tr>';
		for($n=1;$n<$day_of_the_month;$n++)
			echo "<td></td>\n";
		$days = days_month($bulan, $this_year);
		$day = 0;		
		while($day<$days) {
			$class="brd-right";
			if($day_of_the_month==8) {
				echo ($day == 0 ? "" : "</tr>\n") . "<tr>\n";
				$day_of_the_month = 1;
				$class="brd-left";
			}
			
			
			$tgl=$day+1;
			if(isset($adaevent[$tgl])){
				$tgl='<a href="'.base_url().'event/halaman/'.($day+1).'" style="background:red;padding:2px 7px 2px 5px;border-radius:10px;color:#fff">'.$tgl.'</a>';
			}
			echo '<td class="brd-calender">'. $tgl . "</td>\n";
			$day_of_the_month++;
			$day++;
		}
		echo "</tr>
			</tbody>
		</table>";
	
} 
render_calendar(date('Y'),date('m'),@$adaevent);
?>
<center>
<a href="<?php echo base_url()?>event/create"><img src="<?php echo base_url()?>theme/home/images/calbutton.png" class="col-centered" style="height:40px;margin:10px"></a></center>
																						</div>
<!-- end calender -->
																					</div>
																			 
													 
											<!-- END -->
					             
					             
					        
					        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					        <!--End todo list-->
						 
					    </div>
					    <div class="col-lg-8" style="padding-top:20px">
					        <div class="panel panel-trans">
					            <!-- MULAI -->
								<div id="myCarousel" class="carousel slide" data-ride="carousel">
									<!-- Indicators -->
									<?php  $jumlah = round(count($thismonth)/12);?>
									<ol class="carousel-indicators" style=" bottom: -70px;">
										<?php for($i=0;$i<$jumlah;$i++){
											$active='';
											if($i==0){
												$active='class="active"';
											}
											?>
									  
									  <?php }?>
									   
									</ol>
								  
									<!-- Wrapper for slides -->
									<div class="carousel-inner" style="width:94%;margin-left:30px">
										 <div class="item active">
											<div class="row">
												<div class="col-lg-12">
													<div class="row">
														<div class="eq-height">
														 
										<?php
										$hitung_item=0;
										$hitung_col=0;
										$hitung_col2=0;
										
										foreach($thismonth as $dat => $val){
											++$hitung_item;
											
											if($hitung_item <=12){
												
												if($hitung_col < 8){
													
													  
													?>
													<div class="col-lg-3 ">
														<a href="<?php echo base_url().$this->nama_modul.'/' .date('Y/m', $val->created_on) .'/'. $val->slug?>"  class="text-semibold text-danger"><img src="<?php echo trim_image($val->body)?>" style="width:100%;height:200px"></a>
														<div class="panel">
														    <div class=" text-center" style="padding:10px">
															    <a href="<?php echo base_url().$this->nama_modul.'/' .date('Y/m', $val->created_on) .'/'. $val->slug?>"  class="text-semibold text-danger"><?php echo $val->title?></a>
														    </div>
														</div>
													</div>
													  <!--===================================================-->
													<?php  
													++$hitung_col; 
												}else{
												$hitung_col = 0;
											echo '</div></div></div></div></div><div class="item"><div class="row"><div class="col-lg-12"><div class="row"> <div class="eq-height">';
												}
											?>
												
											<?php }else{
												$hitung_item=0; 
												
											}
											?>
									 
					    
					
										
									  <?php }?>
									  
										   </div>
									  </div>
											</div>
										 
									  </div>
											</div>
									  <!-- END ITEM-->
										
										
										
									  
								  
									<!-- Left and right controls -->
									<a class="left carousel-control" href="#myCarousel" data-slide="prev">
									  <span class="glyphicon glyphicon-chevron-left" style="color:red"></span>
									  <span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel" data-slide="next">
									  <span class="glyphicon glyphicon-chevron-right" style="color:red"></span>
									  <span class="sr-only">Next</span>
									</a>
								  </div>
								<!-- UDAHAN -->
					        </div>
					    </div>
					    
					</div>
					        <!--===================================================-->
					
					    </div>
					</div>
	

<!-- BEGIN LOGIN BOX -->  
<script src="<?php echo base_url()?>theme/home/assets/plugins/gsap/main-gsap.min.js"></script> 
<script src="<?php echo base_url()?>theme/home/assets/plugins/backstretch/backstretch.min.js"></script>
<script src="<?php echo base_url()?>theme/home/assets/plugins/bootstrap-loading/lada.min.js"></script> 
</body>

<!-- Mirrored from apps.smartcity.jakarta.go.id/pantau-banjir/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 14:12:01 GMT -->
</html>
 