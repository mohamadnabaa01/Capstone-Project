<?php

$server = "localhost";
$username = "root";
$password = "1807";
$dbname = "newbie_gamers";

$connection = new mysqli($server, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Failed connecting to database");
}

?>