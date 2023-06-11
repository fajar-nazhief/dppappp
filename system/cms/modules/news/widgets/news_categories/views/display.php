<?php 
if($options['styles'] == '0'){
?>

<div style="padding:7px;border-top:1px solid #dedede;background:#f4f4f4;height:15px;font-size:10px;font-weight:bold">Menu Utama</div>
<?php  if(is_array($categories)): ?> 
 
    <ul style="margin-right:5px">
      <li style="border-bottom:1px solid #dedede;padding:5px 5px;"><b><?php  echo anchor("", 'Home'); ?> </b></li>
      <?php  foreach($categories as $category):
   
		 
		  if(($category->uri)){
			echo '<li style="border-bottom:1px solid #dedede;padding:5px 5px" ><b><a href="'.$category->uri.'"> '.$category->title.'</a></b></li>';
			}else{
			echo '<li style="border-bottom:1px solid #dedede;padding:5px 5px" ><b><a  href="'.base_url().'news/category/'.$category->slug.'"> '.$category->title.'</a></b> </li>';
			}
      ?>
	 
	 
<?php  endforeach; ?>
    </ul>
    

<?php  endif; ?>
<?php   }?>

<?php 
 
 
if($options['styles'] == '1'){
  
 if(($article->navigation_group_id)){
	    $catid=$article->navigation_group_id;
	  }
	 
	 $cek=$this->db->where('id',@$catid)->get('news_categories')->row();
	 if(($cek)){
	 if($cek->navigation_group_id =='0'){
	  $catid=@$article->category_id;
	 }}
	 
?>
 <style>
#main-nav {
	width: 1000px;
	height: 50px;
	position: relative;
	list-style: none;
	padding: 0;
}

#main-nav .main-nav-item {
	display: inline;
}

#main-nav .main-nav-tab {
	float: left;
	width: auto;
	height: 50px;
	padding: 10px;
	line-height: 38px;
	text-align: center;
	color: #FFF;
	text-decoration: none;
	font-size: 17px;
}

#main-nav .main-nav-item-active .main-nav-tab {
	background-color: #FFF;
	color: #f60;
	  
}

#main-nav .main-nav-dd {
	position: absolute;
	top: 60px;
	left: 0;
	margin: 0;
	padding: 0;
	background-color: #FFF;
	border-bottom: 4px solid #f60;
	display: none;
}

#main-nav .main-nav-item-active .main-nav-dd {
	display: block;
}

#main-nav .main-nav-dd-column {
	width: 120px;
	padding: 15px 20px 8px;
	display: table-cell;
	border-left: 1px solid #ddd;
	*float: left;
	*border-left: 0;
}

#main-nav .main-nav-dd-column:first-child {
	border-left: 0;
}

#main-nav .main-nav-dd h2 {
	font-size: 12px;
	color: #86c6d7;
}

#main-nav .main-nav-dd a {
	color: #777;
	text-decoration: none;
}

#main-nav .main-nav-dd a:hover {
	color: #86c6d7;
	text-decoration: underline;
}

#main-nav .main-nav-dd ul {
	list-style: none;
	padding: 0;
}

#main-nav .main-nav-dd hr {
	border: 1px dotted #ddd;
}
</style>
<div class="topbar" style="height:60px;border-bottom:3px solid #fff">
      <div class="fill" style="height:60px">
        <div class="container">
          
          
<ul id="main-nav">
    
  <?php  if(is_array($categories)){ ?> 
 
 
      <?php 
     
      foreach($categories as $category):?>
       
     
		 
		
  
     <li class="main-nav-item">
		 
		<?php    if(($category->uri)){
			echo ' <a href="'.$category->uri.'"  class="main-nav-tab" style="font-size:14px"> '.$category->title.'</a>';
			}else{
			echo ' <a  href="'.base_url().'news/category/'.$category->slug.'"  class="main-nav-tab" style="font-size:14px"> '.$category->title.'</a>';
			}
      ?>
		 
		
		<div class="main-nav-dd">
			<div class="main-nav-dd-column" style="width:auto">
				 
				
				
					 <?php 
	  
	        
	   
	 
		//$categories = $this->db->where('show','1')->select('count(default_news.id) as total,news_categories.title as title,news_categories.slug as slug')->join('news_categories','news_categories.id = news.category_id')->group_by('news.category_id')->order_by('news_categories.title','ASC')->get('news')->result();
		$sub = $this->db
		->where('navigation_group_id',$category->id)
		->where('show','1')->order_by('position','ASC')->get('news_categories')->result();
		
		
		 if(($sub)){?>
		<h2 style="font-size:20px;color:#000000">
				 <font color="red"><?php  echo strtoupper($category->title)?></font>
				</h2>
				
				<ul>
		 <?php 
		 
		  unset($cat);
		  $cat = array();
		  foreach($sub as $datr=>$categor){
		    
		      $cat[]=$categor->id;
		    
		    if(($categor->uri)){
			    echo '<li><a href="'.$categor->uri.'" style="text-shadow:none"> '.$categor->title.'</a></li>';
			    }else{
			    echo '<li style="float:none"><a href="'.base_url().'news/category/'.$categor->slug.'" >'.$categor->title.'</a></li>';
			    }
		    }?>

		    	</ul>
		   
		    <?php 
		 }
		
	 
	      ?> 
			</div>
		   <?php 
		 
		    
		    
		       if(empty($sub)){
			$this->db->where('category_id',$category->id);
		       }else{
			$this->db->where_in('category_id',$cat);
		       }
		       
		      $terbaru=$this->db->where('status','live')
		   ->where('created_on <=', now())
		   ->order_by('id','DESC')
		    ->where('section_id', '0')
		   ->limit('5')
		   ->get('news')->result();
		   
		   if(($terbaru)){
		   ?>
		   <div class="main-nav-dd-column">
				<h2 style="font-size:20px;color:#000000">
				BERITA TERBARU 
				</h2>
				
				<ul style="width:250px">
				  <?php 
				    
				  foreach($terbaru as $datan => $valuen){
				    
				    ?>
				  
					<li style="border-bottom:1px solid #dedede;font-size:15px;text-shadow:none">
					 
					  <a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$valuen->created_on)?>/<?php  echo $valuen->slug?>">
					   <div style="font:15px Oswald;color:#244B81;"><?php   echo $valuen->katakunci?></div>
					  <?php  echo $valuen->title?></a></li>
					<?php   }?>
					
				</ul>
		   </div>
		   <?php   }?>
		   <?php 
		   
		  
		  
		  
		  
		     
		      if(empty($sub)){
		    $this->db->where('category_id',$category->id);
		  }else{
		    $this->db->where_in('category_id',$cat);
		  }
		  $min2 = strtotime ( '-2 day' , strtotime (date('Y-m-d 00:00:00'))); 
		    
		    $populer=$this->db->where('status','live')
		   ->where('created_on >=', $min2)
		   ->order_by('klik','DESC')
		    ->where('section_id', '0')
		   ->limit('5')
		   ->get('news')->result();
		   
		   if(($populer)){
		   ?>
		   <div class="main-nav-dd-column">
				<h2 style="font-size:20px;color:#000000">
				PALING POPULER
				</h2>
				
				<ul style="width:250px">
				  <?php 
				  $countp=0;
				  foreach($populer as $datan => $valuen){++$countp;?>
				  <?php   if($countp == 1){?>
				  <li>
				    <a style="border: medium none;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$valuen->created_on)?>/<?php  echo $valuen->slug?>" title="<?php   echo $valuen->title?>">
												  <img src="<?php  echo strip_image($valuen->body);?>" style="width:210px;height:129px;border:5px solid #dedede" alt="artikelmedia.com"></a>
				    </li>
				  <?php   }?>
					<li style="border-bottom:1px solid #dedede;font-size:15px;">
					  
					  <a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$valuen->created_on)?>/<?php  echo $valuen->slug?>">
					  <div style="font:15px Oswald;color:#244B81;"><?php   echo $valuen->katakunci?></div>
					  <?php  echo $valuen->title?></a></li>
					<?php   }?>
					
				</ul>
		   </div>
		   <?php   }?>
		   
		    <?php 
		  if(empty($sub)){
		    $this->db->where('category_id',$category->id);
		  }else{
		    $this->db->where_in('category_id',$cat);
		  }
		  
		    
		      $pilihan=$this->db->where('status','live')
		   ->where('created_on <=', now())
		   ->where('pilihan_editor', '1')
		    ->where('section_id', '0')
		   ->order_by('id','DESC')
		   ->limit('5')
		   ->get('news')->result();
		   if(($pilihan)){
		   ?>
		   
		   <div class="main-nav-dd-column">
				<h2 style="font-size:20px;color:#000000">
				PILIHAN EDITOR
				</h2>
				
				<ul style="width:250px">
				  <?php 
				  $countp=0;
				  foreach($pilihan as $datan => $valuen){ ++$countp;?>
				  <?php   if($countp == 1){?>
				  <li>
				    <a style="border: medium none;" href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$valuen->created_on)?>/<?php  echo $valuen->slug?>" title="<?php   echo $valuen->title?>">
												  <img src="<?php  echo strip_image($valuen->body);?>" style="width:210px;height:129px;border:5px solid #dedede"  alt="artikelmedia.com"></a>
				    </li>
				  <?php   }?>
					<li style="border-bottom:1px solid #dedede;font-size:15px;">
					  
					  <a href="<?php  echo base_url()?>news/<?php  echo date('Y/m',$valuen->created_on)?>/<?php  echo $valuen->slug?>">
					  
					  <div style="font:15px Oswald;color:#244B81;"><?php   echo $valuen->katakunci?></div>
					  <?php  echo $valuen->title?></a></li>
					<?php   }?>
					
				</ul>
		   </div>
		   <?php   }?>
		   <?php   unset($cat);$cat=array();?>
		   <!-- POPULER -->
		   
		</div>
	</li>
<?php  endforeach;
  }?>
	 
	   
</ul>
            
       
	 
	
	  
        </div>
 
      </div>
</div>

<script type="text/javascript">

$(function() {
	var $mainNav = $('#main-nav'),
	navWidth = $mainNav.width();
	
	$mainNav.children('.main-nav-item').hover(function(ev) {
		var $this = $(this),
		$dd = $this.find('.main-nav-dd');
		
		// get the left position of this tab
		var leftPos = $this.find('.main-nav-tab').position().left;
		
		// get the width of the dropdown
		var ddWidth = $dd.width(),
		leftMax = navWidth - ddWidth;
		
		// position the dropdown
		$dd.css('left', Math.min(leftPos, leftMax) );
		
		// show the dropdown
		$this.addClass('main-nav-item-active');
	}, function(ev) {

		// hide the dropdown
		$(this).removeClass('main-nav-item-active');
	});
});

</script>
 
 
<?php   }?>

<?php 
 
 
if($options['styles'] == '2'){
  
 if(($article->navigation_group_id)){
	    $catid=$article->navigation_group_id;
	  }
	 
	 $cek=$this->db->where('id',@$catid)->get('news_categories')->row();
	 if(($cek)){
	 if($cek->navigation_group_id =='0'){
	  $catid=@$article->category_id;
	 }}
	 
?>
 
 		 
				  <?php  if(is_array($categories)){ ?> 
 
 
      <?php 
      $i=0;
      foreach($categories as $category):
      $active="";
      ++$i;
     if(@$catid == $category->id){
    $active="active";
    
      }
		 
		  if(($category->uri)){
			echo '<li id="menu-item-'.$i.'" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-'.$i.'"><a href="'.$category->uri.'"  > '.$category->title.'</a>';
			 
	   
	 
			    if(($category->id)){
				  //$catid=$article['navigation_group_id'];
				  if($category->id <> '0'){
					  $this->db->where('navigation_group_id',$category->id);
				  }
				  echo '<ul class="sub-menu" style="display: none; display: none; visibility: hidden;">';
				  //$categories = $this->db->where('show','1')->select('count(default_news.id) as total,news_categories.title as title,news_categories.slug as slug')->join('news_categories','news_categories.id = news.category_id')->group_by('news.category_id')->order_by('news_categories.title','ASC')->get('news')->result();
				  $sub = $this->db->where('show','1')->order_by('position','ASC')->get('news_categories')->result();
				  foreach($sub as $category){
			    ++$i;
					  echo '<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-'.$i.'" id="menu-item-'.$i.'"><a  href="'.base_url().'news/category/'.$category->slug.'"> '.$category->title.'</a></li> ';
				  }
				  echo '</ul></li>';
			    } 
				
			}else{
			echo '<li id="menu-item-'.$i.'" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-'.$i.'"><a  href="'.base_url().'news/category/'.$category->slug.'"  > '.$category->title.'</a> </li>';
			}
				  
      ?>
	 
	 
<?php  endforeach; ?>
 
 				 
					
				<div class="clear"></div>
  
				  
		
		
<?php   }}?>

<?php   if($options['styles'] == '3'){?>
<div id="mdk-idx-tag" style="margin-bottom:10px">
<a href="#" id="mdk-idx-tag-link"><span>TAG</span></a>
<ul id="mdk-idx-tag-list">
<?php   $sql=$this->db->select(" sum(klik)as jml,keyword")->group_by('keyword')->limit('6')->order_by('jml','DESC')->get('news')->result();
foreach($sql as $dat => $val){ ?>
<li>
 <a href="<?php  echo base_url()?>news/keyword/<?php  echo str_replace(',','-',$val->keyword)?>"> #<?php  echo $val->keyword?></a><span></span>
</li>
<?php   }
?>
</ul>
</div>
<?php   } ?>