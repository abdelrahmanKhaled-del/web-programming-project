<?php
session_start();
$conn = new mysqli("localhost", "root", "", "menus");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = $_POST["username"];
    $password  = $_POST["password"];

    if ($username == "admin" && $password == "admin123") {
        $code = random_int(1000000, 9999999);
        $_SESSION["verification_code"] = $code;

        header("Location: ../php/vertification_code.php?code=$code");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

include "../html/admin_login.php";
