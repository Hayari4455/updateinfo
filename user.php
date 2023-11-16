<?php
    session_start();
    require_once 'ex05_connectdb.php';

    if(!isset($_SESSION['user_login'])){
        $_SESSION['error'] = 'กรุณาล็อคอินเพื่อเข้าสู่ระบบ'; 
        header('location: signin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <h1>Hello , User</h1>
    <?php
if (isset($_SESSION['user_login'])) {
$user_id = $_SESSION['user_login'];
$stmt = $con->query("SELECT * FROM users WHERE user_id = $user_id");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h3 class="mt-4">Welcome , <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h3>
    <div><a href="signout.php" class="btn btn-danger">Logout</a></div>
</body>
</html>