<?php
session_start();
if (isset($_POST['curPas']) && isset($_POST['newPas']) && isset($_POST['newPasCon'])){
    
    include "script_db_connect.php";
    $curPas = validate($_POST['curPas']);
    $newPas = validate($_POST['newPas']);
    $newPasCon = validate($_POST['newPasCon']);

    if ($newPas != $newPasCon){
        header("Location: page_password_reset.php?error=Passwords don't match");
        CloseCon();
        exit();
    }

    $conn = OpenCon();

    $checkOfficerPW = "SELECT Officer_Password from Officer where Officer_Username = '{$_SESSION['username']}'";

    $officerResult = mysqli_query($conn, $checkOfficerPW);

    $officerRow = mysqli_fetch_assoc($officerResult);

    $officerPW = $officerRow['Officer_Password'];

    $query = "UPDATE Officer set Officer_Password = '$newPas' where Officer_Username = '{$_SESSION['username']}' and Officer_Password = '$curPas'";

    if ($officerPW != $curPas){
        header("Location: page_password_reset.php?error=Current password doesn't match, please try again");
        CloseCon();
        exit();
    }else{
        mysqli_query($conn, $query);
        header("Location: page_password_reset.php?error=Password reset");
        CloseCon();
        exit();
    }
}else{
    header("Location: page_password_reset.php");
    exit();
}
?>