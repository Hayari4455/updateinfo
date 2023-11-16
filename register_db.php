<?php
    session_start();
    require_once 'ex05_connectdb.php';

    if (isset($_POST['register'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['confirm_password'];
        $urole = 'users';
       
    //    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($c_password)){
    //     $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
    //     header("location: register.php");
      //}

    if(empty($firstname)){
              $_SESSION['error'] = 'กรุณากรอกชื่อ';
              header("location: register.php");
        }else if(empty($lastname)){
             $_SESSION['error'] = 'กรุณากรอกนามสกุล';
             header("location: register.php");
       }else if(empty($email)){
              $_SESSION['error'] = 'กรุณากรอกอีเมล';
              header("location: register.php");
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['error'] = 'รูปเเบบอีเมลไม่ถูกต้อง';
                header("location: register.php");
      
       }else if(empty($password)){
              $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
                header("location: register.php");

            }else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5 ){
                $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
                  header("location: register.php");

       }else if(empty($c_password)){
               $_SESSION['error'] = 'กรุณากรอกยืนยันรหัสผ่าน';
               header("location: register.php");
       }
       else if($password != $c_password){
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: register.php");
        }
       
       else{
       
       
                try {
                    $sql="SELECT email FROM users WHERE email = :email";
                    $check_email = $con->prepare($sql);
                $check_email->bindParam(":email", $email);
                $check_email->execute();

                if ($check_email->rowCount() > 0) {
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: register.php");
                }else if (!isset($_SESSION['error'])) {

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $con->prepare("INSERT INTO users(firstname, lastname, email, password, urole) VALUES(:firstname, :lastname, :email, :password, :urole)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: register.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: register.php");
                }
             } catch(PDOException $e) {
                echo $e->getMessage();
                }
                }
    }
?>