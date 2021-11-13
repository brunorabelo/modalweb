<?php
// Include config file
require_once "../models/UserModel.php";
require_once 'utils/utils.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isLoggedIn()) {
    header("location: index.php");
    exit;
}

$user = $_SESSION['user'];


// Define variables and initialize with empty values
$password = $confirm_password = "";
$errors = array();
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty(trim($_POST['password']))) {
        $errors[] = 'Please enter a new password.';
    }

    if (empty(trim($_POST['confirm_password']))) {
        $errors[] = 'Please confirm your password.';
    } elseif (trim($_POST['password']) != trim($_POST['confirm_password'])) {//vérifie la confirmation du mdp
        $errors[] = 'Les deux mots de passes ne correspondent pas';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($errors) && empty($confirm_password_err)) {
        $res = UserModel::updatePassword($user, $password);
        if ($res)
            $success = true;
        else $errors[] = "An error occured";
    }
}


get_head();
get_header();
get_profile_navigation(1);

?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <h1 class="h3 mb-3 fw-normal">Modifier mot de passe</h1>
                <?php
                if ($success)
                    echo "<p style='color: green'>Your password has been successfully changed!</p>";
                else {
                    ?>
                    <form action="" method="post">
                        <?php
                        foreach ($errors as $error)
                            echo "<li style='color: red'>$error</li>"
                        ?>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmer le mot de passe:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

<?php

get_footer();

?>