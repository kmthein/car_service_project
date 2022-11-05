<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "car_service";

$conn = mysqli_connect($hostname, $username, $password, $database) or die
("Database connect failed");