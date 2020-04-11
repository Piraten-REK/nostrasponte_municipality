<?php

/**
 * @package nostrasponte_municipality
 */

/**
 * Init function that registers the `municipality` taxanomy
 * @since 1.0.0
 */
function nsm_init() {
	$labels = [
		'name'                       => _x('Kommunen', 'municipality general name', 'nostrasponte_municipality'),
		'singular_name'              => _x( 'Kommune', 'municipality singular name', 'nostrasponte_municipality' ),
		'search_items'               => __( 'Kommunen suchen', 'nostrasponte_municipality' ),
		'all_items'                  => __( 'Alle Kommunen', 'nostrasponte_municipality' ),
		'parent_item'                => __( 'Übergeornete Kommune', 'nostrasponte_municipality' ),
		'parent_item_colon'          => __( 'Übergeornete Kommune:', 'nostrasponte_municipality' ),
		'edit_item'                  => __( 'Kommune bearbeiten', 'nostrasponte_municipality' ),
		'view_item'                  => __( 'Kommune ansehen', 'nostrasponte_municipality' ),
		'update_item'                => __( 'Kommune überarbeiten', 'nostrasponte_municipality' ),
		'add_new_item'               => __( 'Neue Kommune erstellen', 'nostrasponte_municipality' ),
		'new_item_name'              => __( 'Name', 'nostrasponte_municipality' ),
		'not_found'                  => __( 'Keine Kommunen gefunden', 'nostrasponte_municipality' ),
		'no_terms'                   => __( 'Keine Kommunen', 'nostrasponte_municipality' ),
		'back_to_items'              => __( '&larr; Zurück zu den Kommunen', 'nostrasponte_municipality' )
	];
	register_taxonomy('municipality', 'post', [
		'labels' => $labels,
		'description' => __('Kommunen welche Posts und Events zugeordnet werden können', 'nostrasponte_municipality'),
		'hierarchical' => true,
		'rewrite' => ['slug' => 'kommune']
	]);
	flush_rewrite_rules();
}
