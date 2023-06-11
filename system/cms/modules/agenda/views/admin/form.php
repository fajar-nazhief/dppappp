
						
<?php echo form_open(uri_string(), 'class="crud"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
 
 
 <div class="panel panel-default sf">
					 
<div class="panel-body">
	<div class="tab-content">
									<div class="tab-pane fade in active" id="home1">
<div class="form-group">
	<label> Acara </label> 
	<?php echo form_input('acara', htmlspecialchars_decode(@$post->acara), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">Acara</span>
</div>
<div class="form-group">
	<label> Tanggal </label> 
	<?php echo form_input('tgl_agenda', htmlspecialchars_decode(@$post->tgl_agenda), 'maxlength="100" class="form-control input-sm" id="datetimepicker" '); ?>
	<span class="required-icon tooltip">tgl</span>
</div>

<div class="form-group">
	<label> Tempat </label> 
	<?php echo form_input('tempat', htmlspecialchars_decode(@$post->tempat), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">tempat</span>
</div>

<div class="form-group">
	<label> Dihadiri </label> 
	<?php echo form_input('dihadiri', htmlspecialchars_decode(@$post->dihadiri), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">dihadiri</span>
</div>

<div class="form-group">
	<label> Pendamping </label> 
	<?php echo form_input('pendamping', htmlspecialchars_decode(@$post->pendamping), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">pendamping</span>
</div>

<div class="form-group">
	<label> Keterangan </label> 
	<?php  echo form_textarea(array('id' => 'body', 'name' => 'keterangan', 'value' => $post->keterangan, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
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

<style>
	#cke_body{
		padding:10px;
		background: #f0f0f0;
		border:1px solid #CECECE;
	}
	
</style>
<script type="text/javascript">
	html_editor('html_editor', '100%');
	css_editor('css_editor', '100%');
	js_editor('js_editor', '100%');
</script>