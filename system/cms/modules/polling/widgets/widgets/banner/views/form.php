


<ol>
	<li>
		<label>Kategori</label>
		<div id="kategori">
		<?php  echo form_dropdown('txtCat', $category, $options['txtCat']);?>
		</div>
	</li>
	<li class="even">
		<label>Style</label>
		<div>
		<?php  echo form_dropdown('txtStyle', $style, $options['txtCat']);?>
		</div>
	</li>
	<li>
		<label>Limit</label>
		<div>
		<?php  echo form_input('txtLimit',$options['txtLimit'],' class="text" size="5"');?>
		</div>
	</li>
	<li class="even">
		<label>Rotator</label>
		<div>
		<?php  echo form_dropdown('txtRotator', $rotator, $options['txtRotator']);?>
		</div>
	</li>
	 
</ol>