<?php
session_start();
include_once 'db.php';
require 'functions.php';
if (!isLogin()) {
  header("Location: MovieTimeIndex.php");
}
$sql = "SELECT hostuser_id, event_id, event_name, event_date FROM event WHERE event_date>NOW() ORDER BY event_date LIMIT 3"; //upcoming events 

$query=mysqli_query($con, $sql);

if (!$query) {
  die ('SQL Error: ' . mysqli_error($conn));
}

?>
<html>
<head>
	<title>MovieTime</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="MovieTime.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
<h1>Upcoming events</br></h1>
 
  <?php
    echo '<div class="row">';
    while ($row = mysqli_fetch_array($query))
    {
      echo '<div class="col-lg-4 col-m-4 col-sm-6" id="cont">';
      echo '<div class="thumbnail">';
      echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-q5ycEEYfK8rkFatD66BhM6nRZEkFaxv2imiIUHaJG0sn9H60" height="200" width="300">';
      echo '<p class="title">'.$row['event_name'].' '.$row['event_date'].'</p>';
      echo '<div class="overlay">';
      echo'<div class="button"><form method="post">
          <input style="display:none;" name="hostuser_id" value="'.$row["hostuser_id"].'">
          <input style="display:none;" name="event_id" value="'.$row["event_id"].'">
          <button name=\'book_btn\' type=\'submit\'" onclick="return confirm(\'Are you sure you want to book this event?\')"">BOOK</button>
          </form></div>';
      echo '</div></div></div>';
    }
    echo '</div>';
    //check the user_id of the logged in user_id
    
    $user_id = whichUser();

    //insert the new thing into reservations
    if(isset($_POST['book_btn']))
      {
        bookTicket($_POST["event_id"], $user_id, $_POST['hostuser_id']);
    }
  ?>

<style type="text/css">
#cont {
  width: 300px;
  height: 200px;
}

.overlay {
  position: absolute;
  top: 0;
  left: 15;
  width: 300px;
  height: 200px;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

#cont:hover .overlay {
  display: block;
  background: rgba(0, 0, 0, .3);
}

.title {
  position: absolute;
  width: 300px;
  left: 15;
  top: 20px;
  font-weight: 700;
  font-size: 30px;
  text-shadow: 3px 3px 2px black;
  text-align: center;
  text-transform: uppercase;
  color: white;
  z-index: 1;
  transition: top .5s ease;
}

#cont:hover .title {
  top: 0px;
}

.button {
  position: absolute;
  width: 300px;
  left:0;
  top: 150px;
  text-align: center;
  opacity: 0;
  transition: opacity .35s ease;
  background: transparent;
}

.button a {
  width: 200px;
  padding: 12px 48px;
  text-align: center;
  color: white;
  border: solid 2px white;
  z-index: 1;
}

#cont:hover .button {
  opacity: 1;
}

</style>
<?php include 'footer.php';?>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>