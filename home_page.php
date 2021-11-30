<?php 
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {

    header("Location: login_page.php?error=Please login to access protected areas");

}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html,
        body {
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }
        .box {
            display: flex;
            flex-flow: column;
            height: 100%;
        }
        .box .row {
            border: 0px;
        }
        .box .row.header {
            flex: 0 1 200px;
            background-color: #13003f;
        }       
        .header a {
            color: #efeef4;
            text-align: center;
            padding: 15px;
            text-decoration: none;
            font-size: 23px;
            line-height: 25px;
            border-radius: 4px;
            margin: 3px;
        }
        .header img {
            float: left;
        }
        .header img.small {
            visibility: hidden;
        }
        .header a:hover {
            background-color: #3a2c5f;
            color: white;
        }
        .header a.active{
            background-color:#8279a7;
            color: black;
        }
        .header-right {
            float: right;
            padding: 30px 15px;
        }
        .header-right a {
            font-weight: bold;
            text-align: right;
        }
        .box .row.content {
            flex: 1 1 auto;
        }
        .admin {
            visibility: hidden;
        }
        <?php if ($_SESSION['type'] == "2"):?>
            .admin {
                visibility: visible;
            }
        <?php endif; ?>
        nav {
            float: left;
            width: 330px;
            background: #060412;
            flex: 1 1 auto;
            height: 100%
        }
        nav ul {
            list-style-type: none;
            padding: 12px;
        }
        nav ul li {
            margin-bottom: 15px;
            background-color: whitesmoke;
            padding: 12px;
            border-radius: 4px;
        }
        nav ul li a {
            text-decoration: none;
            color: #060412;
            font-size: 23px;
        }
        nav ul li:hover {
            background-color: #6e6782;
        }
        nav ul li a:hover {
            color: white;
        }
        article {
            float: left;
            padding: 20px;
            color: black;
            flex: 1 1 auto;
        }
        article form label {
            font-size: 15px;
        }
        article form input {
            border: 2px solid #ccc;
            display: inline-block;
            padding: 12px 12px;
            box-sizing: border-box;
            border-radius: 4px;
            margin: 5px 0px;
            width: 220px;
            height: 45px;
        }
        .grid {
            display: grid;
            grid-gap: 12px;
            grid-template-columns: repeat(4, 1fr);
        }
        .grid div p select {
            width: 220px;
            height: 45px;    
            border: 2px solid #ccc;
            display: inline-block;
            padding: 12px 12px;
            box-sizing: border-box;
            border-radius: 4px;
            margin: 5px 0px;   
        }
        .hidden {
            visibility: hidden;
        }
        <?php if ($_SESSION['newCar'] == "yes"):?>
            .hidden {
                visibility: visible;
            }
        <?php endif; ?>
        textarea {
            resize: none;
            border-radius: 4px;
            padding: 8px 8px;
        }
        .box .row.footer {
            flex: 0 0 25px;
            background-color: #13003f;
            padding: 5px 75px;
            text-align: right;
            color: #8279a7;
            float: bottom;
        }
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
    <title>Log an Incident</title>
</head>
<body style="background-color: whitesmoke;">
    <div class="box">
        <div class="row header">
            <img id="logo" src="nott_police_logo.jpg" alt="Nottingham Police Logo">
            <img class="small" id="logo_tiny" src="nott_police_logo_tiny.jpg" alt="Nottingham Police Logo Tiny">
            <div class="header-right">
                <a class="admin" href="admin_add_user.php">Admin</a>
                <a class="active" href="home_page.php">Home</a>                
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="row content">
            <nav>
                <ul>
                    <li><a href="home_page.php">Log an incident</a></li>
                    <li><a href="incident_search.php">Search existing incidents</a></li>
                    <li><a href="edit_existing_incidents.php">Edit existing incident</a></li>
                    <li><a href="ownership.php">Vehicle owner database</a></li>
                    <li><a href="password_reset.php">Reset your password</a></li>
                </ul>
            </nav>
            <article>
                <h1>Log a new incident here:</h1>
                <form action="//localhost/databasescw2/add_incident.php" method="post">
                    <div class="grid">
                        <div>
                            <p>
                                <label for="offName">Offendee Name:</label><br>
                                <input type="text" id="offName" name="offName" placeholder="John Doe">
                            </p>                        
                        </div>
                        <div>
                            <p>
                                <label for="carReg">Car Registration:</label><br>
                                <input type="text" id="carReg" name="carReg" placeholder="AE15 K7Y">
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
                        <div class="hidden">
                            <p>
                                <label for="vehicleType">Vehicle Type:</label><br>
                                <input type="text" id="vehicleType" name="vehicleType">
                            </p>
                        </div>
                        <div>
                            <p>
                                <label for="licenseNumber">License Number:</label><br>
                                <input type="text" id="licenseNumber" name="licenseNumber">
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="points">Points Awarded:</label><br>
                                <input type="number" id="points" name="points" value="0" max="11">
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="date">Date:</label><br>
                                <input type="datetime-local" id="date" name="date" width="120px">
                            </p>                            
                        </div>
                        <div class="hidden">
                            <p>
                                <label for="vehicleColour">Vehicle Colour:</label><br>
                                <input type="text" id="vehicleColour" name="vehicleColour">
                            </p>
                        </div>
                    </div>
                    <p>
                        <label for="">Officer Statement:</label><br>
                        <textarea id="statement" name="statement" cols="85" rows="12"></textarea>
                    </p>
                    <div>
                        <?php if (isset($_GET['error'])) { ?>
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