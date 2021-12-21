<?php
session_start();
if (isset($_POST['incidentId'])){
    if (empty($_POST['incidentId'])){
        $_SESSION['incidentId'] = NULL;
        $_SESSION['personIdI'] = NULL;
        $_SESSION['offenceIdI'] = NULL;
        $_SESSION['offNameI'] = NULL;
        $_SESSION['pointsI'] = NULL;
        $_SESSION['pointsOLD'] = NULL;
        $_SESSION['fineI'] = NULL;
        $_SESSION['statementI'] = NULL;
        header("Location: page_edit_incident.php?error=Please enter an Incident ID");
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
        $query = "SELECT Person.Person_ID, Person.Person_Name, Offence_ID, Incident_Points_Awarded, Incident_Fine_Amount, Incident_Statement from Incident
        inner join Person on Incident.Person_ID = Person.Person_ID
        where Incident_ID = {$_POST['incidentId']}";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['incidentId'] = $_POST['incidentId'];
            $_SESSION['personIdI'] = $row['Person_ID'];
            $_SESSION['offenceIdI'] = $row['Offence_ID'];
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
            $_SESSION['offenceIdI'] = NULL;
            $_SESSION['offNameI'] = NULL;
            $_SESSION['pointsI'] = NULL;
            $_SESSION['pointsOLD'] = NULL;
            $_SESSION['fineI'] = NULL;
            $_SESSION['statementI'] = NULL;
            header("Location: page_edit_incident.php?error=Incident not found");
            CloseCon();
            exit();
        }
    }
}else{
    header("Location: page_edit_incident.php");
    exit();
}
?>