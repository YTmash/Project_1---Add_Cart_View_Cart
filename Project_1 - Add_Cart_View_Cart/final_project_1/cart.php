<?php
session_start();
include 'dbc.php'; 

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

$productIds = array_keys($_SESSION['cart']);
$ids = implode(',', array_map('intval', $productIds));

$query = "SELECT * FROM product WHERE productid IN ($ids)";
$result = $conn->query($query);
?>
<h1>Your Shopping Cart</h1>
<ul>
    <?php while ($row = $result->fetch_assoc()): ?>
        <li>
            <img src="<?= $row['prodimg'] ?>" alt="<?= $row['productname'] ?>" style="width:50px;height:50px;">
            <?= $row['prodimg'] ?> - $<?= $row['productprice'] ?>
            <a href="products.php?id=<?= $row['productid'] ?>">View Details</a>
        </li>
    <?php endwhile; ?>
</ul>
