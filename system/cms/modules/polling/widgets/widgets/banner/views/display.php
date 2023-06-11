  <?php   echo css('poll.css','polling'); ?>
  <div>
<?php   if($options['txtRotator'] == 'no'){
    if($options['txtStyle'] == 'vertical'){
        $this->load->model('polling/banner_categories_m');
        $cat=$this->banner_categories_m->getCategory($options['txtCat']);
                                                         
        ?>
    <div class="voteContainer">
	<form action="<?php  echo base_url()?>polling/poll" method="post" class="vote">
	<fieldset>
	<legend><?php  echo $cat->header_polling?></legend>
	<p class="question">
		<?php  echo $cat->polling_name?>
	</p>
	<p>
		 </p>
        <div class="isijakgo">
            <ul class="pollingQ">
                 <?php   foreach($res as $data => $val){?>
                 <li>
                    <img width="80px" height="90px" src="<?php  echo cekImg($val->link_file)?>">
                </li>
                <li id="tulisan">
                    <input type="radio" value="<?php  echo $val->id?>" name="vote"> <?php  echo $val->title?>
                    
                </li>
                 <?php   }?>
                 <li style="padding-top:10px">
                    <input type="hidden" value="<?php  echo $options['txtCat']?>" name="pollid">
			&nbsp;&nbsp;<input type="submit" class="submit" value="Submit">
                 </li>
                 <li style="padding-top:10px">
                    <br><br>
                    <a href="<?php  echo base_url()?>polling/poll_result">Hasil Polling</a>
                 </li>
                
            </ul>
        </div>
        
        <div class="clearer"></div>
        <div style="padding:20px">
		
        </div>
	 
	</fieldset>
	</form>
</div>
     

<?php   }}?>
 </div>