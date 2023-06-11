 
  

<section id="content">
<div class="content-wrap" style="padding: 20px 0;">
<div class="container clearfix">

 
	<!-- main -->
	<div class="fancy-title title-bottom-border">
<h1>What's <span>On</span></h1>
</div> 
<?php 	$data_arr = explode('_',$this->uri->segment('3'));
?>
<div class="form-group row">
<div class="col-sm-2"><h4>Filter By Date</h4></div>
<div class="col-sm-2">
<div class="form-check">
<input class="form-check-input" value="1" type="checkbox" id="gridCheck1" onChange="search_by_date()" <?php if($data_arr[0]){ echo 'checked';}?>>
<label class="form-check-label" for="gridCheck1">
Jan To Mar
</label>
</div>
</div>
<div class="col-sm-2">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="gridCheck2" value="2" onChange="search_by_date()" <?php if($data_arr[1]){ echo 'checked';}?>>
<label class="form-check-label" for="gridCheck2">
Apr To Jun
</label>
</div>
</div>

<div class="col-sm-2">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="gridCheck3"  value="3" onChange="search_by_date()" <?php if($data_arr[2]){ echo 'checked';}?>>
<label class="form-check-label" for="gridCheck3">
Jul To Sep
</label>
</div>
</div>

<div class="col-sm-2">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="gridCheck4"  value="4" onChange="search_by_date()" <?php if($data_arr[3]){ echo 'checked';}?>>
<label class="form-check-label" for="gridCheck4">
Oct To Dec
</label>
</div>
</div>


</div>


								

								
	<div id="posts" class="post-grid grid-container post-masonry grid-3 clearfix">
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