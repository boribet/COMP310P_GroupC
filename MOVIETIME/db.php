<?php
$con=mysqli_connect("localhost","test","test123","film_night");
if (mysqli_connect_errno()){
	{
		echo "failed to connect to MySQL: ".mysqli_connect_errno();
	}
}?>