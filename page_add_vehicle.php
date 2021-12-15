<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: page_login.php?error=Please login to access protected areas");
}
if (!isset($_SESSION['carRegV'])) {
    $_SESSION['carRegV'] = NULL;
}if (!isset($_SESSION['carTypeV'])){
    $_SESSION['carTypeV'] = NULL;
}if (!isset($_SESSION['carColV'])) {
    $_SESSION['carColV'] = NULL;
}if (!isset($_SESSION['licenseNumberV'])) {
    $_SESSION['licenseNumberV'] = NULL;
}if (!isset($_SESSION['nameV'])) {
    $_SESSION['nameV'] = NULL;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <style>
        <?php if ($_SESSION['type'] === "2"):?>
            .admin {
                visibility: visible;
            }
        <?php endif; ?>
        <?php if ($_SESSION['newPerson'] == "yes"):?>
            .hidden {
                visibility: visible;
            }
        <?php endif; ?>
        @media screen and (max-width: 1130px) {
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
    <title>Register Vehicle</title>
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
                <h1>Register a new Vehicle here:</h1>
                <form action="//localhost/databasescw2/script_add_vehicle.php" method="post">
                    <div class="grid">
                        <div>
                            <p>
                                <label for="carReg">Vehicle Registration:</label><br>
                                <input type="text" id="carReg" name="carReg" placeholder="AE15 K7Y.." value="<?php echo htmlspecialchars($_SESSION['carRegV']);?>">
                            </p>                        
                        </div>
                        <div>
                            <p>
                                <label for="carType">Vehicle Type:</label><br>
                                <input type="text" id="carType" name="carType" placeholder="Honda Civic.." value="<?php echo htmlspecialchars($_SESSION['carTypeV']);?>">
                            </p>
                        </div>
                        <div>
                            <p>
                                <label for="carCol">Vehicle Colour:</label><br>
                                <input type="text" id="carCol" name="carCol" placeholder="Navy Brown.." value="<?php echo htmlspecialchars($_SESSION['carColV']);?>">
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="licenseNumber">Driver License Number:</label><br>
                                <input type="text" id="licenseNumber" name="licenseNumber" value="<?php echo htmlspecialchars($_SESSION['licenseNumberV']);?>">
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="name">Driver Name:</label><br>
                                <input type="text" id="name" name="name" placeholder="Paul Scholes.." value="<?php echo htmlspecialchars($_SESSION['nameV']);?>">
                            </p>                            
                        </div>
                        <div class="hidden">
                            <p>
                                <label for="address">Driver Address:</label><br>
                                <input type="text" id="address" name="address">
                            </p>
                        </div>
                        <div class="hidden">
                            <p>
                                <label for="date">Date of Birth:</label><br>
                                <input type="datetime-local" id="date" name="date" width="120px">
                            </p>                            
                        </div>
                    </div>
                    <div>
                        <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><b><?php echo $_GET['error']; ?><b></p>
                        <?php } ?> 
                        <p>
                            <input type="submit" id="recordVehicle" value="Record Vehicle">       
                        </p>          
                    </div>
                </form> 
            </article>
        </div>
        <div class="row footer">
            <footer>
                <p>Contact us - Phone: 0115 967 0999 - Address: Sherwood Lodge Dr, Nottingham NG5 8PP</p>
            </footer>
        </div>
    </div>
</body>
</html>