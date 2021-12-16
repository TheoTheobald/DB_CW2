<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <style>
        @media screen and (max-width: 1090px) {
            img#logo {
                display: none;
            }
            img#logo_tiny {
                visibility: visible;
                padding: 15px;
            }
        }
        @media screen and (max-width: 800px) {
            nav, article {
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
    <title>Incident Login</title>
</head>
<body style="background-color: whitesmoke;">
    <div class="box">
        <div class="row header">
            <img id="logo" src="nott_police_logo.jpg" alt="Nottingham Police Logo">
            <img class="small" id="logo_tiny" src="nott_police_logo_tiny.jpg" alt="Nottingham Police Logo Tiny">
            <div class="header-right">
                <a href="page_home.php">Home</a>
                <a class="active" href="page_login.php">Login</a>
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
                <h1>Please enter your login details here:</h1>
                <form action="//localhost/databasescw2/script_login.php" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" placeholder="Your username.."><br><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="Your password.."><br>
                    <input class="thick" type="checkbox" onclick="showPass()"> Show Password<br><br>
                    <input type="submit" value="Log in">                  

                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><b><?php echo $_GET['error']; ?><b></p>
                    <?php } ?>

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
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>