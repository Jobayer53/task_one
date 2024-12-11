<?php
require_once "db.php";
require_once "crud.php";
$database = new Database();
$db = $database->getConnection();
$crud = new CRUD($db, "users");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   
    $newUser = [
        "name" => $name,
        "email" => $email,
        "password" => $password,
    ];
    if ($crud->create($newUser)) {
        header("Location:index.php");
        exit;
    } else {
        echo "Failed to add user.";
    }
}
?>
