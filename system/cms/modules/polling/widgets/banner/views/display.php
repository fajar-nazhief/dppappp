  <?php   //echo css('poll.css','polling'); ?>
  
  <div>
<?php   if($options['txtRotator'] == 'no'){
    if($options['txtStyle'] == 'vertical'){
        $this->load->model('polling/banner_categories_m');
        $cat=$this->banner_categories_m->getCategory($options['txtCat']);
                                                         
        ?>
	<div class="widget">
					<h3 class="title"><?php  echo $cat->header_polling?> </h3>
					<div class="padder"> 
     
	 
	<form action="<?php  echo base_url()?>polling/poll" method="post" class="vote">
	 
	 
	 <div style="color:#767676;size:13px"><?php  echo $cat->polling_name?></div>
	 
	<p>
		 </p> 
		 <table width="100%">
		    
                 <?php   foreach($res as $data => $val){?>
		 <?php   if(!empty($options['txtWidth'])){$w=$options['txtWidth'];}else{ $w='80';}?>
		 <?php   if(!empty($options['txtHeight'])){$h=$options['txtHeight'];}else{ $h='80';}?>
		 <tr>
		    <td style="width:70px">
   
  <img width="<?php  echo $w?>px" height="<?php  echo $h?>px" src="<?php  echo base_url().'uploads/Banner/'.$val->link_file?>">
		    </td>
		  
		 <td style="vertical-align:middle">
  <div class="title">
  
  <input type="radio" value="<?php  echo $val->id?>" name="vote"> <?php  echo $val->title?>
		 
                </div>
		 </td>
		 </tr>
                 <?php   }?>
		 </table>
                    <input type="hidden" value="<?php  echo $options['txtCat']?>" name="pollid">
			&nbsp;&nbsp;<br><p>
			<button type="submit" class="btn btn-small btn-primary">Pilih</button>
			 
             
                     
                    <a href="<?php  echo base_url()?>polling/poll_result" class="btn btn-small" type="button" >Hasil Polling</a>
                 
	</form>
</div></div>
     

<?php   }}?>
 </div>