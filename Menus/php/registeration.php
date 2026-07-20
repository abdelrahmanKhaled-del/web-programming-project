<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "menus");
    if ($conn->connect_error) {
        $_SESSION['error'] = "Database connection failed!";
        header("Location: ../html/create_account.php");
        exit();
    }

    $firstName       = trim($_POST['firstName']);
    $lastName        = trim($_POST['lastName']);
    $phone           = trim($_POST['phone']);
    $address         = trim($_POST['address']);
    $email           = strtolower(trim($_POST['email']));
    $password        = $_POST['password'];
    $confirmPassword = $_POST['Confirm_Password'];


    if (!preg_match("/^(010|011|012|015)[0-9]{11}$/", $phone)) {
        $_SESSION['error'] = "Invalid phone nuumber , make sure that phone number is 11 digits long , only digits and starts with 010 011 015 012 ONLYYY";
        header("Location: ../html/create_account.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: ../html/create_account.php");
        exit();
    }

    $check = $conn->prepare("SELECT id FROM customer WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "This email is already registered. Please use another email.";
        $check->close();
        header("Location: ../html/create_account.php");
        exit();
    }
    $check->close();

    $stmt = $conn->prepare("INSERT INTO customer (firstName, lastName, phone, address, email, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $phone, $address, $email, $password);

    if ($stmt->execute()) {
        header("Location: ../html/success.html");
        exit();
    } else {
        $_SESSION['error'] = "Error creating account!";
        header("Location: ../html/create_account.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
