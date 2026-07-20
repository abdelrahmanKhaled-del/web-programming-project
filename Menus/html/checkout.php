<?php
session_start();

$conn = new mysqli("localhost", "root", "", "menus");

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

$customer_id = $_SESSION['id'];


$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}


$payment_method = $_POST['payment_method'] ?? 'cash';
$status = ($payment_method === "cash") ? "pending" : "processing";

$stmt = $conn->prepare("
    INSERT INTO orders
    (customer_id, total, driver_id, status, payment_method, created_at)
    VALUES (?, ?, NULL, ?, ?, NOW())
");

$stmt->bind_param("idss", $customer_id, $total, $status, $payment_method);
$stmt->execute();

$order_id = $stmt->insert_id;

$itemStmt = $conn->prepare("
    INSERT INTO order_items (order_id, product_name, price, quantity)
    VALUES (?, ?, ?, ?)
");

foreach ($cart as $item) {

    $name = $item['name'];
    $price = (float)$item['price'];
    $qty = (int)$item['qty'];

    $itemStmt->bind_param("isdi", $order_id, $name, $price, $qty);
    $itemStmt->execute();
}

unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="../css/process_payment.css">
</head>
<body>

<div class="box">

    <h1>✅ Order Placed!</h1>

    <p>Order ID: <b>#<?php echo $order_id; ?></b></p>

    <p>Status: <b><?php echo $status; ?></b></p>

    <p>Payment: <b><?php echo strtoupper($payment_method); ?></b></p>

    <a href="restaurants.php">Back to Restaurants</a>

</div>

</body>
</html>