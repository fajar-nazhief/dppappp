<h3 id="page_title">Galeri Multimedia</h3>
<!-- Div containing all galleries -->
<br><p>
<div class="galleries_container" id="gallery_index">
	<? //print_r($galleries)?>
	<?php if ( ! empty($galleries)){
		foreach ($galleries as $data => $gallery){  ?>
	 
		<!-- Heading --> 
		 <div style="margin:10px 0px ">
			
			<table width="100%" cellpadding="0" cellspacing="0">
			<?php if ( ! empty($gallery->filename)){ ?>
			<tr>
				<td style="width:60px;margin:5px 0px;border-bottom:1px dotted #dedede">
			<a href="<?php echo site_url() . 'galleries/' . $gallery->slug; ?>">
				<?php echo img(array('src' => site_url() . 'files/thumb/' . $gallery->file_id . '/50/50', 'alt' => $gallery->title,'style'=>'border:1px solid #dedede;padding:2px')); ?>
			</a>
				</td>
				<td style="margin:5px 10px;border-bottom:1px dotted #dedede">
			<h2><?php echo anchor('galleries/' . $gallery->slug, $gallery->title); ?></h2>
			 
				<?php echo ( ! empty($gallery->description)) ? $gallery->description : lang('galleries.no_gallery_description'); ?>
				</td>
			</tr>
			<?php } ?>
			
			</table>
			 
		 </div>
		<!-- And the body -->
		 
	 
	 <?}}?>
	 
</div>