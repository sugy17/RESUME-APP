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

$sql = $_GET['query'];

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) array_push($result_array, $row);
        header('Content-type: application/json');
        echo json_encode($result_array);
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);

