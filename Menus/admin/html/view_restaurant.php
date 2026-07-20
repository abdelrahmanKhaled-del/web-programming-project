<?php
$conn = new mysqli("localhost", "root", "", "menus");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("No restaurant selected. Please go back and choose a restaurant.");
}

$restaurant_id = (int) $_GET["id"];

if (isset($_POST['delete_id'])) {

    $delete_id = (int) $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    header("Location: view_restaurant.php?id=" . $restaurant_id);
    exit();
}

$stmt = $conn->prepare("SELECT id, name, image FROM restaurant WHERE id = ?");
$stmt->bind_param("i", $restaurant_id);
$stmt->execute();

$restaurant = $stmt->get_result()->fetch_assoc();

if (!$restaurant) {
    die("Restaurant not found.");
}

$stmt = $conn->prepare("
    SELECT id, name, price, category
    FROM menu
    WHERE restaurant_id = ?
");

$stmt->bind_param("i", $restaurant_id);
$stmt->execute();

$items = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($restaurant["name"]); ?> - Menu</title>
    <link rel="stylesheet" href="../css/view_restaurant.css">
</head>
<body>

<div class="container">

    <div class="header">
        <img src="/MENUS/images/<?php echo htmlspecialchars($restaurant["image"]); ?>" class="logo">
        <h2><?php echo htmlspecialchars($restaurant["name"]); ?> - Menu</h2>
    </div>

    <?php if ($items->num_rows > 0): ?>

        <?php while ($row = $items->fetch_assoc()): ?>
            <div class="menu-item">

                <h3><?php echo htmlspecialchars($row["name"]); ?></h3>
                <p>Category: <?php echo htmlspecialchars($row["category"]); ?></p>
                <p>Price: <?php echo number_format($row["price"], 2); ?> EGP</p>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" onclick="return confirm('Delete this item?')">
                        Delete
                    </button>
                </form>
                <a href="../html/edit_item.php?id=<?php echo $row['id']; ?>">Edit</a>

            </div>
        <?php endwhile; ?>

    <?php else: ?>
        <p>No menu items found.</p>
    <?php endif; ?>

</div>

</body>
</html>