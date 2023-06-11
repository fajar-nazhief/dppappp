
<?php   if($options['styles']=='0'){?>
<?php  if(is_array($categories)){?>
 <h3><?php  echo strtoupper($options['judul'])?></h3>
    
      
    
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<div class="right_articles">
			 <p><img src="<?php  echo strip_image($article_widget->body);?>" width="64px" style="border:1px solid #dedede;padding:2px" title="Image" class="image"><b><a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a></b><br />
        <?php   echo $article_widget->intro?></p>
					  
				 </div> 
			<?php   }?>
			 
      <?php   }?>
	 
      <?php   }//print_r($options)?>
      
      <?php   if($options['styles']=='1'){?>
<?php  if(is_array($categories)){?>
<script type="text/javascript" src="<?php  echo js_url('slidernews.js','news');?>"></script>
<style>
#jqnews
{
	overflow: hidden; 
}

#jqnews div
{
	display: block;
	overflow: hidden; 
}

#jqnewsVert
{
	overflow: hidden; height: 273px;  margin:auto;  
}

#jqnewsVert div
{
	display: block; overflow: hidden;  height: 118px;  margin-bottom:5px;  
}

#jqnewsOriz
{
	border: solid 1px #000;	height: 130px; width: 650px; overflow: hidden; margin:auto;
}

#jqnewsOriz div
{
	float:left;	border: solid 1px #000;	background: #def; height: 118px; width: 150px; margin: 5px;	display:block;
}
</style>
 <h3><?php  echo strtoupper($options['judul'])?></h3>
   
                
                 
            
       <div id="jqnewsVert">
    
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<div class="right_articles">
			 <p><img src="<?php  echo strip_image($article_widget->body);?>" width="64px" style="border:1px solid #dedede;padding:2px" title="Image" class="image"><b><a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a></b><br />
        <?php   echo $article_widget->intro?></p>
					  
				 </div> 
			<?php   }?>
			 
      <?php   }?>
      </div>
	 
      <?php   }//print_r($options)?>
      
       
      <?php   if($options['newstype']=='2'){?>
<?php  if(is_array($categories)){?>
 <h3><?php  echo strtoupper($options['judul'])?></h3>
    
      
    
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<div class="right_articles">
			 <p><img src="<?php  echo strip_image($article_widget->body);?>" width="64px" style="border:1px solid #dedede;padding:2px" title="Image" class="image"><b><a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a></b><br />
        <?php   echo $article_widget->intro?></p>
					  
				 </div> 
			<?php   }?>
			 
      <?php   }?>
	 
      <?php   }//print_r($options)?>
 
 

 
