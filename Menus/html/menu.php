<?php
session_start();

$conn = new mysqli("localhost", "root", "", "menus");

$restaurant_id = $_GET['restaurant_id'] ?? 0;

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['qty']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            "name" => $name,
            "price" => $price,
            "qty" => 1
        ];
    }
}

$stmt = $conn->prepare("SELECT * FROM menu WHERE restaurant_id = ?");
$stmt->bind_param("i", $restaurant_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>

<div class="navbar">
    <div>🍔 MENUS</div>

    <div>
        <a href="restaurants.php">⬅ Back</a>
        <a href="cart.php?restaurant_id=<?php echo $restaurant_id; ?>">🛒 Cart</a>
        <a href="my_orders.php">📦 Orders</a>
    </div>
</div>

<div class="wrapper">

    <div class="header">
        <h1>🍽️ Our Menu</h1>
        <p>Fresh food delivered fast</p>
    </div>

    <div class="container">

        <?php while($row = $result->fetch_assoc()) { ?>

        <div class="card">

            <img src="../images/<?php echo $row['image'] ? $row['image'] : 'default.jpg'; ?>">

            <div class="card-content">

                <h3><?php echo $row['name']; ?></h3>

                <div class="price"><?php echo $row['price']; ?> EGP</div>

                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">

                    <button type="submit" name="add_to_cart">
                        Add to Cart
                    </button>
                </form>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>