<?php
session_start();
if (isset($_POST['licenseNumber']) && isset($_POST['dob']) && isset($_POST['address'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('\'', '', $data);
        return $data;
    }
    if (empty($_POST['licenseNumber'])) {
        header("Location: page_edit_person.php?error=Cannot submit with no licenseNumber");
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
        $query = "UPDATE person set Person_License_No = '{$_POST['licenseNumber']}', Person_DOB = '{$_POST['dob']}'
        , Person_Address = '{$_POST['address']}' where Person_ID = '{$_SESSION['personId']}'";

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
}
?>