<?php
session_start();
include_once 'db.php';
require 'functions.php';
if (!isLogin()) {
    header("Location: MovieTimeIndex.php");
}
?>
<html>
<head>
	<title>Browse Events</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MovieTime.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<?php include 'navbar.php';
  $today=date("Y-m-d");?>
<div class="container">
	<h1>
		Browse events
	</h1>
  <div class="row">
		<form id=type method="post">
      <span class="input-group">
          <label for="name_search">Type in a part of the film or event name: &nbsp;</label>
          <input type="text" name="name_search" class="form-control">
        <label for="sel1">&nbsp;Select type: &nbsp;</label>
        <select class="form-control" name="sel1">
					<option selected value=""></option>
          <option>Student</option>
          <option>Alumni</option>
          <option>Open</option>
        </select>
    </span>
    <span class="input-group">
        <label for="sel2">Select start of period: &nbsp;</label>
        <input type="date" name="sel2" class="form-control" min="<? echo $today;?>" placeholder="Search for..." aria-label="Search for ...">
				<label for="sel2b">&nbsp; Select  end of period: &nbsp;</label>
				<input type="date" name="sel2b" class="form-control" placeholder="Search for..." aria-label="Search for ...">
		</span>
    <span class="input-group">
        <label for="sel3">Select genre: &nbsp;</label>
        <select name="sel3" class="form-control">
					<option></option>
          <option>Animation</option>
          <option>Drama</option>
          <option>Documentary</option>
          <option>Horror</option>
					<option>Action</option>
					<option>Adventure</option>
        </select>
        <label for="sel4">&nbsp;Select location:&nbsp; </label>
        <select class="form-control" name="sel4">
					<option></option>
          <option>Grand Hall</option>
          <option>Medical Sciences Student Screening Room</option>
          <option>UCL Screening Room</option>
          <option>Birckbeck Open Space</option>
        </select>
         <span class="input-group-btn">
          <button class="btn btn-danger" type="submit">Search!</button>
        </span>
  </span>
</form>
</div>
<?php
//initializing variables
$sql="";
$name_search="";
$type = "";
$start_date = "";
$end_date = "";
$genre = "";
$location = "";
$price = "";
$title = "";
//name search film or event
if(isset($_POST['name_search']))
	{
	$name_search =$_POST['name_search'];
  }
//echo $type;
	if(isset($name_search) && !empty($name_search)){
			$sql .= "SELECT title, hostuser_id, event_id, event_name, event_date, event_time, event_length, type, location_name, genre, price FROM event
								JOIN location ON event.location_id=location.location_id
					      JOIN film ON event.film_id=film.film_id
					      JOIN genre ON film.genre_id=genre.genre_id
                WHERE event_date>=NOW()
								AND (event_name LIKE '%$name_search%' OR title LIKE '%$name_search%') ";
              } else {
            			$sql .= "SELECT title, hostuser_id, event_id, event_name, event_date, event_time, event_length, type, location_name, genre, price FROM event
            								JOIN location ON event.location_id=location.location_id
            					      JOIN film ON event.film_id=film.film_id
            					      JOIN genre ON film.genre_id=genre.genre_id
                            WHERE event_date>=NOW() ";
                      }
//type search
if(isset($_POST['sel1']))
	{
	$type =$_POST['sel1'];
  }
//echo $type;
	if(isset($type) && !empty($type)){
			$sql .= " AND type = '$type'";
	}
//date search
if(isset($_POST['sel2']) && isset($_POST['sel2b']))
	{
	$start_date = $_POST['sel2'];
	$end_date = $_POST['sel2b'];

  }
//echo $date;
if(isset($start_date) && !empty($start_date) && isset($end_date) && !empty($end_date)){
		$sql .= " AND '$start_date' < event.event_date AND '$end_date' > event.event_date";
}
//genre search
if(isset($_POST['sel3']))
	{
	$genre = $_POST['sel3'];
  }
//echo $genre;
if(isset($genre) && !empty($genre)){
		$sql .= " AND genre = '$genre'";
}
//location search
if(isset($_POST['sel4']))
	{
	$location = $_POST['sel4'];
  }
//echo $location;
if(isset($location) && !empty($location)){
		$sql .= " AND location_name = '$location'";
}
//closing the query with ;
$sql .= ";";
//establishing connection and searching
$query = mysqli_query($con, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>
<head>
	<title>Results of yours search</title>
	<link rel="stylesheet" type="text/css" href="MovieTimeTable.css">
</head>
<body>
	<h1></h1>
	<table class="data-table">
		<caption class="title"></caption>
		<thead>
			<tr>
				<th>NAME</th>
        <th>FILM</th>
				<th>DATE</th>
				<th>TIME</th>
				<th>LENGTH</th>
				<th>TYPE</th>
				<th>LOCATION</th>
				<th>GENRE</th>
        <th>PRICE (GBP)</th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
      <div name="events">
		<?php
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
          <td style="display:none;">'.$row['event_id'].'</td>
					<td>'.$row['event_name'].'</td>
          <td>'.$row['title'].'</td>
					<td>'.$row['event_date'].'</td>
					<td>'.$row['event_time'].'</td>
					<td>'.$row['event_length'].'</td>
					<td>'.$row['type'].'</td>
					<td>'.$row['location_name'].'</td>
					<td>'.$row['genre'].'</td>
          <td>'.$row['price'].'</td>
					<td>'.
          '<form method="post">
          <input style="display:none;" name="hostuser_id" value="'.$row["hostuser_id"].'">
          <input style="display:none;" name="event_id" value="'.$row["event_id"].'">
          <button name=\'book_btn\' type=\'submit\'">Book</button>
          </form>'
          .'</td>
				</tr>';
		}

    ?>
  </div>
    <?php
		//check the user_id of the logged in user_id

		$user_id = whichUser();

		//insert the new thing into reservations
		if(isset($_POST['book_btn']))
			{
        $soldout=isSoldout($_POST['event_id']);
        $host=$_POST['hostuser_id'];
        if($soldout== TRUE) {
          $msg = "<div class='alert alert-danger'>
               <span class='glyphicon glyphicon-info-sign'></span> &nbsp; This event is sold out!
              </div>";
          echo $msg;
        } else{
          bookTicket($_POST["event_id"], $user_id, $host);
        }
    }
		?>
  <hr>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>
