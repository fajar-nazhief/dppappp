
<style>
.tab-bar>li.active a {
    background: #ED1515;
    color: #fff;
}

.tab-bar>li a {
	color:#000;
}

#country-list {
    float: left;
    list-style: outside none none;
    margin-top: -3px;
    padding: 0;
    position: absolute; 
}

#country-list li {
    background: #f0f0f0 none repeat scroll 0 0;
    border-bottom: 1px solid #bbb9b9;
    padding: 10px;
}
</style>
						
<?php echo form_open(uri_string(), 'class="crud"');
//echo $ss = $post->json_data;
//print_r( unserialize($ss));
?>
 
 <div class="row">
					<div class="padding-md">	
						<h3 class="headline m-top-md">
							<?php if ($this->method == 'create'): ?>
	 <?php echo lang('blog_create_title'); ?> 
<?php else: ?>
		 <?php echo sprintf(lang('blog_edit_title'), $post->title); ?> 
<?php endif; ?>
							<span class="line"></span>
						</h3>
						<div class="row">	
							<div class="col-md-6">
								<div class="panel blog-container">
							 		<div class="panel-body">
									 <div class="form-group">
				<label><?php echo lang('blog_title_label'); ?></label> 
				<?php echo form_input('title', htmlspecialchars_decode($post->title), 'maxlength="100" class="form-control input-sm"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
			</div>
			<div class="form-group">
				<label for="slug"><?php echo lang('blog_slug_label'); ?></label>
				<?php echo form_input('slug', $post->slug, 'maxlength="100" class="form-control input-sm"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
			</div>
			<div class="row">
			<div class="col-lg-10">
				<div class="form-group">
				<label for="status">Bahasa</label>
				<?php echo form_dropdown('bahasa', $arrBahasa, $post->bahasa,' class="form-control input-sm"  ') ?>
			</div>
			<div class="form-group bahasa">
				
				<label for="category_id"><?php echo lang('blog_category_label'); ?></label>
				
				<?php echo form_dropdown('category_id', array(lang('blog_no_category_select_label')) + $folders_tree, @$post->category_id,' class="form-control input-sm chzn-select"' ) ?>
					 
			
			</div>
			
			</div>
			</div>
			<div class="form-group">
				<label for="status"><?php echo lang('blog_status_label'); ?></label>
				<?php echo form_dropdown('status', array('live' => lang('blog_live_label'),'draft' => lang('blog_draft_label')), $post->status,' class="form-control input-sm"') ?>
			</div>
			<input type="hidden" name="created_on" value="<?php echo date('Y-m-d', $post->created_on)?>">
			<div class="form-group">
				<label for="status">Event Started Date</label>
				 <input type="text" name="date_from" value="<?php echo !($post->date_from)?date('d/m/Y'):date('d/m/Y', strtotime($post->date_from))?>" class="form-control datepicker">
			</div>
			<div class="form-group">
				<label for="status">Event Ended Date</label>
				 <input type="text" name="date_end" value="<?php echo !($post->date_end)?date('d/m/Y'):date('d/m/Y',strtotime($post->date_end))?>" class="form-control datepicker2">
			</div>
			 
										<div class="form-group">
				
				<?php echo form_hidden('created_on_hour', date('H', $post->created_on),'class="form-control input-sm"') ?>
				<?php echo form_hidden('created_on_minute',  date('i', ltrim($post->created_on, '0')),'class="form-control input-sm"') ?>
										</div>
										<div class="form-group">
			<label for="comments_enabled"><?php echo lang('blog_comments_enabled_label');?></label>
				<?php echo form_checkbox('comments_enabled', 1, @$post->comments_enabled == 1); ?>
										</div>	
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel blog-container">
							 		<div class="panel-body">
									 <div class="form-group">
<label for="slug">Google map url:</label>
<?php echo form_input('google', $post->google, ' class="form-control input-sm"'); ?> 
<a href="https://www.google.com/maps/@-6.3060074,106.915301,15z" target="_Blank">Open google map</a>
</div>
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
				<?php echo form_input('alamat', $post->alamat, ' class="form-control input-sm" id="alamatauto"'); ?>
				<div id="suggesstion-box"></div>
				<?php //echo form_textarea(array('id' => 'alamat', 'name' => 'alamat', 'value' => $post->alamat, 'rows' => 50, 'class' => 'wysiwyg-simple')); ?>
				  
			</div>
	<div class="form-group">
				<label for="slug">Phone/fax/email</label>
				<?php echo form_input('phone', $post->phone, ' class="form-control input-sm"'); ?>
				 
			</div> 
	<div class="form-group">
				<label for="slug">Jam operasional / detail tambahan</label>
				<?php echo form_textarea(array('id' => 'operasional', 'name' => 'operasional', 'value' => $post->operasional, 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>
				  
			</div>
			<div class="form-group">
				<label for="slug">Transportasi</label>
				<?php echo form_textarea(array('id' => 'transportasi', 'name' => 'transportasi', 'value' => $post->transportasi, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
				  
			</div>
			<div class="form-group">
				<label for="slug">Area Parkir</label>
				<?php echo form_textarea(array('id' => 'parkir', 'name' => 'parkir', 'value' => $post->parkir, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
				  
			</div>
			<div class="form-group">
				<label for="slug">Bahasa yang digunakan</label>
				<?php echo form_textarea(array('id' => 'bahasa_event', 'name' => 'bahasa_event', 'value' => $post->bahasa_event, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
				  
			</div>
	<div class="form-group">
				<label >#Tags</label>
				<?php echo form_dropdown('ahastag_form',   @$m_hastag, @$post->ahastag,' class="form-control input-sm chzn-select" multiple="multiple" id="ahastag_form" onchange="myFunction(this, event)"' ) ?>
				 <input type="hidden" name="ahastag" id="ahastag" value="<?php echo @$post->ahastag?>">	
									 
			
	</div>		
									</div>
								</div>
							</div>
						</div>
					</div>
</div>
 
 <div class="panel panel-default sf">
					<div class="panel-heading">
					
					</div>


					<div class="panel-body">
						 
									</div>
			<div class="form-group">
				
				<div class="panel panel-default">
							<div class="panel-heading">
								CONTENT
							</div>
							<div class="panel-tab clearfix">
								<ul class="tab-bar left">
									<li class="active "><a href="#home2" data-toggle="tab"><i class="fa fa-home"></i> Deskripsi Indonesia</a></li>
									<li><a href="#home3" data-toggle="tab"><i class="fa fa-home"></i> Deskripsi English</a></li>
									<li><a href="#profile2" data-toggle="tab"><i class="fa af-pencil"></i> Intro</a></li>
									
								 </ul>
							</div>
							<div class="panel-body">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="home2">
										<?php echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' => $post->body, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
										
									</div>
									<div class="tab-pane fade in " id="home3">
										<?php echo form_textarea(array('id' => 'bodyeng', 'name' => 'bodyeng', 'value' => $post->body, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
										
									</div>
									<div class="tab-pane fade in" id="profile2">
									 <?php echo form_textarea(array('id' => 'intro', 'name' => 'intro', 'value' => $post->intro, 'rows' => 5, 'class' => 'wysiwyg-advanced')); ?> 
										
									</div>
									 
								 
								</div>
							</div>
						</div><!-- /panel -->
			</div>
					</div>
 </div>
	<div class="buttons float-right padding-top" style="padding:30px">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>	
<script>
$(function() {
  $('#ahastag_form').change(function() {
    //$('#JQResult').html('');
    $('option:selected', $(this)).each(function() {
      $('#ahastag').val(html($(this).val()));
    });
  });
 
});
 
</script>
<script>
function myFunction(element, event)
{
  var result = document.getElementById('ahastag');
 // while(result.firstChild) result.removeChild(result.firstChild);
  var no_sel=0;
  var tag="";
  for (var i = 0; i < element.options.length; i++) {
    if (element.options[i].selected) {
		 if(no_sel > 0)
			   {tag=tag + ',';}
              tag=tag + element.options[i].value;
			  no_sel++;
         
	}
  }
   $('#ahastag').val(tag);
}

</script>


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

 function selectCountry(val) {
$("#alamatauto").val(val);
$("#suggesstion-box").hide();
}

 
	</script>
	

 
