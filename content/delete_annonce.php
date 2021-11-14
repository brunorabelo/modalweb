<?php

require_once 'utils/utils.php';

require_once "../models/AnnonceModel.php";

if (!isLoggedIn()) {
    header('location: index.php');
    exit;
}

$id = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    $annonce = AnnonceModel::getAnnonceDetails($id);

    $annonce = AnnonceModel::getAnnonceDetails($id);
    if ($annonce->user_email != $_SESSION['user']->email) {
        header('location: mes_annonces.php');
        exit;
    }

    AnnonceModel::deleteAnnonce($annonce->id);
    $file = 'img/annonces/' . $annonce->photo;
    unlink($file);
    header('location: mes_annonces.php');
    exit;
}

if (!$id) {
    header('location: index.php');
    exit;
}

$annonce = AnnonceModel::getAnnonceDetails($id);

if (!$annonce) {
    header('location: index.php');
    exit;
}

get_head();

get_header();

get_navigation();


get_breadcrumb($annonce);

?>
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <form action="" method="post">
                    <p><?php echo 'Are you sure you want to delete "' . $annonce->title . '"?'; ?></p>
                    <input id="id" name="id" type="hidden" value="<?php echo $annonce->id ?>">
                    <button class="btn btn-primary" type="submit">Yes</button>
                    <button class="btn btn-secondary" onclick="history.back()" type="button">No</button>
                </form>
            </div>
        </div>
    </div>
<?php
get_footer();
?>