<?php
$conn = new mysqli("localhost", "root", "", "menus");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid item ID");
}

$stmt = $conn->prepare("SELECT restaurant_id FROM menu WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die("Item not found");
}

$restaurant_id = $item['restaurant_id'];

$stmt = $conn->prepare("DELETE FROM menu WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: view_restaurant.php?id=" . $restaurant_id);
exit();
?>