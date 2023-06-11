<h3><?php  echo lang('user_register_header') ?></h3>
<div class="right_articles" style="border-radius: 0px 0px 10px 10px;">
<p>
	<span id="active_step"><?php  echo lang('user_register_step1') ?></span> -&gt; 
	<span><?php  echo lang('user_register_step2') ?></span>
</p>

<p><?php  echo lang('user_register_reasons') ?></p>

<?php  if(!empty($error_string)):?>
<!-- Woops... -->
<div class="error-box">
	<?php  echo $error_string;?>
</div>
<?php  endif;?>  

<?php  echo form_open('register', array('id'=>'register')); ?>
<table>
	<tr><td>
		<label for="first_name"><?php  echo lang('user_first_name') ?></label></td><td>
		<input type="text" name="first_name" maxlength="40" value="<?php  echo $user_data->first_name; ?>" />
	</td></tr>
	
	<tr><td>
		<label for="last_name"><?php  echo lang('user_last_name') ?></label></td><td>
		<input type="text" name="last_name" maxlength="40" value="<?php  echo $user_data->last_name; ?>" />
	</td></tr>
	
	<tr><td>
		<label for="username"><?php  echo lang('user_username') ?></label></td><td>
		<input type="text" name="username" maxlength="100" value="<?php  echo $user_data->username; ?>" />
	</td></tr>
	
	<tr><td>
		<label for="display_name"><?php  echo lang('user_display_name') ?></label></td><td>
		<input type="text"name="display_name" maxlength="100" value="<?php  echo $user_data->display_name; ?>" />
	</td></tr>
	
	<tr><td>
		<label for="email"><?php  echo lang('user_email') ?> - <em><?php  echo lang('user_email_use') ?></em></label></td><td>
		<input type="text" name="email" maxlength="100" value="<?php  echo $user_data->email; ?>" />
	</td></tr>
	
	<tr><td>
		<label for="confirm_email"><?php  echo lang('user_confirm_email') ?></label></td><td>
		<input type="text" name="confirm_email" maxlength="100" value="<?php  echo $user_data->confirm_email; ?>" />
	</td></tr>
	
	<tr><td>
		<label for="password"><?php  echo lang('user_password') ?></label></td><td>
		<input type="password" name="password" maxlength="100" />
	</td></tr>
	
	<tr><td>
		<label for="confirm_password"><?php  echo lang('user_confirm_password') ?></label></td><td>
		<input type="password" name="confirm_password" maxlength="100" />
	</td></tr>
	
	<tr><td>
		<?php  echo form_submit('btnSubmit', lang('user_register_btn')) ?>
	</td></tr>
</table>
<?php  echo form_close(); ?>
</div>