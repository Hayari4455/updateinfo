<?php
session_start();
require_once 'ex05_connectdb.php';
require_once  'header2.php';

if (!isset($_SESSION['admin_login'])) {
$_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
header('location: signin.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert PDO by ?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5 border border-secondary rounded p-3" style="width: 600px;">
    <h3 class="mt-1" >ฟอร์มกรอกข้อมูลศึกษา</h3>
    <hr>
   
        <form action="insertStudentScript.php" method="post" enctype="multipart/form-data">
        <?php
            if(isset($_SESSION['error'])){ 
        ?>
            <div class="alert alert-danger" role="alert">
            <?php
                echo $_SESSION['error'];
                unset ($_SESSION['error']);
            ?>
</div>
            <?php
                }
            ?>

        <?php
            if(isset($_SESSION['success'])){ 
        ?>
            <div class="alert alert-success" role="alert">
            <?php
                echo $_SESSION['success'];
                unset ($_SESSION['success']);
            ?>
</div>
            <?php
                }
            ?>

        <?php
            if(isset($_SESSION['warning'])){ 
        ?>
            <div class="alert alert-warning" role="alert">
            <?php
                echo $_SESSION['warning'];
                unset ($_SESSION['warning']);
            ?>
</div>
            <?php
                }
            ?>
        <div class="mb-2">
            <label for="studentID" class="form-label">Student ID:</label>
            <input type="text" class="form-control" name="stdID" >
        </div>
        <div class="mb-2">
            <label for="fname" class="form-label">Firstname:</label>
            <input type="text" name="fname" class="form-control">
        </div>
        <div class="mb-2">
            <label for="lname" class="form-label">Lastname:</label>
            <input type="text" name="lname" class="form-control">
        </div>
        <div class="mb-2">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-2">
            <label for="phone_no" class="form-label">Phone Number:</label>
            <input type="text" name="phone_no" class="form-control">
        </div>
        

        <div class="mb-2">
            <label for="class" class="form-label">Class:</label>
            <select id="class" name="class" class="form-select">
            <?php
            $sql = "SELECT * FROM rooms";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rooms as $room) : 
        ?>
            <option value="<?php echo $room['room_id'] ?>"><?php echo $room['room_name'] ?></option>
            <?php endforeach; ?>

</select>
        </div>
        <div class="mb-2">
            <label for="photo_file" class="form-label">Student Photo:</label>
            <!-- <input type="file" name="file" class="form-control" accept="image/*"> -->
            <input type="file" name="photo_file" class="form-control streched-link" accept="image/gif, image/jpeg, 
image/png">
<p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
</div>
     
    
      <div class="d-grid">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      <div>

    </form>
    <hr>
<p class="text-end"><a href="index.php">กลับหน้าหลัก</a></p>
</div>

    
</body>
</html>