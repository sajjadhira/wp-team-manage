<?php
/*
Plugin Name: WP Team Manage
Plugin URI: http://inihub.com/plugins/wp-team-manage/
Description: WP Team Manage is a plugin that allows you to manage your team members.
Version: 1.0.0
Author: IniHub
Author URI: http://inihub.com
License: GPLv2 or later
Text Domain: wp-team-manage
*/


// on activation do the following (if not already done)
function wp_team_manage_activation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'team_manage';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        designation varchar(255) NOT NULL,
        image varchar(255) NOT NULL,
        description text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $table_name = $wpdb->prefix . 'team_manage_category';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// on deactivation do the following
register_activation_hook(__FILE__, 'wp_team_manage_activation');


// on deactivation do the following
function wp_team_manage_deactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'team_manage';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    $table_name = $wpdb->prefix . 'team_manage_category';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");

    // Delete plugin options
    delete_option('wp_team_manage_options');

    // Delete user meta
    delete_metadata('user', null, 'wp_team_manage_category', '', true);
    delete_metadata('user', null, 'wp_team_manage_image', '', true);
    delete_metadata('user', null, 'wp_team_manage_description', '', true);
    delete_metadata('user', null, 'wp_team_manage_designation', '', true);
    delete_metadata('user', null, 'wp_team_manage_name', '', true);
}

// on deactivation do the following
register_deactivation_hook(__FILE__, 'wp_team_manage_deactivation');


// require the files
require_once(dirname(__FILE__) . '/includes/wp-team-manage-functions.php');
require_once(dirname(__FILE__) . '/includes/wp-team-manage-admin.php');
require_once(dirname(__FILE__) . '/includes/wp-team-manage-frontend.php');



// admin page
function wp_team_manage_admin_page()
{
    echo '<div class="wrap">';
    echo '<h2>WP Team Manage</h2>';
    echo '<p>This is the admin page.</p>';
    echo '</div>';
}


function wp_team_manage_category_admin_page()
{

    global $wpdb;
    if (isset($_POST['wp_team_manage_category_submit'])) {
        $table_name = $wpdb->prefix . 'team_manage_category';
        $wpdb->insert($table_name, array(
            'name' => $_POST['wp_team_manage_category_name'],
        ));
        echo '<div class="updated"><p>Category added.</p></div>';
    }

    echo '<div class="wrap">';
    echo '<h2>WP Team Manage Category</h2>';
    echo '<h3>Add Category</h3>';
    echo '<form action="" method="post">';
    echo '<p>';
    echo '<label for="wp_team_manage_category_name">Category Name</label>';
    echo '<input type="text" name="wp_team_manage_category_name" id="wp_team_manage_category_name" />';
    echo '</p>';
    echo '<p>';
    echo '<input type="submit" name="wp_team_manage_category_submit" value="Add Category" class="btn-submit" />';
    echo '</p>';
    echo '</form>';
    echo '<p>This is the admin page.</p>';

    // get the category list
    global $wpdb;
    $table_name = $wpdb->prefix . 'team_manage_category';
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    // display the category list
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col" class="manage-column column-name column-primary">Name</th>';
    echo '<th scope="col" class="manage-column column-name">Edit</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($results as $result) {
        echo '<tr>';
        echo '<td>' . $result->name . '</td>';
        echo '<td><a href="">Update Category</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '</div>';
}

// add the admin menu
function wp_team_manage_admin_menu()
{
    add_menu_page('WP Team Manage', 'Wp Team Manage', 'manage_options', 'wp-team-manage', 'wp_team_manage_admin_page', 'dashicons-groups');

    add_submenu_page('wp-team-manage', 'WP Team Manage', 'Team', 'manage_options', 'wp-team-manage', 'wp_team_manage_admin_page');
    add_submenu_page('wp-team-manage', 'WP Team Manage', 'Category', 'manage_options', 'wp-team-manage-category', 'wp_team_manage_category_admin_page');
}


// add the admin menu
add_action('admin_menu', 'wp_team_manage_admin_menu');
