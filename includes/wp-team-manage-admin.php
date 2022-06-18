<?php

// // additional functions

// add the admin menu
function wp_team_manage_admin_menu()
{
    add_menu_page('WP Team Manage', 'Wp Team Manage', 'manage_options', 'wp-team-manage', 'wp_team_manage_admin_page', 'dashicons-groups');

    add_submenu_page('wp-team-manage', 'WP Team Manage', 'Team', 'manage_options', 'wp-team-manage', 'wp_team_manage_admin_page');
    add_submenu_page('wp-team-manage', 'WP Team Manage', 'Category', 'manage_options', 'wp-team-manage-category', 'wp_team_manage_category_admin_page');
    add_submenu_page('wp-team-manage', 'WP Team Manage', 'Add Category', 'manage_options', 'wp-team-add-category', 'wp_team_manage_category_add_page');
}


// add the admin menu
add_action('admin_menu', 'wp_team_manage_admin_menu');
