<?php
session_start();

$conn = new mysqli("localhost", "root", "", "menus");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = $_POST['name'];

    $imageName = $_FILES['image']['name'];
    $tmpName   = $_FILES['image']['tmp_name'];

    $uploadPath = "../../images/" . $imageName;

    if (move_uploaded_file($tmpName, $uploadPath)) {
        $stmt = $conn->prepare("INSERT INTO restaurant (name, image) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $imageName);
        $stmt->execute();
        $stmt->close();

        $message = "Restaurant added successfully!";
    } else {
        $message = "Image upload failed!";
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $conn->query("DELETE FROM menu WHERE restaurant_id = $id");

    $conn->query("DELETE FROM restaurant WHERE id = $id");

    $message = "Restaurant deleted successfully!";
}

$result = $conn->query("SELECT * FROM restaurant");

include "../html/add_restaurant.php";
?>
