<div id="featured" class="widget" style="width:315px">
					<h3 class="title" style="width:285px"> Celebrity twittland.com </h3>
					<div class="padder"> 
					 
					<div style="">
						<ul>
	<?php  foreach($news_widget as $article_widget): ?>
		<li><a href="<?php  echo base_url()?>twittlander/page/<?php  echo $article_widget->intro_en; ?>"><b>@<?php  echo $article_widget->intro_en; ?></b></a>
		<span class="comm_bubble"> Jumlah Chirpstory: <a href="<?php  echo base_url()?>twittlander/page/<?php  echo $article_widget->intro_en; ?>"><?php  echo $article_widget->jml?></a></span>
		</li>
	<?php  endforeach; ?>
</ul>
						</div>
					</div>
					</div>