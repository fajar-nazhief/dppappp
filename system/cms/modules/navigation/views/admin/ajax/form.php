<div id="details-container">
	
	<?php  if ($this->method == 'create'): ?>
		<div class="hidden" id="title-value-<?php  echo $navigation_link->navigation_group_id; ?>">
			<?php  echo lang('nav_link_create_title');?>
		</div>
	<?php  else: ?>
		<div class="hidden" id="title-value-<?php  echo $navigation_link->navigation_group_id; ?>">
			<?php  echo sprintf(lang('nav_link_edit_title'), $navigation_link->title);?>
		</div>
	<?php  endif; ?>
	
	<?php  echo form_open(uri_string(), 'id="nav-' . $this->method . '" class="crud"'); ?>
	<div class="tabs">

		<ul class="tab-menu">
			<li><a href="#news-content-tab"><span>Navigasi Data</span></a></li>
			<li><a href="#news-options-tab"><span>Navigasi Foto</span></a></li>
			 
		</ul>

		<div id="news-content-tab">
		<ul>
<?php  if ($this->method == 'edit'): ?>
			<?php  echo form_hidden('link_id', $navigation_link->id) ?>
<?php  endif; ?>
			
			<?php  echo form_hidden('current_group_id', $navigation_link->navigation_group_id) ?>
			
			<li class="<?php  echo alternator('', 'even'); ?>">
				<label for="title"><?php  echo lang('nav_title_label');?></label>
				<?php  echo form_input('title', $navigation_link->title, 'maxlength="50" class="text"'); ?>
				<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
			</li>
			
			<?php  if ($this->method == 'edit'): ?>
				<li class="<?php  echo alternator('', 'even'); ?>">
					<label for="navigation_group_id"><?php  echo lang('nav_group_label');?></label>
					<?php  echo form_dropdown('navigation_group_id', $groups_select, $navigation_link->navigation_group_id) ?>
				</li>
			<?php  else: ?>
				<?php  echo form_hidden('navigation_group_id', $navigation_link->navigation_group_id) ?>
			<?php  endif; ?>
	
			<li class="<?php  echo alternator('', 'even'); ?>">
				<label for="link_type"><?php  echo lang('nav_type_label');?></label>
				<span class="spacer-right">
					<?php  echo form_radio('link_type', 'url', $navigation_link->link_type == 'url') ?> <?php  echo lang('nav_url_label');?>
					<?php  echo form_radio('link_type', 'uri', $navigation_link->link_type == 'uri') ?> <?php  echo lang('nav_uri_label');?>
					<?php  echo form_radio('link_type', 'module', $navigation_link->link_type == 'module') ?> <?php  echo lang('nav_module_label');?>
					<?php  echo form_radio('link_type', 'page', $navigation_link->link_type == 'page') ?> <?php  echo lang('nav_page_label');?>
				</span>
			</li>
			
			<li class="<?php  echo alternator('', 'even'); ?>">
	
				<p style="<?php  echo ! empty($navigation_link->link_type) ? 'display:none' : ''; ?>">
					<?php  echo lang('nav_link_type_desc'); ?>
				</p>
	
				<div id="navigation-url" style="<?php  echo @$navigation_link->link_type == 'url' ? '' : 'display:none'; ?>">
					<label for="url"><?php  echo lang('nav_url_label');?></label>
					<input type="text" id="url" name="url" value="<?php  echo empty($navigation_link->url) ? 'http://' : $navigation_link->url; ?>" />
				</div>
	
				<div id="navigation-module" style="<?php  echo @$navigation_link->link_type == 'module' ? '' : 'display:none'; ?>">
					<label for="module_name"><?php  echo lang('nav_module_label');?></label>
					<?php  echo form_dropdown('module_name', array(lang('nav_link_module_select_default'))+$modules_select, $navigation_link->module_name) ?>
				</div>
	
				<div id="navigation-uri" style="<?php  echo @$navigation_link->link_type == 'uri' ? '' : 'display:none'; ?>">
					<label for="uri"><?php  echo lang('nav_uri_label');?></label>
					<input type="text" id="uri" name="uri" value="<?php  echo $navigation_link->uri; ?>" />
				</div>
	
				<div id="navigation-page" style="<?php  echo @$navigation_link->link_type == 'page' ? '' : 'display:none'; ?>">
					<label for="page_id"><?php  echo lang('nav_page_label');?></label>
					<select name="page_id">
						<option value=""><?php  echo lang('nav_link_page_select_default');?></option>
						<?php  echo $tree_select; ?>
					</select>
				</div>
			</li>
	
			<li class="<?php  echo alternator('', 'even'); ?>">
				<label for="target"><?php  echo lang('nav_target_label'); ?></label>
				<?php  echo form_dropdown('target', array(''=> lang('nav_link_target_self'), '_blank' => lang('nav_link_target_blank')), $navigation_link->target); ?>
			</li>
	
			<li class="<?php  echo alternator('', 'even'); ?>">
				<label for="class"><?php  echo lang('nav_class_label'); ?></label>
				<?php  echo form_input('class', $navigation_link->class); ?>
			</li>
			<li>
				<label for="link_type">Parent</label>
				<span class="spacer-right">
					<select name="parent">
						<option value="0"> ---- PILIH PARENT ---- </option>
					<?php   foreach($navigation_tree as $link){
						
						if($navigation_link->parent == $link['id']){$sel='selected';}else{$sel='';}
						?>
						<option value="<?php  echo $link['id']?>" <?php  echo $sel?>>
							 <?php  echo $link['title'];?>
						 
						 </option>
						 
						<?php   if ($link['children']){
							 
							$controller->navigation_tree_builder($link, $navigation_link->navigation_group_id);
						}
						
					}?> 
					</select>
				</span>
			</li>
		</ul>
		</div>
		<div id="news-options-tab">
			<table>
				<tr>
					<td colspan="2">
			<label for="target"><a href="<?php  echo base_url()?>admin/files#!path=bannerpage">&raquo; UPLOAD IMAGE </a> </label>
					</td>
				</tr>
				
				 
			<?php 
			$dir2 = 'uploads/files/'; 
			$i=1;  
			foreach($menu_banner as $databanner => $val_banner){?>
			<tr>
			<?php 
				$file2=$val_banner->filename;
				 $png2=strtolower(substr($file2,-3,3));
				if(@$navigation_link->banner == $dir2.$file2){ $chk='TRUE';$color="#fad7ea";}else{$chk='';$color="";}
				 
					
					$data = array(
						'name'        => 'banner',
						'id'          => 'banner',
						'value'       => $dir2.$file2,
						'checked'     => $chk,
						);
					 
						echo '<td style="background:'.$color.'"><img src="'.$dir2.$file2.'"><br>'.$val_banner->name.'</td><td style="background:'.$color.'">'.form_radio($data).'</td>';
					 
					 
					 
				 
			?>
			</tr>
			<?php 
			 
			}
			  
			?>
			</table>
		</div>
	
		<div class="buttons float-left padding-top">
			<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
	
	<?php  echo form_close(); ?>
</div>