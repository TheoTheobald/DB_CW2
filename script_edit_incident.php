<?php
session_start();
if (isset($_POST['points']) && isset($_POST['fine']) && isset($_POST['statement'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (empty($_POST['statement'])) {
        header("Location: page_edit_incident.php?error=Cannot submit a blank statement");
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();
    
        $query = "UPDATE incident set incident_statement = '{$_POST['statement']}', Incident_Points_Awarded = '{$_POST['points']}'
        , Incident_Fine_Amount = '{$_POST['fine']}' where Incident_ID = '{$_SESSION['incidentId']}'";

        if(mysqli_query($conn, $query)){
            $_SESSION['incidentId'] = NULL;
            $_SESSION['offName'] = NULL;
            $_SESSION['points'] = NULL;
            $_SESSION['fine'] = NULL;
            $_SESSION['statement'] = NULL;
            header("Location: page_edit_incident.php?error=Incident changes committed");
            CloseCon();
            exit();
        }else{
            header("Location: page_edit_incident.php?error=Failed to commit to the database");
            CloseCon();
            exit();
        }
    }
}
?>