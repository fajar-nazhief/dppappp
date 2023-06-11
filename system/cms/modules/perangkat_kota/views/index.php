 
<div class="container">
	<?php 
		$this->db->set_dbprefix('tbl_');
		$this->db->where('cat_name','perangkat-kota');
		$post = $this->db->get('perangkat_kota')->result();
		$this->db->set_dbprefix('default_');
	if (!empty($post)): ?>
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
								 
								<th>Perangkat Kota</th>
								<th>Nama Pejabat</th>
								 
							 
							</tr>
						</thead>
						<tbody>
							<?php foreach($post as $val){?>
							<tr>
								 
								<td><?php echo $val->jabatan?></td>
								<td><?php echo $val->nama_pejabat?></td> 
								 
							</tr>
							<?php }?>
							 
						</tbody>
					</table>
					 
				</div>

<?php  else: ?>
	<p>Tidak tidak ditemukan!</p>
<?php  endif; ?>
<?php 
		$this->db->set_dbprefix('tbl_');
		$this->db->where('cat_name','bagian-sekretaris-kota');
		$post = $this->db->get('perangkat_kota')->result();
		$this->db->set_dbprefix('default_');
	if (!empty($post)): ?>
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
								 
								<th>Bagian Sekertaris Kota</th>
								<th>Nama Pejabat</th>
								 
							 
							</tr>
						</thead>
						<tbody>
							<?php foreach($post as $val){?>
							<tr>
								 
								<td><?php echo $val->jabatan?></td>
								<td><?php echo $val->nama_pejabat?></td> 
								 
							</tr>
							<?php }?>
							 
						</tbody>
					</table>
					 
				</div>

<?php  else: ?>
	<p>Tidak tidak ditemukan!</p>
<?php  endif; ?>
</div>