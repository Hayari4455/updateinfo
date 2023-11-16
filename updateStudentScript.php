<?php
session_start(); // เริ่มหรือดึงข้อมูลเซสชัน
require_once "ex05_connectdb.php"; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

$Id = $_POST['id'];               // ดึง from
$s_id = $_POST['stdID'];
$new_fname = $_POST['fname'];
$new_lname = $_POST['lname'];
$new_address = $_POST['address'];
$new_phone = $_POST['phone_no'];
$new_class = $_POST['class'];


$sql = "SELECT students.*, rooms.room_name FROM students
INNER JOIN rooms ON students.room_id = rooms.room_id WHERE id = :id; ";
$stmt = $con->prepare($sql);
$stmt->bindParam(':id', $Id);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

extract($student); // ไม่ต้องสร้างตัวแปรมารองรับ เรียกใช้ผ่านชื่อฟิลด์ได้เลย

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{

        $image_file = $_FILES['txt_file']['name'];
        $type = $_FILES['txt_file']['type'];
        $size = $_FILES['txt_file']['size'];
        $temp = $_FILES['txt_file']['tmp_name'];
        $path = "upload/".$image_file;
        $directory = "upload/"; // set uplaod folder path for upadte time previos file remove and new file upload for next use
        if ($image_file) {
            if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                if (!file_exists($path)) { // check file not exist in your upload folder path
                    if ($size < 5000000) { // check file size 5MB
                        unlink($directory.$student['student_photo']); // unlink function remove previos file
                        move_uploaded_file($temp, 'upload/'.$image_file); // move upload file temperary directory to
        
                          // เริ่มอัพเดทข้อมูล
                        if (!isset($_SESSION['warning'])) {
                        // สร้างค้าสั่ง SQL UPDATE
                        $sql = "UPDATE students SET student_name = :n_fname, student_surname = :n_lname,
                        student_address = :n_address, student_phone = :n_phone, student_photo = :file_up, room_id = :n_room WHERE
                        id = :id";
                        $stmt = $con->prepare($sql);
                        // ผูกค่าพารามิเตอร์
                        $stmt->bindParam(':n_fname', $new_fname);
                        $stmt->bindParam(':n_lname', $new_lname);
                        $stmt->bindParam(':n_address', $new_address);
                        $stmt->bindParam(':n_phone', $new_phone);
                        $stmt->bindParam(':n_room', $new_class);
                        $stmt->bindParam(':file_up', $image_file);
                        $stmt->bindParam(':id', $Id);
                        $result=$stmt->execute();     
                        
                        // sweet alert
                         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                            if($result){
                                echo '<script>
                                setTimeout(function() {
                                Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "แก้ไขข้อมูลส้าเร็จ",
                                showConfirmButton: false,
                                timer: 1500
                                }).then(function() {
                                window.location = "showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                                }, 1000);
                                </script>';
                            }else{
                                echo '<script>
                                setTimeout(function() {
                                Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "เกิดข้อผิดพลาด",
                                showConfirmButton: false,
                                timer: 1500
                                }).then(function() {
                                window.location = "showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                                }, 1000);
                                </script>';
                            }
                        }

                    }else{
                            $_SESSION['warning'] = "Your file to large please upload 5MB size";
                            // เมื่อขนาดไฟล์เกินก้าหนด
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                            echo '<script>
                            setTimeout(function() {
                            Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "ขนาดไฟล์ใหญ่เกินกว่าก้าหนด",
                            text: "กรุณาเลือกไฟล์ไม่เกิน 5MB แล้วลองใหม่อีกครั้ง",
                            showConfirmButton: true,
                            timer: 100000
                            }).then(function() {
                            window.location = " showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                            }, 1000);
                            </script>';    
                        
                        }

                }else{
                        $_SESSION['warning'] = "File already exists... Check upload folder";
                        // เมื่อชื่อไฟล์ซ้้ากัน
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                        echo '<script>
                        setTimeout(function() {
                        Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "ชื่อไฟล์นี้มีอยู่แล้ว",
                        text: "กรุณาเปลี่ยนชื่อไฟล์แล้วลองใหม่อีกครั้ง",
                        showConfirmButton: true,
                        timer: 100000
                        }).then(function() {
                        window.location = "showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                        });
                        }, 1000);
                        </script>';
                     } 

            }else{
                    $_SESSION['warning'] = "Upload JPG, JPEG, PNG & GIF formats...";
                    // เมื่อชนิดของไฟล์ภาพไม่ถูกต้อง
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                    echo '<script>
                    setTimeout(function() {
                    Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "ชนิดไฟล์ไม่ถูกต้อง",
                    text: "กรุณาเลือกไฟล์ที่เป็นภาพ แล้วลองใหม่อีกครั้ง",
                    showConfirmButton: true,
                    timer: 100000
                    }).then(function() {
                    window.location = "showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                    });
                    }, 1000);
                    </script>';
                }

        }else{
                $image_file = $student_photo; // if you not select new image than previos image same it is it.
                // เริ่มอัพเดทข้อมูล
                if (!isset($_SESSION['warning'])) {
                        // สร้างค้าสั่ง SQL UPDATE
                        $sql = "UPDATE students SET student_name = :n_fname, student_surname = :n_lname,
                        student_address = :n_address, student_phone = :n_phone, student_photo = :file_up, room_id = :n_room WHERE
                        id = :id";
                        $stmt = $con->prepare($sql);
                        // ผูกค่าพารามิเตอร์
                        $stmt->bindParam(':n_fname', $new_fname);
                        $stmt->bindParam(':n_lname', $new_lname);
                        $stmt->bindParam(':n_address', $new_address);
                        $stmt->bindParam(':n_phone', $new_phone);
                        $stmt->bindParam(':n_room', $new_class);
                        $stmt->bindParam(':file_up', $image_file);
                        $stmt->bindParam(':id', $Id);
                        $result=$stmt->execute();
            // sweet alert
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            if($result){
                            echo '<script>
                            setTimeout(function() {
                            Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "แก้ไขข้อมูลส้าเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                            }).then(function() {
                            window.location = "showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                            });
                            }, 1000);
                            </script>';
                        }else{
                                echo '<script>
                                setTimeout(function() {
                                Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "เกิดข้อผิดพลาด",
                                showConfirmButton: false,
                                timer: 1500
                                }).then(function() {
                                window.location = "showStudent.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                                }, 1000);
                                </script>';
                            }
            }
            
        }        
        
    }catch(PDOException $e){
        echo $e->getMessage();
        }

 }
?>