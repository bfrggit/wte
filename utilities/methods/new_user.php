<!DOCTYPE html>
<html>

<head>
	<title>PEPO: Where to Eat? New User</title>
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
if(!isset($_POST["name_first"])) $valid = false;
if(!isset($_POST["name_last"])) $valid = false;

// Check if $_POST is valid
if(!$valid){
	die("<section id=\"error\">
			<h2 class=\"contact\">Request Error</h2>
			<p>Invalid HTTP request.</p>
			</section>"
	);
}

$id = $_POST["id_"];
$name_first = $_POST["name_first"];
$name_last = $_POST["name_last"];

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

$res = mysql_query("SELECT * FROM {$tb_u} WHERE id='{$id}'");
if(!$res){
	die("<section id=\"error\">
			<h2 class=\"contact\">Database Error</h2>
			<p>Cannot read from table: ${tb_u}</p>
		</section>"
	);
}
$num = mysql_num_rows($res);
?>

		<section id="receipt">
			<h2 class="intro">New User</h2>
			<p>Your request to create new user with:</p>
			<table id="ver-minimalist">
				<thead>
					<tr>
						<th scope="col" id="id">ID</th>
						<th scope="col" id="name_first">First name</th>
						<th scope="col" id="name_last">Last name</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $name_first; ?></td>
						<td><?php echo $name_last; ?></td>
					</tr>
				</tbody>
			</table>

<?php
if($num > 0){
	die("<p>Failed, because User ID was replicated.</p>
		<p>Please click <a href=\"javascript: history.back()\">here</a> to go back.</p>"
	);
}

$res = mysql_query("INSERT INTO {$tb_u} (id, name_first, name_last) VALUES ('{$id}', '{$name_first}', '{$name_last}')");
if(!res){
	die("<p>Failed, because of a database error.</p>
		<p>Please try again later.</p>"
	);
}
?>
			<p>Succeeded.</p>
			<p>If you were not redirected back in 5 seconds, please click <a href="../users.php">here</a>.</p>

<?php header("refresh: 5; url=../users.php"); ?>
		</section>
	</section>
</body>

</html>