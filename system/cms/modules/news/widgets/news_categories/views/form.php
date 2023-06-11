<ol>
	 
	<li class="even">
		<label>Parent Category</label> 
		<?php  echo form_dropdown('group', @$groups, $options['group']);?>
	</li>
	<li class="even">
		<label>Menu Style</label> 
		<?php  echo form_dropdown('styles', @$styles, $options['styles']);?>
	</li> 
	 
</ol>