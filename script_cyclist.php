<?php
    session_start();
    include "script_db_connect.php";
    if (isset($_POST['offName']) && isset($_POST['address']) && isset($_POST['offence']) && isset($_POST['licenseNumber'])  && isset($_POST['points']) && isset($_POST['date'])
     && isset($_POST['statement'])) {
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           $data = str_replace('\'', '', $data);
           return $data;
        }
        $conn = OpenCon();
        $offName = validate($_POST['offName']);
        $_SESSION['offNameC'] = $offName;
        $address = validate($_POST['address']);
        $_SESSION['addressC'] = $address;
        $offence = validate($_POST['offence']);
        $licenseNumber = validate($_POST['licenseNumber']);
        $_SESSION['licenseNumberC'] = $licenseNumber;     
        $points = validate($_POST['points']);
        $_SESSION['pointsC'] = $points;
        $date = validate($_POST['date']);
        $_SESSION['dateC'] = $date;
        $statement = validate($_POST['statement']);
        $_SESSION['statementC'] = $statement;

        if (empty($offName) || empty($offence) || empty($date) || empty($statement)) {
            header("Location: page_cyclist.php?error=Please fill out all fields");
            CloseCon($conn);
            exit();
        }
        if (empty($licenseNumber) && empty($address)) {
            header("Location: page_cyclist.php?error=Either address or license is need to identify offendee");
            CloseCon($conn);
            exit();
        }
        $searchField = $licenseNumber;
        $searchCriteria = 'Person_License_No';
        if (empty($licenseNumber)) {
            $searchField = $address;
            $searchCriteria = 'Person_Address';
        }

        $checkPerson = "SELECT * from Person where Person_Name = '$offName' and $searchCriteria = '$searchField'";
        $personExists = mysqli_query($conn, $checkPerson);

        if (mysqli_num_rows($personExists) === 0) {
            $createPerson = "INSERT into Person (Person_Name, $searchCriteria) values ('$offName', '$searchField')";
            mysqli_query($conn, $createPerson);
        }

        $getPersonId = "SELECT Person_ID from Person where Person_Name = '$offName' and $searchCriteria = '$searchField'";
        $personIdResult = mysqli_query($conn, $getPersonId);
        $personRow = mysqli_fetch_assoc($personIdResult);
        $personId = $personRow['Person_ID'];
            
        $recordIncident = "INSERT into Incident (Officer_ID, Person_ID, Offence_ID, Incident_Points_Awarded, Incident_Date, Incident_Statement)
        values ('{$_SESSION['id']}', '$personId', '$offence', '$points', '$date', '$statement')";

        if (mysqli_query($conn, $recordIncident)){
            $_SESSION['offNameC'] = NULL;
            $_SESSION['addressC'] = NULL;
            $_SESSION['licenseNumberC'] = NULL;
            $_SESSION['pointsC'] = NULL;
            $_SESSION['dateC'] = NULL;
            $_SESSION['statementC'] = NULL;
            header("Location: page_home.php?error=Incident recorded");
            CloseCon();
            exit();
        }
        header("Location: page_cyclist.php?error=Error committing to database");
        CloseCon();
        exit();
    }
?>