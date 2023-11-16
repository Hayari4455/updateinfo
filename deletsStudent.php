<?php
    require_once "ex05_connectdb.php";

    if (isset($_POST['id'])) {
        $del = $_POST['id'];

        // การลบไฟล์ในโฟรเดอร์รูปใน server
        $select_stmt = $con->prepare('SELECT * FROM students WHERE id = :id');
        $select_stmt->bindParam(':id', $del);
        $select_stmt->execute();

        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // การลบข้อมูลใน DB
        unlink("upload/".$row['student_photo']); // unlink function permanently remove your file
        $sql = "DELETE FROM students where id= :id";
        $delete_stmt = $con->prepare($sql);
        $delete_stmt->bindParam(':id',$del);
        $delete_stmt->execute();
    }
?>
