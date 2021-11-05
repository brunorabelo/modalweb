<?php
// Include config file
require_once "../db/db.php";
require_once "../models/UserModel.php";
require_once "../models/AnnonceModel.php";
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}


// Define variables and initialize with empty values
$title = $description = $price = $place = $quantity = $photo = "";
$title_err = $description_err = $price_err = $place_err = $quantity_err = $photo_err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validate title
    //check if empty
    if (empty(trim($_POST['title']))) {
        $title_err = 'Please enter a title.';
    } elseif(!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["title"]))){//check if special caracter
        $title_err = "title can only contain letters and numbers.";
    }else{
        $title = trim($_POST['title']);
    }

    if (empty(trim($_POST['adresse_mail']))) {
        $adresse_mail = 'Please enter an email.';
    } elseif(!filter_var(trim($_POST['adresse_mail']), FILTER_VALIDATE_EMAIL)) {//check si de la forme truc@bidule.chose
        $adresse_mail_err = "Please enter a valid email.";
    }elseif (UserModel::getUser(trim($_POST['adresse_mail']))==null){
        $adresse_mail = trim($_POST['adresse_mail']);
    }
    else{
        $adresse_mail_err = "This email allready has an account";
    }
    

    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter your password.';
    }else{
        $password = trim($_POST['password']);
    }

    if (empty(trim($_POST['price']))) {
        $password_err = 'Please set a price.';
    }else{
        $password = trim($_POST['password']);
    }

    if (true){
        $numero_telephone = trim($_POST['numero_telephone']);
    }


    if (true){
        $adresse = trim($_POST['adresse']);
    }



    if (empty($title_err) && empty($_err)&& empty($_err) && empty($_err)){
        AnnonceModel::insererAnnonce($title, $description, $quantity, $user_email, $price, $category_id, $photo);
    }
    else{
        $title_err = $password_err = $confirm_password_err = $adresse_mail_err = $numero_telephone_err = $adresse_err = "";
    }

}
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
        <h2>Créer une annonce</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Titre de l'annonce:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>    
            <div class="form-group">
                <label for="password">Description:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <form action=method="post" enctype="multipart/form-data">
                <label for="title">Photo :</label>
                <input type="file" name="photo"/>
                <br>
                <input type="submit" value="envoyer" />
            </form>
            <div class="form-group">
                <label for="confirm_password">Prix :</label>
                <input type="password" class="form-control" id="confirm_password" name="price" required>
            </div>
            <div class="form-group">
                <label for="adresse_mail">Où récupérer l'objet :</label>
                <input type="text" class="form-control" id="adresse_mail" name="adresse_mail" required>
            </div>
            <div class="form-group">
                <label for="numero_telephone">Quantité :</label>
                <input type="number" class="form-control" id="numero_telephone" name="numero_telephone" >
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>