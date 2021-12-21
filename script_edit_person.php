<?php
session_start();
if (isset($_POST['licenseNumber']) && isset($_POST['name']) && isset($_POST['address'])){

    include "script_db_connect.php";
    $licenseNumber = validate($_POST['licenseNumber']);
    $name = validate($_POST['name']);
    $address = validate($_POST['address']);

    if (empty($licenseNumber])){
        header("Location: page_edit_person.php?error=Cannot submit with no licenseNumber");
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
        $query = "UPDATE Person set Person_License_No = '$licenseNumber', Person_Name = '$name', 
        Person_Address = '$address' where Person_ID = '{$_SESSION['personId']}'";

        if(mysqli_query($conn, $query)){
            $_SESSION['personId'] = NULL;
            $_SESSION['nameP'] = NULL;
            $_SESSION['licenseNumberP'] = NULL;
            $_SESSION['dobP'] = NULL;
            $_SESSION['addressP'] = NULL;
            header("Location: page_edit_person.php?error=Person changes committed");
            CloseCon();
            exit();
        }else{
            header("Location: page_edit_person.php?error=Failed to commit to the database");
            CloseCon();
            exit();
        }
    }
}else{
    header("Location: page_edit_person.php");
    exit();
}
?>