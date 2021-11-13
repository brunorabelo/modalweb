<?php

require_once 'utils/utils.php';
require_once "../models/UserModel.php";
require_once "../models/AnnonceModel.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isLoggedIn()) {
    header("location: index.php");
    exit;
}

$user = $_SESSION['user'];

get_head();

get_header();

get_profile_navigation(2);

$annonces = AnnonceModel::getUserAnnonces($user);

list_products($annonces);

get_footer();
?>




