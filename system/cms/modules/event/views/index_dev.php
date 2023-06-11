<!--Bootstrap Datepicker [ OPTIONAL ]-->
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


<div class="row">
 <h1 class="section-header" style="margin-top:100px;margin-bottom:50px">Event Jakarta</h1>
  
 
 
 <div class="container"  style="margin-top:50px;margin-bottom:50px;background-color:#C0C0C0;height:100%;width:100%">
		<div class="panel">
			 <div class="panel-body  pad-all">
					<div class="row mar-all">
						<div class="col-sm-12">
								<form class="form-inline" action="event/search" method="post">
					           <div class="form-group" style="margin: 15px">
					                <label for="demo-inline-inputmail" class="sr-only">Category</label>
					                <?php echo form_dropdown('f_category',array('0'=>'--All Category--')+$folders_tree,@$_SESSION['f_category'],' class="form-control"')?>
					            </div> 
					            <div class="form-group">
					                <label for="demo-inline-inputpass" class="sr-only">Keywords</label>
					                <input name="f_keywords" placeholder="Keywords" id="demo-inline-inputpass" class="form-control" type="text" value="<?php echo @$_SESSION['f_keywords']?>">
                      </div>
                      
					           <div class="form-group" >
                     
                        
                     
                     <input name="date_from" id="date_from"  placeholder="Date Start" class="form-control" value="<?php echo @$_SESSION['date_from']?>" type="text" style="width:150px">
					                            </div>
					            
					           <div class="form-group" id="demo-dp-txtinput">
					                                <input name="date_end" id="date_end" placeholder="Date End" class="form-control" value="<?php echo @$_SESSION['date_end']?>" type="text" style="width:150px">
					                            </div>
					            <button class="btn btn-primary" type="submit" name="search" value="Submit">Submit</button>
								<a href="<?php echo base_url()?>event/create"  class="btn btn-success btn-icon"><i class="demo-psi-pen-5 icon-lg"></i> Send Us Your Event</a>
							<a href="<?php echo base_url()?>festival"  class="btn btn-danger btn-icon"><i class="demo-psi-pen-5 icon-lg"></i> View Festival</a>
							</form>
						</div>
													
					</div>
				</div>
		</div>
 </div>   



<input type="hidden" class="logoputih" value="1">
<div class="wrapper">
  <div class="wrapper_inner">
    <!-- news -->
    <section class="news">

    <?php if (($blog)){ ?>
      <?php
$hit=0; 
foreach ($blog as $post){
++$hit;
$body = strip_tags(text_only($post->body), '<p><a><br />');
?>

      <!-- news  item -->
      <div class="news_item">
        <!-- news  item preview -->
        <span class="news_item_preview">
          <a href="<?php echo base_url().'event/' .date('Y/m', $post->created_on) .'/'. $post->slug?>" data-js="1">
            <img src="<?php echo trim_image($post->body)?>" alt="<?php echo $post->title?>" /><span>
            <h3 style="font-size:12px;margin-top:10px">
            <?php 
            if(strlen($post->title) >'40'){echo substr($post->title,'0','40').'...';}else{echo $post->title;}?>
          </h3>
            <p></p>

            </span>
          </a>

        </span>
      </div>
      <?php }}?>
 


    
    </section>
    
  </div>
</div>
</div>

<div class="row" style="text-align:center">
<?php echo $pagination['links']; ?>
</div>
<div class="row mar-all" style="text-align:center">
<?php if(($categoy_lain)){?>
  
<h1 class="section-header" data-content="JELAJAH">Also Check Out</h1> 
		<?php foreach($categoy_lain as $dat => $val){
		?> 
					<a href="<?php echo base_url().'event/category/'. $val->slug?>">
					 <span class=" pad-all" style="text-decoration:none;font-size:12px"><?php echo $val->title?></span></a> - 
  <?php }}?>
  
</div>


<script>
		$('.head').hide();
		$(".navbar").css("background", "#fff");
    $(".logo").attr("src", "logo.png");
    
   
		</script>