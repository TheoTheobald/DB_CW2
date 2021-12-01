<?php
    session_start();
    include "script_db_connect.php";
    if (isset($_POST['username']) && isset($_POST['password'])) {
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
        $conn = OpenCon();
        $uname = validate($_POST['username']);
        $pass = validate($_POST['password']);
        if (empty($uname)) {
            header("Location: page_login.php?error=User Name is required");
            CloseCon();
            exit();
        }else if(empty($pass)){
            header("Location: page_login.php?error=Password is required");
            CloseCon();
            exit();
        }else{
            $sql = "SELECT * from Officer where Officer_Username = '$uname'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['Officer_Password'] ===  $pass) {
                    echo "Logged in!";
                    $_SESSION['username'] = $row['Officer_Username'];
                    $_SESSION['id'] = $row['Officer_ID'];
                    $_SESSION['type'] = $row['Officer_Type'];
                    header("Location: page_home.php");
                    CloseCon();
                    exit();
                }else{
                    header("Location: page_login.php?error=Incorrect password");
                    CloseCon();
                    exit();
                }
            }else{
                header("Location: page_login.php?error=No record of that username");
                CloseCon();
                exit();
            }
        }
    }
?>