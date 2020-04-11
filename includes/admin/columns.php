<?php

/**
 * @package nostrasponte_municipality
 */

/**
 * Adds a column for `municipality` to posts list
 * @param string[] $columns
 * @return string[]
 * @since 1.1.0
 */
function nsm_add_new_post_columns($columns) {
	$post_type = get_post_type();
	if ($post_type === 'post') {
		return array_merge(
			array_slice($columns, 0, -2),
			[ 'municipality' => __('Kommunen', 'nostrasponte_municipality') ],
			array_slice($columns, -2)
		);
	} else {
		return $columns;
	}
}

/**
 * Adds print logic for the `municipality` columns in posts list
 * @param string $column
 * @param int $post_id
 */
function nsm_manage_post_columns($column, $post_id) {
	switch ($column) {
		case 'municipality':
			$municipality_data = get_the_term_list($post_id, 'municipality', '', ', ');
			echo $municipality_data ? $municipality_data : '—';
			break;
		default:
			break;
	}
}