<script type="text/javascript" src="<?php  echo js_url('jquery/jquery.innerfade.pack.js')?>"></script>
<script type="text/javascript">
	   $(document).ready(
				function(){
					$('ul#banners').innerfade({
						speed: 1000,
						timeout: 5000,
						type: 'sequence',
						containerheight: '70px'
					});
			});
  	</script>
<?php 
  
$imgbg=image_path('bg_images.png','_theme_');
 ?>
 <div style="padding-bottom:10px;overflow: hidden;">

				<ul id="banners" style="list-style: none;overflow: hidden;" >
				  <?php 
				$a=1;
				$img="";
				foreach($res as $data => $val){
						
				if($a <= 2) {
						$img.='<span style="padding-right:25px"><a href="'.$val->link_url.'" target="_blank"><img src="'.base_url().'uploads/Banner/'.$val->link_file.'" style="border:1px solid #d2d2d2;padding:2px"></a></span>';
						++$a;
				}else{
						$img.='<span style="padding-right:0px"><img src="'.base_url().'uploads/Banner/'.$val->link_file.'" style="border:1px solid #d2d2d2;padding:2px"></span>';
				?>
				<li>
						<?php  echo $img;
						$a=1;$img="";?>
				</li>
				<?php   }
				}
				?>
				</ul>
		 
  </div>