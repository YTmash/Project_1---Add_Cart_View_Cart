<?php 
session_start();

$self=basename(($_SERVER['PHP_SELF']));
$page_title="Log in | by User";
include('inc/header.php');


if(isset($errors) && !empty($errors)){
    echo('<div class="container"><h1>Hold on!...</h1><p>There is some missing information</p><p class="w3-red">');
    foreach($errors as $msg){
        echo "- $msg<br>";
    }
    echo '</p><p>Invalid information!</p>';
  }

    ?>

  
<div class="container">
    <form action="login.php" method="post"> 
        <label for="uname"><b>Username</b></label><br>
        <input type="text" id="uname" name="email" placeholder="Enter Email" required><br>

        <label for="psw"><b>Password</b></label><br>
        <input type="password" id="psw" name="password" placeholder="Enter Password" required><br>

        <button type="submit">Login</button><br>

        <label>
            <input type="checkbox" name="remember"> Remember me
        </label>
    </form>
</div>

<div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn" onclick="window.location.href='index.php';">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
</div>

<?php include('inc/footer.php'); ?>
