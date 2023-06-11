
						
<?php echo form_open(uri_string(), 'class="crud"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
 
 
 <div class="panel panel-default sf">
					 
<div class="panel-body">
	<div class="tab-content">
									<div class="tab-pane fade in active" id="home1">
										<div class="form-group">
	<label> Jabatan </label> 
	<?php echo form_input('jabatan', htmlspecialchars_decode(@$post->jabatan), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">title</span>
	
	
</div>
<div class="form-group">
	<label> Nama Pejabat </label> 
	<?php echo form_input('nama_pejabat', htmlspecialchars_decode(@$post->nama_pejabat), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">title</span>
	
	
</div>

 <?php 
 $this->db->select('cat_name as kategori');
 $this->db->group_by('cat_name');
 $rescat = $this->db->get('perangkat_kota')->result();
 foreach($rescat as $vals){
	 $kategori[$vals->kategori]=$vals->kategori;
 } 
 ?>
 
 <div class="form-group">
	<label class=""> Kategori</label>
	 
	<?php echo form_dropdown('cat_name', $kategori , @$post->cat_name,' class="form-control input-sm"') ?>
 
			  </div>
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