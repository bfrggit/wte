<!DOCTYPE html>
<html>

<head>
	<title>PEPO: Where to Eat? Users</title>
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
			<h1><a class="checklink anchorLink">Where to Eat?</a></h1>
		</div>
	</header>

<?php
include $_SERVER['DOCUMENT_ROOT']."/server.php";
include $_SERVER['DOCUMENT_ROOT']."/tables.php";

// Connect to database
if(!mysql_connect($db_host, $db_user, $db_pwd)){
	die("Cannot connect to server: {$db_host}");
}
if(!mysql_select_db($db_name)){
	die("Cannot select database: ${db_name}");
}

// Load table
$res = mysql_query("SELECT * FROM {$tb_u}");
if(!$res){
	die("Cannot read from table.");
}
?>
	<section id="contentcontainer">
		<section id="table">
			<h2 class="intro">Users</h2>
			<p>All users available on the site are listed below.</p>
			<!-- Show table -->
			<table id="ver-minimalist">
				<thead>
					<tr>
						<th scope="col" id="id">ID</th>
						<th scope="col" id="name_first">First Name</th>
						<th scope="col" id="name_last">Last Name</th>
					</tr>
				</thead>

				<tbody>
<?php
$num = mysql_num_rows($res);
$i = 0;
while($i<$num):
	echo "<tr>";
	echo "<td>".mysql_result($res, $i, "id")."</td>";
	echo "<td>".mysql_result($res, $i, "name_first")."</td>";
	echo "<td>".mysql_result($res, $i, "name_last")."</td>";
	echo "</tr>";
	++$i;
endwhile;
?>
				</tbody>
			</table>

<?php
if($num == 0){
	echo "<p>No record.</p>";
}
?>
		</section>
	</section>
</body>

</html>