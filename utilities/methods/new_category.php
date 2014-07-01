<!DOCTYPE html>
<html>

<head>
	<title>PEPO: Where to Eat? New Category</title>
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
			<h1><a>Where to Eat?</a></h1>
		</div>
	</header>

	<section id="contentcontainer">
<?php
$valid = true;
if(!isset($_POST["id_"])) $valid = false;
if(!isset($_POST["name_full"])) $valid = false;

// Check if $_POST is valid
if(!$valid){
	die("<section id=\"error\">
			<h2 class=\"contact\">Request Error</h2>
			<p>Invalid HTTP request.</p>
			</section>"
	);
}

$id = $_POST["id_"];
$name_full = $_POST["name_full"];

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

$res = mysql_query("SELECT * FROM {$tb_c} WHERE id='{$id}'");
if(!$res){
	die("<section id=\"error\">
			<h2 class=\"contact\">Database Error</h2>
			<p>Cannot read from table: ${tb_c}</p>
		</section>"
	);
}
$num = mysql_num_rows($res);
?>

		<section id="receipt">
			<h2 class="intro">New Category</h2>
			<p>Your request to create new category with:</p>
			<table id="ver-minimalist">
				<thead>
					<tr>
						<th scope="col" id="id">ID</th>
						<th scope="col" id="name_full">Name</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $name_full; ?></td>
					</tr>
				</tbody>
			</table>

<?php
if($num > 0){
	die("<p>Failed, because Category ID was replicated.</p>
		<p>Please click <a href=\"javascript: history.back()\">here</a> to go back.</p>"
	);
}

$res = mysql_query("INSERT INTO {$tb_c} (id, name_full) VALUES ('{$id}', '{$name_full}')");
if(!res){
	die("<p>Failed, because of a database error.</p>
		<p>Please try again later.</p>"
	);
}
?>
			<p>Succeeded.</p>
			<p>If you were not redirected back in 5 seconds, please click <a href="../categories.php">here</a>.</p>

<?php header("refresh: 5; url=../categories.php"); ?>
		</section>
	</section>
</body>

</html>