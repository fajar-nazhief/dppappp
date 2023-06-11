<h2><?php  echo sprintf(lang('files.edit_title'), $file->name); ?> </h2>

<?php  echo form_open_multipart(uri_string(), array('class' => 'crud', 'id' => 'files_crud')); ?>
<fieldset>
	<ol>
		<li class="even">
			<?php  echo form_label(lang('files.name_label'), 'name'); ?>
			<?php  echo form_input('name', $file->name, 'class="crud"'); ?>
		</li>
		<li>
			 
			<?php  echo form_label('Youtube', 'name'); ?>
			<?php  echo form_input('youtube', @$file->youtube, 'class="crud"'); ?>
		</li>
		 <?php 
			 $folder=$this->db->where('id',$file->folder_id)->get('file_folders')->row();
			  
			 $news=$this->db->limit('100')->select('news.id as id,news.title as title')->join('news_categories','news_categories.id = news.category_id')->where('news_categories.slug',$folder->slug)->order_by('id','DESC')->get('news')->result();
			 foreach($news as $data => $val){
				$datanews[$val->id]=substr($val->title,0,50);
			 }
			 
			 if(!empty($news)){
			 ?>
		<li class="even">
			
			<?php  echo form_label('Artikel', 'name'); ?>
			<?php  echo form_dropdown('news_id', array(0 => '--PILIH ARTIKEL TERKAIT--') + $datanews, $file->news_id, 'id="news_id" class="crud"');?>
		</li>
		<?php   }?>
		<li >
			<?php  echo form_label(lang('files.description_label'), 'description'); ?>
			<?php  echo form_textarea(array(
				'name'	=> 'description',
				'id'	=> 'description',
				'value'	=> $file->description,
				'rows'	=> '3',
				'cols'	=> '50'
			)); ?>
		</li>
		<li class="even">
			<?php  echo form_label(lang('file_folders.folder_label'), 'folder_id'); ?>
			<?php  echo form_dropdown('folder_id', array(0 => lang('files.dropdown_no_subfolders')) + $folders_tree, $file->folder_id, 'id="folder_id" class="crud"');
			?>
		</li>
		<li>
			<label for="nothing"><?php  echo lang('files.file_label'); ?></label>
			<?php  echo form_upload('userfile'); ?>
		</li>
	</ol>

	<div class="align-right buttons">
		<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save') )); ?>
	</div>
</fieldset>
<?php  echo form_close(); ?>