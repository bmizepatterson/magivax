<?php
/**
* General library of functions
*/

// TO DO: Prevent command line access

function open_body($title, $classes = array(), $echo = true) {
	$class_str = '';
	if ($classes) {
		$class_str .= ' class="';
		foreach ($classes as $class) {
			$class_str .= $class;
		}
		$class_str .= '"';
	}
	$html = '<!DOCTYPE html>
<html>
<head>'. standard_head() . "
<title>$title</title>
</head>
<body{$class_str}>";
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function user_nav($echo = true) {
	$html = <<<EOF
	<div class="user-nav">
		<a class="user-nav_home user-nav_item" href="index.php">Magivax</a>
		<a class="user-nav_item" href="enterpatientinfo.php">Start</a>
		<a class="user-nav_item" href="admin.php">Admin</a>
		<a class="user-nav_item" href="/phpmyadmin/" target="_blank">phpMyAdmin</a>
	</div>
EOF;
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function standard_head() {
	return <<<EOF
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quattrocento+Sans">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="magivax.css">
EOF;
}

function close_body($color_palette = true, $echo = true) {
	$html = $color_palette ? color_palette() : '';
	$html .= '<script src="magivax.js"></script>';
	$html .= "\n</body>\n</html>";
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}

function color_palette() {
	return <<<EOF
	<div id="color-palette">
		<div class="w3-row">
			<div class="w3-display-container w3-col brown palette"><div class="w3-display-middle">#5D5C61</div></div>
			<div class="w3-display-container w3-col gray palette"><div class="w3-display-middle">#817B82</div></div>
			<div class="w3-display-container w3-col light-blue palette"><div class="w3-display-middle">#7395AE</div></div>
			<div class="w3-display-container w3-col blue palette"><div class="w3-display-middle">#557A95</div></div>
			<div class="w3-display-container w3-col tan palette"><div class="w3-display-middle">#B1A296</div></div>
		</div>
	</div>
EOF;
}

function connect_database() {
	try {
        $connection = new PDO('mysql:host=localhost:8889;dbname=magivax', 'magivax_user', 'anti-anti-vax');
	    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $connection;
    } catch (Exception $e) {
        throw new Exception('Error connecting to database: '.$e->getMessage());
    }
}