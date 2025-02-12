<?php

session_start();

if (isset($_GET['productid'])) {
    $productId = $_GET['productid'];

    // Check if cart is already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to cart
    $_SESSION['cart'][$productId] = 1; // Quantity can be managed accordingly

    header("Location: cart.php");
    exit;


    echo '<button>Update Cart</button>';
    echo '<button>Checkout</button>';
}
