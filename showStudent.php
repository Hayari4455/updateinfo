<?php
    session_start();
    require_once 'ex05_connectdb.php';
    require_once 'header2.php';

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
    <title>Show Student Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="http://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="container">
    <h1>Show Studen Data</h1>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
         <a href="insertStudent.php" class="btn btn-primary">เพิ่มข้อมูล</a>
    </div>
    <hr>

    <table id="stdTable" class="table">
      <thead>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Class</th>
            <th>Teacher</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
       </thead>
         <tbody>

         <?php

            $sql = "SELECT students.*, rooms.*, teachers.*
            FROM students
            INNER JOIN rooms ON students.room_id = rooms.room_id
            INNER JOIN teachers ON rooms.teacher_id = teachers.teacher_id;
            ";
            
            $stmt=$con->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

            <?php foreach($result as $student):  
                $imageURL = 'upload/'.$student['student_photo']; ?>
            <tr>
                <td><?php echo $student['student_id'];  ?></td>
                <td><?php echo $student['student_name'];  ?></td>
                <td><?php echo $student['student_surname'];  ?></td>
                <td><?php echo $student['student_address'];  ?></td>
                <td><?php echo $student['student_phone']; ?></td>
                <td><?php echo $student['room_name']; ?></td>
                <td><?php echo $student['teacher_name']; ?></td>
                <td>
                    <img src="<?php echo $imageURL ?>" style="width: 25px;" class="card-img w-10" onclick="showImage(src)">

                </td>
                <td>
                    <form action="updateStudent.php" method="post" style="display:inline;">
                    <input type="hidden" name="student_id" value="<?php  echo $student['id'] ?>">
                    <input type="submit" name="edit" value="Edit" class="btn btn-warning">
                    </form>
                    <form action="deletsStudent.php" method="post" style="display:inline;">
                    <!-- <input type="hidden" name="student_id" value="<?php // echo $student['id'] ?>">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger"> -->

                    <button type="button" class="xxx btn btn-danger bnt-sm"
                    data-student-id="<?php echo $student['id']; ?>">Delete</button>
                    </form>
                    
                </td>
            </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
    <div>
        <a href="index.php" class="btn btn-primary">กลับหน้าหลัก</a>
    </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="http://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


  <!-- // สคริปท์สำหรับลบข้อมูลด้วย SweetAlert2 -->
  <!-- // ฟังก์ชันสำหรับแสดงกล่องยืนยัน SweetAlert2 -->

 <script>
        $(document).ready(function() {           // ใช้งาน DataTables เมื่อเว็บโหลดเสร็จแล้ว
        let table = new DataTable('#stdTable');  // เลือกตารางข้อมูลและเปิดใช้งาน DataTables
        });
    </script>

    <script>
    function showDeleteConfirmation(studentId) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใช้ยืนยัน ให้ส่งค่าฟอร์มไปยัง delete.php เพื่อลบข้อมูล
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'deletsStudent.php';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = studentId;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // แนบตัวตรวจจับเหตุการณ์คลิกกับปุ่มลบทั้งหมดที่มีคลาส deletebutton
    const deleteButtons = document.querySelectorAll('.xxx');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const studentId = button.getAttribute('data-student-id');
            showDeleteConfirmation(studentId);
        });
    });

    function showImage(src){
        Swal.fire({
          title: '',
          text: '',
          imageUrl: src,
          imageWidth: 500,
          imageHeight: 500,
          imageAlt: '',
        })
      }

</script>
</body>
</html>