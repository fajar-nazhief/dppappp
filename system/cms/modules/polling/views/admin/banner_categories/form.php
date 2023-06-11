  
<?php  echo  form_open($this->uri->uri_string()); ?>
	<table style="width:250px;border:1px solid #d2d2d2">
		<tr>
			<td>
		<label for="title">Title</label>
			</td>
			<td> 
		 : <?php  echo $formnya=form_input('title', !empty($category->title)?$category->title:"", 'class="text"');?>
			</td>
		</tr>
		<tr>
			<td>
		<label for="title">Header</label>
			</td>
			<td> 
		 : <?php  echo $formnya=form_input('header_polling', !empty($category->header_polling)?$category->header_polling:"", 'class="text"');?>
			</td>
		</tr>
		<tr>
			<td>
		<label for="title">Nama Polling</label>
			</td>
			<td> 
		 : <?php  echo $formnya=form_input('polling_name', !empty($category->polling_name)?$category->polling_name:"", 'class="text"');?>
			</td>
		</tr>
		<tr>
			<td>
				Simpan
			</td>
			<td>
				: <?php   echo form_dropdown('txtSimpan',array('1'=>'ya','0'=>'tidak') ,!empty($category->simpan_polling)?$category->simpan_polling:"0"); ?>
			</td>
		</tr>
		
	</table>
		
		
		
		 
	<?php  echo form_hidden('user', $user->id);?>
	<?php   $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
<?php  echo  form_close(); ?>