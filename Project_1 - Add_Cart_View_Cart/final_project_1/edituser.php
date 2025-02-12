<?php
if(session_status() == PHP_SESSION_NONE) session_start();




// set query for DB


$sql ="SELECT firstname, lastname, email, password, registrationdate FROM MK's Sports Store_users WHERE userid = 
$userid";


// run the query
$result = mysqli_query($dbc, $sql);


// check the result
if(mysqli_num_rows($result) == 1) {


// fetch the result
$row = mysqli_fetch_array($result, MYSQLI_ASSOC)
}

?>

<h2>Account Information</h2>
<p>Change information as needed and select UPDATE ACCOUNT or you can simply select DELETE ACCOUNT</p>
<form name="edit user" action="edituser.php" method="post">
<label for="userid">Customer # (<i> can't be changed</i>)</label>
<input class="w3-red" name="userid" type="text" value="<?php if (isset($_SESSION['userid'])) 
echo $_SESSION['userid']; ?>" readonly>
<label for="firstname">First Name</label>
<input type="text" name="firstname" value="<?php if (isset($row['firstname'])) echo 