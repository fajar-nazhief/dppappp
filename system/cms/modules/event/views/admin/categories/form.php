 <div class="panel panel-default">
					<div class="panel-heading">
					    <?php if ($this->controller == 'admin_categories' && $this->method === 'edit'): ?>
<h3><?php echo sprintf(lang('cat_edit_title'), $category->title);?></h3>

<?php else: ?>
<h3><?php echo lang('cat_create_title');?></h3>

<?php endif; ?>
					</div>
<?php echo form_open($this->uri->uri_string(), 'class="crud" id="categories"'); ?>
<div class="panel-heading sf">
	
	<div class="form-group" style="display:none">
				<label for="status">Bahasa</label>
				<?php echo form_dropdown('bahasa', $arrBahasa, $category->bahasa,' class="form-control input-sm" onchange="getval(this);"') ?>
			</div>
	
	
	
	
	
<div class="form-group">
	
										<label for="exampleInputEmail1"><?php echo lang('cat_title_label');?></label>
										<?php echo  form_hidden('title_asli', $category->title,'class="form-control input-sm"'); ?>
									   	<?php echo  form_input('title', $category->title,'class="form-control input-sm"'); ?>
									</div>
									<div class="form-group bahasa">
				<label for="link_type">Parent Category</label>
				<div >
					<?php echo form_dropdown('navigation_group_id', array('---PILIH PARENT----') + $folders_tree, @$category->navigation_group_id , 'id="folder_id" class="form-control chzn-select"'); ?>
					 
</div>
			</div>
<div class="form-group">
				<label for="slug"><?php echo lang('blog_slug_label'); ?></label>
				<?php echo form_input('slug', $category->slug, 'maxlength="100" class="form-control input-sm"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
			</div>
			<div class="form-group">
				<label for="slug">Icon untuk menu</label>
				<?php echo form_input('fa_icon', $category->fa_icon, 'maxlength="100" class="form-control input-sm"'); ?> 
			</div>
<div class="form-group">
	<label for="exampleInputEmail1">Intro</label>
	 
										<?php echo form_textarea(array('id' => 'intro', 'name' => 'intro', 'value' => $category->intro, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
									</div>
<hr>
									<div class="form-group">
										<label for="exampleInputEmail1">Photo</label>
										<?php echo form_textarea(array('id' => 'photo', 'name' => 'photo', 'value' => $category->photo, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
									</div>
									<hr>
									<div class="form-group">
										<label for="exampleInputEmail1">Background Banner</label>
										<?php echo form_textarea(array('id' => 'banner', 'name' => 'banner', 'value' => $category->banner, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
									</div>
</div>


              <div class="panel-heading">
            	<div class="buttons float-right padding-top">
            		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
            	</div>
              </div>

</div>
<?php echo form_close(); ?>
 </div>
 <script>
		function getval(sel)
{
      $.getJSON("<?php echo base_url().'admin/event/get_kategori_bahasa/'?>"+sel.value.trim()+"<?php echo '/'.$this->uri->segment(4)?>", function(result){
	var  field='<div class="form-group bahasa"><label for="category_id">Parent Category</label><select name="navigation_group_id" class="form-control input-sm chzn-select">';
          $.each(result, function(i, item){
	 field+='<option value="'+item.id+'">'+item.title+'</option>';
	 
        });
          field +='</select>';
        field +='</div>'; 
        $(".bahasa").html(field);
    });    
}
 
	</script>