<div class="comments_container"> 
<?php  if ($comments): ?>
	 
	<?php  foreach ($comments as $item): ?>
	 <table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" style="padding:10px;border-bottom:1px solid #dedede;background:#f5f5f5">
				<?php  echo date('d-m-Y H:i:s',$item->created_on); ?>
			</td>
		</tr>
		<tr>
			<td width="20%" style="border-right:1px solid #dedede">
				<?php  if ($item->user_id): ?>
									<p class="comment_heading">
										<strong><?php  echo anchor('user/' . $item->user_id, $this->ion_auth->get_user($item->user_id)->display_name); ?></strong>
								<?php  else: ?>
									<p class="comment_heading"><strong><?php  echo anchor($item->website, $item->name); ?></strong>
								<?php  endif; ?>
								<div style="padding:10px;margin:10px">
								<?php  echo gravatar($item->email, 40); ?>
								</div>
			</td>
			<td valign="top">
				<?php  echo nl2br($item->comment); ?> 
						 
			</td>
		</tr>
	 </table>
					 
						
					 
								 
								
								   
									
								 
							 
			
			
						 
					  
		 
	<?php  endforeach; ?>
	 
<?php  else: ?>
	<p><?php  echo lang('comments.no_comments'); ?></p>
<?php  endif; ?>
</div>
<h3 ><?php  echo lang('comments.your_comment'); ?></h3>
<div id="comments_form_container" style="background:#f5f5f5;padding:10px;border-bottom:1px solid #dedede">
	
	
	<?php  echo form_open('comments/create/' . $module . '/' . $id); ?>
		<?php  echo form_hidden('redirect_to', $this->uri->uri_string()); ?>
		<noscript><?php  echo form_input('d0ntf1llth1s1n', '', 'style="display:none"'); ?></noscript>
	
	<?php  if ( ! $this->user): ?>
		<p>
			<label for="name"><?php  echo lang('comments.name_label'); ?>:</label><br />
			<input type="text" name="name" id="name" maxlength="40" value="<?php  echo $comment['name'] ?>" />
		</p>
		<p>
			<label for="email"><?php  echo lang('comments.email_label'); ?>:</label><br />
			<input type="text" name="email" maxlength="40" value="<?php  echo $comment['email'] ?>" />
		</p>
		<p>
			<label for="website"><?php  echo lang('comments.website_label'); ?>:</label><br />
			<input type="text" name="website" maxlength="40" value="<?php  echo $comment['website'] ?>" />
		</p>
	<?php  endif; ?>
	
		<p>
			<label for="message"><?php  echo lang('comments.message_label'); ?>:</label><br />
			<textarea name="comment" id="message" rows="5" cols="30" class="width-full"><?php  echo $comment['comment'] ?></textarea>
		</p>
		<p><?php  echo form_submit('btnSend', lang('comments.send_label')); ?></p>
	<?php  echo form_close(); ?>
</div>