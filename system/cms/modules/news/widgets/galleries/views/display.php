<?php 
if($options['styles']=='0'){
?>
<div class="widget">
<h3 class="title"><?php  echo $options['judul']?></h3>
<div class="padder"> 
 
<div style="">
<?php   
if(($categories)){
foreach($categories as $data => $val){?>
<div id="flickr_badge_image1" class="flickr_badge_image">
 <a href="<?php  echo base_url()?>galleries/<?php  echo $val->slug?>/<?php  echo $val->fid?>"><img src="<?php  echo base_url()?>files/thumb/<?php  echo $val->id?>" width="<?php  echo $options['width']?>" height="<?php  echo $options['height']?>" style="border:1px solid #dedede;padding:3px;"></a>
</div>
<?php   }
}
?>
</div>
</div>
</div>
<?php   }?>

<?php 
if($options['styles']=='2'){
?>
<div class="widget">
<div class="fbj_rcol_sectionwithborder">
            	<div id="fbj_video_section">
                    <h2><?php  echo $options['judul']?></h2>
                    <center>
                    <?php   
                        if(($categories)){
                        foreach($categories as $data => $val){?>
                        
                        <div class="video_box">
                       <a href="<?php  echo base_url()?>galleries/<?php  echo $val->slug?>/<?php  echo $val->fid?>"><img src="<?php  echo base_url()?>files/thumb/<?php  echo $val->id?>" width="<?php  echo $options['width']?>" height="<?php  echo $options['height']?>" style="border:1px solid #dedede;padding:3px;margin:5px 10px;"></a>
                        <a href="#"><?php  echo $val->description?></a>
                        </div> 
                        
                        
                        <?php   }
                        }?>
                    </center>
                     <div class="view_all"><a href="<?php  echo base_url()?>galleries/<?php  echo $val->slug?>">Index Video</a></div>
				</div>
            </div>
</div>
<?php 
}
?>