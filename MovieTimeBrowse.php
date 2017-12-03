<html>
<head>
	<title>My reservations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MovieTime.css">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">
</head>
<body>
	<?php include 'navbar.php'; ?>
<div class="container">
	<h1>
		Browse events
	</h1>
  <div class="row">
    <span class="input-group">
        <label for="sel1">Select genre: </label>
        <select class="form-control" id="sel1">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
        </select>
        <span class="input-group-btn">
          <button class="btn btn-danger" type="button">Search!</button>
        </span>
    </span>
    <span class="input-group">
        <label for="sel2">Select date: </label>
        <input type="date" class="form-control" placeholder="Search for..." aria-label="Search for ...">
        <span class="input-group-btn">
          <button class="btn btn-danger" type="button">Search!</button>
        </span>
    </span>
    <span class="input-group">
        <label for="sel1">Select max length: </label>
        <select class="form-control" id="sel1">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
        </select>
        <span class="input-group-btn">
          <button class="btn btn-danger" type="button">Search!</button>
        </span>
    </span>
  <span class="input-group">
        <label for="sel2">Select location: </label>
        <select class="form-control" id="sel2">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
        </select>
        <span class="input-group-btn">
          <button class="btn btn-danger" type="button">Search!</button>
        </span>
  </span>
  </div>
  <hr>

  
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>