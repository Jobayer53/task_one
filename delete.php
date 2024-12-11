<?php
require_once "db.php";
require_once "crud.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    // Establish database connection
    $database = new Database();
    $db = $database->getConnection();

    // Create CRUD instance for 'users' table
    $crud = new CRUD($db, "users");

    // Delete the user with the provided ID
    $conditions = ['id' => $userId];
    if ($crud->delete($conditions)) {
        // Redirect to the listing page with a success message
        header("Location: index.php?message=User deleted successfully");
        exit;
    } else {
        echo "Error: Could not delete the user.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
