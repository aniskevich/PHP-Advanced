<?php

$config = [
    'db_user' => 'user',
    'db_pass' => 'x4kbTNyvus4XNGxa',
    'db_name' => 'PHP',
    'db_host' => 'localhost'
];

$connect = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

function getCatalog($connect) {
    $query = "SELECT id FROM Products";
    $result = mysqli_query($connect, $query);
    $catalog = [];
    while ($i = mysqli_fetch_assoc($result)) {
        $catalog[] = $i;
    }
    return $catalog;
}

function getProduct($id, $connect) {
    $query = "SELECT * FROM Products WHERE id = $id";
    $result = mysqli_fetch_assoc(mysqli_query($connect, $query));
    return $result;
}

function addToCart($id, $connect) {
    $query = "SELECT * FROM cart WHERE product_id = $id";
    $result = mysqli_query($connect, $query);
    if (!$result) { 
        $query = "INSERT INTO cart ( product_id, quantity) VALUES ('$id', '1')";
    } else {
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = '$id'";
    }
    mysqli_query($connect, $query);
    echo "added";
}