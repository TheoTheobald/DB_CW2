<?php
session_start();
<<<<<<< HEAD
if (isset($_POST['points']) && isset($_POST['fine']) && isset($_POST['statement'])){

    include "script_db_connect.php";
    $points = validate($_POST['points']);
    $fine = validate($_POST['fine']);
    $statement = validate($_POST['statement']);

    if (empty($statement)){
=======
if (isset($_POST['points']) && isset($_POST['fine']) && isset($_POST['statement'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('\'', '', $data);
        return $data;
    }
    if (empty($_POST['statement'])) {
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
        header("Location: page_edit_incident.php?error=Cannot submit a blank statement");
        CloseCon();
        exit();
    }else{
        include "script_db_connect.php";
        $conn = OpenCon();

        $checkMax = "SELECT Offence_Max_Fine, Offence_Max_Points from Offence where Offence_ID = '{$_SESSION['offenceIdI']}'";
        $maxResult = mysqli_query($conn, $checkMax);
        $maxRows = mysqli_fetch_assoc($maxResult);
        $maxFine = $maxRows['Offence_Max_Fine'];
        $maxPoints = $maxRows['Offence_Max_Points'];

        if ($maxPoints < $points){
            header("Location: page_edit_incident.php?error=Points exceed legal maximum for this offence");
            CloseCon($conn);
            exit();
        }elseif ($maxFine < $fine){
            header("Location: page_edit_incident.php?error=Fine exceeds legal maximum for this offence");
            CloseCon($conn);
            exit();
        }
    
        $query = "UPDATE Incident set Incident_Statement = '$statement', Incident_Points_Awarded = '$points'
        , Incident_Fine_Amount = '$fine' where Incident_ID = '{$_SESSION['incidentId']}'";

        $getTotalPoints = "SELECT Person_Points from Person where Person_ID = '{$_SESSION['personIdI']}'";

        $result = mysqli_query($conn, $getTotalPoints);
        $actualVal = mysqli_fetch_assoc($result);
        $oldTotal = $actualVal['Person_Points'];

        $pointsChange = $_POST['points'] - $_SESSION['pointsOLD'];

        $newTotal = $oldTotal + $pointsChange;

        $updatePoints = "UPDATE Person set Person_Points = '$newTotal' where Person_ID = '{$_SESSION['personIdI']}'";

        $getTotalPoints = "SELECT Person_Points from Person where Person_ID = '{$_SESSION['personIdI']}'";

        $result = mysqli_query($conn, $getTotalPoints);
        $actualVal = mysqli_fetch_assoc($result);
        $oldTotal = $actualVal['Person_Points'];

        $pointsChange = $_POST['points'] - $_SESSION['pointsOLD'];

        $newTotal = $oldTotal + $pointsChange;

        $updatePoints = "UPDATE Person set Person_Points = '$newTotal' where Person_ID = '{$_SESSION['personIdI']}'";

        if(mysqli_query($conn, $query)) {
            $_SESSION['incidentId'] = NULL;
<<<<<<< HEAD
            $_SESSION['offenceIdI'] = NULL;
=======
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
            $_SESSION['offNameI'] = NULL;
            $_SESSION['pointsI'] = NULL;
            $_SESSION['fineI'] = NULL;
            $_SESSION['statementI'] = NULL;

<<<<<<< HEAD
            if(mysqli_query($conn, $updatePoints)){
=======
            if(mysqli_query($conn, $updatePoints)) {
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
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
        }else{
            header("Location: page_edit_incident.php?error=Failed to record incident");
            CloseCon();
            exit();
        }
    }
}else{ 
    header("Location: page_edit_incident.php");
    CloseCon();
    exit();
}
?>