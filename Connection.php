<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="flight_booking_system";
    // $username = "id18706535_meet";
    // $password = "Innovative1@Lamp";
    // $dbname=" id18706535_lamp";

    $con = mysqli_connect($servername, $username, $password,$dbname);


    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>