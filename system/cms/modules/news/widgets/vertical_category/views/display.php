 
<?php 
$data['empty']='<img src="'.image_url('icons/noimg.gif').'" style="height:65px;width:95px;padding:2px;border:1px solid #d2d2d2">';
if (($news)){ ?>
			  
						
			<?php 
			$i=0;
			foreach ($news as $article){
			$img=strip_image($article->body);
			if(($img)){
					$data['image']='<img src="'.$img.'" style="height:65px;width:95px;padding:2px;border:1px solid #d2d2d2">';	
			} 
			$data[$i]=anchor('news/' .date('Y/m', $article->created_on) .'/'. $article->slug, $article->title);
			++$i;
			}
}
$style=($style['style'])?$style['style']:"";
$a=0;
if($style == '2'){?>
<div style="padding-bottom:10px">
			<ul id="stream-list" style="padding-top: 10px; width: 510px; height: 20px;">
				   
					<li class="main_toplist_box new_biz " style="overflow: hidden;">
								<fieldset><legend style=""><?php  echo ($news[0]->category_title)?$news[0]->category_title:"";?></legend><br>
								<a href="<?php  echo base_url()?>news/category/<?php  echo ($news[0]->category_slug)?$news[0]->category_slug:"";?>" >
								<?php   echo ($data['image'])?$data['image']:$data['empty'];?>
								 
								</a>
						<?php    
			foreach($data as  $val){
			 if(($data[$a])){?>
				   <img src="<?php  echo image_url('icons/arrow2.png')?>" style="border:none">
				     
				   <?php  echo  $data[$a];//anchor('news/' .date('Y/m', $val->created_on) .'/'. $val->slug, substr($val->title,0,50)); ?>
				   <br>
			<?php   }?>
								 
			<?php   ++$a; }?>
			<span style="float:right;padding-right:20px">
			<a href="<?php  echo base_url()?>news/category/<?php  echo ($news[0]->category_slug)?$news[0]->category_slug:"";?>" ><img src="<?php  echo image_url('icons/read.gif')?>" style="border:none;"></a>
			</span>
								</fieldset></li>
			</ul>
</div>
<?php   }else{?>
			<div style="padding-right:10px;display:block;padding-bottom:10px;font-size:11px">
			<div style="border-top:solid 1px #d2d2d2;">
			<div style="text-align:center">
						<div style="padding-top:20px;padding-bottom:10px">
			<?php   echo ($data['image'])?$data['image']:$data['empty'];?>
			</div> 
			</div> 
			<h2>		
			<?php   echo ($news[0]->category_title)?$news[0]->category_title:"";?>
			</h2>
			<table>
			<?php   
			$a=0;
			foreach($data as $val){
						if(($data[$a])){?>
								<tr><td valign="top"><img src="<?php  echo image_url('icons/arrow2.png')?>" style="border:none"></td><td> <?php  echo $data[$a];	?></td></tr>
						<?php   }
						++$a;
			}
			?>
			</table>
			<br>
			<div style="float:right">
			<a href="<?php  echo base_url()?>news/category/<?php  echo ($news[0]->category_slug)?$news[0]->category_slug:"";?>" ><img src="<?php  echo image_url('icons/read.gif')?>" style="border:none;"></a>
			</div>
			</div>
			</div>
			<div style="margin-bottom:20px">&nbsp;</div>
<?php   }?>