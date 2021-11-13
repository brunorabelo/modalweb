<?php
// Include config file
require_once 'utils/utils.php';
require_once "../models/UserModel.php";
require_once "../models/AnnonceModel.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isLoggedIn()) {
    header("location: index.php");
    exit;
}

$id = null;
$annonce = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;
    $annonce = AnnonceModel::getAnnonceDetails($id);
    if (!$id || !$annonce)
        header("location: mes_annonces.php");
}

// Define variables and initialize with empty values
$title = $description = $price = $place = $quantity = $photo = "";
$title_err = $description_err = $price_err = $place_err = $quantity_err = $photo_err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Validate title
    //check if empty
    $id = trim($_POST['id']);
    if (empty(trim($_POST['title']))) {
        $title_err = 'Please enter a title.';
    } else {
        $title = trim($_POST['title']);
    }


    if (empty(trim($_POST['price']))) {
        $price_err = 'Please set a price.';
    } else {
        $price = trim($_POST['price']);
    }

    if (true) {
        $quantity = trim($_POST['quantity']);
    }


    if (true) {
        $adresse = trim($_POST['adresse']);
    }
    if (true) {
        $category = trim($_POST['category']);
    }


    if (empty($title_err) && empty($_err) && empty($_err) && empty($_err)) {
        $user_email = $_SESSION['user']->email;
        AnnonceModel::updateAnnonce($id, $title, $description, $quantity, $adresse, $user_email, $price, $category, $photo);
    } else {
        $title_err = $password_err = $price_err = $adresse_mail_err = $numero_telephone_err = $adresse_err = "";
    }

}


get_head();
get_header();


?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <h1 class="h3 mb-3 fw-normal">Editer l'annonce</h1>
                <form action="" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $annonce->id?>">
                    <div class="form-group">
                        <label for="title">Titre de l'annonce:</label>
                        <input type="text" class="form-control" id="title" name="title" required
                               value="<?php echo $annonce->title ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <?php
                        get_categories_select($annonce->category_id);
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="password" name="description" required><?php echo $annonce->description ?></textarea>
                    </div>
                    <div class="form-group">
                        <!--                        <form action=method="post" enctype="multipart/form-data">-->
                        <!--                            <label for="title">Photo :</label>-->
                        <!--                            <input type="file" name="photo"/>-->
                        <!--                            <input type="submit" class="btn btn-secondary" value="envoyer"/>-->
                        <!--                        </form>-->
                    </div>
                    <div class="form-group">
                        <label for="price">Prix :</label>
                        <input type="number" class="form-control" placeholder="0.00" id="price" name="price" required value="<?php echo $annonce->price ?>">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Où récupérer l'objet :</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required value="<?php echo $annonce->place ?>">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantité :</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $annonce->quantity ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
get_footer();
?>