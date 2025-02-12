<?php

// start session
if(session_status() === PHP_SESSION_NONE) session_start();

$self = basename($_SERVER['PHP_SELF']);
$page_title = 'Added to cart | By MK';

include ('inc/header.php');
echo "<div class='w3-container w3-teal'><h1>" . $page_title . "<a href='viewcart.php'><i class='fas fa-shopping-cart' id='carticon' title='View Cart'></i></a></h1></div>";

if (isset($_GET['productid']) && filter_var($_GET['productid'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
    // Get and set product ID
    $prod_id = $_GET['productid'];
    // Start cart container
    echo '<div class="addcart">';

    // End of the div container
    echo '</div>'; 

    // Include database connection file
    require_once 'dbc.php';

    // select product info
    $sql = "SELECT productprice FROM product WHERE productid=$prod_id";

    // run the query
    $result = $conn->query($sql);

    // check to see if a value was returned
    if (mysqli_num_rows($result) == 1) {
        // found the price in the DB now we save to a variable
        list($price) = mysqli_fetch_array($result, MYSQLI_NUM);

        // setup the session cart array for this product
        $_SESSION['cart'][$prod_id] = array('quantity' => 1, 'price' => $price);

        // display confirmation to user
        echo '<div class="w3-container w3-teal"><p class="indent">An item has been added to your cart!</p>';
    }

    // check if cart already contains this product


    $productImage = isset($_POST['prodimg']) ? $_POST['prodimg'] : 'default.jpg';

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT productprice, prodimg, productname FROM product WHERE productid = ?");
    $stmt->bind_param("i", $prod_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        list($price) = $result->fetch_array(MYSQLI_NUM);

        // Setup session cart array for this product
        $_SESSION['cart'][$prod_id] = array('quantity' => 1, 'price' => $price);
    } else {
        require_once 'dbc.php';
    }

    $row = mysqli_fetch_assoc($result);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid product ID.';
}






/////////////////////////////////////////////////////////////////////////////////////////////////
//     $_SESSION['cart'][] = [
//     'id' => $prod_Id,
//     'image' => $productImage,
//     'quantity' => $quantity 
//     'price' => $product['price'] 
// ];

        //header('Location: index.php');
        //exit; //

        

    // Set the post variables so we easily identify them, also make sure they are integer

    // if (isset($_POST['productid'])) {
    //     $productId = $_POST['productid'];
    // } else {
    //     echo "Product ID is not set.";
    //     exit; 
  
    // }


    //  <td> ' . $row['productname'] . 'Product Name</td>


    // // create viewcart table 
	// 	echo '<table>
	// 			<tr>
	// 				<th>Product ID</th>
	// 				<th>Product Name</th>
	// 				<th>Product Price</th>
    //                 <th>Quantity</th>
    //                 <th>Subtotal</th>
    //                 <th>Total</th>
	// 			</tr>

    //             <tr>
    //             <td> ' . $prod_id . 'Product ID</td>
    //             </tr>
            

	// 		</table>'


    //     if (isset($_SESSION['cart'][$prod_id])) {
    //     $_SESSION['cart'][$prod_id]['quantity']++; // add 1 to quantity of product in cart
    // }
    