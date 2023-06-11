<ol>
	<li class="even">
		<label>Judul</label> 
		<?php  echo form_input('judul', $options['judul']);?>
	</li>
	<li class="even">
		<label>News Category</label> 
		<?php  echo form_dropdown('group', $groups, $options['group']);?>
	</li>
	<li class="even">
		<label>News Style</label> 
		<?php  echo form_dropdown('styles', $styles, $options['styles']);?>
	</li>
	 <li class="even">
		<label>Jenis Tampilan</label> 
		<?php  echo form_dropdown('newstype', @$newstype, @$options['newstype']);?>
	</li>
	<li class="even">
		<label>Limit</label> 
		<?php  echo form_input('limits', $options['limits']);?>
	</li>
	<li class="even">
		<label>show</label> 
		<?php  echo form_input('show', $options['show']);?>
	</li>
</ol>