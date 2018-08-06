<?php
/**
* General library of functions
*/

// TO DO: Prevent command line access

function open_body($title, array $classes) {
	$class_str = '';
	if ($classes) {
		$class_str .= ' class="';
		foreach ($classes as $class) {
			$class_str .= $class;
		}
		$class_str .= '"';
	}
	return '<!DOCTYPE html>
<html>
<head>'. standard_head() . "
<title>$title</title>
</head>
<body{$class_str}>";
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

function close_body() {
	return "</body>\n</html>";
}