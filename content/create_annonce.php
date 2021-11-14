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


// Define variables and initialize with empty values
$title = $description = $price = $place = $quantity = $photo = "";
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validate title
    //check if empty
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


    if (empty(trim($_POST['price']))) {
        $errors[] = 'Please set a price.';
    } else {
        $price = trim($_POST['price']);
    }

    if (true) {
        $quantity = trim($_POST['quantity']);
    }


    if (true) {
        $place = trim($_POST['adresse']);
    }
    if (true) {
        $category = trim($_POST['category']);
    }
    $dir = 'img/annonces/';

    $filename = tempnam($dir, 'IMG');
    unlink($filename);
    $filename = str_replace('.tmp','',$filename);
    $photo = substr($filename, strpos($filename, "IMG"));
    if (!$dir = uploadImage($filename)) {
        $errors[] = "A problem occured while uploading the image.";
    }


    if (empty($errors)) {
        $user_email = $_SESSION['user']->email;
        $res = AnnonceModel::insererAnnonce($title, $description, $quantity, $place, $user_email, $price, $category, $photo);
        if ($res) {
            header('location: mes_annonces.php');
            exit;
        }
        else $errors[] = "Error inserting annonce";
    }

}


get_head();
get_header();


?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <h1 class="h3 mb-3 fw-normal">Créer une annonce</h1>
                <?php
                foreach ($errors as $error)
                    echo "<li style='color: red'>$error</li>"
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Titre de l'annonce:</label>
                        <input type="text" class="form-control" id="title" name="title" required
                               value="<?php echo htmlspecialchars($title) ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <?php
                        get_categories_select($category ?? null);
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"
                                  required><?php echo htmlspecialchars($description) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Photo :</label>
                        <input type="file" name="photo" value="<?php echo $_FILES['photo']['name'] ?? null ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix :</label>
                        <input type="number" class="form-control" placeholder="0.00" step="0.01" id="price" name="price"
                               required value="<?php echo htmlspecialchars($price) ?>">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Où récupérer l'objet :</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required
                               value="<?php echo htmlspecialchars($place)?>">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantité :</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                               value="<?php echo htmlspecialchars($quantity) ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
get_footer();
?>