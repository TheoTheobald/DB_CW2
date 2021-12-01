<?php
session_start();
if (isset($_POST['incidentId'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (empty($_POST['incidentId'])) {
        header("Location: page_edit_incident.php?error=Please type an Incident ID");
        $_SESSION['incidentId'] = NULL;
        $_SESSION['offName'] = NULL;
        $_SESSION['points'] = NULL;
        $_SESSION['fine'] = NULL;
        $_SESSION['statement'] = NULL;
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
        $query = "SELECT Person.Person_Name, Incident_Points_Awarded, Incident_Fine_Amount, Incident_Statement from Incident
        inner join Person on Incident.Person_ID = Person.Person_ID
        where Incident_ID = {$_POST['incidentId']}";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['incidentId'] = $_POST['incidentId'];
            $_SESSION['offName'] = $row['Person_Name'];
            $_SESSION['points'] = $row['Incident_Points_Awarded'];
            $_SESSION['fine'] = $row['Incident_Fine_Amount'];
            $_SESSION['statement'] = $row['Incident_Statement'];
            header("Location: page_edit_incident.php?error=Incident found");
            CloseCon();
            exit();
        }else{
            header("Location: page_edit_incident.php?error=Incident not found");
            $_SESSION['incidentId'] = NULL;
            $_SESSION['offName'] = NULL;
            $_SESSION['points'] = NULL;
            $_SESSION['fine'] = NULL;
            $_SESSION['statement'] = NULL;
            CloseCon();
            exit();
        }
    }
}
?>