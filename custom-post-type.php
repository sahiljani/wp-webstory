<?php

// assign 
add_action('init', 'create_posttype');




// functions
function create_posttype() {

    register_post_type(
        'webstory',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('webstory'),
                'singular_name' => __('webstory')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),
            'rewrite' => array('slug' => 'webstory'),
            'show_in_rest' => true,

        )
    );
}