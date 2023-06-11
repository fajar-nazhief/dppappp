
						
<?php echo form_open(uri_string(), 'class="crud" enctype="multipart/form-data"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
  
 
 <div class="panel panel-default sf">
					 
<div class="panel-body">
	<div class="tab-content">
									<div class="tab-pane fade in active" id="home1">
										<div class="form-group">
	<label> title </label> 
	<?php echo form_input('title', htmlspecialchars_decode(@$post->title), 'maxlength="100" class="form-control input-sm"'); ?>
	<span class="required-icon tooltip">title</span>
</div>
<div class="form-group">
	<label> Tanggal </label> 
	<?php if(@$post->date){
		$tgl = format_date(@$post->date,'Y/m/d');
	}else{
		$tgl=date('Y/m/d');
	}?>
	<?php echo form_input('date', $tgl, 'maxlength="100" id="datepicker" class="hasDatepicker form-control input-lg"'); ?>
	<span class="required-icon tooltip">date</span>
</div>
 

<?php $this->db->order_by('category_name','ASC');
$res = $this->db->query(' select * from tbl_'.$this->MNAME.'_category')->result(); 
foreach($res as $dat => $val){
$resdata[$val->id] = $val->category_name;
}
?>
<div class="form-group">
<label for="status">Kategori </label>
<?php echo form_dropdown('category_id', $resdata , @$post->category_id,' class="form-control input-sm"') ?>
</div>

<?php $this->db->order_by('media_name','ASC');
$res = $this->db->query(' select * from tbl_'.$this->MNAME.'_media')->result(); 
foreach($res as $dat => $val){
$resdata[$val->id] = $val->media_name;
}
?>
<div class="form-group">
<label for="status">Media </label>
<?php echo form_dropdown('media_id', $resdata , @$post->media_id,' class="form-control input-sm"') ?>
</div>

<div class="form-group">
<label> Deskripsi </label>
<?php echo form_textarea(array('id' => 'desc', 'name' => 'desc', 'value' => @$post->desc, 'rows' => 5, 'class' => ' form-control input-lg')); ?> 
</div>
  
<div class="form-group">
	<label class="control-label col-lg-2"> File</label>
	<div class="col-lg-10">
	<div class="upload-file">
		
	<input name="userfile[]" id="userfile" class="upload-demo" type="file" multiple>
	<label data-title="Select file" for="upload-demosource">
	<span data-title="No file selected..."></span>
	</label>
	<div class="row">
					    <div class="eq-height">
	<?php 
	 
	if($post->source=='array'){
		$src = json_decode($post->source_array);
		 
		foreach($src as $val => $vals){
		?>
		<div class="col-sm-4 eq-box-sm">
		<div id="demo-panel-w-alert" class="panel">
					
					<!--Panel heading-->
				 
		
					<!--Panel body-->
					<div class="panel-body">
					<a href="<?php echo $path.'/'.$vals->name?>" target="_blank"><img src="<?php echo $path.'/'.$vals->name ?>" style="width:100px;margin:10px"> </a>
						<a href="javascript:void(0)" id="demo-panel-alert" class="btn btn-primary" onClick="hapus('<?php echo $vals->name?>')">Hapus</a>
						 
					</div>
				</div>
		
		</div>
	<?php	}
		?>
		</div>
		</div>
	<?php }else{?>
	<a href="<?php echo $path.'/'.$post->source?>" target="_blank"><img src="<?php echo $path.'/'.$post->source?>" style="width:100px;margin:10px"></a>
	<?php }?>
	 </div>
	</div>
</div>
			  
									</div>
									 
	</div>
</div>
 </div>
								 
	
			 
<div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>

<?php echo form_close(); ?>

	<script>
	 $('#datepicker').datepicker({ format:'yyyy/mm/dd'});

	 function hapus(name){
		bootbox.confirm("Anda yakin akan menghapus data ini?!", function(result){ 
		  if(result){
			  
			  window.open("./admin/kliping/del_image/<?php echo $post->id.'/'?>"+name, "_self"); 
		  }
});
	 }
	</script>