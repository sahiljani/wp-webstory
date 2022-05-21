<?php


function load_webstories_template($template) {
    global $post;

    if ('webstory' === $post->post_type && locate_template(array('webstory-template.php')) !== $template) {

        return plugin_dir_path(__FILE__) . 'webstory-template.php';
    }

    return $template;
}

add_filter('single_template', 'load_webstories_template');