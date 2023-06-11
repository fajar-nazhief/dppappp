
	<table border="0" class="listTable">
		<thead>
		<tr>
			<th class="first"><div></div></th>
			<th>TITLE
			</th> 
			<th class="last width-10"><span><?php  echo lang('cat_actions_label');?></span></th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<div class="inner"><?php   $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php   if ($banner_categories): ?>    
			<?php   foreach ($banner_categories as $category): ?>
			<tr>
				<td><input type="checkbox" name="delete[]" value="<?php  echo  $category->id;?>" /></td>
				<td><?php  echo $category->title;?></td> 
				<td>
					<?php  echo anchor('admin/polling/categories/edit/' . $category->id, 'EDIT') ; ?> 
				</td>
			</tr>
			<?php   endforeach; ?>                      
		<?php   else: ?>
			<tr>
				<td colspan="4"><?php  echo lang('cat_no_categories');?></td>
			</tr>
		<?php   endif; ?>    
		</tbody>
	</table>
	 