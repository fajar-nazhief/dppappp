 <script>document.getElementById("modulename").innerHTML = "Create New Event"</script>
 <?php if(($post->category->banner)){?>
 <style>
	#header {
    background-image: url("<?php echo trim_banner($post->category->banner) ?>");
    background-position: right top;
    background-repeat: no-repeat;
    background-size: cover;
    height: 350px;
    margin: 0 auto;
    position: relative;
}

 </style>
 
 <?php }?>


 
 
     
  
<div class="bg-light padding-md" id="feature">
		<div class="container">
			
<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success">
	<?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

		 <?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger">
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>

<?php if (validation_errors()): ?>
<div class="alert alert-danger">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
						
<?php echo form_open_multipart(uri_string(), 'class="crud"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
 <div class="row">
					<div class="padding-md">	
						<h3 class="headline m-top-md">
						 
							<span class="line"></span>
						</h3>
						<div class="row">	
							<div class="col-md-6">
								<div class="panel blog-container">
							 		<div class="panel-body">
									 <div class="form-group">
				<label><?php echo lang('blog_title_label'); ?><span class="text-danger">*</span></label> 
				<?php echo form_input('title', htmlspecialchars_decode($post->title), 'maxlength="100" class="form-control input-sm judul"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
			</div>
			<div class="form-group">
				<label for="slug">Slug <span class="text-danger">*</span></label>
				<?php echo form_input('slug', $post->slug, 'maxlength="100" class="form-control input-sm"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
			</div>
			<div class="row">
			<div class="col-lg-10">
				<div class="form-group">
				<label for="status">Bahasa <span class="text-danger">*</span></label>
				<?php echo form_dropdown('bahasa', $arrBahasa, $post->bahasa,' class="form-control input-sm" onchange="getval(this);"') ?>
			</div>
			<div class="form-group bahasa">
				
				<label for="category_id"><?php echo lang('blog_category_label'); ?> <span class="text-danger">*</span></label>
				
				<?php echo form_dropdown('category_id', array('0'=>'-- Category --') + $folders_tree, @$post->category_id,' class="form-control input-sm chzn-select"' ) ?>
					 
			
			</div>
			</div>
			</div>
			 
			<input type="hidden" name="created_on" value="<?php echo date('Y-m-d', $post->created_on)?>">
			<div class="form-group" id="demo-dp-txtinput">
				<label for="status">Event Started Date <span class="text-danger">*</span></label>
				<input name="date_from" class="form-control" value="<?php echo $post->date_from?>" type="text">
				  </div>
			<div class="form-group" id="demo-dp-txtinput">
				<label for="status">Event Ended Date <span class="text-danger">*</span></label>
				<input name="date_end" class="form-control" value="<?php echo $post->date_end?>" type="text">
			</div>
			 
										<div class="form-group">
				
				<?php echo form_hidden('created_on_hour', date('H', $post->created_on),'class="form-control "') ?>
				<?php echo form_hidden('created_on_minute',  date('i', ltrim($post->created_on, '0')),'class="form-control"') ?>
										</div>
									 
									</div>
								</div>
								<div class="row">	
							<div>
								<div class="panel blog-container">
									<div class="panel-heading">
					        <h3 class="panel-title">Event's Images</h3>
					    </div>
							 		<div class="panel-body">
										 <div class="form-group"> 
											<?php echo form_upload('userfile1'); ?>
					                     
					                </div>
						  
						 <div class="form-group"> 
											  <?php echo form_upload('userfile2'); ?>
					                     
					                </div>
						  
						  <div class="form-group"> 
											<?php echo form_upload('userfile3'); ?>
					                     
					                </div>
						  <div class="text-xs">jpg,jpeg,png Only</div>
									</div>
								</div>
							</div>
							</div>
							</div>
							
							<div class="col-md-6">
								<div class="panel blog-container">
							 		<div class="panel-body">
	<div class="form-group">
				<label for="slug">Lat</label>
				<?php echo form_input('lat', $post->lat, ' class="form-control input-sm"'); ?>
				 
			</div>
	<div class="form-group">
				<label for="slug">Lng</label>
				<?php echo form_input('lng', $post->lng, ' class="form-control input-sm"'); ?>
				 
			</div>
	<div class="form-group">
				<label for="slug">Alamat</label>
				<textarea id="demo-textarea-input" rows="9" class="form-control" placeholder="Your Event's Address here.." name="alamat"></textarea>
			</div>
	<div class="form-group">
				<label for="slug">Phone/fax/email</label>
				<?php echo form_input('phone', $post->phone, ' class="form-control input-sm"'); ?>
				 
			</div>
	<div class="form-group">
				<label for="slug">Jam operasional / detail tambahan</label>
					<textarea id="demo-textarea-input" rows="9" class="form-control" placeholder="More detail here.." name="operasional"></textarea>
			</div>
									</div>
								</div>
							</div>
						</div>
					</div>
</div>
 
 <div class="panel panel-default sf">
					<div class="panel-heading">
					        <h3 class="panel-title">Event's Content</h3>
					    </div>
 

					<div class="panel-body">
						  <div class="panel-body">
					
					         <textarea name="body" class="summernote" id="contents" title="Contents" id="demo-summernote"><?php echo $post->body?></textarea>
					
					    </div>
						<div class="row">
					                        <div class="col-sm-9">
					                            <input class="btn btn-success" type="submit" value="SUBMIT"></input> 
					                        </div>
					                    </div>
									</div>
			 
					</div>
 
 </div>
 	 
<script>
	 
		function getval(sel)
{
      $.getJSON("<?php echo base_url().'admin/event/get_kategori_bahasa/'?>"+sel.value.trim()+"<?php echo '/'.$this->uri->segment(4)?>", function(result){
	var  field='<div class="form-group bahasa"><label for="category_id"> Category</label><select name="category_id" class="form-control input-sm chzn-select">';
          $.each(result, function(i, item){
	 field+='<option value="'+item.id+'">'+item.title+'</option>';
	 
        });
          field +='</select>';
        field +='</div>'; 
        $(".bahasa").html(field);
    });    
}

form = $('form.crud');
$('input[name="title"]', form).keyup(function() {
  $.post('http://jakarta-tourism.go.id/2017/ajax/url_title', { title : $(this).val() }, function(slug){
				$('input[name="slug"]', form).val( slug );
			});
});


 $(function() {
      $('.summernote').summernote({
        height: 200
      });
       
    });

 
	</script>
    </div>
</div>							 
 
  
