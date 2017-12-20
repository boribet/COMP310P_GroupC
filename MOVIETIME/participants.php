<?php 
session_start();
require 'db.php';
require 'functions.php';
if (!isLogin()) {
    header("Location: MovieTimeIndex.php");
}
$user = $_SESSION['userSession'];
$sql = "SELECT event.event_name, event_id
                FROM user JOIN event ON user.user_id=event.hostuser_id
                WHERE user.email='$user'";

        $query = mysqli_query($con, $sql);

        if (!$query) {
            die ('SQL Error: ' . mysqli_error($con));
        }
?>
<html>
<head>
	<title>Participants list</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MovieTime.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
</head>
<body>
	<?php include 'navbar.php';?>
	<div class="container">
	<button type="button" class="btn btn-default btn-md">
  	<a href="MovieTimeMyEvents.php">Back to my events</a>
	</button>
	<h1>See who attends your events</h1>
	
		<form method="post">
			<span class="input-group">
        <label for="selEvent">Select Event:</label>
        <?php 
        echo '<select name="selEvent" class="form-control">';
        while ($row = mysqli_fetch_array($query))
            {echo '<option value="'.$row['event_id'].'">', $row['event_name'].'</option>';
        }
        echo '</select>';
        echo '<input style="display:none;" name="event_id" value="'.$row['event_id'].'">
          <button name=\'part_btn\' type=\'submit\' class="btn btn-danger">Submit</button>';
        ?>
        </span>
        </form>

<hr>
<h3>Participants</h3>
<h4>
<ol>
<?php 
if(isset($_POST['part_btn'])){
	$event_id = $_POST['selEvent'];
	$sql2 = "SELECT first_name, last_name, username FROM user, reservation, event
WHERE event.event_id='$event_id' AND event.event_id=reservation.event_id AND reservation.user_id=user.user_id";
$query2 = mysqli_query($con, $sql2);
while ($row2 = mysqli_fetch_array($query2))
            {echo '<li>'.$row2['first_name']." ".$row2['last_name'].'</li>';
        }
if (mysqli_num_rows($query2)==0){
    echo "There are no participants for this event.";
    }
}
?>
</ol>
</h4>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
