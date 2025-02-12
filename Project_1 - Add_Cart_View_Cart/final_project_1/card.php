<?php
include '../final_project_2/dbc.php'; // Connect to database

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT productid, productname, prodimg, productprice FROM product";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prod_id = $row["productid"];
        $prod_name = $row["productname"];
        $prod_price = $row["productprice"];
        $prod_img = $row["prod_img"];

        echo "<div class='card'>
                <img src='$prod_img'>
                <h3>$prod_name</h3>
                <p class='price'>$ $prod_price</p>
                <p><img src='$prod_img'></p>
                <a href='addcart?prod_id=$prod_id'><button>Add to Cart</button></a>
              </div>";
    }
    
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>