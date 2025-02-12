<?php

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define the number of ../ to get to the root folder
define('ROOT_LEVEL', './');

// Change title and include header
$page_title = "MK's Sports Store | By MK";
include __DIR__ . '/inc/header.php';

// Include database connection
include 'dbc.php';

// Page header with cart icon
echo "<div class='w3-container w3-teal'>
        <h1>{$page_title} <a href='viewcart.php'>
        <i class='fas fa-shopping-cart' id='carticon' title='View Cart'></i></a></h1>
      </div>";

// Create table for the cart
echo '<table style="width:100%">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>';

// Check if cart is not empty
if (!empty($_SESSION['cart'])) {
    // Build the SQL query to fetch the products in the cart
    $sql = "SELECT * FROM product WHERE productid IN (" . implode(",", array_keys($_SESSION['cart'])) . ") ORDER BY productname ASC";
    
    // Execute the query
    $result = $conn->query($sql);

    // If products found, display them
    if ($result && $result->num_rows > 0) {
        $total = 0;

        // Start the form to update cart quantities and delete items
        echo '<form method="POST" action="viewcart.php">';

        while ($product = $result->fetch_assoc()) {
            $productId = htmlspecialchars($product['productid']);
            $productName = htmlspecialchars($product['productname']);
            $productPrice = htmlspecialchars($product['productprice']);
            $quantity = isset($_SESSION['cart'][$productId]) ? (int)$_SESSION['cart'][$productId] : 0;
            $subtotal = $quantity * $productPrice;
            $total += $subtotal;

            // Display each product in the cart with Update and Delete buttons
            echo "<tr>
                    <td>{$productId}</td>
                    <td>{$productName}</td>
                    <td>\${$productPrice}</td>
                    <td>
                        <input type='number' name='quantity-{$productId}' value='{$quantity}' min='0'>
                    </td>
                    <td>\${$subtotal}</td>
                    <td>
                        <button type='submit' name='update_cart' class='w3-button w3-green'>Update</button>
                        <button type='submit' name='delete_item' value='{$productId}' class='w3-button w3-red'>Delete</button>
                    </td>
                  </tr>";
        }

        echo '</table>'; // Close the table

        // Display total price and buttons
        echo "<div class='cart-summary'>
                <p>Total: \${$total}</p>
                <button type='submit' name='update_cart' class='w3-button w3-green'>Update Cart</button>
                <a href='checkout.php'><input type='button' class='w3-button w3-blue' value='Checkout'></a>
              </div>";

        echo '</form>'; // Close the form
    } else {
        echo '<div class="emptycart w3-camo-green"><p><span class="carterror"><strong>Oh no, your cart is currently empty!</span> Come on, buy some stuff!</strong></p></div>';
    }
} else {
    // If the cart is empty, display a message
    echo '<div class="emptycart w3-camo-green"><p><span class="carterror"><strong>Oh no, your cart is currently empty!</span> Come on, buy some stuff!</strong></p></div>';
}

// Update product quantities
if (isset($_POST['update_cart']) && isset($_SESSION['cart'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'quantity-') === 0 && is_numeric($value)) {
            $productId = str_replace('quantity-', '', $key);
            $quantity = (int)$value;

            if ($quantity > 0) {
                $_SESSION['cart'][$productId] = $quantity;
            } else {
                // Remove the product from the cart if quantity is 0
                unset($_SESSION['cart'][$productId]);
            }
        }
    }

    // Redirect to avoid form resubmission
    header('Location: viewcart.php');
    exit;
}

// Delete item from the cart
if (isset($_POST['delete_item'])) {
    $productIdToDelete = $_POST['delete_item'];
    if (isset($_SESSION['cart'][$productIdToDelete])) {
        unset($_SESSION['cart'][$productIdToDelete]);
    }

}


// Include footer
include __DIR__ . '/inc/footer.php';


	// $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    // $products = $stmt->fetchAll(PDO::FETCH_ASSOC);