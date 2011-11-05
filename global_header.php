<?php require("classes/util.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Virtual Coach | <?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
	<!-- CSS concatenated and minified via ant build script-->
	<link rel="stylesheet" href="css/style.css">
	<!-- end CSS-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>
</head>

<body>

	<div class="topbar">
		<div class="fill">
			<div class="container">
				<a class="brand" href="./">Virtual Coach</a>
				<ul class="nav">
					<?php if ($page == "home") { echo "<li class='active'>";} else { echo "<li>"; } ?><a href="./">Home</a></li>
					<?php if ($page == "about") { echo "<li class='active'>";} else { echo "<li>"; } ?><a href="about">About</a></li>
					<?php if ($page == "contact") { echo "<li class='active'>";} else { echo "<li>"; } ?><a href="contact">Contact</a></li>
				</ul>
				<?php if (!$SESSION["is_logged_in"]):?>
				<form action="" class="pull-right">
					<input class="input-small" type="text" placeholder="Username">
					<input class="input-small" type="password" placeholder="Password">
					<button class="btn" type="submit">Sign in</button>
				</form>
				<?php else: ?>
				<ul class="nav secondary-nav">
					<li><a href="dashboard">Dashboard</a></li>
					<li><a href="account">Account</a></li>
					<li><a href="logout">Logout</a></li>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
    