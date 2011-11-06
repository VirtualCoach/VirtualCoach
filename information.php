<?php 

$title = "Your Information";
$page = "information";

require_once("classes/User.php");

$user_t = new User();
$user_t->require_login();

require("global_header.php");

?>	
	<div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h2>We just need a few more details about you...<br /><br /></h2>
		<form action="classes/signup2.php" method="post">
		<div class="clearfix <?php if ($e == 'age') echo 'error'; ?>">
			<label for="xlInput">Age</label>
			<div class="input">
				<input class="xlarge span2" id="age" name="age" size="30" type="text">
				<?php if ($e == 'age'): ?>
					<span class="help-inline">Age error</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix <?php if ($e == 'weight') echo 'error'; ?>">
			<label for="xlInput">Weight</label>
			<div class="input">
				<input class="xlarge span2" id="weight" name="weight" size="30" type="text">
				<?php if ($e == 'weight'): ?>
					<span class="help-inline">Weight error</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix <?php if ($e == 'height') echo 'error'; ?>">
			<label for="xlInput">Height</label>
			<div class="input">
				<input class="xlarge span2" id="height" name="height" size="30" type="text">
				<?php if ($e == 'height'): ?>
					<span class="help-inline">Height error</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix <?php if ($e == 'years') echo 'error'; ?>">
			<label for="xlInput">Years Cycling</label>
			<div class="input">
				<input class="xlarge span2" id="years" name="years" size="30" type="text">
				<?php if ($e == 'years'): ?>
					<span class="help-inline">Year error</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="actions">
			<div class="span-one-third pull-left">
				<div id="file-uploader">
					<noscript>          
					   <p>Please enable JavaScript</p>
				        <!-- or put a simple form for upload here -->
				    </noscript>
				</div>
			</div>
			<div class="span-one-third pull-right">
				<div class="sample_data">
					...or Use Sample Data
				</div>
			</div>
			<div class="clearfix"></div>
        </div>
		<div class="actions">
			<input type="hidden" id="myfile" name="myfile" value="">
			<input type="submit" class="btn success large" value="Finish">
        </div>
		</form>
      </div>
	
<?php require("global_footer.php"); ?>