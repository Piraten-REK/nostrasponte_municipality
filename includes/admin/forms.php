<?php

/** Adds metadata forms to the `Add new` dialog
 * @since 1.2.0
 */
function nsm_add_form_fields_new(string $taxonomy) {
    wp_enqueue_media();
	?>
	<div class="form-field term-group nsm__long-name__wrapper">
		<label for="nsm__long-name"><?php esc_html_e('Langer Name', 'nostrasponte_municipality'); ?></label>
		<input type="text" id="nsm__long-name" name="nsm__long-name" value="" placeholder="<?php echo esc_attr_x('z.B. &bdquo;Ortsgruppe Kerpen&ldquo;', 'Long Name example', 'nostrasponte_municipality'); ?>">
	</div>
    <div class="form-field term-group nsm__bg-image__wrapper">
        <label for="nsm__bg-image__btn"><?php esc_html_e('Hintergrundbild', 'nostrasponte_municipality') ?></label>
        <div class="image-preview-wrapper">
            <img src="" width="100" height="100" style="max-height: 100px; width: 100px;" id="nsm__bg-image__img">
        </div>
        <input type="button" id="nsm__bg-image__btn" class="button" value="<?php esc_attr_e('Bild hochladen', 'nostrasponte_municipality'); ?>">
        <input type="hidden" id="nsm__bg-image" name="nsm__bg-image" value="">
    </div>
	<details class="form-field term-group nsm__partners__wrapper" style="background: rgba(0,0,0,.1);padding:.4em;">
        <summary>
            <h4 id="nsm__partners__title"><?php esc_html_e('Anprechpartner', 'nostrasponte_municipality'); ?></h4>
            <p><?php esc_html_e('Hier kannst du bis zu fünf Ansprechpartner für die Kommune anlegen.', 'nostrasponte_municipality'); ?></p>
        </summary>
		<?php for ($i = 1; $i <=4; $i++) { ?>
			<h5 id="nsm__partner--<?php echo $i; ?>__title"><?php printf(esc_html_x('Ansprechpartner Nummer %d', 'Countable label for municipality partners', 'nostrasponte_municipality'), $i); ?></h5>
			<label for="nsm__partner--<?php echo $i; ?>__name"><?php echo esc_html_x('Name', 'Name of municipality partner', 'nostrasponte_municipality'); ?></label>
			<input type="text" id="nsm__partner--<?php echo $i; ?>__name" name="nsm__partner--<?php echo $i; ?>__name">
            <label for="nsm__partner--<?php echo $i; ?>__bio"><?php echo esc_html_x('Kurzbiographie', 'short bio of municipality partner', 'nostrasponte_municipality'); ?></label>
            <textarea name="nsm__partner--<?php echo $i; ?>__bio" id="nsm__partner--<?php echo $i; ?>__bio" cols="40" rows="5"></textarea>
            <label for="nsm__partner--<?php echo $i; ?>__tags"><?php echo esc_html_x('Tags', 'tags of municipality partner', 'nostrasponte_municipality'); ?></label>
            <p class="nsm__partner--<?php echo $i; ?>__tags__info">Titel oder ähnliches der Person, durch Kommata getrennt</p>
            <input type="text" id="nsm_partner--<?php echo $i; ?>__tags" name="nsm_partner--<?php echo $i; ?>__tags" placeholder="z.B. Ortsgruppensprecherin Kerpen, Stadtratsmitglied Kerpen">
            <label for="nsm__partner--<?php echo $i; ?>__avatar__btn"><?php esc_html_e('Portrait', 'nostrasponte_municipality') ?></label>
            <div class="image-preview-wrapper">
                <img src="" width="100" height="100" style="max-height: 100px; width: 100px;" id="nsm__partner--<?php echo $i; ?>__avatar__img">
            </div>
            <input type="button" id="nsm__partner--<?php echo $i; ?>__avatar__btn" class="button" value="<?php esc_attr_e('Bild hochladen', 'nostrasponte_municipality'); ?>">
            <input type="hidden" id="nsm__partner--<?php echo $i; ?>__avatar" name="nsm__partner--<?php echo $i; ?>__avatar" value="">
            <label for="nsm__partner--<?php echo $i; ?>__mail"><?php echo esc_html_x('E-Mail-Kontaktadresse', 'email address of municipality partner', 'nostrasponte_municipality'); ?></label>
            <input type="email" id="nsm__partner--<?php echo $i; ?>__mail" name="nsm__partner--<?php echo $i; ?>__mail">
		<?php } ?>
	</details>
	<?php
}

/** Adds metadata forms to the `Edit` dialog
 * @since 1.2.0
 */
function nsm_add_form_fields_edit(WP_Term $term, string $taxonomy) {
    wp_enqueue_media();
    $data = get_term_meta($term->term_id, 'municipality_data', true);
    ?>
    <table class="form-table" role="presentation">
        <tbody>
            <tr class="form-field nsm__long-name__wrapper">
                <th scope="row">
                    <label for="nsm__long-name"><?php esc_html_e('Langer Name', 'nostrasponte_municipality'); ?></label>
                </th>
                <td>
                    <input type="text" id="nsm__long-name" name="nsm__long-name" value="<?php echo esc_attr($data['long_title']); ?>" placeholder="<?php echo esc_attr_x('z.B. &bdquo;Ortsgruppe Kerpen&ldquo;', 'Long Name example', 'nostrasponte_municipality'); ?>">
                </td>
            </tr>
            <tr class="form-field term-group nsm__bg-image__wrapper">
                <th class="row">
                    <label for="nsm__bg-image__btn"><?php esc_html_e('Hintergrundbild', 'nostrasponte_municipality') ?></label>
                </th>
                <td>
                    <div class="image-preview-wrapper">
                        <img src="<?php echo esc_attr(isset($data['bg-image']) ? wp_get_attachment_url($data['bg-image']) : ''); ?>" width="100" height="100" style="max-height: 100px; width: <?php echo esc_attr(isset($data['bg-image']) ? 'auto' : '100px'); ?>;" id="nsm__bg-image__img">
                    </div>
                    <input type="button" id="nsm__bg-image__btn" class="button" value="<?php esc_attr_e('Bild hochladen', 'nostrasponte_municipality'); ?>">
                    <input type="hidden" id="nsm__bg-image" name="nsm__bg-image" value="<?php echo esc_attr($data['bg-image']); ?>">
                </td>
            </tr>
            <tr class="form-field term-group nsm__partners__wrapper">
                <th scope="row"><?php esc_html_e('Anprechpartner', 'nostrasponte_municipality'); ?></th>
                <td>
	                <?php
	                function t ($test, $html = false): string {
		                if (is_array($test)) return esc_attr(implode(', ', $test));
		                if ($html) return esc_html($test);
		                return isset($test) ? esc_attr($test) : '';
	                }
                    for ($i = 1; $i <=4; $i++) {
	                    $partner = $data['partners'][$i - 1];
                        ?>
                        <article class="nsm__partner--<?php echo $i; ?>" style="background: #fff; padding: 10px; display: flex; flex-direction: column;<?php if ($i < 5) { ?> margin-bottom: 14px;<?php } ?>">
                            <style>label[for^="nsm__partner"] { margin-top: 8px; }</style>
                            <h4 id="nsm__partner--<?php echo $i; ?>__title"><?php printf(esc_html_x('Ansprechpartner Nummer %d', 'Countable label for municipality partners', 'nostrasponte_municipality'), $i); ?></h4>
                            <label for="nsm__partner--<?php echo $i; ?>__name"><?php echo esc_html_x('Name', 'Name of municipality partner', 'nostrasponte_municipality'); ?></label>
                            <input type="text" id="nsm__partner--<?php echo $i; ?>__name" name="nsm__partner--<?php echo $i; ?>__name" value="<?php echo t($partner['name']); ?>">
                            <label for="nsm__partner--<?php echo $i; ?>__bio"><?php echo esc_html_x('Kurzbiographie', 'short bio of municipality partner', 'nostrasponte_municipality'); ?></label>
                            <textarea name="nsm__partner--<?php echo $i; ?>__bio" id="nsm__partner--<?php echo $i; ?>__bio" cols="40" rows="5"><?php echo t($partner['bio']); ?></textarea>
                            <label for="nsm__partner--<?php echo $i; ?>__tags"><?php echo esc_html_x('Tags', 'tags of municipality partner', 'nostrasponte_municipality'); ?></label>
                            <input type="text" id="nsm_partner--<?php echo $i; ?>__tags" name="nsm_partner--<?php echo $i; ?>__tags" placeholder="z.B. Ortsgruppensprecherin Kerpen, Stadtratsmitglied Kerpen" value="<?php echo t($partner['tags']); ?>">
                            <p class="nsm__partner--<?php echo $i; ?>__tags__info"><small>Titel oder ähnliches der Person, durch Kommata getrennt</small></p>
                            <label for="nsm__partner--<?php echo $i; ?>__avatar__btn"><?php esc_html_e('Portrait', 'nostrasponte_municipality') ?></label>
                            <div class="image-preview-wrapper">
                                <img src="<?php echo esc_attr(isset($partner['avatar']) ? wp_get_attachment_url($partner['avatar']) : ''); ?>" width="100" height="100" style="max-height: 100px; width: <?php echo esc_attr(isset($partner['avatar']) ? 'auto' : '100px'); ?>;" id="nsm__partner--<?php echo $i; ?>__avatar__img">
                            </div>
                            <input type="button" id="nsm__partner--<?php echo $i; ?>__avatar__btn" class="button" value="<?php esc_attr_e('Bild hochladen', 'nostrasponte_municipality'); ?>">
                            <input type="hidden" id="nsm__partner--<?php echo $i; ?>__avatar" name="nsm__partner--<?php echo $i; ?>__avatar" value="<?php echo t($partner['avatar']); ?>">
                            <label for="nsm__partner--<?php echo $i; ?>__mail"><?php echo esc_html_x('E-Mail-Kontaktadresse', 'email address of municipality partner', 'nostrasponte_municipality'); ?></label>
                            <input type="email" id="nsm__partner--<?php echo $i; ?>__mail" name="nsm__partner--<?php echo $i; ?>__mail" value="<?php echo t($partner['email']); ?>">
                        </article>
	                <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

/** Adds javascript to call the wordpress image picker
 * @since 1.2.0
 * @see nsm_add_form_fields_new
 * @see nsm_add_form_fields_edit
 */
function nsm_javascript() {
    $my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
    ?><script>
        jQuery( document ).ready( function( $ ) {

            // Uploading files
            const wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            const set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

            function mediaModal (identifier) {
                let file_frame;
                jQuery(`${identifier}__btn`).on('click', function( event ){

                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if ( file_frame ) {
                        // Set the post ID to what we want
                        file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                        // Open frame
                        file_frame.open();
                        return;
                    } else {
                        // Set the wp.media post id so the uploader grabs the ID we want when initialised
                        wp.media.model.settings.post.id = set_to_post_id;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: wp.i18n.__('Ein Bild zum Hochladen auswählen', 'nostrasponte_municipality'),
                        button: {
                            text: wp.i18n.__('Bild hochladen', 'nostrasponte_municipality'),
                        },
                        multiple: false	// Set to true to allow multiple files to be selected
                    });

                    // When an image is selected, run a callback.
                    file_frame.on( 'select', function() {
                        // We set multiple to false so only get one image from the uploader
                        const attachment = file_frame.state().get('selection').first().toJSON();

                        // Do something with attachment.id and/or attachment.url here
                        $( `${identifier}__img` ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                        $( identifier ).val( attachment.id );

                        // Restore the main post ID
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });

                    // Finally, open the modal
                    file_frame.open();
                });

                // Restore the main ID when the add media button is pressed
                jQuery( 'a.add_media' ).on( 'click', function() {
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
            }

            for (let i = 1; i <= 5; i++) mediaModal(`#nsm__partner--${i}__avatar`)

            mediaModal('#nsm__bg-image')

        });
    </script><?php
}