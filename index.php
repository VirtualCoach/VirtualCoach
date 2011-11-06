<?php 

require_once("classes/User.php");
$user = new User();

if ($user->is_logged_in()) {
	header("Location: dashboard");
}

$title = "Training predictions adapted to your workout history";
$page = "home";

require("global_header.php");

?>	
	<div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
		<div class="span8 pull-left">
			<div id="home_chart" style="width: 100%; height: 400px"></div>
		</div>
		<div class="span6 pull-right">
			<h2>Performance Enhancing Software</h2><br />
			<p>InSight provides personalized training recommendations and is the easiest way to get advice and predictions to deliver real results.</p><br />
			<p><a href="signup" class="btn large huge success pull-left">Sign Up Now &raquo;</a></p>
		</div>
		<div class="clearfix"></div>
      </div>

      <!-- Example row of columns -->
      <div class="row home_boxes">
        <div class="span-one-third">
          <h2>The InSight Blog</h2>
          <p>Check out our blog for the latest updates.</p>
		  <img src="img/blog.png" width="100px" />
        </div>
        <div class="span-one-third">
          <h2>Training Predictions</h2>
           <p>Our algorithm learns from your workout history to give you the best results.</p>
			<img src="img/algo.png" width="100px" />
       </div>
        <div class="span-one-third">
          <h2>NEW: Goals</h2>
          <p>Create fitness or result-based goals <br />using our predictions.</p>
			<img src="img/goals.png" width="100px" />
          <!--<p><a class="btn" href="signup">Sign Up &raquo;</a></p>-->
        </div>
      </div>
<?php require("global_footer.php"); ?>

