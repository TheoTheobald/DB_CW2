<?php
if (isset($_POST['fullName']) && isset($_POST['DOB']) && isset($_POST['type']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordCon'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } 
}

include "script_db_connect.php";
$conn = OpenCon();

if ($_POST['password'] != $_POST['passwordCon']){
    header("Location: page_admin_user.php?error=Passwords don't match");
    CloseCon();
    exit();
}else{
    $query = "INSERT into Officer (Officer_Name, Officer_DOB, Officer_Username, Officer_Password, Officer_Type)
    values ('{$_POST['fullName']}', '{$_POST['DOB']}', '{$_POST['username']}', '{$_POST['password']}', '{$_POST['type']}')";

    if (mysqli_query($conn, $query)){
        header("Location: page_admin_user.php?error=User created");
        CloseCon();
        exit();
    }else{
        header("Location: page_admin_user.php?error=Error committing to database");
        CloseCon();
        exit();
    }
}
?>