<?php

// // additional functions



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
