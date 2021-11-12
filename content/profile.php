<?php
// Include config file
require_once "../models/UserModel.php";
require_once 'utils/utils.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isLoggedIn()) {
    header("location: index.php");
    exit;
}


// Define variables and initialize with empty values
$password = $confirm_password = $adresse_mail = $numero_telephone = $adresse = "";
$password_err = $confirm_password_err = $adresse_mail_err = $numero_telephone_err = $adresse_err = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (empty(trim($_POST['adresse_mail']))) {
        $adresse_mail = 'Please enter an email.';
    } elseif (!filter_var(trim($_POST['adresse_mail']), FILTER_VALIDATE_EMAIL)) {//check si de la forme truc@bidule.chose
        $adresse_mail_err = "Please enter a valid email.";
    } elseif (UserModel::getUser(trim($_POST['adresse_mail'])) == null) {
        $adresse_mail = trim($_POST['adresse_mail']);
    } else {
        $adresse_mail_err = "This email allready has an account";
    }


    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    }
    if (empty(trim($_POST['confirm_password']))) {
        $password_err = 'Please confirm your password.';
    } elseif (trim($_POST['password']) != trim($_POST['confirm_password'])) {//vérifie la confirmation du mdp
        $confirm_password_err = ' les deux mots de passes ne correspondent pas';
    } else {
        $password = trim($_POST['password']);
    }


    if (true) {
        $numero_telephone = trim($_POST['numero_telephone']);
    }


    if (true) {
        $adresse = trim($_POST['adresse']);
    }


    if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        UserModel::insererUtilisateur($password, $numero_telephone, $adresse, $adresse_mail);
    } else {
        $password_err = $confirm_password_err = $adresse_mail_err = $numero_telephone_err = $adresse_err = "";
    }

}


$user = $_SESSION['user'];

get_head();
get_header();
get_profile_navigation(0);

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 ">
            <h1 class="h3 mb-3 fw-normal">Modifier compte</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom">
                </div>
                <div class="form-group">
                    <label for="numero_telephone">Numéro de téléphone:</label>
                    <input type="tel" class="form-control" id="numero_telephone" name="numero_telephone"
                           value="<?php echo $user->phone ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" id="adresse" name="adresse"
                           value="<?php echo $user->address ?>">
                </div>
                <div class="form-group">
                    <label for="adresse_mail">Adresse mail:</label>
                    <input type="text" class="form-control" id="adresse_mail" name="adresse_mail"
                           value="<?php echo $user->email ?>" disabled>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Modifier">
                </div>
            </form>
        </div>
    </div>
</div>

<?php

get_footer();

?>


<!--<!DOCTYPE html>-->
<!--<html lang="fr">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Sign Up</title>-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
<!--    <style>-->
<!--        body{ font: 14px sans-serif; }-->
<!--        .wrapper{ width: 360px; padding: 20px; }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--    <div class="wrapper">-->
<!--        <h2>Créer un compte</h2>-->
<!--        <form action="" method="post">-->
<!--            <div class="form-group">-->
<!--                <label for="password">Mot de passe:</label>-->
<!--                <input type="password" class="form-control" id="password" name="password" required>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="confirm_password">Confirmer le mot de passe:</label>-->
<!--                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="adresse_mail">Adresse mail:</label>-->
<!--                <input type="text" class="form-control" id="adresse_mail" name="adresse_mail" required>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="numero_telephone">Numéro de téléphone:</label>-->
<!--                <input type="number" class="form-control" id="numero_telephone" name="numero_telephone" >-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="adresse">Adresse:</label>-->
<!--                <input type="text" class="form-control" id="adresse" name="adresse" >-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <input type="submit" class="btn btn-primary" value="Submit">-->
<!--                <input type="reset" class="btn btn-secondary ml-2" value="Reset">-->
<!--            </div>-->
<!--            <p>Vous avez déjà un compte ? <a href="login.php"> Connectez vous ici</a>.</p>-->
<!--        </form>-->
<!--    </div>    -->
<!--</body>-->
<!--</html>-->