
 
<script>
  $('#judul').html('<?php echo $categories[0]->category_title?>');
  </script>




<div class=" d-none d-xl-block" style="padding-top:200px">&nbsp;</div>
<div class="d-md-none"  style="padding-top:50px">&nbsp;</div>
<main class="white_bg" > 
<div id="position" style="padding:0px;background:#fff">

		<div class="container">

			<ul class="headercrumb">

				<li><a href="<?php echo base_url()?>">Home</a>

				</li> 

				<li><a href="javascript:void(0)"><?php echo   $categories[0]->category_title?></a></li>

			</ul>

		</div>

	</div>

	<!-- End position -->
  <div class="container margin_60" style="padding-bottom:0px">
<div class="row"> 

<?php 
    
    if (($news)){ ?>
      <?php
$hit=0; 
foreach($news as $val){
  $img = url_img($val->body);
    $intro=text_only(htmltotext($val->body));
?> 
<div class="col-md-6" >
  <div class="row" style="margin-bottom:30px">
<div class="col-md-3" >
<a href="<?php echo base_url().'news/' .date('Y/m', $val->created_on) .'/'. $val->slug?>">
 <div class="d-md-none" >
<img src="<?php echo $img?>"  alt="<?php echo $val->title?>" class="img-artikel-xs" style="width:100%;border-radius:30px">
</div>
<div class="d-none d-xl-block" >
<img src="<?php echo $img?>"  alt="<?php echo $val->title?>" class="img-artikel" style="width:130px">
</div>
</a>
      </div>
      <div class="col-md-9"> 
      	<small><i class="icon-calendar"></i> <?php echo date('d-m-Y', $val->created_on)?></small>
        <a href="<?php echo base_url().'news/' .date('Y/m', $val->created_on) .'/'. $val->slug?>" ><h6 style="margin-top:3px"><?php echo $val->title?></h6></a>
      <p style="font-size:12px;color:#555"><?php echo substr($intro,0,150)?>...</p>
</div> 
</div>
</div>
<?php }}?>
             

                </div>
                <hr>
            <nav aria-label="Page navigation">
<?php echo $pagination['links']; ?>
                </nav>
                </div>
                </main>