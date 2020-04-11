<?php

/**
 * Kommunen
 *
 * @package nostrasponte_municipality
 * @author Mike Kühnapfel <mailto:mike.kuehnapfel@piraten-rek.de>
 * @copyright 2020 Mike Kühnapfel
 * @license GPL-3.0-or-later
 * @version 1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Kommunen
 * Plugin URI: https://github.com/veyxos/nostrasponte-municipality
 * Description: Fügt die Taxanomy &bdquo;Kommunen&ldquo; (municipality) zu Posts hinzu
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Mike Kühnapfel
 * Author URI: mailto:mike.kuehnapfel@piraten-rek.de
 * License: GNU General Public License 3.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 * Text Domain: nostrasponte_municipality
 */

if (!function_exists('add_action')) {
	die("Hi there! I'm just a plugin not much I can do when called directly.");
}

// Includes
include('includes/activate.php');
include('includes/init.php');

// Hooks
register_activation_hook(__FILE__, 'nsm_activate_plugin');
add_action('init', 'nsm_init', 0);