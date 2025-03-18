<?php
include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $result = $conn->query("SELECT * FROM products");
    echo json_encode(value: $result->fetch_all(MYSQLI_ASSOC));
}

if ($method === "POST") {
    $data = json_decode(json: file_get_contents(filename: "php://input"), associative: true);
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";
    echo json_encode(value: ["success" => $conn->query($sql)]);
}

if ($method === "PUT") {
    $id = $_GET['id'];
    $data = json_decode(json: file_get_contents(filename: "php://input"), associative: true);
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $sql = "UPDATE products SET name = '$name', description = '$description', price = $price, WHERE id ='$id';";
    echo json_encode(value: ["success" => $conn->query($sql)]);
}

if ($method === "DELETE") {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = '$id'";
    echo json_encode(value: ["success" => $conn->query($sql)]);
}
