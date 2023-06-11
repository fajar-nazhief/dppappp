<?php  echo form_open('admin/collection/action');?>

<h3><?php  echo lang('collection_list_title');?></h3>

<?php  if (!empty($collection)): ?>

	<table border="0" class="table-list">
		<thead>
			<tr>
				<th><?php  echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th><?php  echo lang('collection_post_label');?></th>
				<th class="width-10"><?php  echo lang('collection_category_label');?></th>
				<th class="width-10"><?php  echo lang('collection_date_label');?></th>
				<th class="width-5"><?php  echo lang('collection_status_label');?></th>
				<th class="width-10"><span><?php  echo lang('collection_actions_label');?></span></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="inner filtered"><?php  $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php  foreach ($collection as $article): ?>
				<tr>
					<td><?php  echo form_checkbox('action_to[]', $article->id);?></td>
					<td><?php  echo $article->title;?></td>
					<td><?php  echo $article->category_title;?></td>
					<td><?php  echo date('M d, Y', $article->created_on);?></td>
					<td><?php  echo lang('collection_'.$article->status.'_label');?></td>
					<td>
						<?php  echo anchor('admin/collection/preview/' . $article->id, lang($article->status == 'live' ? 'collection_view_label' : 'collection_preview_label'), 'rel="modal-large" class="iframe" target="_blank"') . ' | '; ?>
						<?php  echo anchor('admin/collection/edit/' . $article->id, lang('collection_edit_label'));?> |
						<?php  echo anchor('admin/collection/delete/' . $article->id, lang('collection_delete_label'), array('class'=>'confirm')); ?>
					</td>
				</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>

	<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish'))); ?>

<?php  else: ?>
	<p><?php  echo lang('collection_no_articles');?></p>
<?php  endif; ?>

<?php  echo form_close();?>