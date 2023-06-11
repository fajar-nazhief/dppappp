 
<div class="container">
	<?php  if (!empty($post)): ?>
<div class="panel panel-default table-responsive">
					<div class="panel-heading">
					
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4 col-sm-4">
							 
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>
					<table class="table table-striped" id="responsiveTable">
						<thead>
							<tr>
								 
								<th>Unit Kerja Perangkat Daerah</th>
								<th>Kepala UKPD</th>
								<th>Kontak</th>
							 
							</tr>
						</thead>
						<tbody>
							<?php foreach($post as $val){?>
							<tr>
								 
								<td><?php echo $val->nama_ukpd?></td>
								<td><?php echo $val->nama_pejabat?></td>
								<td><?php echo $val->kontak?></td>
								 
							</tr>
							<?php }?>
							 
						</tbody>
					</table>
					 
				</div>

<?php  else: ?>
	<p>Tidak tidak ditemukan!</p>
<?php  endif; ?>
</div>