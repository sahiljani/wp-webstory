<?php



add_action('admin_menu', 'register_media_selector_settings_page');

function register_media_selector_settings_page() {


    add_submenu_page(
        'edit.php?post_type=webstory',
        'Logo Selector',
        'Logo Selector',
        'manage_options',
        'logo',
        'media_selector_settings_page_callback'
    );
}

function media_selector_settings_page_callback() {

    // Save attachment ID
    if (isset($_POST['submit_image_selector']) && isset($_POST['image_attachment_id'])) :
        update_option('media_selector_attachment_id', absint($_POST['image_attachment_id']));
    endif;

    wp_enqueue_media();

?>
<div id="wpwrap" class="wrap wp-core-ui">
    <form method='post'>

        <div class='thumbnail  thumbnail image-preview-wrapper'>
            <img id='image-preview'
                src='<?php echo wp_get_attachment_url(get_option('media_selector_attachment_id'));  ?>'
                style='width:315px;'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php _e('Upload image'); ?>" />
        <input type='hidden' name='image_attachment_id' id='image_attachment_id'
            value='<?php echo get_option('media_selector_attachment_id'); ?>'>
        <input type="submit" name="submit_image_selector" value="Save" class="button-primary">
    </form>
</div>
<?php

}


add_action('admin_footer', 'media_selector_print_scripts');

function media_selector_print_scripts() {

    $my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);

?><script type='text/javascript'>
jQuery(document).ready(function($) {

    // Uploading files
    var file_frame;
    var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
    var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

    jQuery('#upload_image_button').on('click', function(event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (file_frame) {
            // Set the post ID to what we want
            file_frame.uploader.uploader.param('post_id', set_to_post_id);
            // Open frame
            file_frame.open();
            return;
        } else {
            // Set the wp.media post id so the uploader grabs the ID we want when initialised
            wp.media.model.settings.post.id = set_to_post_id;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select a image to upload',
            button: {
                text: 'Use this image',
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();

            // Do something with attachment.id and/or attachment.url here
            $('#image-preview').attr('src', attachment.url).css('width', '315px');
            $('#image_attachment_id').val(attachment.id);

            // Restore the main post ID
            wp.media.model.settings.post.id = wp_media_post_id;
        });

        // Finally, open the modal
        file_frame.open();
    });

    // Restore the main ID when the add media button is pressed
    jQuery('a.add_media').on('click', function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });
});
</script><?php
            }