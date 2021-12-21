<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])){

    header("Location: page_login.php?error=Please login to access protected areas");

}
?>
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
        @media screen and (max-width: 1020px){
=======
        @media screen and (max-width: 1060px) {
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
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
<<<<<<< HEAD
        @media screen and (max-width: 1150px){
=======
        @media screen and (max-width: 1150px) {
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
            img#logo {
                display: none;
            }
            img#logo_tiny {
                visibility: visible;
                padding: 15px;
            }
        }
    </style>
    <title>Search vehicles</title>
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
function serveResults() { /// This function was found on StackExchange - I can't find the page but I don't want to be penalised for Plagiarism.
  var input, filter, table, tr, td, i, txtValue; /// I changed a few elements obviously but the core of this function is not my own work.
  input = document.getElementById("searchField");
  filter = input.value.toUpperCase();
  table = document.getElementById("resultsTable");
  tr = table.getElementsByTagName("tr");
  searchCrit = document.getElementById("searchCrit")
  for (i = 0; i < tr.length; i++){
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1){
        tr[i].style.display = "";
      }else{
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>