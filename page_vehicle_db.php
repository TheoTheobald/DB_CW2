<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {

    header("Location: page_login.php?error=Please login to access protected areas");

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
        table, th, tr, td {
            border: 2px solid #6e6782;
            border-radius: 4px;
            padding: 2px;
            font-size: 18px;
        }
        table {
            background-color: #13003f;
        }
        th, tr, td {
            background-color: whitesmoke;
        }
        .box .row.footer {
            flex: 0 0 25px;
            background-color: #13003f;
            padding: 5px 75px;
            text-align: right;
            color: #8279a7;
            float: bottom;
        }
        @media screen and (max-width: 1060px) {
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
        @media screen and (max-width: 1100px) {
            img#logo {
                display: none;
            }
            img#logo_tiny {
                visibility: visible;
                padding: 15px;
            }
        }
    </style>
    <title>Search people</title>
</head>
<body style="background-color: whitesmoke;">
    <div class="box">
        <div class="row header">
            <img id="logo" src="nott_police_logo.jpg" alt="Nottingham Police Logo">
            <img class="small" id="logo_tiny" src="nott_police_logo_tiny.jpg" alt="Nottingham Police Logo Tiny">
            <div class="header-right">
                <a class="admin" href="page_admin_user.php">Admin</a>
                <a class="active" href="page_search_incident.php">Home</a>
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
                    <li><a href="page_password_reset.php">Reset your password</a></li>
                </ul>
            </nav>
            <article>
                <h1>Search for a vehicle:</h1>
                <form>
                    <div class="grid">
                        <div>
                            <p>
                                <label for="searchField">Registration Plate:</label><br>
                                <input type="text" id="searchField" onkeyup="serveResults()" name="searchField" placeholder="...">
                            </p>                        
                        </div>
                    </div>
                </form>
                <?php
                include 'script_db_connect.php';

                $conn = OpenCon();
                $query = "SELECT Vehicle_License, Vehicle_Type, Vehicle_Colour, Person.Person_Name from Vehicle 
                left join Ownership on Vehicle.Vehicle_ID = Ownership.Vehicle_ID
                left join Person on Ownership.Person_ID = Person.Person_ID";
                $result = mysqli_query($conn, $query);
                ?>
                <div class="overflow">
                    <table id="resultsTable">
                        <tr>
                            <th>Registration Plate</th>
                            <th>Vehicle Type</th>
                            <th>Vehicle Colour</th>
                            <th>Owner Name</th>
                        </tr>
                        <?php while ($row1 = mysqli_fetch_array($result)):;?>
                        <tr>
                            <td><?php echo $row1[0];?></td>
                            <td><?php echo $row1[1];?></td>
                            <td><?php echo $row1[2];?></td>
                            <td><?php echo $row1[3];?></td>
                        </tr>
                        <?php endwhile;?>
                    </table>
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
function serveResults() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchField");
  filter = input.value.toUpperCase();
  table = document.getElementById("resultsTable");
  tr = table.getElementsByTagName("tr");
  searchCrit = document.getElementById("searchCrit")
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>