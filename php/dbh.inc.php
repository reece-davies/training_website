<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "fitness_database"; // tutorial: loginsystemtut

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn)
{
    die("Connection Failed: ".mysqli_connect_error);
}


?>