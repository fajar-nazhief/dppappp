<ol>
	<li class="even">
		<label>Judul</label> 
		<?php  echo form_input('judul', $options['judul']);?>
	</li>
	<li class="even">
		<label>collection Category</label> 
		<?php  echo form_dropdown('group', $groups, $options['group']);?>
	</li>
	<li class="even">
		<label>Jenis Tampilan</label> 
		<?php  echo form_dropdown('styles', $styles, $options['styles']);?>
	</li>
	 <li class="even">
		<label>Jenis Tampilan</label> 
		<?php  echo form_dropdown('collectiontype', @$collectiontype, @$options['collectiontype']);?>
	</li>
	 <li class="even">
		<label>Start Limit</label> 
		<?php  echo form_input('start_limits', $options['start_limits']);?>
	</li>
	<li class="even">
		<label>Limit</label> 
		<?php  echo form_input('limits', $options['limits']);?>
	</li>
	<li class="even">
		<label>Warna</label> 
		# <?php  echo form_input('warna', $options['warna']);?>
	</li>
	<li class="even">
		<label>Width</label> 
		<?php  echo form_input('width', $options['width']);?>
	</li><li class="even">
		<label>Height</label> 
		<?php  echo form_input('height', $options['height']);?>
	</li>
</ol>