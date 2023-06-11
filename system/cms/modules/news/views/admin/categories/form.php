<div class="panel">
	<div class="panel-heading">
	<h3 class="panel-title">
	<?php  if ($this->method == 'create'): ?>

<?php  echo lang('cat_create_title');?>

<?php  else: ?>
<?php  echo sprintf(lang('cat_edit_title'), $category->title);?>

<?php  endif; ?>
</h3>
	</div>
<?php  echo form_open($this->uri->uri_string(), 'class="crud panel-body form-horizontal form-padding" id="categories"'); ?>

 
		<div class="form-group">
		<label class="col-sm-2 control-label" for="title"><?php  echo lang('cat_title_label');?></label>
		<div class="col-sm-4">
		<?php  echo  form_input('title', $category->title,' class="form-control"'); ?>
		<?php  echo  form_hidden('title_asli', $category->slug,' class="form-control"'); ?>
		<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
		</div>
		</div>
		<div class="form-group">
		<label class="col-sm-2 control-label" for="title">Slug</label>
		<div class="col-sm-4">
		<?php  echo  form_input('slug', $category->slug,' class="form-control"'); ?> 
		<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
		</div>
		</div>
		 
		
		<div class="form-group">
				<label class="col-sm-2 control-label" for="title">Parent Category</label>
				<div class="col-sm-4">
					<?php  echo form_dropdown('navigation_group_id',  $folders_tree, @$category->navigation_group_id , 'id="folder_id" class="required form-control"'); ?>
					 
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">Menu kiri</label>
				<div class="col-sm-4">
					<?php  echo form_dropdown('left_menu', array('0'=>'Sembunyikan','1'=>'Tampikan'), @$category->left_menu , 'id="folder_id" class="required form-control"'); ?>
					 
				</div>
			</div>
				<div class="form-group">
		<label class="col-sm-2 control-label" for="title">Urutan Tampilan: </label>
		<div class="col-sm-4">
		<?php  echo form_dropdown('position', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'), @$category->position , 'id="folder_id" class="required form-control"'); ?>
		</div>
		</div>
<div class="form-group">
				<label class="col-sm-2 control-label" for="title">Navigasi</label>
				<div class="col-sm-4">
					<select name="show" class="form-control"> 
					 
						<option value="1" <?php   if($category->show == '1' ){echo 'selected';}else{ echo '';}?>>
							 Tampilkan
						 
						 </option>
						 <option value="0" <?php   if($category->show == '0' ){echo 'selected';}else{ echo '';}?>>
							 Simpan
						 
						 </option>
						  
					</select>
				</div>
			</div>
		<div class="form-group">
		<label class="col-sm-2 control-label" for="title">Jika Link URL: </label>
		<div class="col-sm-4">
		<?php  echo  form_input('uri', @$category->uri,' class="form-control"') ?> <span class="text-sm text-danger">*isi Jika perlu atau kosongkan</span>
		</div>
		</div>
		<div class="form-group">
		<label class="col-sm-2 control-label" for="title">Banner URL: </label>
		<div class="col-sm-4">
		<?php  echo  form_input('banner', @$category->banner,' class="form-control"') ?> <span class="text-sm text-danger">*isi Jika perlu atau kosongkan</span>
		</div>
		</div>
	
		 
		
	 
	<div class="buttons float-left padding-top"> 
<button class="button">
	<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</button>
</div> 


<?php  echo form_close(); ?>
	</div>