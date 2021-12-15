<?php
    session_start();
    include "script_db_connect.php";
    if (isset($_POST['offName']) && isset($_POST['carReg']) && isset($_POST['offence']) && isset($_POST['licenseNumber'])  && isset($_POST['points']) && isset($_POST['date'])
     && isset($_POST['statement'])){
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           $data = str_replace('\'', '', $data);
           return $data;
        }
        $conn = OpenCon();
        $offName = validate($_POST['offName']);
        $_SESSION['offNameH'] = $offName;
        $carReg = validate($_POST['carReg']);
        $_SESSION['carRegH'] = $carReg;
        $offence = validate($_POST['offence']);
        $licenseNumber = validate($_POST['licenseNumber']);
        $_SESSION['licenseNumberH'] = $licenseNumber;
        $points = validate($_POST['points']);
        $_SESSION['pointsH'] = $points;
        $date = validate($_POST['date']);
        $_SESSION['dateH'] = $date;
        $statement = validate($_POST['statement']);
        $_SESSION['statementH'] = $statement;

        $checkPerson = "SELECT * from Person where Person_Name = '$offName' and Person_License_No = '$licenseNumber'";
        $checkCar = "SELECT * from Vehicle where Vehicle_License = '$carReg'";

        if (empty($offName) || empty($carReg) || empty($offence) || empty($licenseNumber) || empty($date) || empty($statement)){
            if ($offence == 8 || $offence == 12){
                $_SESSION['offNameC'] = $_SESSION['offNameH'];
                $_SESSION['licenseNumberC'] = $_SESSION['licenseNumberH'];
                $_SESSION['pointsC'] = $_SESSION['pointsH'];
                $_SESSION['dateC'] = $_SESSION['dateH'];
                $_SESSION['statementC'] = $_SESSION['statementH'];
                $_SESSION['offNameH'] = NULL;
                $_SESSION['carRegH'] = NULL;
                $_SESSION['licenseNumberH'] = NULL;
                $_SESSION['pointsH'] = NULL;
                $_SESSION['dateH'] = NULL;
                $_SESSION['statementH'] = NULL;
                header("Location: page_cyclist.php?error=Please fill out all fields");
                CloseCon($conn);
                exit();
            }
            header("Location: page_home.php?error=Please fill out all fields");
            CloseCon($conn);
            exit();
        }else{
            $personExists = mysqli_query($conn, $checkPerson);
            $carExists = mysqli_query($conn, $checkCar);

            if (mysqli_num_rows($carExists) === 0){
                $_SESSION['carRegV'] = $carReg;
                $_SESSION['licenseNumberV'] = $licenseNumber;
                $_SESSION['nameV'] = $offName;
                header("Location: page_add_vehicle.php?error=Vehicle not known, please register before recording incident");
                CloseCon();
                exit();
            }
            if (mysqli_num_rows($personExists) === 0){
                $createPerson = "INSERT into Person (Person_Name, Person_License_No) values ('$offName', '$licenseNumber')";
                mysqli_query($conn, $createPerson);
            }
            $getPersonId = "SELECT Person_ID from Person where Person_Name = '$offName' and Person_License_No = '$licenseNumber'";
            $getCarId = "SELECT Vehicle_ID from Vehicle where Vehicle_License = '$carReg'";

            $personIdResult = mysqli_query($conn, $getPersonId);
            $carIdResult = mysqli_query($conn, $getCarId);

            $personRow = mysqli_fetch_assoc($personIdResult);
            $carRow = mysqli_fetch_assoc($carIdResult);
            
            $personId = $personRow['Person_ID'];
            $carId = $carRow['Vehicle_ID'];

            $checkOwnership = "SELECT * from Ownership where Person_ID = '$personId' and Vehicle_ID = '$carId'";
            $ownershipResult = mysqli_query($conn, $checkOwnership);

            if (mysqli_num_rows($ownershipResult) === 0){
                $createOwnership = "INSERT into Ownership (Person_ID, Vehicle_ID) values ('$personId', '$carId')";
                mysqli_query($conn, $createOwnership);
            }
            
            $recordIncident = "INSERT into Incident (Officer_ID, Person_ID, Vehicle_ID, Offence_ID, Incident_Points_Awarded, Incident_Date, Incident_Statement)
             values ('{$_SESSION['id']}', '$personId', '$carId', '$offence', '$points', '$date', '$statement')";

            if (mysqli_query($conn, $recordIncident)){
                $_SESSION['offNameH'] = NULL;
                $_SESSION['carRegH'] = NULL;
                $_SESSION['licenseNumberH'] = NULL;
                $_SESSION['pointsH'] = NULL;
                $_SESSION['dateH'] = NULL;
                $_SESSION['statementH'] = NULL;
                header("Location: page_home.php?error=Incident recorded");
                CloseCon();
                exit();
            }
            header("Location: page_home.php?error=Error committing to database");
            CloseCon();
            exit();
        }
    }
?>