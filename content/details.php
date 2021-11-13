<?php

require_once 'utils/utils.php';

require_once "../models/AnnonceModel.php";

$id = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;
}

if (!$id)
    header('location: index.php');

get_head();

get_header();

get_navigation();

$annonce = AnnonceModel::getAnnonceDetails($id);
if (!$annonce)
    header('location: index.php');

get_breadcrumb($annonce);

get_annonce_details($annonce);

get_footer();
?>