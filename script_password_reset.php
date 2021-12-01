<?php
session_start();
if (isset($_POST['curPas']) && isset($_POST['newPas']) && isset($_POST['newPasCon'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
}
if ($_POST['newPas'] != $_POST['newPasCon']){
    header("Location: page_password_reset.php?error=Passwords don't match");
    CloseCon();
    exit();
}
include "script_db_connect.php";
$conn = OpenCon();

$query = "UPDATE Officer set Officer_Password = '{$_POST['newPas']}' where Officer_Name = '{$_SESSION['username']}' and Officer_Password = '{$_POST['curPas']}'";

if (mysqli_query($conn, $query)){
    header("Location: page_password_reset.php?error=Password reset.");
    CloseCon();
    exit();
}else{
    header("Location: page_password_reset.php?error=Current password doesn't match, please try again");
    CloseCon();
    exit();
}
?>