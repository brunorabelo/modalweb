<?php

require_once 'utils/utils.php';
require_once "../models/AnnonceModel.php";
require_once "../models/CategoryModel.php";

$categories = CategoryModel::getCategories();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $category = $_GET['category'] ?? null;
    $search = $_GET['search'] ?? null;

    $annonces = AnnonceModel::getAnnonces($search, $category);
}

get_head();
get_header();
list_products($annonces);
get_footer();


?>

