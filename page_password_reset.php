<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])){

    header("Location: page_login.php?error=Please login to access protected areas");

}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <style>
        <?php if ($_SESSION['type'] == "2"):?>
            .admin {
                visibility: visible;
            }
        <?php endif; ?>
        <?php if ($_SESSION['newCar'] == "yes"):?>
            .hidden {
                visibility: visible;
            }
        <?php endif; ?>
        {}
        @media screen and (max-width: 1130px){
            img#logo {
                display: none;
            }
            img#logo_tiny {
                visibility: visible;
                padding: 15px;
            }
            nav {
                width: 100%;
                height: auto;
            }
            img#logo_tiny {
                padding: 5px;
            }
            footer p {
                display: none;
            }
        }
    </style>
    <title>Password Reset</title>
</head>
<body style="background-color: whitesmoke;">
    <div class="box">
        <div class="row header">
            <img id="logo" src="nott_police_logo.jpg" alt="Nottingham Police Logo">
            <img class="small" id="logo_tiny" src="nott_police_logo_tiny.jpg" alt="Nottingham Police Logo Tiny">
            <div class="header-right">
                <a class="admin" href="page_admin_user.php">Admin</a>
                <a class="active" href="page_home.php">Home</a>                
                <a href="script_logout.php">Logout</a>
            </div>
        </div>
        <div class="row content">
            <nav>
                <ul>
                    <li><a href="page_home.php">Log an incident</a></li>
                    <li><a href="page_search_incident.php">Incident database</a></li>
                    <li><a href="page_edit_incident.php">Edit existing incident</a></li>
                    <li><a href="page_people_db.php">People database</a></li>
                    <li><a href="page_edit_person.php">Edit existing person</a></li>
                    <li><a href="page_vehicle_db.php">Vehicle database</a></li>
                    <li><a href="page_add_vehicle.php">Register a vehicle</a></li>
                    <li><a href="page_password_reset.php">Reset your password</a></li>
                </ul>
            </nav>
            <article>
                <h1>Please enter password information here:</h1>
                <div class="grid">
                    <form action="http://mersey.cs.nott.ac.uk/~psxtt1/script_password_reset.php" method="post">
                        <label for="curPas">Current password:</label><br>
                        <input type="password" id="curPas" name="curPas" placeholder="Current password.."><br><br>
                        <label for="newPas">New password:</label><br>
                        <input type="password" id="newPas" name="newPas" placeholder="New password.."><br><br>
                        <label for="newPasCon">Confirm password:</label><br>
                        <input type="password" id="newPasCon" name="newPasCon" placeholder="New password.."><br>
                        <input class="thick" type="checkbox" onclick="showPass()"> Show Passwords<br><br>
                        <input type="submit" value="Change Password">                  

                        <?php if (isset($_GET['error'])){ ?>
                        <p class="error"><b><?php echo $_GET['error']; ?><b></p>
                        <?php } ?>
                    </form>
                </div> 
            </article>
        </div>
        <div class="row footer">
            <footer>
                <p>Contact us - Phone: 0115 967 0999 - Address: Sherwood Lodge Dr, Nottingham NG5 8PP</p>
            </footer>
        </div>
    </div>
    <script>
        function showPass() {
            var x = document.getElementById("curPas");
            var y = document.getElementById("newPas");
            var z = document.getElementById("newPasCon");
            if (x.type === "password"){
                x.type = "text";
                y.type = "text";
                z.type = "text";
            }else{
                x.type = "password";
                y.type = "password";
                z.type = "password";
            }
        }
    </script>
</body>
</html>