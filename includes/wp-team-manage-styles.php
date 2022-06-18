<?php
// adding styles

function admin_enqueue_styles_callback()
{
    // adding styles
    wp_enqueue_style('wp-team-manage-admin-style', plugins_url('/assets/css/wp-team-manage-admin.css', __DIR__));
}

add_action('admin_enqueue_scripts', "admin_enqueue_styles_callback");

// adding scripts

function admin_enqueue_scripts_callback()
{
    // adding scripts
    wp_enqueue_script('wp-team-manage-admin-script', plugins_url('/assets/js/wp-team-manage-admin.js', __DIR__));
}

add_action('admin_enqueue_scripts', "admin_enqueue_scripts_callback");
