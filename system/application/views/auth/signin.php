<?php echo form_open('auth/signin', array('role' => 'form')); ?>
	<fieldset>
		<legend>Sign In</legend>
		
		<?php echo $template['partials']['form_errors']; ?>

		<div class="form-group">
			<label for="email">Email address:</label>
			<?php echo form_input(array(
										'id'	=> 'email',
										'name'	=> 'user_email',
										'class'	=> 'form_control'
										));
										?>
		</div>

		<div class="form-group">
			<label for="password">Password:</label>
			<?php echo form_input(array(
										'id'	=> 'password',
										'name'	=> 'user_password',
										'class'	=> 'form_control'
										));
										?>
		</div>

		<div class="checkbox">
			<label>
				<input type="checkbox" name="keep_signed_in" value="1" /> Keep me signed in on this device
			</label>
		</div>

		
		<button type="submit" class="btn btn-default">Sign In</button>
		
	</fieldset>

</form>