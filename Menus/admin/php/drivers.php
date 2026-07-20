<?php
$conn = new mysqli("localhost", "root", "", "menus");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

	if ($conn->query("INSERT INTO drivers (name, phone) VALUES ('$name', '$phone')")) {
        $message = "Driver added successfully!";
   	 } else {
        $message = "Error: " . $conn->error;
   	 }}

$result = $conn->query("SELECT * FROM drivers");

include "../html/drivers.php";
