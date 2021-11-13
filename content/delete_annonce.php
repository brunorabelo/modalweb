<?php

require_once 'utils/utils.php';

require_once "../models/AnnonceModel.php";

if (!isLoggedIn())
    header('location: index.php');

$id = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'] ?? null;
    AnnonceModel::deleteAnnonce($id);
    header('location: mes_annonces.php');
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

?>
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <form action="" method="post">
                    <p><?php echo 'Are you sure you want to delete "' . $annonce->title . '"?'; ?></p>
                    <input id="annonce_id" name="annonce_id" type="hidden" value="<?php echo $annonce->id ?>">
                    <button class="btn btn-primary" type="submit">Yes</button>
                    <button class="btn btn-secondary" onclick="history.back()" type="button">No</button>
                </form>
            </div>
        </div>
    </div>
<?php
get_footer();
?>