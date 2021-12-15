<?php
    session_start();
    include "script_db_connect.php";
    if (isset($_POST['carReg']) && isset($_POST['carType']) && isset($_POST['carCol']) && isset($_POST['licenseNumber'])  && isset($_POST['name']) && isset($_POST['address'])
     && isset($_POST['date'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = str_replace('\'', '', $data);
           return $data;
        }
        $conn = OpenCon();
        $carReg = validate($_POST['carReg']);
        $_SESSION['carRegV'] = $carReg;
        $carType = validate($_POST['carType']);
        $_SESSION['carTypeV'] = $carType;
        $carCol = validate($_POST['carCol']);
        $_SESSION['carColV'] = $carCol;
        $licenseNumber = validate($_POST['licenseNumber']);
        $_SESSION['licenseNumberV'] = $licenseNumber;
        $name = validate($_POST['name']);
        $_SESSION['nameV'] = $name;
        $address = validate($_POST['address']);
        $date = validate($_POST['date']);

        $checkPerson = "SELECT * from Person where Person_Name = '$name' and Person_License_No = '$licenseNumber'";

        if (empty($carReg) || empty($carType) || empty($carCol) || empty($licenseNumber) || empty($name)){
            header("Location: page_add_vehicle.php?error=Please fill out all fields");
            CloseCon($conn);
            exit();
        }else{
            $personExists = mysqli_query($conn, $checkPerson);

            if (mysqli_num_rows($personExists) === 0){
                if(empty($address) || empty($date)){
                    $_SESSION['newPerson'] = "yes";
                    header("Location: page_add_vehicle.php?error=Person not known - please fill out all new fields");
                    CloseCon();
                    exit();
                }else{
                    $createPerson = "INSERT into Person (Person_Name, Person_License_No, Person_Address, Person_DOB) 
                    values ('$name', '$licenseNumber', '$address', '$date')";
                    if (mysqli_query($conn, $createPerson)){
                        $_SESSION['newPerson'] = "no";
                    }
                }
            }

            $createCar = "INSERT into Vehicle (Vehicle_License, Vehicle_Type, Vehicle_Colour)
            values ('$carReg', '$carType', '$carCol')";

            mysqli_query($conn, $createCar);

            $getPersonId = "SELECT Person_ID from Person where Person_Name = '$name' and Person_License_No = '$licenseNumber'";
            $getCarId = "SELECT Vehicle_ID from Vehicle where Vehicle_License = '$carReg'";

            $personIdResult = mysqli_query($conn, $getPersonId);
            $carIdResult = mysqli_query($conn, $getCarId);

            $personRow = mysqli_fetch_assoc($personIdResult);
            $carRow = mysqli_fetch_assoc($carIdResult);
            
            $personId = $personRow['Person_ID'];
            $carId = $carRow['Vehicle_ID'];

            $checkOwnership = "SELECT * from Ownership where Person_ID = '$personId' and Vehicle_ID = '$carId'";
            $ownershipResult = mysqli_query($conn, $checkOwnership);

            echo $personId;
            echo $carId;
            echo mysqli_num_rows($ownershipResult);

            if (mysqli_num_rows($ownershipResult) === 0){
                $createOwnership = "INSERT into Ownership (Person_ID, Vehicle_ID) values ('$personId', '$carId')";
                mysqli_query($conn, $createOwnership);
            }
            $_SESSION['carRegV'] = NULL;
            $_SESSION['carTypeV'] = NULL;
            $_SESSION['carColV'] = NULL;
            $_SESSION['licenseNumberV'] = NULL;
            $_SESSION['nameV'] = NULL;
            header("Location: page_add_vehicle.php?error=Vehicle added to database");
            CloseCon();
            exit();
        }
    }
?>