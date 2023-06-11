<?php   //echo search_form('admin/polling/index','')?>
<?php  echo  form_open('admin/polling/delete'); ?>
Menemukan : <?php  echo $total_rows?> Data
	<table border="0" class="listTable">
		<thead>
		<tr>
			<th class="first"><div></div></th>
			<th>Nama</a>
			</th> 
			<th>&nbsp;VOTE
			</th> 
			<th>&nbsp;Category 
			</th>
			<th>&nbsp;Urutan Tampilan
			</th> 
			<th class="last width-10"><span><?php  echo lang('cat_actions_label');?></span></th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="inner"><?php   $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php   
		 
		if ($banner): ?>    
			<?php   foreach ($banner as $category):
			if($category->simpan == '1'){ $color='red';}else{$color="";}
			?>
			
			<tr>
				<td><input type="checkbox" name="delete[]" value="<?php  echo  $category->id;?>" /></td>
				<td><?php  echo $category->title;?></td>
				<td>
				 <form name="voting" action="<?php  echo base_url()?>admin/polling/voting" method="post">
				
				<?php    
				echo form_hidden('vote',$category->id);
				echo form_hidden('pollid',$category->pollid);
				
				?>
				<button   value="delete" name="btnAction" type="submit">
					<span>vote</span>
				</button>
				</form>
				</td> 
				<td style="color:<?php  echo $color?>"><?php  echo $category->catTitle;?></td>
				<td style="color:<?php  echo $color?>"><?php  echo $category->urutan;?></td> 
				<td>
					<?php  echo anchor('admin/polling/edit/' . $category->id, lang('cat_edit_label'))  ; ?> 
					<?php //=anchor('admin/polling/delete/' . $category->id, lang('cat_delete_label'), array('class'=>'confirm'));?>
				</td>
			</tr>
			
			<?php   endforeach; ?>                      
		<?php   else: ?>
			<tr>
				<td colspan="6"><?php  echo lang('cat_no_categories');?></td>
			</tr>
		<?php   endif; ?>
		
		</tbody>
	</table>
	<?php   $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
<?php  echo form_close(); ?>