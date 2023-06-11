
						
<?php echo form_open(uri_string(), 'class="crud" enctype="multipart/form-data"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
  
 
 <div class="panel panel-default sf">
					 
<div class="panel-body">
	<div class="tab-content">
									<div class="tab-pane fade in active" id="home1">
										<div class="form-group">
	<label> Judul </label> 
	<?php echo form_input('title', htmlspecialchars_decode(@$post->title), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">Judul</span>
</div>
<div class="form-group">
	<label> Tentang </label> 
	<?php echo form_input('tentang', htmlspecialchars_decode(@$post->tentang), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">Judul</span>
</div>


 

<?php $this->db->order_by('title','ASC');
$res = $this->db->query(' select * from default_'.$this->MNAME.'_categories')->result(); 
foreach($res as $dat => $val){
$resdata[$val->id] = $val->title;
}
?>
<div class="form-group">
<label for="status">Kategori </label>
<?php echo form_dropdown('category_id', $resdata , @$post->category_id,' class="form-control input-sm"') ?>
</div> 
<div class="form-group">
	<label> Files </label> 
	<input name="userfile[]" id="userfile" class="upload-demo" type="file" multiple>
	<span class="required-icon tooltip">Judul</span>
</div>
<table class="table table-striped">
		<thead>
			<tr>
				<th>No.</th>
					<th>File</th>
					<th>Action</th>
			</tr>
		</thead>
		<tbody>

		<?php if(!empty($post->source_array)){
	$data = json_decode($post->source_array);
	$i=0;
	foreach($data as $valdata){
		++$i;
		?>
<tr>
				<td><?php echo $i;?></td>
					<td><a href="../srv-5/regulasi/<?php echo $valdata->name;?>"><?php echo $valdata->name;?></a></td>
					<td><a href="<?php echo base_url()?>admin/regulasi/delete_data/<?php echo $valdata->name;?>/<?php echo $post->id;?>" class="btn btn-success">Delete</a></td>
			</tr>
		<?php 
		 
	}
	?>

<?php }?>

</tbody>
</table>
			  
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