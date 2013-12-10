<?php

/*
Plugin Name: Show Actions
Description: Displays all currently registered Actions at the bottom of each page
Version: 1.0
Author: Rich Jenks
Author URI: http://richjenks.com/
*/

// Get correct id for plugin
$thisfile=basename(__FILE__, ".php");

// Register plugin
register_plugin(
	$thisfile, //Plugin id
	'Show Actions', //Plugin name
	'1.0', //Plugin version
	'Rich Jenks', //Plugin author
	'http://richjenks.com/', //author website
	'Displays all currently registered Actions at the bottom of each page', //Plugin description
	FALSE, //page type - on which admin tab to display
	FALSE //main function (administration)
);

	add_action('footer','show_actions',array());
	add_action('theme-footer','show_actions',array());

/**
 * Display a table of all currently registered actions
 */
function show_actions() {
	global $plugins;

	echo '<br><h3>Currently Registered Actions</h3>';
	echo '<table class="highlight">';
	echo '	<tr>';
	echo '		<th>Hook</th>';
	echo '		<th>Function</th>';
	echo '		<th>File</th>';
	echo '	</tr>';

	// Display each hook as a table row
	foreach ($plugins as $hook) {
		echo '	<tr>';
		echo '		<td>'.$hook['hook'].'</td>';
		echo '		<td>'.$hook['function'].'</td>';
		echo '		<td>'.$hook['file'].'</td>';
		echo '	</tr>';
	}

	echo '</table>';
}

?>