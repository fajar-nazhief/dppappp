<script>

	var html='';

	html +='<a href="<?php echo base_url()?>admin/<?php echo $this->MNAME?>/categories/" class="btn btn-md btn-info">';

	html +='<span class="shortcut-icon">';

	html +='<i class="ion-back">&laquo;</i>';

	html +='</span>';

	html +='<span class="text">Back</span>';

	html +='</a>';

				

	html +='<a href="<?php echo base_url()?>admin/<?php echo $this->MNAME?>/create/<?php echo $this->uri->segment(4)?>" class="btn btn-md btn-info">';

	html +='<span class="shortcut-icon">';

	html +='<i class="ion-clipboard"></i>';

	html +='</span>';

	html +='<span class="text"> Upload Foto</span>';

	html +='</a>';

$('#menuatas').html(html);</script>

<form class="form-inline no-margin" action="<?php echo base_url()?>admin/potret_wilayah/pdf" method="post" accept-charset="utf-8">

 <div class="row">

		<div class="col-md-9">

			<div class="input-group">

		

			<?php $this->db->set_dbprefix('');

		$this->db->select('tbl_gallery.createdby as iduser,default_profiles.first_name');

		$this->db->join('tbl_gall_cat', 'tbl_gallery.gall_cat_id = tbl_gall_cat.gall_cat_id', 'left');

		$this->db->join('default_profiles', 'tbl_gallery.createdby = default_profiles.user_id', 'left');

		$this->db->group_by('tbl_gallery.createdby,default_profiles.first_name');

		

		//$this->db->where('nama_modul',$this->nama_modul);

	 $res = $this->db->get('tbl_gallery')->result();

	 

		foreach($res as $userkey => $userdata){

			$userd[$userdata->iduser] = $userdata->first_name;

		}

		?>

            <?php echo form_dropdown('user', $userd,'',' class="form-control" style="width:200px"'); ?>

        </div>

 

	<div class="input-group">

            <?php echo form_dropdown('bulan',bln(),'',' class="form-control" style="width:200px"'); ?>

        </div>

		<div class="input-group">

		<?php 

		$batasthn = (date('Y')+5);

		for($i=(date('Y')-5); $i<= $batasthn;$i++ ){



			$tahun[$i]=$i;

		}?>

            <?php echo form_dropdown('tahun',$tahun,date('Y'),' class="form-control" style="width:200px"'); ?>

        </div>

	

	<div class="input-group">

		<button type="submit" class="btn btn-success btn-sm">Download Laporan Xls</button>

	</div>

	</div></div>

	</form>

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

				 

					<td><?php echo $post->title_caption; ?></td>

					<td><?php echo $post->category_title;

				

				 

				

			//		$json =  unserialize($post->json_data) ;?></td>

					<td><?php echo format_date($post->created_on); ?></td>

					<td>

					<?php if ($post->author): ?>

						<?php echo anchor('user/' . $post->createdby, $post->author->display_name, 'target="_blank"'); ?>

					<?php else: ?>

						<?php echo lang('blog_author_unknown'); ?>

					<?php endif; ?>

					</td> 

					<td class="text-center buttons buttons-small">

						<div class="btn-group">

							<button class="btn btn-success btn-sm" data-toggle="dropdown">Action</button>

						 

							<ul class="dropdown-menu">

								<li><a href="javascript:void(0)" id="myBtn" role="button" data-toggle="modal" onClick="showModal('<?php echo site_url('admin/'.$this->MNAME.'/preview/'.$post->id).'/modal';?>')" > <i class="fa fa-eye"></i> View</a></li>

							 <li><?php echo anchor('admin/'.$this->MNAME.'/edit/' .$this->uri->segment(4).'/'. $post->id, 'Edit', 'class="button edit"'); ?></li>



								<li class="divider"></li>

								<li><?php echo anchor('admin/'.$this->MNAME.'/delete/' . $post->id.'/'.$this->uri->segment(4), 'Delete', 'onclick="return confirm(\'Yakin anda ingin menghapus data ini?\');"'); ?></li>

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