<?php
    error_reporting(E_ERROR);

    $exist = 1;
	require_once '../login.php';
	$conn = new mysqli($hostnetwork,$username,$password,$database);
    if ($conn->connect_error){
        $exist = 0;
    }
?>