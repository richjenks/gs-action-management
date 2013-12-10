<?php

/*
Plugin Name: Remove Action
Description: Allows plugin developers to remove actions
Version: 1.0
Author: Rich Jenks
Author URI: http://richjenks.com/
*/

// Show currently registered actions
$showActionsAdmin = true;
$showActionsTheme = false;

// Get correct id for plugin
$thisfile=basename(__FILE__, ".php");

// Register plugin
register_plugin(
	$thisfile, //Plugin id
	'Remove Action', //Plugin name
	'1.0', //Plugin version
	'Rich Jenks', //Plugin author
	'http://richjenks.com/', //author website
	'Allows plugin developers to remove actions', //Plugin description
	'plugins', //page type - on which admin tab to display
	'adminMenu' //main function (administration)
);

// Add menu item Plugins > Remove Action
add_action('plugins-sidebar','createSideMenu',array($thisfile,'Remove Action'));

/**
 * Content for Plugins > Remove Action page
 */
function adminMenu() {

	echo '<h3>Remove Action</h3>';
	echo '<p>To remove a registered action, use the following code:</p>';
	echo '<div class="h5"><code>remove_action($hook, $function, $file);</code></div>';
}

/**
 * Add action to unregister action
 * 
 * The actual unregistering of an action must be performed at the very end
 * otherwise we may try to unregister an action which hasn't registered yet!
 * 
 * Therefore, to remove an action we must register an action, and it is possible
 * for this plugin to commit suicide by registering and unregistering itself!
 * 
 * @param string $hook The hook to which the action is attached
 * @param string $function The name of the function attached to the hook
 * @param string $file The name of the file which added the action
 */
function remove_action($hook, $function, $file) {
	add_action($hook, 'unregister_action', array($hook, $function, $file));
}

/**
 * Performs the unregistering of the action
 * Called by remove_action
 * 
 * @param string $targetHook The hook to which the action is attached
 * @param string $function The name of the function attached to the hook
 * @param string $file The name of the file which added the action
 */
function unregister_action($targetHook, $function, $file) {
	global $plugins;

	foreach ($plugins as $key => $registeredHook) {
		if ($registeredHook['hook'] == $targetHook && $registeredHook['function'] == $function && $registeredHook['file'] == $file) {
			unset($plugins[$key]);
			echo '<b>'.$key.' | '.$registeredHook['hook'].' | '.$registeredHook['function'].' | '.$registeredHook['file'].'</b>';
		}
	}
}

?>