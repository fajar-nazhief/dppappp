<h3 id="page_title"><a href="<?=base_url()?>galleries" style="color:#fff">Home</a> &raquo <?php echo $gallery->title; ?></h3>
<!-- Div containing all galleries -->

<div class="galleries_container" id="gallery_single" style="padding:10px 3px">
	<div class="gallery clearfix">
		<!-- A gallery needs a description.. -->
		<div class="gallery_heading" style="padding-bottom:10px;border-bottom:1px solid #dedede;margin-bottom:10px">
			<p><?php echo $gallery->description; ?></p>
		</div>
		<h3> FOTO </h3>
		<!-- The list containing the gallery images -->
 
			<?php if ($gallery_images): ?>
			<?php foreach ( $gallery_images as $image): ?>
			 
				<a href="<?php echo site_url('galleries/' . $gallery->slug . '/' . $image->id); ?>" class="gallery-image" rel="gallery-image" data-src="<?php echo site_url() . 'files/large/' . $image->file_id; ?>" title="<?php echo $image->name; ?>">
					<?php echo img(array('src' => site_url() . 'files/thumb/' . $image->file_id, 'alt' => $image->name,'style'=>'border:1px solid #dedede;padding:2px;margin:5px')); ?>
				</a>
			 
			<?php endforeach; ?>
			<?php endif; ?>
		 
	</div>
</div>

<!--  VIDEO GALERI -->

<div class="gallery_heading" style="padding-bottom:10px;border-bottom:1px solid #dedede;margin-bottom:10px">
			 
		</div>
<h3> VIDEO </h3>
<div class="galleries_container" id="gallery_single" style="padding:10px 3px">
	<div class="gallery clearfix">
		<!-- A gallery needs a description.. -->
		 
		<!-- The list containing the gallery images -->
 
			<?php if ($gallery_video): ?>
			<?php foreach ( $gallery_video as $video): ?>
			 
				<a href="<?php echo site_url('galleries/' . $gallery->slug . '/' . $video->id); ?>" class="gallery-image" rel="gallery-image" data-src="<?php echo site_url() . 'files/large/' . $video->file_id; ?>" title="<?php echo $video->name; ?>">
					<?php echo img(array('src' => site_url() . 'files/thumb/' . $video->file_id, 'alt' => $video->name,'style'=>'border:1px solid #dedede;padding:2px;margin:5px')); ?>
				</a>
			 
			<?php endforeach; ?>
			<?php endif; ?>
		 
	</div>
</div>

<br style="clear: both;" />
<?php if ( ! empty($sub_galleries) ): ?>
<h2><?php echo lang('galleries.sub-galleries_label'); ?></h2>
<!-- Show all sub-galleries -->
<div class="sub_galleries_container">
	<?php foreach ($sub_galleries as $sub_gallery): ?>
	<div class="gallery clearfix">
		<!-- Heading -->
		<div class="gallery_heading">
			<?php if ( ! empty($sub_gallery->filename)) : ?>
			<a href="<?php echo site_url() . 'galleries/' . $sub_gallery->slug; ?>">
				<?php echo img(array('src' => site_url() . 'files/thumb/' . $sub_gallery->file_id, 'alt' => $sub_gallery->title)); ?>
			</a>
			<?php endif; ?>
			<h3><?php echo anchor('galleries/' . $sub_gallery->slug, $sub_gallery->title); ?></h3>
		</div>
		<!-- And the body -->
		<div class="gallery_body">
			<p>
				<?php echo ( ! empty($sub_gallery->description)) ? $sub_gallery->description : lang('galleries.no_gallery_description'); ?>
			</p>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
<br style="clear: both;" />

<?php if ($gallery->enable_comments == 1): ?>
	<?php echo display_comments($gallery->id);?>
<?php endif; ?>