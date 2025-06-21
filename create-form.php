

<?php
    session_start();
    

    // Initialize session data
    if (!isset($_SESSION['user_list'])) {
        $_SESSION['user_list'] = [];
    }
    if (!isset($_SESSION['user_number'])) {
        $_SESSION['user_number'] = 1;
    }


    // Handle user deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
        $delete_id = $_POST['delete_user'];
        unset($_SESSION['user_list'][$delete_id]);
    }


    // Handle user edition
    if ($_SERVER["REQUEST_METHOD"] == "POST" 
        && isset($_POST['new_name']) 
        && isset($_POST['new_phone']) 
        && isset($_POST['edit_user'])
    ) {

        $edit_id = $_POST['edit_user'];

        $_SESSION['user_list'][$edit_id] = [
            'name' => $_POST['new_name'],
            'phone' => $_POST['new_phone'],
        ];
    }

    // Handle user addition
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['phone_number'])) {
        $user_number = $_SESSION['user_number']++;

        $_SESSION['user_list'][$user_number] = [
            'name' => $_POST['username'],
            'phone' => $_POST['phone_number'],
        ];
    }


    // to clear data
    // session_destroy();

?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>User Form</title>
        </head>
        <body>

            <h2>Add User</h2>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Name" required />
                <input type="text" name="phone_number" placeholder="Phone number" required />
                <input type="submit" value="Submit" />
            </form>
            <?php

                echo "<h2>Total User List : " . count($_SESSION['user_list']) . "</h2>";
            ?>
            <?php
                foreach ($_SESSION['user_list'] as $index => $values) {
                        echo "<br />User No $index <br />";

                    foreach ($values as $key => $value) {
                        echo "$key : $value<br />";
                    }

                    echo '
                        <div class="container" style="display:flex;">
                            <form method="post" style="margin-top: 5px;">
                                <input type="hidden" name="delete_user" value="' . $index . '">
                                <button type="submit">Delete user</button>
                            </form>
                            <form action="http://localhost/php-crud/edit-form.php" method="post" style="margin-top: 5px; margin-left: 5px;">
                                <input type="hidden" name="edit_user" value="'. $index . '">
                                <button type="submit">Edit user</button>
                            </form><br />
                        </div>
                        ';
                }
            ?>
            


        </body>
    </html>
