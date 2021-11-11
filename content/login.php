<?php
require_once "utils/utils.php";
require_once "../models/UserModel.php";
session_start();


// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}


$email = $password = '';
$email_err = $password_err = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if username is empty
    if (empty(trim($_POST['email']))) {
        $email_err = 'Please enter username.';
    } else {
        $email = trim($_POST['email']);
    }
    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    } else {
        $password = trim($_POST['password']);
    }
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $user = UserModel::login($email, $password);
        if ($user) {
            // Start a new session
            session_start();

            // Store data in sessions
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;

            // Redirect to user to page
            header('location: index.php');
        } else {
            $email_err = "Email or password invalid.";
        }
    }
}


get_head();
get_header();


?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <form action="" method="post">

                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-group">
                    <label for="floatingInput">Email address:</label>
                    <input type="email" class="form-control" name="email" id="floatingInput"
                           placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="floatingPassword">Password:</label>
                    <input type="password" class="form-control" name="password" id="floatingPassword"
                           placeholder="Password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

get_footer();

?>