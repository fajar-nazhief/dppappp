<?php if (@$blog): ?>

	
 
	<div>
	<div class="panel panel-default">
					 
					<div class="panel-body">
<form class="form-inline no-margin" action="<?php echo base_url()?>admin/kliping/pdf" method="post" accept-charset="utf-8" target="_Blank">
 <div class="row">
		<div class="col-md-3">
			<div class="input-group">
		<?php
 
		
		//$this->db->where('nama_modul',$this->nama_modul);
	 $res = $this->db->get('profiles')->result();
		foreach($res as $userkey => $userdata){
			$userd[$userdata->user_id] = $userdata->first_name;
		}
		?>
            <?php echo form_dropdown('user', array('0'=>'-- Pilih User--')+$userd,'',' class="form-control" style="width:200px"'); ?>
        </div>
		</div>
		<div class="col-md-3">
	<div class="input-group">
            <?php echo form_dropdown('bulan',bln(),'',' class="form-control" style="width:200px"'); ?>
        </div>
		</div>
		<div class="col-md-3">
	<div class="input-group">
            <?php echo form_dropdown('tahun',thn(),date('Y'),' class="form-control" style="width:200px"'); ?>
        </div>
		</div>
		<div class="col-md-3">
	
	<div class="input-group">
		<button type="submit" class="btn btn-success btn-sm">Download Laporan Xls</button>
	</div>
	</div></div>
	</form>
	</div>
					</div>
					<?php echo form_open('admin/blog/action'); ?>
	 <div class="panel panel-default">
	 
								<div class="panel-body">
								 <div class="row"><span>Total</span> <span class="badge badge-success m-left-xs"><?php echo $total?></span></div>
								<br>
							<table class="table table-bordered table-condensed table-hover table-striped">
								<thead>
									<tr>
										 
				<th>Judul</th>
				<th>Kategori/Jenis</th>
				<th>Tgl Input</th>
				<th>Input By</th> 
				<th class="text-center"><span>Action</span></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($blog as $post): ?>
				<tr>
				 
					<td><?php echo $post->title; ?></td>
					<td><?php echo $post->category_title;
				
				 
				
			//		$json =  unserialize($post->json_data) ;?></td>
					<td><?php echo format_date($post->date,'d-m-Y'); ?></td>
					<td>
					<?php echo ($post->author); ?>
						 
					 
					</td> 
					<td class="text-center buttons buttons-small">
						<div class="btn-group">
							<button class="btn btn-success btn-sm" data-toggle="dropdown">Action</button>
							 
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0)" id="myBtn" role="button" data-toggle="modal" onClick="showModal('<?php echo site_url('admin/'.$this->MNAME.'/preview/'.$post->id).'/modal';?>')" > <i class="fa fa-eye"></i> View</a></li>
							 <li><?php echo anchor('admin/'.$this->MNAME.'/edit/' . $post->id, 'Edit', 'class="button edit"'); ?></li>

								<li class="divider"></li>
								<li><?php echo anchor('admin/'.$this->MNAME.'/delete/' . $post->id, 'Delete', 'onclick="return confirm(\'Yakin anda ingin menghapus data ini?\');"'); ?></li>
							</ul>
						</div>


						
					</td>
				</tr>
			<?php endforeach; ?>
									 
								</tbody>
							</table>
							<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                                 
						</div>
		</div> 
	 </div>
 
	 
<?php else: ?>
	<div class="closable notification success alert alert-warning">
	<?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>
<script>
function showModal(data)
			{
				 
					// var uid = $(this).data('id');
					$("#myModal").modal();
					$('#isiModal').load(data, {}, function() {
						  
					}); 
					 
			} 
  </script>


 <!--Modal-->
		<div class="modal fade" id="myModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>View Data</h4>
      				</div>
				    <div class="modal-body">
				        <p id="isiModal">Please wait while Loading...</p>
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->