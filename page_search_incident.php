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
<<<<<<< HEAD
        {}
        @media screen and (max-width: 1120px){
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
        @media screen and (max-width: 1150px){
            img#logo {
                display: none;
            }
            img#logo_tiny {
                visibility: visible;
                padding: 15px;
            }
        }
    </style>
    <title>Search Incidents</title>
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
<<<<<<< HEAD
                <h1>Search for an Incident:</h1>
=======
                <h1>Search for an existing Incident:</h1>
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
                <form>
                    <div class="grid">
                        <div>
                            <p>
                                <label for="searchField">Find:</label><br>
                                <input type="text" id="searchField" onkeyup="serveResults()" name="searchField" placeholder="...">
                            </p>                        
                        </div>
                        <div>
                            <p>
                                <label for="searchCrit">Search criteria:</label><br>
                                <select name="searchCrit" id="searchCrit">   
                                    <option value="fullName">Offendee Name</option>   
                                    <option value="regNumber">Registration Number</option>            
                                </select>
                            </p>   
                        </div>
                    </div>
                </form>
                <?php
                include 'script_db_connect.php';

                $conn = OpenCon();
<<<<<<< HEAD
                $query = "SELECT Incident.Incident_ID, Person.Person_Name, Vehicle.Vehicle_License, Offence.Offence_Description, Incident_Points_Awarded, Incident_Fine_Amount, Incident.Incident_Date from Incident 
                inner join Offence on Incident.Offence_ID = Offence.Offence_ID 
                inner join Person on Incident.Person_ID = Person.Person_ID 
                inner join Vehicle on Incident.Vehicle_ID = Vehicle.Vehicle_ID";
=======
                $query = "SELECT incident.Incident_ID, person.Person_Name, vehicle.Vehicle_License, offence.Offence_Description, Incident_Points_Awarded, Incident_Fine_Amount, incident.Incident_Date from incident 
                inner join offence on incident.Offence_ID = offence.Offence_ID 
                inner join person on incident.Person_ID = person.Person_ID 
                inner join vehicle on incident.Vehicle_ID = vehicle.Vehicle_ID";
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
                $result = mysqli_query($conn, $query)
                ?>
                <table id="resultsTable">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Registration</th>
                        <th>Offence Committed</th>
                        <th>Points</th>
                        <th>Fine</th>
                        <th>Date of incident</th>
                    </tr>
                    <?php while ($row1 = mysqli_fetch_array($result)):;?>
                    <tr>
                        <td><?php echo $row1[0];?></td>
                        <td><?php echo $row1[1];?></td>
                        <td><?php echo $row1[2];?></td>
                        <td><?php echo $row1[3];?></td>
                        <td><?php echo $row1[4];?></td>
                        <td><?php echo $row1[5];?></td>
                        <td><?php echo $row1[6];?></td>
                    </tr>
                    <?php endwhile;?>
                </table>
<<<<<<< HEAD
                <?php if (mysqli_num_rows($result) == 0):;?>
                <p><?php echo "No results to display";?></p>
                <?php endif;?>
=======
                <?php while (mysqli_num_rows($result) == 0):;?>
                <p><?php echo "Fuck this";?></p>
                <?php endwhile;?>
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
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
<<<<<<< HEAD
  if (searchCrit.value == "fullName"){
      column = 1;
=======
  if (searchCrit.value == "fullName") {
      column = 1;
  }
  if (searchCrit.value == "regNumber") {
      column = 2;
>>>>>>> 8ee6a638c529b8586c36a09480b44f8ac1fbe76c
  }
  if (searchCrit.value == "regNumber"){
      column = 2;
  }
  for (i = 0; i < tr.length; i++){
    td = tr[i].getElementsByTagName("td")[column];
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