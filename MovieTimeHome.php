<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: index.php");
}
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "film_night";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//or die('Error connecting to MySQL server.'.
// mysql_error());

$query = "SELECT event_name, event_time FROM event ORDER BY event_time LIMIT 3";
?>
<html>
<head>
	<title>MovieTime</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MovieTime.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
<h1>Latest events</br></h1>
<h2>
<ol>
    <li>Random event 1 (2017/11/14, location: Main room)</li>
    <li>Random event 2</li>
    <li>Random event 3</li>
  </ol>
</h2>
  
<h1>Your next events</h1>
<h2>
  <ol>
    <li>Random event 1</li>
    <li>Random event 2</li>
    <li>Random event 3</li>
  </ol>
</h2>
<table class="data-table">
    <thead>
      <tr>
        <th>NAME</th>
        <th>TIME</th>
      </tr>
    </thead>
    <tbody>
    <?php
//CHECK THISSSS
    while ($row = mysqli_fetch_array($query))
    {
      echo '<tr>
          <td>'.$row['event_name'].'</td>
          <td>'.$row['event_time'].'</td>
        </tr>';
    }?>
    </tbody>
  </table>

</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>