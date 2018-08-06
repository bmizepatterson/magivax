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

function standard_head() {
	return <<<EOF
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quattrocento+Sans">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="magivax.css">
EOF;
}

function close_body($echo = true) {
	$html = '';
	$html .= '<script src="magivax.js"></script>';
	$html .= "\n</body>\n</html>";
	if ($echo) {
		echo $html;
	} else {
		return $html;
	}
}