<?php
session_start();
if (!isset($_SESSION["verification_code"])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST["code"];

    if ($entered_code == $_SESSION["verification_code"]) {
        header("Location: ../php/dashboard.php");
        exit();
    } else {
        $error = "Invalid code, Please try again later";
    }
}

include "../html/vertification_code.php";


