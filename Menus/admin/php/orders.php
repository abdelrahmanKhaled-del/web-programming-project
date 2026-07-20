<?php
session_start();
$conn = new mysqli("localhost", "root", "", "menus");

$message = "";

if (isset($_POST['assign'])) {
    $order_id = intval($_POST['order_id']);
    $driver_id = intval($_POST['driver_id']);

    $stmt = $conn->prepare("
        UPDATE orders
        SET driver_id = ?, status = 'Assigned'
        WHERE id = ?
    ");
    $stmt->bind_param("ii", $driver_id, $order_id);
    $stmt->execute();

    $message = "✅ Driver assigned successfully!";
}

$orders = $conn->query("
    SELECT orders.*, drivers.name AS driver_name
    FROM orders
    LEFT JOIN drivers ON orders.driver_id = drivers.id
    ORDER BY orders.id DESC
");

$drivers = $conn->query("SELECT * FROM drivers");

include "../html/order.php";
?>