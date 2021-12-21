<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])){

    header("Location: page_login.php?error=Please login to access protected areas");

}if (!isset($_SESSION['offNameH'])){
    $_SESSION['offNameH'] = NULL;
}if (!isset($_SESSION['carRegH'])){
    $_SESSION['carRegH'] = NULL;
}if (!isset($_SESSION['licenseNumberH'])){
    $_SESSION['licenseNumberH'] = NULL;
}if (!isset($_SESSION['pointsH'])){
    $_SESSION['pointsH'] = NULL;
}if (!isset($_SESSION['dateH'])){
    $_SESSION['dateH'] = NULL;
}if (!isset($_SESSION['statementH'])){
    $_SESSION['statementH'] = NULL;
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
    <title>Log an Incident</title>
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
                <h1>Log a new Incident here:</h1>
                <form action="http://mersey.cs.nott.ac.uk/~psxtt1/script_incident.php" method="post">
                    <div class="grid">
                        <div>
                            <p>
                                <label for="offName">Offendee Name:</label><br>
                                <input type="text" id="offName" name="offName" placeholder="Paul Scholes.." value="<?php echo htmlspecialchars($_SESSION['offNameH'])?>">
                            </p>                        
                        </div>
                        <div>
                            <p>
                                <label for="carReg">Vehicle Registration:</label><br>
                                <input type="text" id="carReg" name="carReg" placeholder="AE15 K7Y.." value="<?php echo htmlspecialchars($_SESSION['carRegH'])?>">
                            </p>
                        </div>
                        <div>
                            <p>
                                <label for="offence">Offence:</label><br>
                                <select name="offence" id="offence">   
                                    <option value="1">Speeding</option>   
                                    <option value="2">Motorway Speeding</option>  
                                    <option value="3">Seat belt offence</option>  
                                    <option value="4">Illegal parking</option>  
                                    <option value="5">Drink driving</option>  
                                    <option value="6">Unlicensed driving</option>  
                                    <option value="7">Traffic light offence</option>  
                                    <option value="8">Pavement cycling</option>  
                                    <option value="9">Failure to control vehicle</option>  
                                    <option value="10">Dangerous driving</option>  
                                    <option value="11">Careless driving</option>  
                                    <option value="12">Dangerous cycling</option>           
                                </select>
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="licenseNumber">License Number:</label><br>
                                <input type="text" id="licenseNumber" name="licenseNumber" placeholder="SCHOL27278320423.." value="<?php echo htmlspecialchars($_SESSION['licenseNumberH'])?>">
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="points">Points Awarded:</label><br>
                                <input type="number" id="points" name="points" value="0" max="11" value="<?php echo htmlspecialchars($_SESSION['pointsH'])?>">
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="date">Date:</label><br>
                                <input type="datetime-local" id="date" name="date" width="120px" value="<?php echo htmlspecialchars($_SESSION['dateH'])?>">
                            </p>                            
                        </div>
                    </div>
                    <p>
                        <label for="">Officer Statement:</label><br>
                        <textarea class="noResize" id="statement" name="statement" placeholder="Spat in my cereal.." cols="85" rows="12"><?php echo htmlspecialchars($_SESSION['statementH'])?></textarea>
                    </p>
                    <div>
                        <?php if (isset($_GET['error'])){ ?>
                        <p class="error"><b><?php echo $_GET['error']; ?><b></p>
                        <?php } ?> 
                        <p>
                            <input type="submit" id="logInc" value="Log Incident">       
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