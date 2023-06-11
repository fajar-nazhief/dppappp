<?php  if ($this->method == 'create'): ?>
	<h3>Map</h3>
<?php  else: ?>
	<h3>Google</h3>
<?php  endif; ?>

<?php  echo form_open(uri_string(), 'class="crud"'); ?>

	<div class="tabs">

		<ul class="tab-menu">
			<li><a href="#news-content-tab"><span>Google Api's Key</span></a></li >
		</ul>

		<div id="news-content-tab">

			<ol>

				<li>
					<label for="title">Api's Key</label>
					<?php  echo form_input('apikey', htmlspecialchars_decode(@$article->apikey), 'maxlength="100"'); ?>
					 
				</li>

				<li class="even">
					<label for="slug">width</label>
					<?php  echo form_input('width', @$article->widhtmap, 'maxlength="100" class="width-20"'); ?>
					 
				</li>

				<li>
					<label for="status">Height</label>
					<?php  echo form_input('height', @$article->widhtmap, 'maxlength="100" class="width-20"'); ?>
				</li>

		 

			</ol>
		</div>
 


	</div>
	

<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit') )); ?>

<?php  echo form_close(); ?>