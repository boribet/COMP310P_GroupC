<?php $today=date("Y-m-d");
include_once 'functions.php'; ?>
<div class="row">
<form id="submit" method="post">
    <span class="input-group">
        <label for="event_name">Type in a name for your event: </label>
        <input  name="event_name" placeholder="Event name" class="form-control"  type="text" required>
         </span>
    <span class="input-group">
        <label for="type">Select type: </label>
        <select class="form-control" name="type" required>
		  <option selected value=""></option>
          <option>Student</option>
          <option>Alumni</option>
          <option>Open</option>
        </select>
    </span>
    <span class="input-group">
        <label for="date">Select date:  </label>
        <input type="date" name="date" min="<? echo $today;?>"class="form-control" placeholder="Search for..." aria-label="Search for ..." required>
    </span>
    <span class="input-group">
        <label for="time">Select time of the event:  </label>
        <input  name="time" placeholder="HH:MM:SS" class="form-control"  type="time" required>
    </span>
    <span class="input-group">
        <label for="length">Select length:  </label>
        <input  name="length" placeholder="HH:MM:SS" class="form-control"  type="time" required>
    </span>
    <span class="input-group">
        <label for="no_tickets">Select the number of tickets to sell:  </label>
        <input  name="no_tickets" placeholder="Number of tickets" class="form-control"  type="number" required min="10">
    </span>
    <span class="input-group">
        <label for="price">Select the price of tickets (GBP):  </label>
        <input  name="price" placeholder="Price" class="form-control"  type="number" required min="0">
  </span>
    <span class="input-group">
        <label for="location">Select location:  </label>
<?php
    //select event to book
    $query = "SELECT location_id, location_name FROM location;";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    $select= '<select name="location" required>';
    $select.='<option value=""></option>';
    while ($row = mysqli_fetch_array($result)) {
          $select.='<option value="'.$row['location_id'].'">'.$row['location_name'].'</option>';
     }
    $select.='</select>';
    echo $select;
    ?>
  </span>
  <span class="input-group">
        <label for="film">Select a film:  </label>
      <?php
  //select event to book
  $query = "SELECT film_id, title FROM film;";
  $result = mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $select= '<select name="film" required>';
  $select.='<option value=""></option>';
  while ($row = mysqli_fetch_array($result)) {
        $select.='<option value="'.$row['film_id'].'">'.$row['title'].'</option>';
  }
  $select.='</select>';
  echo $select;
  ?>
  <span class="input-group-btn">
  <button name="submit_btn" class="btn btn-danger" type="submit">Create!</button>
  </span>
</form>
</div>
<?php
  $user_id=whichUser();

if(isset($_POST['submit_btn']))
  {
  $event = $_POST['event_name'];
  $type = $_POST['type'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $length = $_POST['length'];
  $no_tickets = $_POST['no_tickets'];
  $price = $_POST['price'];
  $location = $_POST['location'];
  $film_id=$_POST['film'];
  $query = "INSERT INTO event(hostuser_id, event_name, type, location_id, event_date, event_time, event_length, film_id, ticket_number, price)
  VALUES ($user_id, '$event', '$type', $location, '$date', '$time', '$length', $film_id, $no_tickets, $price);";
  if ($con->query($query)){
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully created !
      </div>";
     echo $msg;
    }
  else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while creating event !
     </div>";
     echo $msg;
  }
      header('Location: http://localhost/MOVIETIME/MovieTimeMyEvents.php');
}

?>
