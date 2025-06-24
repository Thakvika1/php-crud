<?php
    $file = 'user_data.json';

    // Load existing data
    if (file_exists($file)) {
        $user_data = json_decode(file_get_contents($file), true);
    } else {
        $user_data = [];
    }

    // Delete user
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_user'])) {
        $id = $_POST['delete_user'];
        unset($user_data[$id]);
        file_put_contents($file, json_encode($user_data, JSON_PRETTY_PRINT));
    }

    // Edit user
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_name'], $_POST['new_phone'], $_POST['edit_user'])) {
        $id = $_POST['edit_user'];
        $user_data[$id] = [
            'name' => $_POST['new_name'],
            'phone' => $_POST['new_phone'],
        ];
        file_put_contents($file, json_encode($user_data, JSON_PRETTY_PRINT));
    }

    // Add user
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['phone_number'])) {
        $user_data[] = [
            'name' => $_POST['username'],
            'phone' => $_POST['phone_number'],
        ];
        file_put_contents($file, json_encode($user_data, JSON_PRETTY_PRINT));
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>User Form</title>
    </head>
    <body>
        <h2>Add User</h2>

        <!-- add user form  -->
        <form method="post">
            <input type="text" name="username" placeholder="Name" required />
            <input type="text" name="phone_number" placeholder="Phone number" required />
            <input type="submit" value="Submit" />
        </form>

        <h2>Total Users: <?= count($user_data) ?></h2>
        <?php foreach ($user_data as $index => $user): ?>
            <div style="margin-top: 10px; border: 1px solid #ccc; padding: 10px;">
                <strong>User #<?= ($index + 1) ?></strong><br>
                Name: <?= htmlspecialchars($user['name']) ?><br>
                Phone: <?= htmlspecialchars($user['phone']) ?><br>

                <!-- delete form  -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="delete_user" value="<?= $index ?>">
                    <button type="submit">Delete</button>
                </form>

                <!-- edit form  -->
                <form action="edit-form.php" method="post" style="display:inline;">
                    <input type="hidden" name="edit_user" value="<?= $index ?>">
                    <button type="submit">Edit</button>
                </form>
            </div>
        <?php endforeach; ?>
    </body>
</html>
