<?php

$servername="localhost";
$username="root";
$password="";
$dbname="db_39";


try{
    $con = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

   //echo "เชิ่อมต่อข้อมูลสำเร็จ";

}catch(PDOException $e){
 
    echo "เชิ่อมต่อข้อมูลผิดพลาด". $e -> getMessage();



}
?>
