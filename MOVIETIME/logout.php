<?php
session_start();

if (!isset($_SESSION['userSession'])) {
 header("Location: MovieTimeIndex.php");
} else if (isset($_SESSION['userSession'])!="") {
 header("Location: MovieTimeHome.php");
}

if (isset($_GET['logout'])) {
 session_destroy();
 unset($_SESSION['userSession']);
 header("Location: MovieTimeIndex.php");
}?>