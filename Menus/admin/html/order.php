<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <link rel="stylesheet" href="../css/order.css">
</head>
<body>

<div class="header">
    <h1>🚚 Order Management</h1>
</div>

<a href="dashboard.php" class="back">⬅ Back to Dashboard</a>

<div class="container">

    <?php if (!empty($message)) { ?>
        <div class="success-msg"><?php echo $message; ?></div>
    <?php } ?>

    <?php while($order = $orders->fetch_assoc()) { ?>

        <?php
        $status = strtolower(trim($order['status'] ?? 'pending'));
        ?>

        <div class="order-card">

            <h3>Order #<?php echo $order['id']; ?></h3>

            <p><strong>Total:</strong> <?php echo $order['total']; ?> EGP</p>
            <p><strong>Payment:</strong> <?php echo $order['payment_method']; ?></p>
            <p><strong>Date:</strong> <?php echo $order['created_at']; ?></p>

            <p>Status:
                <span class="status <?php echo $status; ?>">
                    <?php echo $order['status'] ?? 'Pending'; ?>
                </span>
            </p>
            
            <?php if ($status === 'pending') { ?>

                <form method="post">
                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">

                    <select name="driver_id" required>
                        <option value="">Assign Driver</option>

                        <?php 
                        $drivers->data_seek(0);
                        while($d = $drivers->fetch_assoc()) { ?>
                            <option value="<?php echo $d['id']; ?>">
                                <?php echo $d['name']; ?> (<?php echo $d['phone']; ?>)
                            </option>
                        <?php } ?>
                    </select>

                    <button type="submit" name="assign">Assign Driver</button>
                </form>

            <?php } else { ?>

                <p class="assigned-label">
                    Assigned to: <?php echo $order['driver_name'] ?? 'Not assigned'; ?>
                </p>

            <?php } ?>

        </div>

    <?php } ?>

</div>

</body>
</html>