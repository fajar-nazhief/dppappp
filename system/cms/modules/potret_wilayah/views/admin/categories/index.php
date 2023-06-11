<div>
	 <div class="panel panel-default">
	     <?php if ($categories): ?>
       
<div class="panel-body">
						<form class="form-inline no-margin" action="<?php echo site_url('admin/'.$this->MNAME.'/categories/index')?>" method="post">
							<div class="row">
								<div class="col-md-5">
									<div class="input-group">
							            <input class="form-control input-sm" type="text" name="search">
							            <div class="input-group-btn">
							            	<button type="submit" class="btn btn-sm btn-success" tabindex="-1">Search</button> 
							            </div> <!-- /input-group-btn -->
							        </div> <!-- /input-group -->
								</div><!-- /.col -->
							</div><!-- /.row -->
						</form>
					<br>
	<?php echo form_open('admin/blog/categories/delete'); ?>

	<table border="0" class="table table-bordered table-condensed table-hover table-striped">
		<thead>
		<tr>
			<th width="20">
			  	<label class="label-checkbox">
										<?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?>

										<span class="custom-checkbox"></span>
									</label>

                </th>
			<th style="width:50px">ID</th>
			<th>Title</th> 
			<th>Url</th>
			<th width="200" class="align-center"><span>Action</span></th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="4">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($categories as $category): ?>
			<tr>
				
				<td>	<label class="label-checkbox">
										<?php echo form_checkbox('action_to[]', $category->gall_cat_id); ?>
										<span class="custom-checkbox"></span>
									</label></td>
				<td>
					<?php echo $category->gall_cat_id?>
				</td>
				
				
				
				<td><?php echo anchor('admin/'.$this->MNAME.'/listdata/'. $category->gall_cat_id,$category->gall_cat_title, 'class="button edit"'); ?>
				 </td>
			 
				<td>
					<?php echo site_url($this->MNAME.'/category/'.$category->gall_cat_id)?>
				</td>
				
                <td class="align-center buttons buttons-small">
						<div class="btn-group">
							<button class="btn btn-success btn-sm" data-toggle="dropdown">Action</button>
							<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-sm"><span class="caret"></span></button>
							<ul class="dropdown-menu">
							 <li><?php echo anchor('admin/'.$this->MNAME.'/listdata/'. $category->gall_cat_id,'Upload in category', 'class="button edit"'); ?></li>
								<li>	<?php echo anchor('admin/'.$this->MNAME.'/categories/edit/' . $category->gall_cat_id, 'Edit', 'class="button edit"'); ?> </li>
								<li><?php echo anchor('admin/'.$this->MNAME.'/categories/delete/' . $category->gall_cat_id, 'Delete', 'onclick="return confirm(\'Yakin anda ingin menghapus data ini?\');"') ;?>   </li>

							</ul>
						</div>



					</td>


			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
	 </div>
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
	     

	<?php echo form_close(); ?>

<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('cat_no_categories'); ?></h2>
	</div>
<?php endif; ?>
	 