<?php
/**
* General library of functions
*/

// TO DO: Prevent command line access

/**
 * Each view should echo this function to start HTML output
 * @param string $title of the page for the <title> tag
 * @param array $classes an array of strings representing classes that should
 * 		  be applied to the <body> tag
 * @param bool $echo echo | return output
 * @return string | void
 */
function open_body($title, $classes = array(), $echo = false) {
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

/**
 * Output HTML to create a nav bar at the top of the page
 * @param bool $echo echo | return output
 * @return string | void
 */
function user_nav($echo = false) {
	$html = <<<EOF
	<div class="user-nav">
		<a class="user-nav_home user-nav_item" href="/">Magivax</a>
		<a class="user-nav_item" href="/enterpatientinfo">Start</a>
		<a class="user-nav_item" href="/admin">Admin</a>
		<a class="user-nav_item" href="/about">About</a>
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
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quattrocento+Sans">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="/assets/magivax.css">
EOF;
}

/**
 * Output HTML to close the body
 * @param bool $color_palette whether to include the color palette at the bottom of the page
 * @param bool $echo echo | return output
 * @return string | void
 */
function close_body($color_palette = true, $echo = false) {
	$html = $color_palette ? color_palette() : '';
	$html .= '<script src="/assets/magivax.js"></script>';
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
