<ol>
	<li class="even">
		<label>News Category</label> 
		<?php  echo form_dropdown('group', $groups, $options['group']);?>
	</li>
	<li class="even">
		<label>Style</label> 
		<?php  echo form_dropdown('style', array('1'=>'Vertical','2'=>'Horizontal'), $options['style']);?>
	</li>
	<li class="even">
		<label>Limit</label> 
		<?php  echo form_input('limit',$options['limit']);?>
	</li>
</ol>
 