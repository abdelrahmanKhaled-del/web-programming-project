<?php
session_start();

$conn = new mysqli("localhost", "root", "", "menus");

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

if ($order_id <= 0) {
    die("Invalid order ID");
}

$orderStmt = $conn->prepare("
    SELECT id, customer_id, total, created_at, driver_id, status, payment_method
    FROM orders
    WHERE id = ?
");

$orderStmt->bind_param("i", $order_id);
$orderStmt->execute();
$orderInfo = $orderStmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("
    SELECT product_name, price, quantity
    FROM order_items
    WHERE order_id = ?
");

$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("
        <h2 style='text-align:center;'>No items found for Order #$order_id</h2>
        <p style='text-align:center;'>Check if order_items are being saved correctly.</p>
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="../css/order_details.css">
</head>
<body>

<div class="container">

    <h2>📦 Order #<?php echo $order_id; ?></h2>

    <div style="text-align:center; margin-bottom:15px;">
        <p>💳 Payment: <b><?php echo strtoupper($orderInfo['payment_method']); ?></b></p>
        <p>📌 Status: <b><?php echo strtoupper($orderInfo['status']); ?></b></p>
        <p>📅 Date: <b><?php echo $orderInfo['created_at']; ?></b></p>
        <p>💰 Total: <b><?php echo $orderInfo['total']; ?> EGP</b></p>
    </div>

    <div class="back-container">
        <a href="my_orders.php" class="back-btn">⬅ Back</a>
    </div>

    <table>

        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>

        <?php
        $grand = 0;

        while ($item = $result->fetch_assoc()) {

            $total = $item['price'] * $item['quantity'];
            $grand += $total;
        ?>

        <tr>
            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
            <td><?php echo $item['price']; ?> EGP</td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $total; ?> EGP</td>
        </tr>

        <?php } ?>

        <tr class="total-row">
            <td colspan="3"><b>Grand Total</b></td>
            <td><b><?php echo $grand; ?> EGP</b></td>
        </tr>

    </table>

</div>

</body>
</html>