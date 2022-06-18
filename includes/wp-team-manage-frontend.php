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


function wp_team_manage_category_add_page()
{


    global $wpdb;
    if (isset($_POST['wp_team_manage_category_submit'])) {
        $table_name = $wpdb->prefix . 'team_manage_category';
        $wpdb->insert($table_name, array(
            'name' => $_POST['wp_team_manage_category_name'],
        ));
        echo '<div class="updated"><p>Category added.</p></div>';
?>
        <script>
            setTimeout(function() {
                window.location.href = '<?php echo admin_url('admin.php?page=wp-team-manage-category'); ?>';
            }, 2000);
        </script>
    <?php
    }

    ?>
    <div class="wrap">
        <div class="wp-team-manage">
            <h1>WP Team Manage</h1>

            <h2>Add Category</h2>
            <p>Add Team Category</p>

            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Name</th>
                        <td><input type="text" name="wp_team_manage_category_name" value="" size="25" placeholder="Add Team Category" /></td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" name="wp_team_manage_category_submit" class="button-primary" value="Add Category" />
                </p>
            </form>
        </div>
    </div>
<?php
}

function wp_team_manage_category_admin_page()
{

    // get the category list
    global $wpdb;
    $table_name = $wpdb->prefix . 'team_manage_category';
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap">';
    echo '<h2>WP Team Manage Category</h2>';

    echo '<p>This is the admin page.</p>';

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
