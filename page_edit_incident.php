<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {

    header("Location: page_login.php?error=Please login to access protected areas");

}
if (!isset($_SESSION['offName']) || !isset($_SESSION['points']) || !isset($_SESSION['fine']) || !isset($_SESSION['statement'])){
    $_SESSION['offName'] = NULL;
    $_SESSION['points'] = NULL;
    $_SESSION['fine'] = NULL;
    $_SESSION['statement'] = NULL;
}
?>
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
            flex: 0 1 180px;
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
            grid-template-columns: repeat(3, 1fr);
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
        {}
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
    <title>Edit existing Incident</title>
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
                    <li><a href="page_search_incident.php">Search existing incidents</a></li>
                    <li><a href="page_edit_incident.php">Edit existing incident</a></li>
                    <li><a href="page_people_db.php">People database</a></li>
                    <li><a href="page_vehicle_db.php">Vehicle database</a></li>
                    <li><a href="page_add_vehicle.php">Register a vehicle</a></li>
                    <li><a href="page_password_reset.php">Reset your password</a></li>
                </ul>
            </nav>
            <article>
                <h1>Edit an existing Incident here:</h1>
                <form action="//localhost/databasescw2/script_fetch_incident.php" method="post">
                    <div class="grid">
                        <div>
                            <p>
                                <label for="incidentId">Statement ID:</label><br>
                                <input type="number" id="incidentId" name="incidentId">
                            </p>
                        </div>
                        <div>
                            <p>
                                <br>
                                <input type="submit" id="fetch" value="Fetch Incident">  
                            </p>
                        </div>
                    </div>
                </form>
                <form action="//localhost/databasescw2/script_edit_incident.php" method="post">
                    <div class="grid">
                        <div>
                            <p>
                                <label for="offName">Offendee Name:</label><br>
                                <input type="text" id="offName" name="offName"  readonly value=<?php echo htmlspecialchars($_SESSION['offName']);?>>
                            </p>                        
                        </div>
                        <div>
                            <p>
                                <label for="points">Points Awarded:</label><br>
                                <input type="number" id="points" name="points" value=<?php echo htmlspecialchars($_SESSION['points']);?> max="11">
                            </p>                            
                        </div>
                        <div class="admin">
                            <p>
                                <label for="points">Fine Given (£):</label><br>
                                <input type="number" id="fine" name="fine" value=<?php echo htmlspecialchars($_SESSION['fine']);?> max="10000">
                            </p>                            
                        </div>
                    </div>
                    <p>
                        <label for="">Officer Statement:</label><br>
                        <textarea id="statement" name="statement" cols="85" rows="12"><?php echo htmlspecialchars($_SESSION['statement']);?></textarea>
                    </p>
                    <div>
                        <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><b><?php echo $_GET['error']; ?><b></p>
                        <?php } ?> 
                        <p>
                            <input type="submit" id="commitChanges" value="Commit Changes">       
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