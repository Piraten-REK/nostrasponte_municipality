<?php

/** Parses the added meta data
 * @since 1.2.0
 */
function nsm_save_term_admin (int $term_id, int $tt_id, bool $update) {
	$term = get_term($term_id, 'municipality');

	$term_data = get_term_meta( $term_id, 'municipality_data', true );
	$term_data = empty($term_data) ? [] : $term_data;
	$term_data['long_title'] = isset($term_data['long_title']) ? $term_data['long_title'] : $term->name;
	$term_data['partners'] = isset($term_data['partners']) ? $term_data['partners'] : [];

	if (isset($_POST['nsm__long-name']) && !empty($_POST['nsm__long-name'])) {
		$term_data['long_title'] = sanitize_text_field($_POST['nsm__long-name']);
	}

	$partners = [];
	$partner_default = [
		'name'      => null,
		'bio'       => null,
		'tags'      => [],
		'avatar'    => null,
		'email'     => null
	];
	for ($i = 1; $i <= 5; $i++) {

		$p = $partner_default;

		if (isset($_POST["nsm__partner--${i}__name"]) && !empty($_POST["nsm__partner--${i}__name"])) {
			$p['name'] = sanitize_text_field($_POST["nsm__partner--${i}__name"]);
		} else if (isset($term_data['partners'][$i]) && isset($term_data['partners'][$i]['name']) && !empty($term_data['partners'][$i]['name'])) {
			$p['name'] = $term_data['partners'][$i]['name'];
		}
		if (isset($_POST["nsm__partner--${i}__bio"]) && !empty($_POST["nsm__partner--${i}__bio"])) {
			$p['bio'] = sanitize_textarea_field($_POST["nsm__partner--${i}__bio"]);
		} else if (isset($term_data['partners'][$i]) && isset($term_data['partners'][$i]['bio']) && !empty($term_data['partners'][$i]['bio'])) {
			$p['bio'] = $term_data['partners'][$i]['bio'];
		}
		if (isset($_POST["nsm_partner--${i}__tags"]) && !empty($_POST["nsm_partner--${i}__tags"])) {
			$p['tags'] = preg_split('/,\s?/', sanitize_text_field($_POST["nsm_partner--${i}__tags"]));
		} else if (isset($term_data['partners'][$i]) && isset($term_data['partners'][$i]['tags']) && !empty($term_data['partners'][$i]['tags'])) {
			$p['tags'] = $term_data['partners'][$i]['tags'];
		}
		if (isset($_POST["nsm__partner--${i}__avatar"]) && !empty($_POST["nsm__partner--${i}__avatar"])) {
			$p['avatar'] = intval(sanitize_text_field($_POST["nsm__partner--${i}__avatar"]));
		} else if (isset($term_data['partners'][$i]) && isset($term_data['partners'][$i]['avatar']) && !empty($term_data['partners'][$i]['avatar'])) {
			$p['avatar'] = $term_data['partners'][$i]['avatar'];
		}
		if (isset($_POST["nsm__partner--${i}__mail"]) && !empty($_POST["nsm__partner--${i}__mail"])) {
			$p['email'] = sanitize_email($_POST["nsm__partner--${i}__mail"]);
		} else if (isset($term_data['partners'][$i]) && isset($term_data['partners'][$i]['email']) && !empty($term_data['partners'][$i]['email'])) {
			$p['email'] = $term_data['partners'][$i]['email'];
		}

		array_push($partners, $p);
	}

	if (!empty($partners)) $term_data['partners'] = $partners;

	update_term_meta($term_id, 'municipality_data', $term_data);
}