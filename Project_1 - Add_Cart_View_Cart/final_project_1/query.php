<?php

// start session
session_start();

$sql = "SELECT productid, productprice, producttype, productname, prodimg FROM product";

// run query
$output = mysqli_query($conn, $sql);

echo  "<div class='cont'>";

if(mysqli_num_rows($output) > 0) {

while ($row = mysqli_fetch_assoc($output)) {
    $prod_id = $row['productid'];

  echo
           "<div class='row'>
                <div class='card'>
                    <img src='" . $row['prodimg'] . "' alt='" . $row["productname"] . "' style='width: 100%'>
                    <h3 class='caption'>" . $row['productname'] . "</h3>
                    <p class='price'>$" . $row["productprice"] . "</p>
                    <form method='get' action='addcart.php'>
                        <input type='hidden' name='productid' value='" . $row ["productid"] . "'> 
                        <input type='hidden' name='productname' value='" . $row["productname"] . "'>
                        <input type='hidden' name='productprice' value='" . $row["productprice"] . "'>
                        <input type='hidden' name='product_image' value='" . $row["prodimg"] . "'>
                        <input type='number' name='quantity' value=' 1 '>
                        <button ='./addcart.php?productid=$prod_id'>Add to Cart</button>
                    </form>
                </div>
            </div>";

}
} else {
    echo "Error: " . mysqli_error($conn). "";

  }
    echo "</div>";