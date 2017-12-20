<?php
session_start();
function whichUser()
{
  require 'db.php';
  //check the user_id of the logged in user_id
  $user = $_SESSION['userSession'];
  $query = "SELECT user_id, email FROM user WHERE email = '$user';";
  $result = mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $user_id = $row['user_id'];
  return $user_id;
}
  function isLogin()
{
	if(!isset($_SESSION['userSession']) || $_SESSION['userSession']=='')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function hostEvent($persEmail, $relation){
		require 'db.php';
		$string="event.event_date $relation NOW()";
		$sql = "SELECT event.event_name, event.event_date, event.event_time, event.event_id, user.email
        FROM user JOIN event ON user.user_id=event.hostuser_id
        WHERE user.email='$persEmail'AND $string";

        $query = mysqli_query($con, $sql);

        if (!$query) {
            die ('SQL Error: ' . mysqli_error($con));
        }

        while ($row = mysqli_fetch_array($query))
        {
            echo "<ul>";{
            echo "<li>". "Event Name: ", $row['event_name']."</li>";
            echo "Event Date: ", $row['event_date']."<br>";
            echo "Event Time: ", $row['event_time'];
            if ($relation=='>=' || $relation=='>')
            {
            	echo '<form method="post">
            	<input style="display:none;" name="event_id" value="'.$row["event_id"].'">
            	<button class="btn btn-danger" name=\'cancel_btn\' type=\'submit\' onclick="return confirm(\'Are you sure you want to cancel this event?\');"">Cancel event</button>
            	</form>';
            }
        }
            echo "</ul>";

        }
        if ($relation=='>=' || $relation=='>')
        {	if (mysqli_num_rows($query)==0){
            echo "You have no hosted events.";
       		}
       	}
        else {
        	if (mysqli_num_rows($query)==0){
            echo "You did not host any events in the past.";
       		}
        }

        //check the user_id of the logged in user_id
        $user_id=whichUser();

        //delete from   reservations
        if(isset($_POST['cancel_btn']))
          {
          $event_id = $_POST["event_id"];
          $query = "DELETE FROM event
          WHERE hostuser_id=$user_id AND event_id=$event_id;";
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
          header('Refresh:0; url= http://localhost/MOVIETIME/MovieTimeMyEvents.php');
        }
}

function emailExists($emailInput){
  require 'db.php';
  $check_email = $con->query("SELECT email FROM user WHERE email='$emailInput'");
  $count = $check_email->num_rows;
  if ($count == 0) {
    return false;
  } else {
    return true;
    }
}

function getInfo($user){
  include 'db.php';
  $sql = "SELECT first_name, last_name, username, email FROM user WHERE email='$user'";

        $query = mysqli_query($con, $sql);

        if (!$query) {
            die ('SQL Error: ' . mysqli_error($con));
        }
        
        while ($row = mysqli_fetch_array($query))
        {   echo "<ul>";
            echo "<li>". "Your User Name: ", $row['username']."</li>";
            echo "<li>". "Your First Name: ", $row['first_name']."</li>";
            echo "<li>". "Your Last Name: ", $row['last_name']."</li>";
            echo "<li>". "Your Email : ", $row['email']."</li>";
            echo "</ul>";
        }
            
}

function bookTicket($event_id, $user_id, $host){
  require 'db.php';
  if($host!=$user_id)
  {
    $event_id = $_POST["event_id"];
    $check = $con->query("SELECT user_id, event_id FROM reservation WHERE user_id = $user_id AND event_id = $event_id;");
    $count=$check->num_rows;
    if ($count==0)
    {
      $query = "INSERT INTO reservation(user_id, event_id, purchase_date)
      VALUES ($user_id, $event_id, NOW() );";
        if ($con->query($query)){
          $msg = "<div class='alert alert-success'>
                  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully booked !
                 </div>";
          echo $msg;
        }else {
          $msg = "<div class='alert alert-danger'>
                  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while booking !
                 </div>";
          echo $msg;
              }
    } else {
        $msg = "<div class='alert alert-danger'>
               <span class='glyphicon glyphicon-info-sign'></span> &nbsp; You have already booked this event!
              </div>";
        echo $msg;
      }
  } else {
    $msg = "<div class='alert alert-danger'>
         <span class='glyphicon glyphicon-info-sign'></span> &nbsp; You can not book your own event!
        </div>";
    echo $msg;
    }
}
function noTicket($event_id, $relation){
  include 'db.php';
  $persEmail=$_SESSION['userSession'];
  $string="event.event_date $relation NOW()";
  $sql4 = "SELECT reservation.event_id
                FROM reservation, event, user
                WHERE user.email='$persEmail' AND user.user_id=event.hostuser_id AND reservation.event_id=event.event_id AND event.event_id='$event_id' 
                AND $string";

          $query4 = mysqli_query($con, $sql4);

          if (!$query4) {
               die ('SQL Error: ' . mysqli_error($con));
            }
  $row_cnt = $query4->num_rows;
  return $row_cnt;
}
function isSoldout($event_id){
  include 'db.php';
  $sql= "SELECT reservation.reservation_id, reservation.event_id, event.event_id, event.ticket_number FROM reservation
             JOIN event on reservation.event_id=event.event_id
            WHERE event.event_id=$event_id;";
  $query = mysqli_query($con, $sql);
  $i=-1;
  if (mysqli_num_rows($query)==0){
    return false;
  } else{
        while ($row = mysqli_fetch_array($query))
         {
           $i++;
          $reservations[$i]=$row['reservation_id'];
          $ticket_number=$row['ticket_number'];
        }
  if (sizeof($reservations)<$ticket_number){
    return false;
  } else {
    return true;
  }
}
}
function maxTicket($ev_id){
    include 'db.php';
  $sql= "SELECT event.event_id, event.ticket_number FROM event
            WHERE event.event_id=$ev_id;";
  $query = mysqli_query($con, $sql);
  if (mysqli_num_rows($query)==0){
    echo "Error while loading in max number of tickets.";
  } else{
        while ($row = mysqli_fetch_array($query))
         {
           $ticket_number=$row['ticket_number'];
        }
      }
    return $ticket_number;
  }
function email($to) {
  include_once 'functions.php';
  require 'db.php';
  $today=date("Y-m-d");
  $user_id=whichUser();
  $sql = "SELECT event.event_name, event.event_date, reservation.user_id,reservation.event_id, event.event_id
        FROM event JOIN reservation ON event.event_id=reservation.event_id
        WHERE user.user_id=$user_id;";

  $query = mysqli_query($con, $sql);
  if (!$query) {
            die ('SQL Error: ' . mysqli_error($con));
  }
  while ($row = mysqli_fetch_array($query))
  {
    $date=$_POST['event_date'];
    if($date = $today) {
    mail($to,"You have an event today, please visit the website for more information!","FROM: team@movietime.com");
    }
  }
}
?>