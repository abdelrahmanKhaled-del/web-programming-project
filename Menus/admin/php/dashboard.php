<?php
$conn = new mysqli("localhost", "root", "", "menus");

$restaurants = $conn->query("SELECT COUNT(*) AS total FROM restaurant")->fetch_assoc();
$menu = $conn->query("SELECT COUNT(*) AS total FROM menu")->fetch_assoc();
$drivers = $conn->query("SELECT COUNT(*) AS total FROM drivers")->fetch_assoc();

include "../html/dashboard.php";
