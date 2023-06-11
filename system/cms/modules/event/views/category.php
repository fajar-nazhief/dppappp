<div class="row">
 <h1 class="section-header" style="margin-top:100px;margin-bottom:50px"><?php echo $blog[0]->category_title?></h1>
  

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
            <img src="<?php echo trim_image($post->body)?>" alt="<?php echo $post->title?>" />
            <?php if($post->rekomendasi=='1'){?>
	<div class="ribbon_3"><span>Recommend</span></div>
<?php }?>
            <span>
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