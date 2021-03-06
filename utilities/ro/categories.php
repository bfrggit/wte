<!DOCTYPE html>
<html>

<head>
	<title>PEPO: Where to Eat? Categories</title>
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
<?php include $_SERVER['DOCUMENT_ROOT']."/lib/header_button.htm"; ?> <!--
			<nav><ul>
				<li><a class="table anchorLink" href="#table">List</a></li>
				<li><a class="new anchorLink" href="#new">New</a></li>
				<li><a class="delete anchorLink" href="#delete">Delete</a></li>
			</ul></nav> -->
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

// Load table
$res = mysql_query("SELECT * FROM {$tb_c}");
if(!$res){
	die("<section id=\"error\">
			<h2 class=\"contact\">Database Error</h2>
			<p>Cannot read from table: ${tb_c}</p>
		</section>"
	);
}
?>

		<section id="table">
			<h2
				class="intro"
				style="background:
					url(/style/images/about.png)
					no-repeat -10px -10px;"
			>Categories
			</h2>
			<p>All categories available on the site are listed below.</p>
			<!-- Show table -->
			<table id="ver-minimalist">
				<thead>
					<tr>
						<th scope="col" id="id">ID</th>
						<th scope="col" id="name_full">Name</th>
					</tr>
				</thead>

				<tbody>
<?php
$num = mysql_num_rows($res);
$i = 0;
while($i < $num):
	echo "<tr>";
	echo "<td>".mysql_result($res, $i, "id")."</td>";
	echo "<td>".mysql_result($res, $i, "name_full")."</td>";
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
			<div class="break" />
		</section> <!--

		<section id="new">
			<h2 class="intro">New Category</h2>
			<p>Please fill in the form below.</p>
			
			<form id="newform" action="methods/new_category.php" method="POST">
				<p><label for="id_">Category ID must be unique</label></p>
				<input
					type="text"
					id="id_"
					name="id_"
					placeholder="Example: chinese"
					required
					tabindex="1"
					maxlength="12"
				/>
				<p><label for="name_full">Name</label></p>
				<input
					type="text"
					id="name_full"
					name="name_full"
					placeholder="Example: Chinese"
					required
					tabindex="2"
					maxlength="48"
				/>

				<input
					type="submit"
					id="submit"
					name="submit"
					tabindex="10"
					value="Submit"
					style="margin-left: 25px"
				/> 
			</form>
			<div class="break" />
		</section> --> <!--

		<section id="delete">
			<h2 class="intro">Delete Category</h2>
			<p>Please identify the category to delete by ID.</p>
			
			<form id="deleteform" action="methods/delete_category.php" method="POST">
				<p><label for="id_">Category</label></p>
<?php /*
$num = mysql_num_rows($res);
$i = 0;
while($i < $num):
	$radio_id = mysql_result($res, $i, "id");
	$radio_name = mysql_result($res, $i, "name_full");
	echo "<input
			type=\"radio\"
			id=\"id_\"
			name=\"id_\"
			value=\"{$radio_id}\"
			required
			style=\"margin: 0px 10px 0px 25px\"
		/>{$radio_name} ({$radio_id})";
	++$i;
endwhile; */
?>
				<p></p>
				<input
					type="submit"
					id="submit"
					name="submit"
					tabindex="10"
					value="Submit"
					style="margin-top: 15px"
<?php //if($num == 0) echo "disabled"; ?>
				/> 
			</form>
			<div class="break" />
		</section> -->
	</section>
</body>

</html>