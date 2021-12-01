<?php
    session_start();
    include "script_db_connect.php";
    if (isset($_POST['offName']) && isset($_POST['carReg']) && isset($_POST['offence']) && isset($_POST['licenseNumber'])  && isset($_POST['points']) && isset($_POST['date'])
     && isset($_POST['statement']) && isset($_POST['vehicleType'])  && isset($_POST['vehicleColour'])){
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
        $conn = OpenCon();
        $offName = validate($_POST['offName']);
        $carReg = validate($_POST['carReg']);
        $offence = validate($_POST['offence']);
        $licenseNumber = validate($_POST['licenseNumber']);
        $points = validate($_POST['points']);
        $date = validate($_POST['date']);
        $statement = validate($_POST['statement']);
        $vehicleType = validate($_POST['vehicleType']);
        $vehicleColour = validate($_POST['vehicleColour']);

        $checkPerson = "SELECT * from Person where Person_Name = '$offName' and Person_License_No = '$licenseNumber'";
        $checkCar = "SELECT * from Vehicle where Vehicle_License = '$carReg'";

        if (empty($offName) || empty($carReg) || empty($offence) || empty($licenseNumber) || empty($date) || empty($statement)){
            header("Location: page_home.php?error=Please fill out all fields");
            CloseCon($conn);
            exit();
        }else{
            $personExists = mysqli_query($conn, $checkPerson);
            $carExists = mysqli_query($conn, $checkCar);

            if (mysqli_num_rows($carExists) === 0){
                if(empty($vehicleType) || empty($vehicleColour)){
                    $_SESSION['newCar'] = "yes";
                    header("Location: page_home.php?error=Car not known - please fill out all new fields");
                    CloseCon();
                    exit();
                }else{
                    $createCar = "INSERT into Vehicle (Vehicle_License, Vehicle_Type, Vehicle_Colour) values ('$carReg', '$vehicleType', '$vehicleColour')";
                    mysqli_query($conn, $createCar);
                    $_SESSION['newCar'] = "no";
                }
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