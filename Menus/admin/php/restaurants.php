<?php
$conn = new mysqli("localhost", "root", "", "menus");
$result = $conn->query("SELECT * FROM restaurant");
include "../html/restaurants.php";
