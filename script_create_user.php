<?php
session_start();
if (isset($_POST['fullName']) && isset($_POST['DOB']) && isset($_POST['type']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordCon'])){

    include "script_db_connect.php";
    $conn = OpenCon();

    $fullName = validate($_POST['fullName']);
    $_SESSION['fullNameO'] = $fullName;
    $dob = validate($_POST['DOB']);
    $_SESSION['DOBO'] = $dob;
    $type = validate($_POST['type']);
    $_SESSION['typeO'] = $type;
    $username = validate($_POST['username']);
    $_SESSION['usernameO'] = $username;
    $password = validate($_POST['password']);
    $_SESSION['passwordO'] = $password;
    $passwordCon = validate($_POST['passwordCon']);
    $_SESSION['passwordConO'] = $passwordCon;

    if ($_POST['password'] != $_POST['passwordCon']){
        header("Location: page_admin_user.php?error=Passwords don't match");
        CloseCon();
        exit();
    }else{
        $query = "INSERT into Officer (Officer_Name, Officer_DOB, Officer_Username, Officer_Password, Officer_Type)
        values ('$fullName', '$dob', '$username', '$password', '$type')";

        if (mysqli_query($conn, $query)){
            $_SESSION['fullNameO'] = NULL;
            $_SESSION['DOBO'] = NULL;
            $_SESSION['typeO'] = NULL;
            $_SESSION['usernameO'] = NULL;
            $_SESSION['passwordO'] = NULL;
            $_SESSION['passwordConO'] = NULL;
            header("Location: page_admin_user.php?error=User created");
            CloseCon();
            exit();
        }else{
            header("Location: page_admin_user.php?error=Error committing to database");
            CloseCon();
            exit();
        }
    }
}else{
    header("Location: page_admin_user.php");
    exit();
}?>