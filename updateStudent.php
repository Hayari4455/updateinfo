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
    <h3 class="mt-1" >เเก้ไขข้อมูลนักศึกษา</h3>
    <hr>
   

    <?php
            // ดึงข้อมูลเดิมจากฐานข้อมูล
            $id = $_POST['student_id']; // หรือใช้ POST ตามการส่งข้อมูล
            // $sql = "SELECT * FROM students WHERE student_id = :student_id";
            $sql = "SELECT students.*, rooms.room_name
            FROM students
            INNER JOIN rooms ON students.room_id = rooms.room_id WHERE id = :id;
            ";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($student); // ไม่ต้องสร้างตัวแปรมารองรับ เรียกใช้ผ่านชื่อฟิลด์ได้เลย
            $imageURL = 'upload/'.$student_photo;
    ?>

    
        <form action="updateStudentScript.php" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">

        <div class="mb-2">
            <label for="studentID" class="form-label">Student ID:</label>
            <input type="text" class="form-control" name="stdID" value="<?php echo $student_id; ?>"readonly>
        </div>
        <div class="mb-2">
            <label for="fname" class="form-label">Firstname:</label>
            <input type="text" name="fname" class="form-control"value="<?php echo $student_name; ?>">
        </div>
        <div class="mb-2">
            <label for="lname" class="form-label">Lastname:</label>
            <input type="text" name="lname" class="form-control"value="<?php echo $student_surname; ?>">
        </div>
        <div class="mb-2">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="address" class="form-control"value="<?php echo $student_address; ?>">
        </div>
        <div class="mb-2">
            <label for="phone_no" class="form-label">Phone Number:</label>
            <input type="text" name="phone_no" class="form-control"value="<?php echo $student_phone; ?>">
        </div>
        

        <div class="mb-2">
            <label for="class" class="form-label">Class:</label>
    <select id="class" name="class" class="form-select">
            <?php
// เรียกข้อมูลห้องเรียนจากฐานข้อมูล
        $sql = "SELECT * FROM rooms";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // วนลูปเพื่อแสดงตัวเลือกส้าหรับห้องเรียน
        foreach ($rooms as $room) {
        $roomId = $room['room_id'];
        $roomName = $room['room_name'];
        // เช็คว่าห้องเรียนที่เลือกตรงกับข้อมูลนักเรียน
        $selected = ($student['room_id'] == $roomId) ? 'selected' : '';
        echo "<option value='$roomId' $selected>$roomName</option>";
        }
?>




    </select>
        </div>
        <div class="mb-2">
            <label for="photo_file" class="form-label">Student Photo:</label>
            <p>
        <img src="<?php echo $imageURL ?>" height="100" width="100" class="mb-2" >
        <input type="file" name="txt_file" class="form-control" value="<?php echo $student_photo; ?>">
        <p class="small"><b>Note:</b> กดปุุม "Choose File" ถ้าต้องการเลือกภาพใหม่</p>
            </p>

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