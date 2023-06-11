<div class="panel panel-default">

	 

 



<div class="panel-body">

								<div class="pad-btm form-inline">

					            <div class="row">

					                <div class="col-sm-6 table-toolbar-left">

					                     <span>Total</span> <span class="badge badge-success m-left-xs"></span>

					                </div>

					                <div class="col-sm-6 table-toolbar-right">

						<div class="btn-group">

						 </div>

					                    <div class="form-group">

						

						<?php  echo form_open('admin/news/categories/index'); ?>

					                        <input placeholder="Search" name="search" class="form-control" type="text">

											<?php echo form_close()?>

					                    </div> 

					                </div>

					            </div>

					        </div>

								<?php  echo form_open('admin/news/categories/delete'); ?>

	<table class="table table-bordered table-condensed table-hover table-striped" >

		<thead>

		<tr>

			<th style="width: 20px;"><?php  echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>

			<th>id</th>

			<th><?php  echo lang('cat_category_label');?></th> 
			<th>Url</th> 

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

				<td><?php  echo base_url().'news/category/'.$category->slug;?></td>

				<td>

					<?php  echo anchor('admin/news/categories/edit/' . $category->id, lang('cat_edit_label'),'class="btn btn-primary btn-sm"') . ' | '; ?>

					<a href="javascript:void(0)" class="confirm btn btn-primary btn-sm" onClick="confirmation('<?php echo base_url().'admin/news/categories/delete/'.$category->id?>')">Delete</a>  

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

	<?php  echo form_close(); ?>

	 



</div>

</div>



<script>

	function confirmation(url) {

		var answer = confirm("Apakah anda yakin akan menghapus data?")

		if (answer){ 

			window.location = url;

		}

		else{

			return false; 

		}

	}

</script>