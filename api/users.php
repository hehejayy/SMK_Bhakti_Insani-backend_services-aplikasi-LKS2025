<?php
include 'config.php';
header("Content-Type: application/json");

$method = $_SERVER ['REQUEST_METHOD'];

if ($method == "GET") {
    $result = $conn->query(query: "SELECT * FROM users");
    echo json_encode (value: $result-> fetch_all(mode: MYSQLI_ASSOC));
}

if ($method == "POST") {
    $data = json_decode(json: file_get_contents(filename:"php://input"), associative : true);
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    echo json_encode (value: ["success" => $conn->query(query: $sql)]);
}