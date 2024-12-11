<?php
require_once "db.php";
require_once "crud.php";
$database = new Database();
$db = $database->getConnection();
$crud = new CRUD($db, "users");


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    $user = $crud->read(['id' => $userId]);
    if (empty($user)) {
        die("User not found.");
    }
    $user = $user[0]; 
} else {
    die("Invalid request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];


    $updateData = ['name' => $name, 'email' => $email];
    $conditions = ['id' => $userId];

    if ($crud->update($updateData, $conditions)) {
        header("Location: index.php?message=User updated successfully");
        exit;
    } else {
        echo "Error: Could not update the user.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
