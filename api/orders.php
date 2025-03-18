<?php
include 'config.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    $result = $conn->query("SELECT orders.id, users.name AS user, products.name AS product, orders.quantity, orders.price
                            FROM orders 
                            JOIN users ON orders.user_id = users.id 
                            JOIN products ON orders.product_id = products.id");
    echo json_encode(value: $result->fetch_all(MYSQLI_ASSOC));
}

if ($method === "POST") {
    $data = json_decode(file_get_contents(filename: "php://input"), associative: true);
    $user_id = $data['user_id'];
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];
    $price = $data['price'];

    $sql = "INSERT INTO orders (user_id, product_id, quantity, price) VALUES ('$user_id', '$product_id', '$quantity', '$price')";
    echo json_encode(["success" => $conn->query($sql)]);
}


if ($method === "PUT") {
    $id = $_GET['id'];
    $data = json_decode(file_get_contents(filename: "php://input"), associative: true);
    $user_id = $data['user_id'];
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];
    $price = $data['price'];

    $sql = "UPDATE orders SET user_id = '$user_id', product_id = '$product_id', quantity = '$quantity', price = $price 
            WHERE id = '$id'";
    echo json_encode(["success" => $conn->query($sql)]);
}


if ($method === "DELETE") {
    $id = $_GET['id'];
    $sql = "DELETE FROM orders WHERE id = $id";
    echo json_encode(value: ["success" => $conn->query($sql)]);
}
