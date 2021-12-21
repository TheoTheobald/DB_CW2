<?php
session_start();
<<<<<<< HEAD
if (isset($_POST['personId'])){
    if (empty($_POST['personId'])){
=======
if (isset($_POST['personId'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('\'', '', $data);
        return $data;
    }
    if (empty($_POST['personId'])) {
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
        header("Location: page_edit_person.php?error=Please enter a Person ID");
        $_SESSION['personId'] = NULL;
        $_SESSION['nameP'] = NULL;
        $_SESSION['licenseNumberP'] = NULL;
        $_SESSION['dobP'] = NULL;
        $_SESSION['addressP'] = NULL;
<<<<<<< HEAD
=======
        CloseCon();
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
        $query = "SELECT Person_Name, Person_License_No, Person_DOB, Person_Address from Person
        where Person_ID = {$_POST['personId']}";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['personId'] = $_POST['personId'];
            $_SESSION['nameP'] = $row['Person_Name'];
            $_SESSION['licenseNumberP'] = $row['Person_License_No'];
            $_SESSION['dobP'] = $row['Person_DOB'];
            $_SESSION['addressP'] = $row['Person_Address'];
            header("Location: page_edit_person.php?error=Person found");
            CloseCon();
            exit();
        }else{
            header("Location: page_edit_person.php?error=Person not found");
            $_SESSION['personId'] = NULL;
            $_SESSION['nameP'] = NULL;
            $_SESSION['licenseNumberP'] = NULL;
            $_SESSION['dobP'] = NULL;
            $_SESSION['addressP'] = NULL;
            CloseCon();
            exit();
        }
    }
<<<<<<< HEAD
}else{
    header("Location: page_edit_person.php");
    exit();
=======
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
}
?>