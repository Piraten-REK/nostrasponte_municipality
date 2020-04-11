<?php

/**
 * @package nostrasponte_municipality
 */

/**
 * Admin initialization
 * @since 1.1.0
 */
function nsm_admin_init() {
	include('columns.php');

	add_filter('manage_posts_columns', 'nsm_add_new_post_columns');
	add_action('manage_posts_custom_column', 'nsm_manage_post_columns', 10, 2);
}
