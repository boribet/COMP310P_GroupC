<?php $today=date("Y-m-d");
include_once 'functions.php';
require 'db.php';?>
<div class="row">
<form id="submit" method="post">
      <span class="input-group">
        <label for="notes">Select the event you wish to review:&nbsp; </label>
        <?php
        $user_id=whichUser();
        $query = "SELECT event.event_id, event_name, event_date, event_time, event_length, type, location_name, genre FROM event
                JOIN location ON event.location_id=location.location_id
                JOIN film ON event.film_id=film.film_id
                JOIN genre ON film.genre_id=genre.genre_id
                JOIN reservation ON reservation.event_id=event.event_id
                WHERE event_date<NOW() AND reservation.user_id =$user_id;";
      $result = mysqli_query($con,$query);
      echo '<select name="sel_event" required>';
      while ($row = mysqli_fetch_array($result)){
        echo '<option value="'.$row['event_id'].'">'.$row['event_name'].'</option>';
      }
      echo '</select>';             
      ?>
    </span>
      <span class="input-group">
          <label for="notes">What do you think about this event:&nbsp; </label>
          <input  name="notes" placeholder="Feedback" class="form-control"  type="text" required>
          </span>
    <span class="input-group">
        <label for="rating">Rate this event: &nbsp;</label>
        <select class="form-control" name="rating" required>
          <option selected value=""></option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
   <small>&nbsp;&nbsp;&nbsp;</small>
   <button name="submit_btn" class="btn btn-danger" type="submit">Submit!</button>
  </span>
</form>
</div>
<?php

if(isset($_POST['submit_btn']))
  {
  $event = $_POST['sel_event'];
  $rating = $_POST['rating'];
  $notes = $_POST['notes'];
  $query = "INSERT INTO feedback(user_id, event_id, rating, notes)
  VALUES ($user_id, '$event', $rating, '$notes');";
  if ($con->query($query)){
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully submitted !
     </div>";
     echo $msg;
  }else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while submitting !
     </div>";
     echo $msg;
  }
      header('Location: http://localhost/MOVIETIME/MovieTimeReservations.php');
}

?>
