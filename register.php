<?php
session_start();
require_once 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
    .new_container{
        width : 600px;
        padding : 20px;
        border : 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
    }
   /* body{
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f5f5f5;
        height: 100vh;
    } */

</style>

</head>
<body>
<div class="new_container m-auto mt-5" >
    <h3 class="mt-4" >REGISTER</h3>
    <hr>
   
        <form action="register_db.php" method="post">

        <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>





      <div class="mb-3">
        <label for="firstname" class="form-label">Fristname</label>
        <input type="text" class="form-control" name="firstname" >
    
      </div>

      <div class="mb-3">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname" >
    
     </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" >
    
     </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" name="password" >
    
     </div>
      <div class="mb-3">
        <label for="confrim_password" class="form-label">Confirm password</label>
        <input type="text" class="form-control" name="confirm_password" >
    
     </div>


    <div class="d-grid">
      <button type="submit" class="btn btn-primary" name="register">Submit</button>
      </div>

       
   
    
    </form>
    <hr>
    <p class="text-start">เป็นสมาชิกใช่ไหม คลิกที่นี่เพื่อ <a href="signin.php">เข้าสู่ระบบ</a></p>

</div>
</body>
</html>