<?php
    session_start();
    include "db_connection.php";
    if (isset($_POST['offendeeName']) && isset($_POST['carReg']) && isset($_POST['offence']) && isset($_POST['points']) && isset($_POST['date'])) && isset($_POST['statement']){
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data); // Find is removed from statement page - new page to edit existing statements must be added - admin must add fines later
           return $data;
        }
        $conn = OpenCon();
        $uname = validate($_POST['username']);
        $pass = validate($_POST['password']);
        if (empty($uname)) {
            header("Location: login_page.php?error=User Name is required");
            exit();
        }else if(empty($pass)){
            header("Location: login_page.php?error=Password is required");
            exit();
        }else{
            $sql = "select * from Officer where Officer_Username = '$uname'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['Officer_password'] ===  $pass) {
                    echo "Logged in!";
                    $_SESSION['username'] = $row['Officer_username'];
                    $_SESSION['id'] = $row['Officer_id'];
                    header("Location: incident_search.php");
                    exit();
                }else{
                    header("Location: login_page.php?error=Incorrect password");
                    exit();
                }
            }else{
                header("Location: login_page.php?error=No record of that username");
                exit();
            }
        }
    }
?>