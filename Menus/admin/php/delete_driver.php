<?php
$conn = new mysqli("localhost", "root", "", "menus");

$id = $_GET['id'];

$conn->query("DELETE FROM drivers WHERE id = $id");

header("Location: drivers.php");
exit();
?>