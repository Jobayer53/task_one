<?php
require_once "db.php";
require_once "crud.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    $database = new Database();
    $db = $database->getConnection();

    $crud = new CRUD($db, "users");

    $conditions = ['id' => $userId];
    if ($crud->delete($conditions)) {
        header("Location: index.php?message=User deleted successfully");
        exit;
    } else {
        echo "Error: Could not delete the user.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
