<?php 

require_once("classes/User.php");
$user = new User();

if (!$user->is_logged_in()) {
	header("Location: .");
}

$title = "Dashboard";
$page = "dashboard";

require("global_header.php");

?>	
<div class="container">
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit dash">
		<div class="well">
			<h2 class="pull-left">Dashboard</h2>
			<a href="#" class="btn large primary pull-right">Upload Workout</a>
			<div class="clearfix"></div>
	    </div>
		<div class="well">
			<div class="row">
				<div class="span1">&nbsp;</div>
				<div class="span2 input">
					<div class="input">
						<select name="col1" id="col1" class="span2">
							<option value="power" selected>Power</option>
							<option value="rpm">RPM</option>
							<option value="speed">Speed</option>
							<option value="hr">Heart Rate</option>
						</select>
					</div>
				</div>
				<!--<div class="span1 input">
					<h3>&nbsp;vs.</h3>
				</div>
				<div class="span3 input">
					<div class="input">
						<select name="col2" id="col2" class="span2">
							<option value="none" selected>None</option>
							<option value="power">Power</option>
							<option value="rpm">RPM</option>
							<option value="speed">Speed</option>
							<option value="hr">Heart Rate</option>
						</select>
					</div>
				</div>-->
				<div class="span6 input">
					<label for="xlInput">Points&nbsp;&nbsp;</label>
					<div class="input">
						<input class="xlarge span2" id="points" name="points" size="3" value="20" type="text">
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
			<div id="dash_chart"></div>
		</div>
		
		<div class="well">
			<h2 class="pull-left">Rider Profile</h2>
			<a href="#" class="btn large success pull-right">Add Goal</a>
			<div class="span4 bgwhite numerics pull-left clearleft">
				<h1 class="pull-right" style="color:#C43C35;"><small>Target Power</small> 515</h1>
				<h1 class="pull-right" style="color:#57A957;"><small>Target RPM</small> 97</h1>
				<h1 class="pull-right" style="color:#57A957;"><small>Sprint RPM</small> 108</h1><br /><br />
				<h1 class="pull-right"><small>Target HR</small> 185</h1><br />
				<div class="clearfix"></div>
			</div>
			<div class="span10 pull-right">
				<div class="row">
					<div class="span1">&nbsp;</div>
					<div class="span2 input">
						<div class="input">
							<select name="pcol1" id="pcol1" class="span2">
								<option value="t" selected>Time</option>
								<option value="rpm">RPM</option>
							</select>
						</div>
					</div>
					<div class="span5 input">
						<label for="xlInput">Points&nbsp;&nbsp;</label>
						<div class="input">
							<input class="xlarge span2" id="ppoints" name="ppoints" size="3" value="20" type="text">
						</div>
					</div>
				</div>
				<div id="rider_profile_chart"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

<?php require("global_footer.php"); ?>