

<?php
// Start session to use session variables
session_start();

// Get the edit user ID passed from form.php
$edit_id = $_POST['edit_user'] ?? null;

// If no ID is passed, redirect or show error
if ($edit_id === null) {
    echo "No user selected to edit.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit form</title>
  </head>
  <body>
    <form action="http://localhost/php-crud/create-form.php" method="post">
        <input type="hidden" name="edit_user" value="<?= $edit_id ?>" />
        <input type="text" name="new_name" placeholder="New name" required />
        <input type="text" name="new_phone" placeholder="New phone number" required />
        <input type="submit" value="Confirm" />
    </form>
  </body>
</html>
