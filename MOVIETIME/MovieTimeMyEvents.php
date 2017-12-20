<?php
session_start();
require 'db.php';
include_once 'functions.php';
if (!isLogin()){
    header("Location: MovieTimeIndex.php");
}
$persEmail = $_SESSION['userSession'];
?>
<html>
<head>
  <title>My Events</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="MovieTime.css">
  <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container">

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#stat1Modal">
      Current ticket sales
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#stat2Modal">
      Past ticket sales & feedbacks
    </button>
    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#newModal">
      Create new event
    </button>
    <button type="button" class="btn btn-alert btn-lg"><a href="participants.php">
      Participants</a>
    </button>


    <!-- Modal that links to current ticket sales -->
    <div class="modal fade" id="stat1Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Current ticket sales</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <?php
            $sql3 = "SELECT event.event_name, event.event_date, event.event_id
                    FROM user JOIN event ON user.user_id=event.hostuser_id
                    WHERE user.email='$persEmail'AND event.event_date>=NOW()";

            $query3 = mysqli_query($con, $sql3);

            if (!$query3) {
                die ('SQL Error: ' . mysqli_error($con));
            }
            
                
            while ($row3 = mysqli_fetch_array($query3))
            {
              $ev_id=$row3['event_id'];
              $maxticket=maxTicket($ev_id);
              $row_cnt = noTicket($ev_id, ">=");
              echo "<ul>";
              echo "<li><strong>". "Event Name: ".$row3['event_name']."</strong></li>";
              echo "Event Date: ", $row3['event_date']."<br>";
              echo "Released number of tickets in total: ".$maxticket;
              echo "</br>Number of tickets sold: ".$row_cnt;
              echo "</ul>";
            }
            if (mysqli_num_rows($query3)==0){
                echo "You have no hosted events.";
            }
            ?>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal that links to past ticket sales -->
    <div class="modal fade" id="stat2Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Ticket sales history</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <?php
            $sql3 = "SELECT event.event_name, event.event_date, event.event_id
                    FROM user JOIN event ON user.user_id=event.hostuser_id
                    WHERE user.email='$persEmail'AND event.event_date<NOW()";

            $query3 = mysqli_query($con, $sql3);

            if (!$query3) {
                die ('SQL Error: ' . mysqli_error($con));
            }    
            while ($row3 = mysqli_fetch_array($query3))
            {
              $ev_id=$row3['event_id'];
              $maxticket=maxTicket($ev_id);
              $row_cnt = noTicket($ev_id, "<");
              echo "<ul>";
              echo "<li><strong>". "Event Name: ".$row3['event_name']."</strong></li>";
              echo "Event Date: ", $row3['event_date']."<br>";
              echo "Released number of tickets in total: ".$maxticket;
              echo "</br>Number of tickets sold: ".$row_cnt;
              echo "<hr>";
              echo " Feedbacks:";
              $sql5 = "SELECT   feedback.rating, feedback.notes
              FROM user JOIN event ON user.user_id=event.hostuser_id
              JOIN feedback ON event.event_id=feedback.event_id
              WHERE user.email='$persEmail'AND event.event_date<NOW() AND event.event_id='$ev_id'";
              $query5 = mysqli_query($con, $sql5);

              if (!$query5) {
                die ('SQL Error: ' . mysqli_error($con));
              }
              echo "<ol>";
              while ($row5 = mysqli_fetch_array($query5))
              {

                echo "<li>". " Rating: ", $row5['rating']."</li>";
                echo " Comment: ", $row5['notes'];
              }
              if (mysqli_num_rows($query5)==0){
                echo "There are no feedbacks for this event.";}
                echo "</ol>";
                echo "</ul>";
              }
              if (mysqli_num_rows($query3)==0){
                echo "You have no hosted events.";
              }
            ?>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal to create new event -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create new event</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <?php include 'MovieTimeCreateEvent.php'; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="partModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Participants</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <?php $persEmail=$_SESSION['userSession'];
            if(isset($_POST['part_btn']))
                {
                $event_id = $_POST["event_id"];
                $sql4 = "SELECT reservation.event_id
                    FROM reservation, event, user
                    WHERE user.email='$persEmail' AND user.user_id=event.hostuser_id AND reservation.event_id=event.event_id";

                $query4 = mysqli_query($con, $sql4);

                if (!$query4) {
                   die ('SQL Error: ' . mysqli_error($con));
                }
                $row_cnt = $query4->num_rows;
                echo "Number of participants: ".$row_cnt;
            }  ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <h1>Upcoming events that you host:</h1>
    <h2>
      <?php hostEvent($persEmail, ">="); ?>
    </h2>
    <h1> Events hosted in the past:</h1>
    <h2>
      <?php
        hostEvent($persEmail, "<");
      ?>
        </ul>
    </h2>

  </div>
  <?php include 'footer.php';?>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>
