

						

<?php echo form_open(uri_string(), 'class="crud"');

//echo $ss = $post->json_data;

//print_r( unserialize($ss));

?>

 

 

 

 <div class="panel panel-default sf">

					 

<div class="panel-body">

	 

 



<div class="form-group">

	<label> title </label> 

	<?php echo form_input('title', htmlspecialchars_decode(@$post->title), 'style="width:500px" class="form-control input-lg"'); ?>

	<span class="required-icon tooltip">title</span>

</div>
<div class="form-group">
					<label  >Kategori</label> 
					<?php  echo form_dropdown('category_id',$folders_tree, @$post->category_id,'class="form-control"') ?>
					  
				</div>

<div class="form-group">

	<label class=""> date</label>

	<div class="">

	<div class="input-group" id="demo-dp-txtinput">

	<input name="date" value="<?php echo @$post->date?>" id="datepicker" class="hasDatepicker form-control input-lg" type="text" data-date-format="yyyy/mm/dd">

	 

	</div>

	</div>

	

</div>



<div class="form-group">

<label> text </label>

<?php echo form_textarea(array('id' => 'text', 'name' => 'text', 'value' => @$post->text, 'rows' => 5, 'class' => ' form-control input-lg')); ?>

</div>



<div class="form-group">

	<label> url </label> 

	<?php echo form_input('url', htmlspecialchars_decode(@$post->url), 'style="width:500px"  class="form-control input-lg"'); ?>

	<span class="required-icon tooltip">url</span>

</div> 



 

</div>

 </div>

								 

	

			 

<div class="buttons float-right padding-top">

	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>

</div>



<?php echo form_close(); ?>

	<script>

		$( "#datepicker" ).datepicker({ format: 'yyyy-mm-dd' });

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