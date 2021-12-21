<?php
session_start();
<<<<<<< HEAD
if (isset($_POST['incidentId'])){
    if (empty($_POST['incidentId'])){
        $_SESSION['incidentId'] = NULL;
        $_SESSION['personIdI'] = NULL;
        $_SESSION['offenceIdI'] = NULL;
=======
if (isset($_POST['incidentId'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('\'', '', $data);
        return $data;
    }
    if (empty($_POST['incidentId'])) {
        header("Location: page_edit_incident.php?error=Please enter an Incident ID");
        $_SESSION['incidentId'] = NULL;
        $_SESSION['personIdI'] = NULL;
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
        $_SESSION['offNameI'] = NULL;
        $_SESSION['pointsI'] = NULL;
        $_SESSION['pointsOLD'] = NULL;
        $_SESSION['fineI'] = NULL;
        $_SESSION['statementI'] = NULL;
<<<<<<< HEAD
        header("Location: page_edit_incident.php?error=Please enter an Incident ID");
=======
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
<<<<<<< HEAD
        $query = "SELECT Person.Person_ID, Person.Person_Name, Offence_ID, Incident_Points_Awarded, Incident_Fine_Amount, Incident_Statement from Incident
=======
        $query = "SELECT Person.Person_ID, Person.Person_Name, Incident_Points_Awarded, Incident_Fine_Amount, Incident_Statement from Incident
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
        inner join Person on Incident.Person_ID = Person.Person_ID
        where Incident_ID = {$_POST['incidentId']}";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['incidentId'] = $_POST['incidentId'];
            $_SESSION['personIdI'] = $row['Person_ID'];
<<<<<<< HEAD
            $_SESSION['offenceIdI'] = $row['Offence_ID'];
=======
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
            $_SESSION['offNameI'] = $row['Person_Name'];
            $_SESSION['pointsI'] = $row['Incident_Points_Awarded'];
            $_SESSION['pointsOLD'] = $row['Incident_Points_Awarded'];
            $_SESSION['fineI'] = $row['Incident_Fine_Amount'];           
            $_SESSION['statementI'] = $row['Incident_Statement'];
            header("Location: page_edit_incident.php?error=Incident found");
            CloseCon();
            exit();
        }else{
            $_SESSION['incidentId'] = NULL;
            $_SESSION['personIdI'] = NULL;
<<<<<<< HEAD
            $_SESSION['offenceIdI'] = NULL;
=======
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
            $_SESSION['offNameI'] = NULL;
            $_SESSION['pointsI'] = NULL;
            $_SESSION['pointsOLD'] = NULL;
            $_SESSION['fineI'] = NULL;
            $_SESSION['statementI'] = NULL;
<<<<<<< HEAD
            header("Location: page_edit_incident.php?error=Incident not found");
=======
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
            CloseCon();
            exit();
        }
    }
}else{
    header("Location: page_edit_incident.php");
    exit();
}
?>