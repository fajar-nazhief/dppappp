<?php echo form_open(uri_string(), 'class="crud"  enctype="multipart/form-data"'); 
?>
<div class="panel panel-default sf">
<div class="panel-body">
<div class="tab-content"> 	 
	
	
	 
	
	
	
<div class="form-group">
	
										<label for="exampleInputEmail1">Judul</label>
										<?php echo  form_hidden('title_asli', $category->gall_cat_title,'class="form-control input-sm"'); ?>
									   	<?php echo  form_input('gall_cat_title', $category->gall_cat_title,'class="form-control input-sm"'); ?>
									</div>
									<div class="form-group">
<label> Deskripsi </label>
<?php echo form_textarea(array('id' => 'gall_cat_desc', 'name' => 'gall_cat_desc', 'value' => @$category->gall_cat_desc, 'rows' => 5, 'class' => ' form-control input-lg')); ?> 
</div>
  
<div class="form-group">
	<label class="control-label col-lg-2"> File</label>
	<div class="col-lg-10">
	<div class="upload-file">
		
	<input name="userfile" id="userfile" class="upload-demo" type="file">
	<label data-title="Select file" for="upload-demosource">
	<span data-title="No file selected..."></span>
	</label>
	<a href="<?php echo base_url() ?>uploads/potret-wilayah/<?php echo $category->gall_cat_cover?>" target="_blank"><img src="<?php echo base_url() ?>uploads/potret-wilayah/<?php echo $category->gall_cat_cover?>" style="width:100px;margin:10px"></a>
	 </div>
	</div>
</div>


              

</div>
<div class="buttons float-right padding-top">
            		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
            	</div>
<?php echo form_close(); ?>
</div>
</div>
</div>