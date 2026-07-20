<?php
$conn = new mysqli("localhost", "root", "", "menus");

$message = "";

$restaurants = $conn->query("SELECT * FROM restaurant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restaurant_id = $_POST['restaurant_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $uploadPath = "../../images/" . $imageName;

    if (move_uploaded_file($tmpName, $uploadPath)) {
        $conn->query("
            INSERT INTO menu (restaurant_id, name, price, image)
            VALUES ('$restaurant_id', '$name', '$price', '$imageName')
        ");
        $message = "Menu item added successfully!";
    } else {
        $message = "Image upload failed!";
    }
}

include("../html/add_menu.php");
?>

