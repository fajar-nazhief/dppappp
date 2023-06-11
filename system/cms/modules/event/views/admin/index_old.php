<?php if (@$blog): ?>
<div class="panel panel-default">
					<div class="panel-heading">Download Excel</div>
					<div class="panel-body">
<form class="form-inline no-margin" action="<?php echo base_url()?>admin/<?php echo $this->nama_modul?>/download" method="post" accept-charset="utf-8">
 <div class="row">
								<div class="col-md-9">
									<div class="input-group">
		<?php
		$this->db->select('blog.author_id,profiles.first_name');
		$this->db->join('blog_categories', 'blog.category_id = blog_categories.id', 'left');
		$this->db->join('profiles', 'blog.author_id = profiles.user_id', 'left');
		$this->db->group_by('blog.author_id,profiles.first_name');
		
		$this->db->where('nama_modul',$this->nama_modul);
	 $res = $this->db->get('blog')->result();
		foreach($res as $userkey => $userdata){
			$userd[$userdata->author_id] = $userdata->first_name;
		}
		?>
            <?php echo form_dropdown('user', array('0'=>'-- Pilih User--')+$userd,'',' class="form-control" style="width:200px"'); ?>
        </di>
 
	<div class="input-group">
            <?php echo form_dropdown('bulan',bln(),'',' class="form-control" style="width:200px"'); ?>
        </div>
	
	<div class="input-group">
		<button type="submit" class="btn btn-success btn-sm">Download Xls</button>
	</div></div></div>
	</form>
	</div>
					</div>
					<br>
	<?php echo form_open('admin/'.$this->nama_modul.'/action'); ?>
 
	<div>
	 <div class="panel panel-default">
							<div class="panel-body">
								<span>Total</span><span class="badge badge-success m-left-xs"><?php echo $total?></span>
							</div>
							<table class="table table-bordered table-condensed table-hover table-striped">
								<thead>
									<tr>
										<th width="20">
											<label class="label-checkbox">
										<?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?>
										
										<span class="custom-checkbox"></span>
									</label>
										</th>
										<th>Bahasa</th>
				<th><?php echo lang('blog_post_label'); ?></th>
				<th>URL</th>
				<th><?php echo lang('blog_category_label'); ?></th>
				<th><?php echo lang('blog_date_label'); ?></th>
				<th><?php echo lang('blog_written_by_label'); ?></th>
				<th><?php echo lang('blog_status_label'); ?></th>
				<th width="320" class="align-center"><span><?php echo lang('blog_actions_label'); ?></span></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($blog as $post): ?>
				<tr>
					<td>
						<label class="label-checkbox">
										<?php echo form_checkbox('action_to[]', $post->id); ?>
										<span class="custom-checkbox"></span>
									</label>
									</td>
					<td class="align-center">
					<?php   echo $img = $post->bahasa;
			 
					
					?> 
				</td>
					<td><?php echo $post->title; ?></td>
					<td><?php echo base_url().$this->nama_modul.'/' .date('Y/m', $post->created_on) .'/'. $post->slug?></td>
					<td><?php echo $post->category_title;
				
				 
				
			//		$json =  unserialize($post->json_data) ;?></td>
					<td><?php echo format_date($post->created_on); ?></td>
					<td>
					<?php if ($post->author): ?>
						<?php echo anchor('user/' . $post->author_id, $post->author->display_name, 'target="_blank"'); ?>
					<?php else: ?>
						<?php echo lang('blog_author_unknown'); ?>
					<?php endif; ?>
					</td>
					<td><?php echo lang('blog_'.$post->status.'_label'); ?></td>
					<td class="align-center buttons buttons-small">
						<div class="btn-group">
							<button class="btn btn-success btn-sm" data-toggle="dropdown">Action</button>
							<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-sm"><span class="caret"></span></button>
							<ul class="dropdown-menu">
							 <li><?php echo anchor('admin/'.$this->nama_modul.'/edit/' . $post->id, lang('blog_edit_label'), 'class="button edit"'); ?></li>
								<?php if($post->rekomendasi == 0){?>
							<li><?php echo anchor('admin/'.$this->nama_modul.'/rekomendasi/' . $post->id, 'Rekomendasi', 'class="button edit"'); ?></li>
							<?php }else{?>
							<li><?php echo anchor('admin/'.$this->nama_modul.'/rekomendasi_stop/' . $post->id, 'Stop Rekomendasi', 'class="button edit"'); ?></li>
							<?php }?>
								<li class="divider"></li>
								<li><?php echo anchor('admin/'.$this->nama_modul.'/delete/' . $post->id, lang('blog_delete_label'), array('class'=>'confirm button delete confirm PopConfirm_open','value'=>'coba')); ?></li>
							</ul>
						</div>


						
					</td>
				</tr>
			<?php endforeach; ?>
									 
								</tbody>
							</table>
							<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                                 
						</div>
	 <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish'))); ?>
	 </div>
 
	 
<?php else: ?>
	<div class="closable notification success alert alert-warning">
	<?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>
