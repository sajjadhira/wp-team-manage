<?php

// additional functions


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
