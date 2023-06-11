<div class="panel panel-default">

					 

					<div class="panel-body">

<form class="form-inline no-margin" action="<?php echo base_url()?>admin/agenda/download" method="post" accept-charset="utf-8">

 <div class="row">

		<div class="col-md-9">

			<div class="input-group">

		<?php

		$this->db->set_dbprefix('');

		$this->db->select('tbl_agenda.createdby,default_profiles.first_name'); 

		$this->db->join('default_profiles', 'tbl_agenda.createdby = default_profiles.user_id', 'left');

		$this->db->group_by('tbl_agenda.createdby,default_profiles.first_name');

		

		//$this->db->where('nama_modul',$this->nama_modul);

	 $res = $this->db->get('tbl_agenda')->result();

	 $this->db->set_dbprefix('tbl_');

		foreach($res as $userkey => $userdata){

			$userd[$userdata->author_id] = $userdata->first_name;

		}

		?>

            <?php echo form_dropdown('user', $userd,'',' class="form-control" style="width:200px"'); ?>

        </div>

 

	<div class="input-group">

            <?php echo form_dropdown('bulan',bln(),'',' class="form-control" style="width:200px"'); ?>

        </div>

	

	<div class="input-group">

		<button type="submit" class="btn btn-success btn-sm">Download Laporan Xls</button>

	</div>

	</div></div>

	</form>

	</div>

					</div>

<!-- Ditambahkan Buat download excel berdasarkan Kalender Event -->

 

<?php if (@$blog): ?>



	<?php echo form_open('admin/blog/action'); ?>

 

	<div>

	 <div class="panel panel-default">

							<div class="panel-body">

								 <div class="row"><span>Total</span> <span class="badge badge-success m-left-xs"><?php echo $total?></span></div>

								<br>

							<table class="table table-bordered table-condensed table-hover table-striped">

								<thead>

									<tr>

										 

									<th>Tgl</th> 

									<th>Acara</th> 

				<th>Tempat</th>

				<th>Dihadiri</th>

				<th>Pendamping</th>

				<th>Keterangan</th>

				<th class="text-center"><span>Action</span></th>

									</tr>

								</thead>

								<tbody>

									<?php foreach ($blog as $post): ?>

				<tr>

				<td><?php echo format_date($post->tgl_agenda,'d-m-Y H:i'); ?></td>

					<td><?php echo $post->acara; ?></td> 

					<td><?php echo $post->tempat; ?></td>

					<td><?php echo $post->dihadiri; ?></td>  

					<td><?php echo $post->pendamping; ?></td> 

					 

					<td><?php echo $post->keterangan; ?></td>

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