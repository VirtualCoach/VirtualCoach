<?php 

$title = "Dashboard";
$page = "dashboard";

require("global_header.php");

?>	
	<div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h2>Dashboard</h2>
        <div id="dash_chart"></div>
      </div>
	<script>
		var glob_uid = <?php echo $_SESSION["uid"]; ?>;
	</script>

<?php require("global_footer.php"); ?>