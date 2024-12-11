<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php 
       require_once "db.php";
       require_once "crud.php";
       
       // Database connection
       $database = new Database();
       $db = $database->getConnection();
       
       // CRUD instance
       $crud = new CRUD($db, "users");
       
       // Fetch all users
       $users = $crud->read();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title text-center " >Task One (CRUD)</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" >Add User</h5>
                    </div>
                    <div class="card-body">
                        <form action="store.php" method="post" >
                            <div class="mb-3">    
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                               <button type="submit" class="btn btn-primary" >Store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" >All Users</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               <?php  if(!empty($users)){foreach($users as $key => $user){ ?>
                                    <tr>
                                        <th scope="row"><?=$key+1?></th>
                                        <td><?=$user['name']?></td> 
                                        <td><?=$user['email']?></td>
                                        <td>
                                            <a href="edit.php?id=<?=$user['id']?>" class="btn btn-success">Edit</a>    
                                            <a class="btn btn-danger del text-white" href="delete.php?id=<?=$user['id']?>">Delete</a>
                                      
                                        </td>   
                                    </tr>
                               <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
<?php
