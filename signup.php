<?php 

$title = "Signup";
$page = "signup";

require("global_header.php");

?>	
	<div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h3>Signup</h3>
		<form action="classes/signup.php" method="post">
		<div class="clearfix <?php if ($e == 'email') echo 'error'; ?>">
			<label for="xlInput">Email</label>
			<div class="input">
				<input class="xlarge" id="email" name="email" size="30" type="text">
				<?php if ($e == 'email'): ?>
					<span class="help-inline">Email already exists</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix <?php if ($e == 'username') echo 'error'; ?>">
			<label for="xlInput">Username</label>
			<div class="input">
				<input class="xlarge" id="username" name="username" size="30" type="text">
				<?php if ($e == 'username'): ?>
					<span class="help-inline">Username already exists</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix <?php if ($e == 'passwords') echo 'error'; ?>">
			<label for="xlInput">Password</label>
			<div class="input">
				<input class="xlarge" id="password" name="password" size="30" type="password">
				<?php if ($e == 'passwords'): ?>
					<span class="help-inline">Passwords do not match</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix <?php if ($e == 'passwords') echo 'error'; ?>">
			<label for="xlInput">Confirm Password</label>
			<div class="input">
				<input class="xlarge" id="cpassword" name="cpassword" size="30" type="password">
				<?php if ($e == 'passwords'): ?>
					<span class="help-inline">Passwords do not match</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="actions">
			<input type="submit" class="btn primary" value="Create my account">
        </div>
		</form>
      </div>

<?php require("global_footer.php"); ?>