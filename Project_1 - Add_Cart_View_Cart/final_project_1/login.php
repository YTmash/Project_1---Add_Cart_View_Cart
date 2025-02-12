<?php
// Start the session


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Require the helper file for login and the database connection
    require('./inc/loginfunctions.php');
    include 'dbc.php';


    list($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);

    // Name of page
    $page_title = "MK's Sports Store | Login";


    if($check) {
        $_SESSION['userid'] = $data['id'];
        $_SESSION['firstname'] = $data['f_name'];
        $_SESSION['lastname'] = $data['l_name'];
        $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);

    

    // Redirect the user to loggedin.php
        redirect_user('loggedin.php');
    } else {
        $errors = $data;
        print_r($errors);
    }

    mysqli_close($dbc);

}

    include('inc/loginpage.php');


    // Footer
    include('./inc/footer.php');
    ?>
