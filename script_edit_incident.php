<?php
session_start();
if (isset($_POST['points']) && isset($_POST['fine']) && isset($_POST['statement'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('\'', '', $data);
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

        $getTotalPoints = "SELECT Person_Points from Person where Person_ID = '{$_SESSION['personIdI']}'";

        $result = mysqli_query($conn, $getTotalPoints);
        $actualVal = mysqli_fetch_assoc($result);
        $oldTotal = $actualVal['Person_Points'];

        $pointsChange = $_POST['points'] - $_SESSION['pointsOLD'];

        $newTotal = $oldTotal + $pointsChange;

        $updatePoints = "UPDATE Person set Person_Points = '$newTotal' where Person_ID = '{$_SESSION['personIdI']}'";

        if(mysqli_query($conn, $query)) {
            $_SESSION['incidentId'] = NULL;
            $_SESSION['offNameI'] = NULL;
            $_SESSION['pointsI'] = NULL;
            $_SESSION['fineI'] = NULL;
            $_SESSION['statementI'] = NULL;
<<<<<<< Updated upstream
            header("Location: page_edit_incident.php?error=Incident changes committed");
            CloseCon();
            exit();
=======

            if(mysqli_query($conn, $updatePoints)) {
                $_SESSION['pointsOLD'] = NULL;
                $_SESSION['personIdI'] = NULL;
                header("Location: page_edit_incident.php?error=Incident changes committed");
                CloseCon();
                exit();
            }else{
                header("Location: page_edit_incident.php?error=Failed to update offendee points");
                CloseCon();
                exit();
            }
>>>>>>> Stashed changes
        }else{
            header("Location: page_edit_incident.php?error=Failed to record incident");
            CloseCon();
            exit();
        }
    }
}
?>