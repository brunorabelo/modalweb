<?php
// Include config file
require_once "../models/UserModel.php";
require_once 'utils/utils.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isLoggedIn() || !isAdmin()) {
    header("location: index.php");
    exit;
}


$errors = array();
$success = false;

$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email = $_GET['user'] ?? null;
}
if (!$email)
    header('location: users.php');

$nom = $prenom = $newEmail = $adresse = $numero_telephone = $password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if nom is empty
    if (empty(trim($_POST['nom']))) {
        $errors[] = 'Please enter a nom.';
    } else $nom = $_POST['nom'];

    // check if prenom is empty
    if (empty(trim($_POST['prenom']))) {
        $errors[] = 'Please enter a prenom.';
    } else $prenom = $_POST['prenom'];

    $email = trim($_POST['email']);

    if (empty(trim($_POST['email']))) {
        $errors[] = 'Please insert an email';
    } else $newEmail = $_POST['email'];

    if (true) {
        $numero_telephone = trim($_POST['numero_telephone']);
    }
    $password = null;
    if (empty(trim($_POST['password']))) {
        $password = null;
    } else
        $password = trim($_POST['password']);

    if (true) {
        $adresse = trim($_POST['adresse']);
    }

    if (empty($errors)) {
        UserModel::updateUserByAdmin($email, $newEmail, $nom, $prenom, $numero_telephone, $adresse, $password);
        $success = true;
        header('location: users.php');
    }
}


$user = UserModel::getUser($email);

get_head();
get_header();
get_profile_navigation(3);

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 ">
            <h1 class="h3 mb-3 fw-normal">Modifier compte de <? echo $user->email ?></h1>

            <?php
            if ($success)
                echo "<p style='color: green'>The personal data has been successfully changed!</p>";
            else {
                foreach ($errors as $error)
                    echo "<li style='color: red'>$error</li>";
            }
            ?>
            <form action="" method="post">
                <input type="hidden" name="email" id="email" value="<?php echo $email ?>">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user->nom ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom"
                           value="<?php echo $user->prenom ?>">
                </div>
                <div class="form-group">
                    <label for="numero_telephone">Numéro de téléphone:</label>
                    <input type="tel" class="form-control" id="numero_telephone" name="numero_telephone"
                           value="<?php echo $user->phone ?>">
                </div>
                <div class="form-group">
                    <label for="adresse_mail">Adresse mail:</label>
                    <input type="text" class="form-control" id="adresse_mail" name="adresse_mail" required
                           value="<?php echo $user->email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" id="adresse" name="adresse"
                           value="<?php echo $user->address ?>">
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