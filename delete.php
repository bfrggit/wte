<?php
include "vars.php";
?>
<html>
<head>
    <title>428: Where to Eat?</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.anchor.js" type="text/javascript"></script>
    <script src="js/jquery.fancybox-1.2.6.pack.js" type="text/javascript"></script>
</head>
<body>
    <header> <!-- HTML5 header tag -->
    	<div id="headercontainer">
    		<h1><a class="checklink anchorLink">Where To Eat?</a></h1>
    		<nav> <!-- HTML5 navigation tag -->
    		</nav>
    	</div>
    </header>

    <section id="contentcontainer">
<?php
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("<section id=\"dberr\"><h2 class=\"order\">Database Failure</h2><p>Can't connect to database.</p></section>");

if (!mysql_select_db($database))
    die("<section id=\"dberr\"><h2 class=\"order\">Database Failure</h2><p>Can't select database.</p></section>");

$result = mysql_query("TRUNCATE TABLE {$ti}");
?>

        <section id="only">
            <h2 class="check">Orders Cleared</h2>
            <p>Will redirect you back home in 5 seconds...</p>
<?php header('refresh:5; url=/wte');?>
            <p>If your browser doesn't redirect you automatically, <script>
    document.write('<a href="' + document.referrer + '">click here</a>');
</script>.</p>
        </section>
    </section>
</body>
</html>
