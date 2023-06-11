 
<?php  
$this->db->where('bahasa',$_SESSION['bahasa']);
$this->db->where('nama_modul','event');
$this->db->where('pilihan_editor','1');  
$this->db->where("MONTH(date_from) >=",date('m'));
$this->db->where("YEAR(date_from) >=",date('Y'));  
$this->db->order_by('id','DESC');
$ress = $this->db->get('blog')->row();
if(($ress)){
 $img=trim_image($ress->body);
?>
 <section id="slider" class="slider-element slider-parallax full-screen dark" style="overflow: hidden; background: url('<?php echo $img?>') no-repeat center center;background-size: cover;">

<div class="slider-parallax-inner">
<div class="container clearfix vertical-middle" style="z-index: 3;">
<div class="heading-block title-center nobottomborder">
<h1><?php echo $ress->title?> starts in:</h1>
</div>
<div id="countdown-ex1" class="countdown countdown-large coming-soon divcenter bottommargin" style="max-width:700px;"></div>
<div class="center topmargin-lg">
<a href="#" class="button button-3d button-purple button-rounded button-xlarge">Buy Tickets</a>
<span class="d-none d-md-inline-block"> - OR - </span>
<a href="<?php echo base_url().'event/' .date('Y/m', $ress->created_on) .'/'. $ress->slug?>" class="button button-3d button-white button-light button-rounded button-xlarge">Read Details</a>
</div>
</div>
</div>
</section>
<script>	$('#page-title').hide();</script>
<?php }?>
<!--        -->
<section id="content"> 
<form action="event/search" method="post" role="form" class="landing-wide-form clearfix">
<div class="col_four_fifth nobottommargin">
<div class="col_one_third nobottommargin">
<input name="f_keywords" placeholder="Keywords" id="demo-inline-inputpass" class="form-control" type="text" value="<?php echo @$_SESSION['f_keywords']?>" style="display:none">
<?php echo form_dropdown('f_category',array('0'=>'--All Category--')+$folders_tree,@$_SESSION['f_category'],' class="form-control form-control-lg not-dark"')?> 
</div>
<div class="col_one_third nobottommargin"> 
<input name="date_from" id="date_from"  placeholder="Date Start" class="form-control form-control-lg not-dark" value="<?php echo @$_SESSION['date_from']?>" type="text">
</div>
<div class="col_one_third col_last nobottommargin">
<input name="date_end" id="date_end" placeholder="Date End" class="form-control form-control-lg not-dark" value="<?php echo @$_SESSION['date_end']?>" type="text">
</div>
</div>
<div class="col_one_fifth col_last nobottommargin">
<button class="btn btn-lg btn-danger btn-block nomargin" name="search" value="Submit" type="submit" style="">SEARCH EVENT</button>
</div>
</form> 
</section>



<section id="content">
<div class="content-wrap" style="padding: 20px 0;">
<div class="container clearfix">

<div class="container clearfix" style="padding-bottom:50px">
 

<div class="col_one_fourth nobottommargin">
<div class="feature-box fbox-center fbox-effect">
<div class="fbox-icon">
<a href="<?php echo base_url()?>event/create"><i class="icon-hand-up i-alt"></i></a>
</div>
<h3>Send Us Your Event</h3> 
</div> 
</div>

<div class="col_one_fourth nobottommargin">
<div class="feature-box fbox-center fbox-effect">
<div class="fbox-icon">
<a href="<?php echo base_url()?>festival"><i class="icon-screen i-alt"></i></a>
</div>
<h3>View Festival</h3> 
</div> 
</div>


<div class="clear"></div>
</div>
	<!-- main -->
	<div id="posts" class="post-grid grid-container post-masonry grid-4 clearfix">
  <?php if (($blog)){ ?>
      <?php
$hit=0; 
foreach ($blog as $post){
++$hit;
$img=only_img(trim_image($post->body));
$body = strip_tags(text_only($post->body), '<p><a><br />');
?>

	<div class="entry clearfix">
	<?php if($post->rekomendasi=='1'){?>
	<div class="ribbon_3"><span>Recommend</span></div>
<?php }?>
	<div class="card">
	<div class="entry-image" style="margin-bottom:0px">
<a href="<?php echo $img?>" data-lightbox="image"><img class="image_fade" src="<?php echo $img?>" alt="<?php echo $post->title?>"></a>

</div>
<div class="card-body">


 
<div class="entry-title">
<h2><a href="<?php echo base_url().'event/' .date('Y/m', $post->created_on) .'/'. $post->slug?>"><?php echo $post->title?></a></h2>
</div>
 
<div class="entry-content">
<?php 
            if(strlen($body) >'250'){echo substr($body,'0','250').'...';}else{echo $body;}?></p>
<a href="<?php echo base_url().'event/' .date('Y/m', $post->created_on) .'/'. $post->slug?>" class="more-link">Read More</a>
</div> 
</div>
<div class="card-footer" style="padding:0px;">
<div class="toggle toggle-bg" style="margin:0px">
<div class="togglet"><i class="toggle-closed icon-ok-circle"></i><i class="toggle-open icon-remove-circle"></i> Time and location</div>
<div class="togglec" style="margin-bottom: 20px;">
<i class="icon-calendar3"></i> Start :<span class="badge badge-success"> <?php echo date('d-m-Y',strtotime($post->date_from));?></span><br><i class="icon-calendar3"></i> End :<span class="badge badge-danger"> <?php echo date('d-m-Y',strtotime($post->date_end));?></span>
</div>
</div>	
</div>
</div>
</div>


<?php }}?>

</div>
	<!-- end main -->
 
<?php echo $pagination['links']; ?> 
	</div>
	</div>
	</section> 
	<script src="<?php echo base_url()?>assets/datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/datepicker/css/datepicker.css">

<script>
      $(function(){
			window.prettyPrint && prettyPrint();
			$('#date_from').datepicker({
				format: 'mm/dd/yyyy',
        autoclose: true,
			}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});

      $('#date_end').datepicker({
				format: 'mm/dd/yyyy',
        autoclose: true,
			}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});
			
       
		});
</script>
<script>
	 
    $(".logo").attr("src", "logo.png");
    
   
		</script>
		<script>
		jQuery(document).ready( function($){
			var newDate = new Date(<?php echo date('Y',strtotime($ress->date_from)).','.date('m',strtotime($ress->date_from)).','.date('d',strtotime($ress->date_from))?>);
			$('#countdown-ex1').countdown({until: newDate});
		});

		var cal = $( '#calendar' ).calendario( {
			onDayClick : function( $el, $contentEl, dateProperties ) {

				for( var key in dateProperties ) {
					console.log( key + ' = ' + dateProperties[ key ] );
				}

			},
			caldata : canvasEvents
		} ),
		$month = $( '#calendar-month' ).html( cal.getMonthName() ),
		$year = $( '#calendar-year' ).html( cal.getYear() );

		$( '#calendar-next' ).on( 'click', function() {
			cal.gotoNextMonth( updateMonthYear );
		} );
		$( '#calendar-prev' ).on( 'click', function() {
			cal.gotoPreviousMonth( updateMonthYear );
		} );
		$( '#calendar-current' ).on( 'click', function() {
			cal.gotoNow( updateMonthYear );
		} );

		function updateMonthYear() {
			$month.html( cal.getMonthName() );
			$year.html( cal.getYear() );
		}

		 
	</script>