<!DOCTYPE html>
<html>

<head>
	<title>PEPO: Where to Eat? Delete Location</title>
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
		</div>
	</header>

	<section id="contentcontainer">
<?php
$valid = true;
if(!isset($_POST["id_"])) $valid = false;

// Check if $_POST is valid
if(!$valid){
	die("<section id=\"error\">
			<h2 class=\"contact\">Request Error</h2>
			<p>Invalid HTTP request.</p>
			</section>"
	);
}

$id = $_POST["id_"];

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

$res = mysql_query("SELECT * FROM {$tb_l} WHERE id='{$id}'");
if(!$res){
	die("<section id=\"error\">
			<h2 class=\"contact\">Database Error</h2>
			<p>Cannot read from table: ${tb_l}</p>
		</section>"
	);
}
$num = mysql_num_rows($res);
?>

		<section id="receipt">
			<h2 class="intro">Delete Location</h2>
			<p>Your request to delete location with:</p>
			<table id="ver-minimalist">
				<thead>
					<tr>
						<th scope="col" id="id">ID</th>
						<th scope="col" id="name_full">Name</th>
						<th scope="col" id="latitude">Latitude</th>
						<th scope="col" id="longitude">Longitude</th>
					</tr>
				</thead>
				<tbody>
<?php
$num = mysql_num_rows($res);
$i = 0;
if($num < 1){
	echo "<tr>";
	echo "<td>".$id."</td>";
	echo "<td>-</td>";
	echo "<td>-</td>";
	echo "<td>-</td>";
	echo "</tr>";
}
while($i < $num):
	echo "<tr>";
	echo "<td>".mysql_result($res, $i, "id")."</td>";
	echo "<td>".mysql_result($res, $i, "name_full")."</td>";
	echo "<td>".mysql_result($res, $i, "latitude")."</td>";
	echo "<td>".mysql_result($res, $i, "longitude")."</td>";
	echo "</tr>";
	++$i;
endwhile;
?>
				</tbody>
			</table>

<?php
// Should not happen
if($num < 1){
	die("<p>Failed, because Location ID did not exist.</p>
		<p>Please click <a href=\"../locations.php\">here</a> to go back.</p>"
	);
}

$res = mysql_query("DELETE FROM {$tb_l} WHERE id='{$id}'");
if(!res){
	die("<p>Failed, because of a database error.</p>
		<p>Please try again later.</p>"
	);
}
?>
			<p>Succeeded.</p>
			<p>If you were not redirected back in 5 seconds, please click <a href="../locations.php">here</a>.</p>

<?php header("refresh: 5; url=../locations.php"); ?>
		</section>
	</section>
</body>

</html>