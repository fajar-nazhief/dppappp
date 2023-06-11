<h3><?php  echo lang('cat_list_title');?></h3>
<?php  echo form_open('admin/collection/categories/index'); ?>
<?php   echo form_input('search','','')?>
<input type="submit" name="submit" value="Search">
<?php   echo form_close()?>
<?php  echo form_open('admin/collection/categories/delete'); ?>
	<table border="0" class="table-list">
		<thead>
		<tr>
			<th style="width: 20px;"><?php  echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
			<th>id</th>
			<th><?php  echo lang('cat_category_label');?></th>
			<th>Upload Photo / Video</th>
			<th style="width:10em"><span><?php  echo lang('cat_actions_label');?></span></th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					<div class="inner"><?php  $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php  if ($categories): ?>
			<?php  foreach ($categories as $category): ?>
			<tr>
				<td><?php  echo form_checkbox('action_to[]', $category->id); ?></td>
				<td><?php  echo $category->id?></td>
				<td><?php  echo $category->title;?></td>
				<td><?php   if($category->folder_id <> '0'){?>
					<a href="<?php  echo base_url()?>admin/files#!path=artikel/<?php  echo $category->slug;?>&filter=">Upload</a>
				<?php   }else{?>
				<a href="<?php  echo base_url()?>admin/collection/categories/buat_folder/<?php  echo $category->slug;?>">Buat Folder</a>
				<?php   }?>
				</td>
				<td>
					<?php  echo anchor('admin/collection/categories/edit/' . $category->id, lang('cat_edit_label')) . ' | '; ?>
					<?php  echo anchor('admin/collection/categories/delete/' . $category->id, lang('cat_delete_label'), array('class'=>'confirm'));?>
				</td>
			</tr>
			<?php  endforeach; ?>
		<?php  else: ?>
			<tr>
				<td colspan="3"><?php  echo lang('cat_no_categories');?></td>
			</tr>
		<?php  endif; ?>
		</tbody>
	</table>
	<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
<?php  echo form_close(); ?>