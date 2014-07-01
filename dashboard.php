<!DOCTYPE html>
<html>
<?php /*
PEPO: Where to Eat?

        <<< dashboard.php

Author:     Charles Zhu
Created on: 7/1/2014
*/ ?>
<head>
	<title>PEPO: Where to Eat? Dashboard</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<link rel="shortcut icon" href="/icon.png" />
	<link rel="icon" href="/icon.png" />

	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
	</script>

	<![endif]-->
	<!--[if IE 7]>
	<link
		rel="stylesheet"
		href="/style/ie7.css"
		type="text/css"
		media="screen"
	/>
	<![endif]-->

	<link
		rel="stylesheet"
		href="/style/style.css"
		type="text/css"
		media="screen"
	/>

	<script
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"
		type="text/javascript">
	</script>
	<script
		src="/js/jquery.anchor.js"
		type="text/javascript">
	</script>
	<script
		src="/js/jquery.fancybox-1.2.6.pack.js"
		type="text/javascript">
	</script>
</head>

<body>
	<header>
		<div id="headercontainer">
<?php include $_SERVER['DOCUMENT_ROOT']."/lib/header_button.htm"; ?>
			<nav><ul>
				<li><a class="dashboard anchorLink" href="#dashboard">Dashboard</a></li>
				<li><a class="utilities anchorLink" href="#utilities">Utilities</a></li>
				<li><a class="about anchorLink" href="#about">About</a></li>
			</ul></nav>
		</div>
	</header>

	<section id="contentcontainer">
<?php
include $_SERVER['DOCUMENT_ROOT']."/server.php";
include $_SERVER['DOCUMENT_ROOT']."/tables.php";

// Connect to database
if(!mysql_connect($db_host, $db_user, $db_pwd)){
	die("<section id=\"error\">
			<h2 class=\"contact\">Server Error</h2>
			<p>Cannot connect to server: {$db_host}</p>
			</section>"
	);
}
if(!mysql_select_db($db_name)){
	die("<section id=\"error\">
			<h2 class=\"contact\">Server Error</h2>
			<p>Cannot select database: ${db_name}</p>
		</section>"
	);
}
/*
// Load table
$res = mysql_query("SELECT * FROM {$tb_u}");
if(!$res){
	die("<section id=\"error\">
			<h2 class=\"contact\">Database Error</h2>
			<p>Cannot read from table: ${tb_u}</p>
		</section>"
	);
} */
?>

		<section id="dashboard">
			<h2
				class="intro"
				style="background:
					url(/style/images/portfolio.png)
					no-repeat -10px -10px;"
			>Dashboard
			</h2>
			<p>Dashboard is coming soon.</p>
			<p>Please come back later.</p>
			<div class="break" />
		</section>

		<section id="utilities">
			<h2 class="intro">Utilities</h2>
			<p>Utilities are management tools for this site.</p>

			<p><label for="pusers">Users</label></p>
			<p
				id="pusers"
				style="margin-left: 25px"
			>	User management is privileged.<br>
				Please contact administrators for user registration.<br>
				User list is
				<a href="/utilities/ro/users.php">here</a>.
			</p>
			
			<p><label for="plocations">Locations</label></p>
			<p
				id="plocations"
				style="margin-left: 25px"
			>	Location management is present
				<a href="/utilities/locations.php">here</a>.
			</p>

			<p><label for="pcategories">Categories</label></p>
			<p
				id="pcategories"
				style="margin-left: 25px"
			>	Category management is present
				<a href="/utilities/categories.php">here</a>.
			</p>

			<p><label for="poptions">Options</label></p>
			<p
				id="poptions"
				style="margin-left: 25px"
			>	Option management is coming soon.<br>
				Please come back later.
			</p>

			<div class="break" />
		</section>

		<section id="about">
			<h2
				class="intro"
				style="background:
					url(/style/images/about.png)
					no-repeat -10px -10px;"
			>About
			</h2>
<?php include $_SERVER['DOCUMENT_ROOT']."/lib/p_about.htm"; ?>
			<div class="break" />
		</section>
	</section>
</body>

</html>