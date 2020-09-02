<?php
// AUTH
session_start();

// If there is no username, they are logged out, so show them the login link
if (!isset($_SESSION['username'])) {
	header("location: /new/login.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../include/config.php');

$result_array = array();

//add auth for url
//add security for resume upload folder

$app_id = $_GET['application_id'];
$seen = $_GET['seen'];

$sql="update application set seen=$seen where application_id=$app_id";

if ($result = mysqli_query($link, $sql)) {
    echo "success";
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
