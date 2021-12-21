<?php

<<<<<<< HEAD
function OpenCon(){
    $dbhost = "mysql.cs.nott.ac.uk";
    $dbuser = "psxtt1";
    $dbpass = "SIXFTN";
    $db = "psxtt1";
    $port = "3306";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);
=======
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "cw2";
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
 
    return $conn;
}
 
function CloseCon($conn){
    $conn -> close();
}

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace('\'', '', $data);
    return $data;
}
?>