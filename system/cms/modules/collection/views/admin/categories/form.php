<?php  if ($this->method == 'create'): ?>
<h3><?php  echo lang('cat_create_title');?></h3>

<?php  else: ?>
<h3><?php  echo sprintf(lang('cat_edit_title'), $category->title);?></h3>

<?php  endif; ?>

<?php  echo form_open($this->uri->uri_string(), 'class="crud" id="categories"'); ?>

<fieldset>
	<ol>
		<li class="even">
		<label for="title"><?php  echo lang('cat_title_label');?></label>
		<?php  echo  form_input('title', $category->title); ?>
		<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
		</li>
		<li>
		<label for="title">Slug</label>
		<?php  echo  form_input('slug', $category->slug); ?>
		<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
		</li>
		
		<li class="even">
				<label for="link_type">Parent Category</label>
				<span class="spacer-right">
					<?php  echo form_dropdown('navigation_group_id', array('---PILIH PARENT----') + $folders_tree, @$category->navigation_group_id , 'id="folder_id" class="required"'); ?>
					 
				</span>
			</li>
		
<li>
				<label for="link_type">Tampilkan</label>
				<span class="spacer-right">
					<select name="show"> 
					 
						<option value="1" <?php   if($category->show == '1' ){echo 'selected';}else{ echo '';}?>>
							 Tampilkan
						 
						 </option>
						 <option value="0" <?php   if($category->show == '0' ){echo 'selected';}else{ echo '';}?>>
							 Simpan
						 
						 </option>
						  
					</select>
				</span>
			</li>
		<li class="even">
		<label for="title">Jika Link URL: </label>
		<?php  echo  form_input('uri', @$category->uri); ?> *isi Jika perlu atau kosongkan
		</li>
		<li>
		<label for="title">Urutan Tampilan: </label>
		<?php  echo  form_input('position', @$category->position); ?>  
		</li>
		<li  class="even" >
			<label for="title">Banner: </label>
					<?php  echo form_textarea(array('id' => 'banner', 'name' => 'banner', 'value' => $category->banner, 'rows' => 5, 'class' => 'wysiwyg-advanced')); ?>
					 </li>
		
	</ol>
	<div class="buttons float-left padding-top"> 
<button class="button">
	<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</button>
</div>
</fieldset>


<?php  echo form_close(); ?>