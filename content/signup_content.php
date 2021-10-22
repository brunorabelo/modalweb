<?php
// Include config file
require_once "../db/db.php";
require_once "../models/UserModel.php";
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}


// Define variables and initialize with empty values
$username = $password = $confirm_password = $adresse_mail = $numero_telephone = $adresse = "";
$username_err = $password_err = $confirm_password_err = $adresse_mail_err = $numero_telephone_err = $adresse_err = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validate username
    //check if empty
    if (empty(trim($_POST['username']))) {
        $username_err = 'Please enter username.';
    } elseif(!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"]))){//check if special caracter
        $username_err = "Username can only contain letters and numbers.";
    }else{
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['adresse_mail']))) {
        $adresse_mail = 'Please enter an email.';
    } elseif(filter_var(trim($_POST['adresse_mail']), FILTER_VALIDATE_EMAIL)) {//check si de la forme truc@bidule.chose
        $username_err = "Please enter a valid email.";
    }else{
        var_dump (UserModel::getUser($trim($_POST['adresse_mail'])));
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
            header('location: welcome.php');
        } else {
            $email_err = "Email or password invalid.";
        }
    }
}
?>
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Créer un compte</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Identifiant:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>    
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="adresse_mail">Adresse mail:</label>
                <input type="text" class="form-control" id="adresse_mail" name="adresse_mail" required>
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de téléphone:</label>
                <input type="number" class="form-control" id="numero_telephone" name="numero_telephone" >
            </div>
            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" class="form-control" id="adresse" name="adresse" >
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Vous avez déjà un compte ? <a href="login.php"> Connectez vous ici</a>.</p>
        </form>
    </div>    
</body>
</html>