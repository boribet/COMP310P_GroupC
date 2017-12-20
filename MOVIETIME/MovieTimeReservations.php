<?php
session_start();
require 'db.php';
require 'functions.php';
if (!isLogin()) {
  header("Location: MovieTimeIndex.php");
}
$today=date("Y-m-d");
if(isset($_POST['btn-cancel'])) {
 $persEmail=$_SESSION['userSession'];
 $query = "DELETE FROM reservation WHERE reservation.user_id=user.user_id AND user.email='$persEmail'";
      mysqli_query($con,$query);
 $con->close();
}
?>
<html>
<head>
	<title>My reservations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MovieTime.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">

</head>
<body>
	<?php include 'navbar.php';?>

    <div class="container">

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#feedbackModal">
            Submit Feedback
        </button>

        <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mModalLabel">Submit Feedback</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <?php include 'MovieTimeFeedbackSubmission.php'; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <h1>
		  My reservations
	    </h1>
	    <h3>

        <?php
            $persEmail = $_SESSION['userSession'];
            $sql = "SELECT  event.event_id, event.event_name, event.event_date, reservation.purchase_date
            FROM user, reservation, event WHERE user.email='$persEmail' AND user.user_id=reservation.user_id
            AND reservation.event_id=event.event_id AND event.event_date>='$today'";
            $query = mysqli_query($con, $sql);

            if (!$query) {
                die ('SQL Error: ' . mysqli_error($con));
            }
            while ($row = mysqli_fetch_array($query))
            {
                echo "Event: ".$row['event_name'];
                echo "<ul>";
                echo "<li>". "Event date: ". $row['event_date'].'</li>';
                echo "<li>". "Purchase date: ".$row['purchase_date']."</li>";
                echo "</ul>".'<form method="post">
                    <input style="display:none;" name="event_id" value="'.$row["event_id"].'">
                    <button class="btn btn-danger" name=\'cancel_btn\' type=\'submit\' onclick="return confirm(\'Are you sure you want to cancel this event?\');"">Cancel</button>
                    </form>';
            }
            if (mysqli_num_rows($query)==0){
            echo "You have no reservations.";
            }
            $user_id=whichUser();
        
    		if(isset($_POST['cancel_btn']))
    		{
    			$event_id = $_POST["event_id"];
    			$query = "DELETE FROM reservation
    			WHERE user_id=$user_id AND event_id=$event_id;";
    			if ($con->query($query)){
    			$msg = "<div class='alert alert-success'>
    					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully canceled !
    				 </div>";
    			echo $msg;
    			}else {
    			     $msg = "<div class='alert alert-danger'>
    					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while canceling !
    				 </div>";
    				 echo $msg;
    			}
                header('Location: http://localhost/MOVIETIME/MovieTimeReservations.php');
    		}

        ?>
	</ul>
	</h3>
    <hr>
	<h1>
		My past events
	</h1>
    <h3>
      <?php
    $sql = "SELECT  event.event_name, event.event_date, reservation.purchase_date
    FROM user, reservation, event WHERE user.email='$persEmail' AND user.user_id=reservation.user_id
    AND reservation.event_id=event.event_id AND event.event_date<'$today'";
    $query = mysqli_query($con, $sql);

    if (!$query) {
        die ('SQL Error: ' . mysqli_error($con));
    }
    while ($row = mysqli_fetch_array($query))
    {
        echo "Event: ".$row['event_name'];
        echo "<ul>";
        echo "<li>". "Event date: ". $row['event_date'].'</li>';
        echo "<li>". "Purchase date: ".$row['purchase_date']."</li>";
        echo "</ul>";
    }
    if (mysqli_num_rows($query)==0){
            echo "You have no past reservations.";
        }
    ?>
    </h3>
</div>
<?php include 'footer.php';?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>
