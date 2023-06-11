<?php echo form_open(uri_string(), 'class="crud"'); 
?>
<div class="panel panel-default sf">
<div class="panel-body">
<div class="tab-content"> 	 
	
	
 
	
	
	
<div class="form-group">
	
										<label for="exampleInputEmail1">Judul</label>
										<?php echo  form_hidden('title_asli', $category->category_name,'class="form-control input-sm"'); ?>
									   	<?php echo  form_input('title', $category->category_name,'class="form-control input-sm"'); ?>
									</div>


              

</div>
<div class="buttons float-right padding-top">
            		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
            	</div>
<?php echo form_close(); ?>
</div>
</div>
</div>