<?php

$host = "localhost";
$db_name = "lks";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}
?>
