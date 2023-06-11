<script>
	var html='';
	html +='<a href="<?php echo base_url()?>admin/<?php echo $this->MNAME?>/listdata/<?php echo $this->uri->segment(4)?>" class="btn btn-md btn-info">';
	html +='<span class="shortcut-icon">';
	html +='<i class="ion-back">&laquo;</i>';
	html +='</span>';
	html +='<span class="text">Back</span>';
	html +='</a>';
				
	html +='<a href="<?php echo base_url()?>admin/<?php echo $this->MNAME?>/create/<?php echo $this->uri->segment(4)?>" class="btn btn-md btn-info">';
	html +='<span class="shortcut-icon">';
	html +='<i class="ion-clipboard"></i>';
	html +='</span>';
	html +='<span class="text"> Upload Foto</span>';
	html +='</a>';
$('#menuatas').html(html);</script>
						
<?php echo form_open(uri_string(), 'class="crud"  enctype="multipart/form-data"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
  
 
 <div class="panel panel-default sf">
					 
<div class="panel-body">
	<div class="tab-content">
									<div class="tab-pane fade in active" id="home1">
									 
	<?php echo form_input('gall_cat_id', $this->uri->segment(4), 'maxlength="100" class="form-control input-lg" style="display:none"'); ?>
	  

<div class="form-group">
	<label> Judul </label> 
	<?php echo form_input('title_caption', htmlspecialchars_decode(@$post->title_caption), 'maxlength="100" class="form-control input-lg"'); ?>
	<span class="required-icon tooltip">title_caption</span>
</div>

 

<div class="form-group">
	<label class="control-label col-lg-2"> Foto</label>
	<div class="col-lg-10">
	<div class="upload-file">
		
	<input name="userfile" id="userfile" class="upload-demo" type="file">
	<label data-title="Select file" for="upload-demosource">
	<span data-title="No file selected..."></span>
	</label>
	<a href="http://utara.jakarta.go.id/srv-5/images/gallery/<?php echo $post->img_thumb?>" target="_blank"><img src="http://utara.jakarta.go.id/srv-5/images/gallery/<?php echo $post->img_thumb?>" style="width:100px;margin:10px"></a>
	 </div>
	</div>
</div>

 
 
	 
	 
			  
									</div>
									<div class="tab-pane fade" id="profile1">
										--
									</div>
	</div>
</div>
 </div>
								 
	
			 
<div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>

<?php echo form_close(); ?>
	<script>
		$(function	()	{
			var currentStep = 1;
			
			$('#wizardTab li a').click(function()	{
				return false;
			});
			
			$('#nextStep').click(function()	{
	
				currentStep++;
				
				if(currentStep == 2)	{
					$('#wizardTab li:eq(1) a').tab('show');
					$('#wizardProgress').css("width","66%");
					
					$('#prevStep').attr('disabled',false);
					$('#prevStep').removeClass('disabled');
				}
				else if(currentStep == 3)	{
					$('#wizardTab li:eq(2) a').tab('show');
					$('#wizardProgress').css("width","100%");
					
					$('#nextStep').attr('disabled',true);
					$('#nextStep').addClass('disabled');
				}
				
				return false;
			});
			
			$('#prevStep').click(function()	{
		
				currentStep--;
				
				if(currentStep == 1)	{
				
					$('#wizardTab li:eq(0) a').tab('show');
					$('#wizardProgress').css("width","66%");
						
					$('#prevStep').attr('disabled',true);
					$('#prevStep').addClass('disabled');
					
					$('#wizardProgress').css("width","33%");
				}
				else if(currentStep == 2)	{
				
					$('#wizardTab li:eq(1) a').tab('show');
					$('#wizardProgress').css("width","66%");
							
					$('#nextStep').attr('disabled',false);
					$('#nextStep').removeClass('disabled');
					
					$('#wizardProgress').css("width","66%");
				}
				
				return false;
			});
		});
	</script>