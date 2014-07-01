<!DOCTYPE html>
<html>

<head>
	<title>PEPO: Where to Eat? Locations</title>
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
			<nav><ul>
				<li><a class="table anchorLink" href="#table">List</a></li>
				<li><a class="new anchorLink" href="#new">New</a></li>
				<li><a class="delete anchorLink" href="#delete">Delete</a></li>
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

// Load table
$res = mysql_query("SELECT * FROM {$tb_l}");
if(!$res){
	die("<section id=\"error\">
			<h2 class=\"contact\">Database Error</h2>
			<p>Cannot read from table: ${tb_l}</p>
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
			>Locations
			</h2>
			<p>All locations available on the site are listed below.</p>
			<!-- Show table -->
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
if($num == 0){
	echo "<p>No record.</p>";
}
?>
			<div class="break" />
		</section>

		<section id="new">
			<h2 class="intro">New Location</h2>
			<p>Please fill in the form below.</p>
			
			<form id="newform" action="methods/new_location.php" method="POST">
				<p><label for="id_">Location ID must be unique</label></p>
				<input
					type="text"
					id="id_"
					name="id_"
					placeholder="Example: rabbitb"
					required
					tabindex="1"
					maxlength="12"
				/>
				<p><label for="name_full">Name</label></p>
				<input
					type="text"
					id="name_full"
					name="name_full"
					placeholder="Example: Rabbit Burrow"
					required
					tabindex="2"
					maxlength="48"
				/>
				<p><label for="latitude">Latitude</label></p>
				<input
					type="number"
					id="latitude"
					name="latitude"
					placeholder="Example: 33.6424107"
					required
					tabindex="3"
					step="0.0000001"
					min="-90"
					max="90"
				/>
				<p><label for="longitude">Longitude</label></p>
				<input
					type="number"
					id="longitude"
					name="longitude"
					placeholder="Example: -117.8305355"
					required
					tabindex="4"
					step="0.0000001"
					min="-180"
					max="180"
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
		</section>

		<section id="delete">
			<h2 class="intro">Delete Location</h2>
			<p>Please identify the location to delete by ID.</p>
			
			<form id="deleteform" action="methods/delete_location.php" method="POST">
				<p><label for="id_">Location</label></p>
<?php
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
endwhile;
?>
				<p></p>
				<input
					type="submit"
					id="submit"
					name="submit"
					tabindex="10"
					value="Submit"
					style="margin-top: 15px"
<?php if($num == 0) echo "disabled"; ?>
				/> 
			</form>
			<div class="break" />
		</section>
	</section>
</body>

</html>