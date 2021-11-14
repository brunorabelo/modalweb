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
$errors = array();
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Check if nom is empty
    if (empty(trim($_POST['nom']))) {
        $errors[] = 'Please enter your nom.';
    } else $nom = $_POST['nom'];

    // check if prenom is empty
    if (empty(trim($_POST['prenom']))) {
        $errors[] = 'Please enter your prenom.';
    } else $prenom = $_POST['prenom'];


    if (true) {
        $numero_telephone = trim($_POST['numero_telephone']);
    }


    if (true) {
        $adresse = trim($_POST['adresse']);
    }

    if (empty($errors)) {
        $user = $_SESSION['user'];
        UserModel::updateUser($user, $nom, $prenom, $numero_telephone, $adresse);
        $user = UserModel::getUser($user->email);
        $_SESSION['user'] = $user;
        $success = true;
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

            <?php
            if ($success)
                echo "<p style='color: green'>Your personal data has been successfully changed!</p>";
            else {
                foreach ($errors as $error)
                    echo "<li style='color: red'>$error</li>";
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($user->nom) ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom"
                           value="<?php echo htmlspecialchars($user->prenom) ?>">
                </div>
                <div class="form-group">
                    <label for="numero_telephone">Numéro de téléphone:</label>
                    <input type="tel" class="form-control" id="numero_telephone" name="numero_telephone"
                           value="<?php echo htmlspecialchars($user->phone) ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" id="adresse" name="adresse"
                           value="<?php echo htmlspecialchars($user->address) ?>">
                </div>
                <div class="form-group">
                    <label for="adresse_mail">Adresse mail:</label>
                    <input type="text" class="form-control" id="adresse_mail" name="adresse_mail"
                           value="<?php echo htmlspecialchars($user->email) ?>" disabled>
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