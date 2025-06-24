<?php
  $file = 'user_data.json';
  $edit_id = $_POST['edit_user'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post" action="create-form.php">
        <input type="hidden" name="edit_user" value="<?= $edit_id ?>">
        <input type="text" name="new_name" required>
        <input type="text" name="new_phone"  required>
        <input type="submit" value="Update">
    </form>
    <a href="create-form.php">Back to list</a>
</body>
</html>
