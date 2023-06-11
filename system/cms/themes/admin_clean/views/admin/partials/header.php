		
		<ul class="nav-notification clearfix">
				 <li class="dropdown" style="margin-top: 10px;">
					<span data-toggle="dropdown" class="dropdown-toggle">
						
						<form action="<?php echo current_url(); ?>" id="change_language" method="get">
				<select name="lang" onchange="this.form.submit();">
					<option value="">-- Select Language --</option>
			<?php foreach($this->config->item('supported_languages') as $key => $lang): ?>
		    		<option value="<?php echo $key; ?>" <?php echo CURRENT_LANGUAGE == $key ? 'selected="selected"' : ''; ?>>
						<?php echo $lang['name']; ?>
					</option>
        	<?php endforeach; ?>
	        	</select> 
		</form>
					</span>
			
		</li>
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php echo $user->display_name?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#"> 
								<div class="detail">
									<strong><?php echo sprintf(lang('cp_logged_in_welcome'), $user->display_name); ?></strong>
									 
								</div>
							</a>
						</li>
						<li>
							<?php if ($this->settings->enable_profiles) echo '<a tabindex="-1" href="'.base_url().'edit-profile" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a>'; ?>
							</li>
						 
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		
		
		 