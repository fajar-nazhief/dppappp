<?php if (isset($buttons) && is_array($buttons)): ?>
	<?php foreach ($buttons as $key => $button): ?>
		<?php
		/**
		 * @var		$extra	array associative
		 * @since	1.2.0-beta2
		 */ ?>
		<?php $extra	= NULL; ?>
		<?php $button	= ! is_numeric($key) && ($extra = $button) ? $key : $button; ?>

		<?php switch ($button) :
			case 'delete': ?>
				<button href="#PopConfirm" type="submit" name="btnAction" value="delete" class="btn btn-danger confirm PopConfirm_open">
					<span><?php echo lang('buttons.delete'); ?></span>
				</button>
				<?php break;
			case 're-index': ?>
				<button type="submit" name="btnAction" value="re-index" class="button">
					<span><?php echo lang('buttons.re-index'); ?></span>
				</button>
				<?php break;
				case 'publish':?>
			<button type="submit" name="btnAction" value="<?php echo $button ?>" class="button btn btn-success">
					<span>Publish</span>
				</button>
			<?php break;
			case 'activate':
			case 'deactivate':
			case 'approve':
			case 'save':    ?>
			<button type="submit" name="btnAction" value="<?php echo $button ?>" class="button btn btn-success">
					<span><?php echo $button ?></span>
				</button>
			<?php break;
			case 'save_exit':    ?>
			<button type="submit" name="btnAction" value="<?php echo $button ?>" class="button btn btn-info">
					<span>Save and exit</span>
				</button>
			<?php break;
			case 'unapprove':
			case 'upload': ?>
				<button type="submit" name="btnAction" value="<?php echo $button ?>" class="button">
					<span><?php echo lang('buttons.' . $button); ?></span>
				</button>
				<?php break;
			case 'cancel':
              ?>
			<a href="<?php echo 'admin/' . $this->module_details['slug']?>" type="submit" name="btnAction" value="<?php echo $button ?>" class="button btn btn-warning">
					<span>Cancel</span>
				</a>
			<?php break;
			case 'close':
			case 'preview':
				echo anchor('admin/' . $this->module_details['slug'], lang('buttons.' . $button), 'class="button ' . $button . '"');
				break;

			/**
			 * @var		$id scalar - optionally can be received from an associative key from array $extra
			 * @since	1.2.0-beta2
			 */
			case 'edit':
				$id = is_array($extra) && array_key_exists('id', $extra) ? '/' . $button . '/' . $extra['id'] : NULL;

				echo anchor('admin/' . $this->module_details['slug'] . $id, lang('buttons.' . $button), 'class="button ' . $button . '"');
				break; ?>

		<?php endswitch; ?>
	<?php endforeach; ?>
<?php endif; ?>