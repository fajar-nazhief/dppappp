<h3><?php  echo lang('user_login_header') ?></h3>

<?php  if (validation_errors()): ?>
<div class="error-box">
	<?php  echo validation_errors();?>
</div>
<?php  endif; ?>

<?php  echo form_open('users/login', array('id'=>'login'), array('redirect_to' => $redirect_to)); ?>
<div class="right_articles" style="border-radius: 0px 0px 10px 10px;">
<table>
	<tr>
		<td><?php  echo lang('user_email'); ?></td><td>
		<input type="text" id="email" name="email" maxlength="120" />
	</td></tr>
	<tr>
		<td><?php  echo lang('user_password'); ?></td><td>
		<input type="password" id="password" name="password" maxlength="20" />
	</td></tr>
	 <tr>
	<td>
		<input type="submit" value="<?php  echo lang('user_login_btn') ?>" name="btnLogin" /> | <?php  echo anchor('register', lang('user_register_btn'));?>
	</td></tr>
	<tr>
		<td>
		<?php  echo anchor('users/reset_pass', lang('user_reset_password_link'));?>
	</td>
	</tr>
</table>
</div>
<?php  echo form_close(); ?>