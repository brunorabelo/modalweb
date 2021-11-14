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
if (!$email) {
    header('location: users.php');
    exit;
}

$nom = $prenom = $newEmail = $adresse = $numero_telephone = $password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);

    if ($_POST['send'] == 'delete') {
        UserModel::deleteUser($email);
        if ($email === $_SESSION['user']->email)
            header('location: logout.php');
        else
            header("location: users.php");
        exit;
    }
    // Check if nom is empty
    if (empty(trim($_POST['nom']))) {
        $errors[] = 'Please enter a nom.';
    } else $nom = $_POST['nom'];

    // check if prenom is empty
    if (empty(trim($_POST['prenom']))) {
        $errors[] = 'Please enter a prenom.';
    } else $prenom = $_POST['prenom'];


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
    var_dump($_POST['is_admin']);

    $is_admin = 0;
    if (isset($_POST['is_admin']) && $_POST['is_admin'])
        $is_admin = 1;

    if (true) {
        $adresse = trim($_POST['adresse']);
    }

    if (empty($errors)) {
        UserModel::updateUserByAdmin($email, $newEmail, $nom, $prenom, $numero_telephone, $adresse, $password, $is_admin);
        $success = true;
        header('location: users.php');
        exit;
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
                <h1 class="h3 mb-3 fw-normal">Modifier compte de <? echo htmlspecialchars($user->email) ?></h1>

                <?php
                if ($success)
                    echo "<p style='color: green'>The personal data has been successfully changed!</p>";
                else {
                    foreach ($errors as $error)
                        echo "<li style='color: red'>$error</li>";
                }
                ?>
                <form action="" method="post">
                    <input type="hidden" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom"
                               value="<?php echo htmlspecialchars($user->nom) ?>">
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
                        <label for="adresse_mail">Adresse mail:</label>
                        <input type="text" class="form-control" id="adresse_mail" name="adresse_mail" required
                               value="<?php echo htmlspecialchars($user->email) ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse"
                               value="<?php echo htmlspecialchars($user->address) ?>">
                    </div>
                    <div class="form-group">
                        <label for="is_admin">Admin:</label>
                        <input type="checkbox" id="is_admin" name="is_admin"
                               value="1" <?php echo $user->is_admin ? 'checked' : '' ?>>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" name="send" value="update" class="btn btn-primary">Modifier
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" name="send" value="delete" class="btn btn-danger"
                                    onclick="return confirm('All the annonces related to the user will be deleted. Are you sure you want to continue?');">
                                Delete user
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php

get_footer();

?>