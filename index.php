<?php 

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
			<h2>Training predictions adapted to <i>your</i> workout history</h2>
			<p>Virtual Coach provides personalized training recommendations and is the easiest way to get advice and predictions to deliver real results.</p>
			<p><a href="signup" class="btn large success">Sign Up Now &raquo;</a></p>
		</div>
		<div class="clearfix"></div>
      </div>

      <!-- Example row of columns -->
      <div class="row home_boxes">
        <div class="span-one-third">
          <h2>What?</h2>
          <p>Virtual Coach provides personalized training recommendations for professional and amateur cyclists. It aims to deliver succinct and functional training advice and predictions to deliver real results.</p>
        </div>
        <div class="span-one-third">
          <h2>How?</h2>
           <p>Training predictions are adapted from your workout history, which is collected on your bicycle in real time via your Power Meter device. Metrics are presented in a convenient and easy to understand format, while predictions are generated based on a sophisticated machine learning algorithm.</p>
       </div>
        <div class="span-one-third">
          <h2>Why?</h2>
          <p>Personal trainers are expensive and typically are not well-qualified. See real results at a lower cost simply by interacting with Virtual Coach. Join this exciting network of cyclists and change your cycling today.</p>
          <p><a class="btn" href="signup">Sign Up &raquo;</a></p>
        </div>
      </div>
<?php require("global_footer.php"); ?>