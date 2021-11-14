<?php

require_once 'utils/utils.php';

require_once "../models/AnnonceModel.php";

get_head();

get_header();

get_navigation(0);

$annonces = AnnonceModel::getAllAnnonces();

list_products($annonces);

get_footer();
?>




