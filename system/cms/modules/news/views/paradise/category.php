<div class="row">
 <h1 class="section-header" style="margin-top:100px;margin-bottom:50px"><?php echo $categories[0]->category_title?></h1>
  

<input type="hidden" class="logoputih" value="1">
<div class="wrapper">
  <div class="wrapper_inner">
    <!-- news -->
    <section class="news">

    <?php 
    
    if (($news)){ ?>
      <?php
$hit=0; 
foreach ($news as $post){
++$hit;
$body = strip_tags(text_only($post->body), '<p><a><br />');
?>

      <!-- news  item -->
      <div class="news_item news_i">
        <!-- news  item preview -->
        <span class="news_item_preview">
          <a href="<?php echo base_url().'news/' .date('Y/m', $post->created_on) .'/'. $post->slug?>" data-js="1">
            <img src="<?php echo trim_image($post->body,$post->foto)?>" alt="<?php echo $post->title?>" /><span>
            <h3 style="font-size:14px;margin-top:10px">
            <?php 
            if(strlen($post->title) >'60'){echo substr($post->title,'0','60').'...';}else{echo $post->title;}?>
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

<div class="row" style="text-align:center">
<?php if(($categoy_lain)){?>
  
<h1 class="section-header" data-content="JELAJAH">Also Check Out</h1>
<div class="section-header-underline"></div>
		<?php foreach($categoy_lain as $dat => $val){
		?>
		<div class="panel">
			<div class="container">
					                <div class="panel-body text-center">
	
					                 
						
						 <div class="pad-all eq-box-sm " style="background: url('<?php echo trim_image($val->banner)?>');
						 background-position: center;background-repeat: no-repeat;background-size: cover;min-height:250px;border-radius:5px">
						  
					<a  class="mar-all"   href="<?php echo base_url().'blog/category/'. $val->slug?>">
					<div style="background-color: rgba(0, 0, 0, 0.5);">
					 <h2 class="asikfont text-white pad-all"><?php echo $val->title?></h2>
					   <p class="m-bottom-md text-white asikfont pad-all"><?php echo substr($val->intro,0,200)?>...</p>
					 </div>
					</a>
					          
					
					        </div>
					       
						
					                </div>
						    </div>
					            </div>
	 
	 
  <?php }}?>
  
</div>



<script>
		$('.head').hide();
		$(".navbar").css("background", "#fff");
    $(".logo").attr("src", "logo.png");
    
   
		</script>