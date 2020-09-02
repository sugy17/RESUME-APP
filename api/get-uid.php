<?php
session_start();
include('mobile-otp.php');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);


//add email or mobile verification
//echo "verified=".$_SESSION[$_GET['mobile']];

include('../include/config.php');
header('Content-type: application/json');

$result_array = array();

if ($_GET['email'] == '')
    die('{"msg":"bad request"}');
$sql = "select * from applicant where email='" . $_GET['email'] . "' and mobile='" . $_GET['mobile'] . "'";

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) array_push($result_array, $row);
        $result_array[0]["verified"]=1;
        echo json_encode($result_array[0]);
        mysqli_free_result($result);
    } else {
        $sql = "INSERT INTO applicant (email,mobile) VALUES ('" . $_GET['email'] . "', '" . $_GET['mobile'] . "')";
        if (mysqli_query($link, $sql)) {
            $uid = mysqli_insert_id($link);
            //echo json_encode({"uid" => $uid,"verified" => 1});
            echo "{\"uid\":\"$uid\",\"verified\":1}";
            //echo "{\"msg\":\"New record created successfully. Last inserted ID is: $uid\"}";
        } else {
            echo "Error: " . $sql . "<--->" . mysqli_error($link);
        }
    }
} else {
    echo '{"msg":"ERROR: Could not execute' . $sql . ' ' . mysqli_error($link) . '"}';
}

// Close connection
mysqli_close($link);
