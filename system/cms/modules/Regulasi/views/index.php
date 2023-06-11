 
 
	<?php  if (!empty($news)): ?>
	<a href="<?php echo base_url()?>regulasi/category/<?php echo $this->uri->segment(3)?>" class="btn btn-warning" style="color:#fff">All</a>
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
								 
								<th><?php echo $news[0]->judul_kategori?></th>
								<th>Deskripsi</th>
								<th>Download</th>
							 
							</tr>
						</thead>
						<tbody>
							<?php 
							
							foreach($news as $val){
								$data='<h5>FIles: </h5><table id=hehe><tbody>';
								$dataarr = json_decode($val->source_array);
								foreach($dataarr  as $valar){
									$data .='<tr><td><a href=../srv-5/regulasi/'.$valar->name.'>'.$valar->name.'</a></td></tr>';
								}
								$data.='</tbody><table>';
								?>
							<tr>
								 
								<td><?php echo $val->title?></td>
								<td><?php echo $val->tentang?></td>
								<td><a haref="javascript:void(0);" class="btn btn-success" onClick="modalpop('<?php echo $data;?>');$('#hehe').attr('class','table table-striped')"><i class="icon-download-1" style="color:#fff"></i></a></td>
								 
							</tr>
							<?php }?>
							 
						</tbody>
					</table>
                         
				</div>

<?php  else: ?>
	<p>Tidak tidak ditemukan!</p>
<?php  endif; ?> 
<div class="row" style="text-align:center">
<?php echo $pagination['links']; ?>
</div>
<script>
	
	$('form').get(0).setAttribute('action', 'regulasi/search/<?php echo $this->uri->segment(3)?>');  
	
</script>