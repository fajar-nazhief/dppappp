 <center>
	<br><br><p>
<!-- Div containing all galleries -->
<div class="galleries_container" id="gallery_image">
	<div class="gallery clearfix">
		
		<?php if ($gallery_image->youtube){?>
		<!-- An image needs a description.. -->
		<div class="gallery_image_description">
			<iframe width="400" height="315" src="http://www.youtube.com/embed/<?php echo $gallery_image->youtube; ?>" frameborder="0" allowfullscreen></iframe>
			 <div style="text-align:left;padding:10px 10px;">
				<?=$gallery_image->description?>
				  
			 </div>
		</div>
		<?}else{?>
		<!-- Div containing the full sized image -->
		<div class="gallery_image_full">
			<img src="<?php echo site_url() . 'files/large/' . $gallery_image->file_id; ?>" alt="<?php echo $gallery_image->name; ?>" width="400px" style="padding:5px;border:1px solid #dedede"/>
		 <div style="text-align:left;padding:10px 10px;">
				<?=$gallery_image->description?>
				  
			 </div>
		</div>
		<?}?>
	</div>
</div><br>
 </center> 
<!-- Div containing all galleries -->
<div class="galleries_container" id="gallery_single" style="padding:10px 3px">
	<div class="gallery clearfix">
		<!-- A gallery needs a description.. -->
		<div class="gallery_heading" style="border:0px;padding-bottom:10px;border-bottom:0px;margin-bottom:10px">
			 
		</div>
		<h3 style="border-bottom:1px solid #C70607;padding:0px"> Foto <?php echo $gallery->title; ?> </h3>
		<!-- The list containing the gallery images -->
 <?//print_r($gallery_images)?>
			<?php if (!empty($gallery_images)): ?>
			<?php foreach ( $gallery_images as $image): ?>
			 
				<a href="<?php echo site_url('galleries/' . $gallery->slug . '/' . $image->id); ?>" class="gallery-image" rel="gallery-image" data-src="<?php echo site_url() . 'files/large/' . $image->file_id; ?>" title="<?php echo $image->name; ?>">
					<?php echo img(array('src' => site_url() . 'files/thumb/' . $image->file_id, 'alt' => $image->name,'style'=>'border:1px solid #dedede;padding:2px;margin:5px')); ?>
				</a>
			 
			<?php endforeach; ?>
			<?php endif; ?>
		 
	</div>
</div>
<br style="clear: both;" />

<!--  VIDEO GALERI -->

<div class="gallery_heading" style="border-top:0px;padding-bottom:10px;border-bottom:0px solid #dedede;margin-bottom:10px">
			 
		</div>
<h3> Video <?php echo $gallery->title; ?> </h3>
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