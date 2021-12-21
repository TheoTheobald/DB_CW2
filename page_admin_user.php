<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || $_SESSION['type'] === 1){

    header("Location: page_login.php?error=Please login to access protected areas");

}if (!isset($_SESSION['fullNameO'])){
    $_SESSION['fullNameO'] = NULL;
}if (!isset($_SESSION['DOBO'])){
    $_SESSION['DOBO'] = NULL;
}if (!isset($_SESSION['usernameO'])){
    $_SESSION['usernameO'] = NULL;
}if (!isset($_SESSION['passwordO'])){
    $_SESSION['passwordO'] = NULL;
}if (!isset($_SESSION['passwordConO'])){
    $_SESSION['passwordConO'] = NULL;
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
<<<<<<< HEAD
        {}
        @media screen and (max-width: 1130px){
=======
        @media screen and (max-width: 1130px) {
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
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
    <title>Create new Officer user</title>
</head>
<body style="background-color: whitesmoke;">
    <div class="box">
        <div class="row header">
            <img id="logo" src="nott_police_logo.jpg" alt="Nottingham Police Logo">
            <img class="small" id="logo_tiny" src="nott_police_logo_tiny.jpg" alt="Nottingham Police Logo Tiny">
            <div class="header-right">
                <a class="active" href="page_admin_user.php">Admin</a>
                <a href="page_home.php">Home</a>
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
                <h1>Create a new Officer user:</h1>
                <form action="http://mersey.cs.nott.ac.uk/~psxtt1/script_create_user.php" method="post">
                    <div class="grid">
                        <div>
                            <p>
                                <label for="fullName">Officer Name:</label><br>
                                <input type="text" id="fullName" name="fullName" placeholder="Bill Boggs" value="<?php echo htmlspecialchars($_SESSION['fullNameO']);?>">
                            </p>                        
                        </div>
                        <div>
                            <p>
                                <label for="DOB">Date of Birth:</label><br>
                                <input type="datetime-local" id="DOB" name="DOB" width="120px" value="<?php echo htmlspecialchars($_SESSION['DOBO']);?>">
                            </p>
                        </div>
                        <div>
                            <p>
                                <label for="type">User type:</label><br>
                                <select name="type" id="type">   
                                    <option value="1">Normal user</option>   
                                    <option value="2">Administrator</option>            
                                </select>
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="username">Username:</label><br>
                                <input type="text" id="username" name="username" placeholder="Bill Plodsley" value="<?php echo htmlspecialchars($_SESSION['usernameO']);?>"><br>
                                <input class="thick" type="checkbox" onclick="showPass()"> Show Passwords
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="password">Password:</label><br>
                                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($_SESSION['passwordO']);?>"><br>
                            </p>                            
                        </div>
                        <div>
                            <p>
                                <label for="passwordCon">Password:</label><br>
                                <input type="password" id="passwordCon" name="passwordCon" value="<?php echo htmlspecialchars($_SESSION['passwordConO']);?>">
                            </p>                            
                        </div>
                    </div>
                    <div>
                        <?php if (isset($_GET['error'])){ ?>
                        <p class="error"><b><?php echo $_GET['error']; ?><b></p>
                        <?php } ?> 
                        <p>
                            <input type="submit" id="logInc" value="Create User">       
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
    <script>
        function showPass() {
            var x = document.getElementById("password");
            var y = document.getElementById("passwordCon");
            if (x.type === "password"){
                x.type = "text";
                y.type = "text";
            }else{
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</body>
</html>