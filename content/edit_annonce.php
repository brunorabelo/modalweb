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
    if (!$id || !$annonce || !checkAuthorization($annonce->user_email))
        header("location: mes_annonces.php");
}

// Define variables and initialize with empty values
$title = $description = $price = $place = $quantity = $photo = "";
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Validate title
    //check if empty
    $id = trim($_POST['id']);
    $annonce = AnnonceModel::getAnnonceDetails($id);
    if (!$annonce)
        $errors[] = "Problem updating the annonce";
    if (empty(trim($_POST['title']))) {
        $errors[] = 'Please enter a title.';
    } else {
        $title = trim($_POST['title']);
    }

    if (empty(trim($_POST['description']))) {
        $errors[] = 'Please enter a description.';
    } else {
        $description = trim($_POST['description']);
    }

    $test = '';
    if (empty(trim($_POST['price']))) {
        $errors[] = 'Please set a price.';
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
    $photo = $annonce->photo;

    if (!empty($_FILES['photo']['tmp_name'])) {
        $dir = 'img/annonces/';
        $oldFilename = $dir . $annonce->photo;
        unlink($oldFilename);
        $filename = tempnam($dir, 'IMG_');
        unlink($filename);
        $photo = substr($filename, strpos($filename, "IMG_"));
        if (!$dir = uploadImage($filename)) {
            $errors[] = "A problem occured while uploading the image.";
        }
    }

    $user_email = $_SESSION['user']->email;
    if (!checkAuthorization($annonce->user_email))
        $errors[] = "You are not allowed to edit this annonce";
    if (empty($errors)) {
        AnnonceModel::updateAnnonce($id, $title, $description, $quantity, $adresse, $price, $category, $photo);
        $annonce = AnnonceModel::getAnnonceDetails($id);
    }
}


get_head();
get_header();


?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <h1 class="h3 mb-3 fw-normal">Editer l'annonce</h1>
                <?php
                foreach ($errors as $error)
                    echo "<li style='color: red'>$error</li>"
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?php echo $annonce->id ?>">
                    <div class="form-group">
                        <label for="title">Titre de l'annonce:</label>
                        <input type="text" class="form-control" id="title" name="title" required
                               value="<?php echo htmlspecialchars($annonce->title) ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <?php
                        get_categories_select($annonce->category_id);
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"
                                  required><?php echo htmlspecialchars($annonce->description) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Current Photo: </label>
                        <!-- Product thumb imgs -->
                        <div class="container">
                            <!-- row -->
                            <div class="row">
                                <img src="./img/annonces/<?php echo htmlspecialchars($annonce->photo) ?>" alt="">
                            </div>
                        </div>
                        <label for="photo">Photo :</label>
                        <input type="file" name="photo" accept="image/png, image/jpeg"/>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix :</label>
                        <input type="number" class="form-control" placeholder="0.00" step="0.01" id="price" name="price"
                               required
                               value="<?php echo htmlspecialchars($annonce->price) ?>">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Où récupérer l'objet :</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required
                               value="<?php echo htmlspecialchars($annonce->place) ?>">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantité :</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                               value="<?php echo htmlspecialchars($annonce->quantity) ?>">
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